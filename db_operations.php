<?php
// db_operations.php

function getTables($pdo) {
    $stmt = $pdo->query("SHOW TABLES");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getTableColumns($pdo, $table) {
    $stmt = $pdo->query("DESCRIBE $table");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getTableData($pdo, $table) {
    $stmt = $pdo->query("SELECT * FROM $table");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertData($pdo, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $stmt = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($values)");
    $stmt->execute($data);
}

function updateData($pdo, $table, $data, $id) {
    $set = "";
    foreach ($data as $column => $value) {
        $set .= "$column = :$column, ";
    }
    $set = rtrim($set, ", ");
    $stmt = $pdo->prepare("UPDATE $table SET $set WHERE id = :id");
    $data['id'] = $id;
    $stmt->execute($data);
}

function deleteData($pdo, $table, $id) {
    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");
    $stmt->execute(['id' => $id]);
}
?>
