
<?php
function dbConnect() {
    include('config.php');
    return new mysqli($host, $user, $pwd, $name);
}

class Dal {
    private $connection;

    public function __construct() {
        include('config.php');
        $this->connection = new mysqli($this->host, $this->user, $this->pwd, $this->name);
    }

    public function query($sql, $params = [], $returns = []) {
        $qry = $this->connection->prepare($sql);
        if ($paramCount = count($params)) {
            $qry->bind_param(str_repeat('s', $paramCount), ...$params);
        }
        $qry->execute();
        if ($returns) {
            $qry->store_result();
            $ret = [];
            if (in_array('count', $returns)) {
                $ret['count'] = $qry->num_rows;
            }
            if (in_array('rows', $returns)) {
                $rows = []
                while ($row = $qry->fetch_row()) {
                    array_push($rows, $row);
                }
                $ret['rows'] = $rows;
            }
            if (in_array('result', $returns)) {
                $ret['result'] = $qry->fetch_assoc();
            }
            if (in_array('insert-id', $returns)) {
                $ret['insert-id'] = $this->connection->insert_id;
            }
            return $ret;
        }
    }

    // public function create($table, $columns, $values) {
    //     $columns = inplode(", ", $columns);

    //     $sql = "INSERT INTO $table ($columns) VALUES (" . str_repeat('?, ', count($values)) . ")";
    //     $qry = $this->connection->prepare($sql);
    //     $qry
    // }
}

?>