<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once $_SERVER["DOCUMENT_ROOT"]."/connection_db.php";
    $id = $_POST["id"];
    try {
        $sql = 'DELETE FROM tracks WHERE id = :id';
        // Prepare the SQL statement
        $stmt = $pdo->prepare($sql);
        // Bind the parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Execute the statement
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->rowCount() > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "No record found with the given ID.";
        }
        } catch (PDOException $e) {
        // Handle execution error
        echo "Error: " . $e->getMessage();
    }
}