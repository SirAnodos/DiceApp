<?php

// object which performs account functions
Class AccountHandler {
    private $uname;
    private $pwd;
    private $connection;

    public function __construct(string $uname = '', string $pwd = '') {
        $this->uname = $uname;
        $this->pwd = $pwd;
        include("./database/database.php");
        $this->connection = dbConnect();
    }

    // login to account
    public function login() {
        // db query: get user
        $qry = $this->connection->prepare("SELECT id, password FROM `users` WHERE username = ?");
        $qry->bind_param('s', $this->uname);
        $qry->execute();
        $qry->store_result();

        // if user exists, try to validate
        if ($qry->num_rows === 1) {
            $qry->bind_result($id, $pwdHash);
            $qry->fetch();

            // verify password, echo proper response for success or failure
            if (password_verify($this->pwd, $pwdHash)) {
                // set session variables if successful
                $_SESSION['uid'] = $id;
                $_SESSION['uname'] = $this->uname;
                return array(200, "Login successful.");
            } else {
                return array(401, "Password incorrect.");
            }
        // user does not exist
        } else {
            return array(401, "Invalid username.");
        }
    }

    // logout of account
    public function logout() {
        // unset session variables
        session_unset();
        return array(200, "Logged out.");
    }

    // register new accont
    public function register() {
        // check for valid username and password
        if ($this->uname == '') {
            return array(422, "Username required.");
        } else if ($this->pwd == '') {
            return array(422, "Password required.");
        // if username and password are valid, try to register account
        } else {
            // db query: get user to check if username is available
            $qry = $this->connection->prepare("SELECT id FROM `users` WHERE username = ?");
            $qry->bind_param('s', $this->uname);
            $qry->execute();
            $qry->store_result();

            // if username is available, register new user
            if ($qry->num_rows === 0) {
                // hash password for storage
                $hashedPwd = password_hash($this->pwd, PASSWORD_DEFAULT);
                // db query: insert new user
                $qry = $this->connection->prepare("INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, ?, ?)");
                $qry->bind_param('ss', $this->uname, $hashedPwd);
                $qry->execute();
                // set session variables
                $_SESSION['uid'] = $this->connection->insert_id;
                $_SESSION['uname'] = $this->uname;
                return array(200, "Registration successful.");
            // if username not available, alert the user
            } else {
                return array(409, "Username unavailable.");
            }
        }
    }

    // delete account
    public function delete() {
        // db query: delete user by id
        $qry = $this->connection->prepare("DELETE FROM `users` WHERE id = ?");
        $qry->bind_param('s', $_SESSION['uid']);
        $qry->execute();
        session_unset();
        return array(200, "Account deleted.");
    }
}