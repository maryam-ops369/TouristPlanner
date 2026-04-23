
<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM places WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<h2>Edit Place</h2>

<form method="POST" enctype="multipart/form-data">
    
    Name: 
    <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

    Category: 
    <input type="text" name="category" value="<?php echo $row['category']; ?>"><br><br>

    Distance: 
    <input type="text" name="distance" value="<?php echo $row['distance']; ?>"><br><br>

    Description:<br>
    <textarea name="description"><?php echo $row['description']; ?></textarea><br><br>

    <!-- SHOW CURRENT IMAGE -->
    <p>Current Image:</p>
    <?php
    if(!empty($row['image'])) {
        echo "<img src='images/" . $row['image'] . "' width='150'><br><br>";
    }
    ?>

    <!-- NEW IMAGE -->
    Change Image:
    <input type="file" name="image"><br><br>

    <input type="submit" name="update" value="Update">
</form>

<?php
if (isset($_POST['update'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // CHECK IF NEW IMAGE UPLOADED
    if(!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];

        move_uploaded_file($tempName, "images/" . $imageName);

        $query = "UPDATE places SET 
                    name='$name',
                    category='$category',
                    distance='$distance',
                    description='$description',
                    image='$imageName'
                  WHERE id=$id";

    } else {

        // KEEP OLD IMAGE
        $query = "UPDATE places SET 
                    name='$name',
                    category='$category',
                    distance='$distance',
                    description='$description'
                  WHERE id=$id";
    }

    mysqli_query($conn, $query);

    header("Location: admin.php?msg=updated");
    exit();
}
?>

