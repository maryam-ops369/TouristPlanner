<?php
include 'db.php';

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $distance = $_POST['distance'];
    $description = $_POST['description'];

    $sql = "INSERT INTO places (name, category, distance, description)
            VALUES ('$name', '$category', '$distance', '$description')";

    $conn->query($sql);

    header("Location: admin.php");
}
?>

<h1>Add Place</h1>

<form method="POST">

Name:
<input type="text" name="name" placeholder="Enter place name" required><br>

Category:
<select name="category" required>
    <option value="">-- Select Category --</option>
    <option value="Beach">Beach</option>
    <option value="Temple">Temple</option>
    <option value="Park">Park</option>
    <option value="Historical">Historical</option>
</select><br>

Distance:
<input type="number" name="distance" placeholder="Distance in KM" required> km<br>

Description:
<textarea name="description" placeholder="Enter short description" required></textarea><br>

<button type="submit" name="submit">Add</button>

</form>