<?php
include 'db.php';

$id = $_GET['id'];

if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $distance = $_POST['distance'];
    $description = $_POST['description'];

    $sql = "UPDATE places SET 
            name='$name',
            category='$category',
            distance='$distance',
            description='$description'
            WHERE id=$id";

    $conn->query($sql);

    header("Location: admin.php");
}

$result = $conn->query("SELECT * FROM places WHERE id=$id");
$row = $result->fetch_assoc();
?>

<h1>Edit Place</h1>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
    Category: <input type="text" name="category" value="<?php echo $row['category']; ?>"><br>
    Distance: <input type="text" name="distance" value="<?php echo $row['distance']; ?>"><br>
    Description: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
    <button type="submit" name="update">Update</button>
</form>