<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM places WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>
<h2>Edit Place</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    Category: <input type="text" name="category" value="<?php echo $row['category']; ?>"><br><br>

    Distance: <input type="text" name="distance" value="<?php echo $row['distance']; ?>"><br><br>

    Description:<br>
    <textarea name="description"><?php echo $row['description']; ?></textarea><br><br>

    <input type="submit" name="update" value="Update">
</form>
<?php
if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "UPDATE places SET 
                name='$name',
                category='$category',
                distance='$distance',
                description='$description'
              WHERE id=$id";

    mysqli_query($conn, $query);

header("Location: admin.php?msg=updated");
exit();
exit();
}
?>