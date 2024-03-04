<?php
include('connection.php');

// Function to insert data
function insertData($data) {
    global $conn;
    $sql = "INSERT INTO your_table_name (column1, column2, column3) VALUES (:value1, :value2, :value3)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $data['value1']);
    $stmt->bindParam(':value2', $data['value2']);
    $stmt->bindParam(':value3', $data['value3']);
    return $stmt->execute();
}

// Function to fetch all data
function getAllData() {
    global $conn;
    $sql = "SELECT * FROM your_table_name";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to update data
function updateData($id, $data) {
    global $conn;
    $sql = "UPDATE your_table_name SET column1 = :value1, column2 = :value2, column3 = :value3 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $data['value1']);
    $stmt->bindParam(':value2', $data['value2']);
    $stmt->bindParam(':value3', $data['value3']);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

// Function to delete data
function deleteData($id) {
    global $conn;
    $sql = "DELETE FROM your_table_name WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}
?>
