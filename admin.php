
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

/* =========================
   ADD PLACE (WITH IMAGE)
========================= */
if (isset($_POST['add_place'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $distance = mysqli_real_escape_string($conn, $_POST['distance']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    /* NEW FIELDS */
    $opening_time = mysqli_real_escape_string($conn, $_POST['opening_time']);
    $travel_tips = mysqli_real_escape_string($conn, $_POST['travel_tips']);
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

    /* IMAGE UPLOAD */
    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempName, "images/" . $imageName);

    $sql = "INSERT INTO places 
            (name, category, distance, description, opening_time, travel_tips, latitude, longitude, image)
            VALUES 
            ('$name', '$category', '$distance', '$description', '$opening_time', '$travel_tips', '$latitude', '$longitude', '$imageName')";

    $conn->query($sql);

    header("Location: admin.php?msg=added");
    exit();
}

/* =========================
   DELETE PLACE
========================= */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE FROM places WHERE id=$id");

    header("Location: admin.php?msg=deleted");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css?v=2">

    <style>
        body {
            font-family: Arial;
            margin: 20px;
            background: #f5f5f5;
        }

        h1, h3 {
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        textarea {
            min-height: 100px;
        }

        button {
            padding: 10px 15px;
            background: #333;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #333;
            color: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .delete-btn {
            background: red;
        }

        img {
            border-radius: 5px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Admin Panel</h1>

    <?php
    if (isset($_GET['msg'])) {

        if ($_GET['msg'] == "added") {
            echo "<p class='success'>Place added successfully!</p>";
        }

        if ($_GET['msg'] == "deleted") {
            echo "<p class='error'>Place deleted successfully!</p>";
        }

        if ($_GET['msg'] == "updated") {
            echo "<p class='success'>Place updated successfully!</p>";
        }
    }
    ?>

    <!-- =========================
         ADD NEW PLACE FORM
    ========================== -->

    <form method="POST" enctype="multipart/form-data">

        <h3>Add New Place</h3>

        <input type="text" name="name" placeholder="Place Name" required>

        <select name="category" required>
            <option value="">Select Category</option>
            <option>Recreational / Sightseeing</option>
            <option>Nature / Viewpoint</option>
            <option>Nature / Mountain Range</option>
            <option>Nature / River</option>
            <option>Nature / Water Stream</option>
            <option>Religious Site</option>
            <option>Heritage / Cultural Site</option>
            <option>Historical / Nature</option>
            <option>Eco Tourism / Camping</option>
        </select>

        <input type="text" name="distance" placeholder="Distance (e.g. 10 km)" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <!-- NEW FIELD -->
        <input type="text" name="opening_time" placeholder="Opening Time (e.g. 8:00 AM - 6:00 PM)" required>

        <!-- NEW FIELD -->
        <textarea name="travel_tips" placeholder="Travel Tips (e.g. Best visited in morning, carry water, wear shoes)" required></textarea>

        <!-- NEW FIELD -->
        <input type="text" name="latitude" placeholder="Latitude (e.g. 7.2906)" required>

        <!-- NEW FIELD -->
        <input type="text" name="longitude" placeholder="Longitude (e.g. 80.6337)" required>

        <!-- IMAGE -->
        <input type="file" name="image" required>

        <button type="submit" name="add_place">Add Place</button>

    </form>

    <!-- =========================
         DISPLAY TABLE
    ========================== -->

    <h3>All Places</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Opening Time</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM places");

        while ($row = $result->fetch_assoc()) {

            echo "<tr>";

            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['opening_time'] . "</td>";

            echo "<td>
                    <img src='images/" . $row['image'] . "' width='80'>
                  </td>";

            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "'>
                        <button>Edit</button>
                    </a>

                    <a href='admin.php?delete=" . $row['id'] . "'>
                        <button class='delete-btn'>Delete</button>
                    </a>
                  </td>";

            echo "</tr>";
        }
        ?>

    </table>

</div>

</body>
</html>