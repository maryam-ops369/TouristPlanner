<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM places WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Place Details</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>

<h1><?php echo $row['name']; ?></h1>

<p><b>Category:</b> <?php echo $row['category']; ?></p>
<p><b>Distance:</b> <?php echo $row['distance']; ?></p>
<p><b>Description:</b> <?php echo $row['description']; ?></p>

<a href="places.php">Back to Places</a>

</body>
</html>