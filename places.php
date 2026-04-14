<?php
session_start();
include 'db.php';
?>
<?php
if(isset($_GET['add'])) {
    $id = $_GET['add'];

    if(!isset($_SESSION['plan'])) {
        $_SESSION['plan'] = [];
    }

    $_SESSION['plan'][] = $id;

    // 👉 REDIRECT to plan page
    if(isset($_GET['go']) && $_GET['go'] == 'plan') {
        header("Location: plan.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Places</title>
    <link rel="stylesheet" href="css/style.css">
    
</head>


<body>
    <nav>
    <a href="index.html">Home</a>
    <a href="places.php">Places</a>
    <a href="plan.php">My Plan</a>
    <a href="admin.php">Admin</a>
    </nav>

<h1>Places to Visit</h1>

<form method="GET">
    <label>Filter by Category:</label>
    <select name="category">
        <option value="">All</option>
        <option value="Nature / Viewpoint">Nature / Viewpoint</option>
        <option value="Nature / River">Nature / River</option>
        <option value="Nature / Mountain Range">Nature / Mountain Range</option>
        <option value="Religious Site">Religious Site</option>
        <option value="Heritage / Cultural Site">Heritage / Cultural Site</option>
        <option value="Eco Tourism / Camping">Eco Tourism / Camping</option>
    </select>
    <button type="submit">Filter</button>
</form>

<?php
if(isset($_GET['category']) && $_GET['category'] != "") {

    $category = $_GET['category'];
    $sql = "SELECT * FROM places WHERE category='$category'";

} else {

    $sql = "SELECT * FROM places";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='place'>";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p><b>Category:</b> " . $row['category'] . "</p>";
        echo "<p><b>Distance:</b> " . $row['distance'] . "</p>";
        echo "<p>" . $row['description'] . "</p>";

        echo "<a href='details.php?id=" . $row['id'] . "'>
                <button>View Details</button>
              </a>";
        echo "<a href='places.php?add=" . $row['id'] . "&go=plan'>
                  <button>Add to Plan</button>
             </a>";
        echo "</div>";
    }
} else {
    echo "No places found";
}
?>



</body>
</html>