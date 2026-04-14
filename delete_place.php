<?php
include 'db.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM places WHERE id=$id";
    $conn->query($sql);
}

header("Location: admin.php");
exit();
?>