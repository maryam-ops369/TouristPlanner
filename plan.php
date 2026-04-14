<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Plan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<nav>
    <a href="index.html">Home</a>
    <a href="places.php">Places</a>
    <a href="plan.php">My Plan</a>
    <a href="admin.php">Admin</a>
</nav>


<body>

<h1>My Day Plan</h1>

<?php

if(isset($_SESSION['plan']) && count($_SESSION['plan']) > 0) {

    foreach($_SESSION['plan'] as $id) {

        $sql = "SELECT * FROM places WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        echo "<div>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "</div>";
    }

} else {
    echo "No places added yet.";
}

?>

<a href="places.php">Back to Places</a>

</body>
</html>