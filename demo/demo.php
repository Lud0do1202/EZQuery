<?php

// Include lib
include "./EZQuery/EZQuery.php";

// EZQuery
$ez = new EZQuery();

// Delete DB
$delete = $ez->executeEdit("DELETE FROM users");
echo "DELETE : $delete <br><br>";

// Insert 
$insert1 = $ez->executeEdit("INSERT INTO users (id, lastname, firstname) VALUE (?, ?, ?)", 0, "Doe", "Jonh");
$insert2 = $ez->executeEdit("INSERT INTO users (id, lastname, firstname) VALUE (?, ?, ?)", 1, "Doe", "Jane");
$insert3 = $ez->executeEdit("INSERT INTO users (id, lastname, firstname) VALUE (?, ?, ?)", 2, "Patel", "Aisha");

echo "INSERT 1 : $insert1 <br>";
echo "INSERT 2 : $insert2 <br>";
echo "INSERT 3 : $insert3 <br><br>";

// Binding
$fields = "lastname, firstname";
$userID = 0;
$user = $ez->executeSelect("SELECT % FROM users WHERE id = ?", $fields, $userID);
echo "BINDING : ";
print_r($user);

// Debug
$ez->debug();
echo "<br><br>DEBUG : ";
$user = $ez->executeSelect("SELECT lastname, firstname FROM users WHERE id = ?", 0);
print_r($user);
$ez->debug(false);

// Users
$ez = new EZQuery();
$users = $ez->executeSelect("SELECT lastname, firstname FROM users");
echo "<br><br>USERS : ";
print_r($users);

// Empty
$user = $ez->executeSelect("SELECT lastname, firstname FROM users WHERE id = ?", 100);
echo "<br><br>EMPTY : ";
print_r($user);
echo "<br><br> TRY : ";
print_r($user[0]);
