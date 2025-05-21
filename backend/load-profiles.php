<?php

// $profiles = [];
// DB query: get profiles where uid == $_SESSION[id]
// for each result row (each profile)
//   add to $profiles new profile object
//   DB query: get rolls where profile == id of this profile
//   for each result row (each saved roll)
//     profile->addRoll(this roll)
// 
// echo saved dice form:
// <div>
//   <select> profile selector
//     <option> None </option>
//     for $profile in $profiles, echo <option> element
//   </select>
//   <select> roll selector
//     <option> None </option>
//     for $profile in $profiles,
//       for $roll in $profile->getRolls(), echo <option> element with hidden attribute
//   </select>
// 
// figure out inputs for saving. Need:
// new profile - dropdown appears with name and save button
// delete profile - dropdown appears with confirm and cancel
// new roll - dropdown appears with name and save button
// overwrite roll - dropdown appears with confirm and cancel
// delete roll - dropdown appears with confirm and cancel
?>