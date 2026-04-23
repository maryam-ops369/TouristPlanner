
<?php
session_start();
include 'db.php';

// ADD TO PLAN
$addedMsg = "";

if (isset($_GET['add'])) {

    $id = (int) $_GET['add'];

    if (!isset($_SESSION['plan'])) {
        $_SESSION['plan'] = [];
    }

    if (!in_array($id, $_SESSION['plan'])) {
        $_SESSION['plan'][] = $id;
        $addedMsg = "Place added to plan!";
    } else {
        $addedMsg = "Already in your plan!";
    }

    // REDIRECT TO PLAN IF REQUESTED
    if (isset($_GET['go']) && $_GET['go'] == 'plan') {
        header("Location: plan.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Places</title>
    <link rel="stylesheet" href="css/style.css?v=1">
</head>

<body>

<div class="container">

    <!-- NAVBAR -->
    <nav>
        <a href="index.html">Home</a>
        <a href="places.php">Places</a>
        <a href="plan.php">My Plan</a>
        <a href="admin.php">Admin</a>
    </nav>

    <h1>Places to Visit</h1>

    <!-- SUCCESS MESSAGE -->
    <?php if ($addedMsg != "") { ?>
        <div class="success"><?php echo $addedMsg; ?></div>
    <?php } ?>

    
<!-- CLEAN SEARCH + FILTER -->
<form method="GET" class="top-bar">

    <!-- SEARCH INPUT -->
    <input 
        type="text" 
        name="search" 
        placeholder="Search places..."
        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
    >

    <!-- CATEGORY FILTER -->
    <select name="category">
        <option value="">All Categories</option>

        <option value="Nature / Viewpoint"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Nature / Viewpoint") echo "selected"; ?>>
            Nature / Viewpoint
        </option>

        <option value="Nature / River"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Nature / River") echo "selected"; ?>>
            Nature / River
        </option>

        <option value="Nature / Mountain Range"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Nature / Mountain Range") echo "selected"; ?>>
            Nature / Mountain Range
        </option>

        <option value="Religious Site"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Religious Site") echo "selected"; ?>>
            Religious Site
        </option>

        <option value="Heritage / Cultural Site"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Heritage / Cultural Site") echo "selected"; ?>>
            Heritage / Cultural Site
        </option>

        <option value="Eco Tourism / Camping"
            <?php if (isset($_GET['category']) && $_GET['category'] == "Eco Tourism / Camping") echo "selected"; ?>>
            Eco Tourism / Camping
        </option>
    </select>

    <!-- SUBMIT BUTTON -->
    <button type="submit">Search</button>

</form>





    <?php
    // QUERY BUILD
    $sql = "SELECT * FROM places WHERE 1";

    if (!empty($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql .= " AND (name LIKE '%$search%' 
                   OR category LIKE '%$search%' 
                   OR description LIKE '%$search%')";
    }

    if (!empty($_GET['category'])) {
        $category = mysqli_real_escape_string($conn, $_GET['category']);
        $sql .= " AND category='$category'";
    }

    $result = $conn->query($sql);
    ?>

    <!-- NO RESULTS -->
    <?php if ($result->num_rows == 0) { ?>
        <p class="no-results">No places found.</p>
    <?php } ?>

    <!-- GRID -->
    <div class="grid">

        <?php while ($row = $result->fetch_assoc()) { ?>

            <div class="card">

                <!-- IMAGE -->
                <?php if (!empty($row['image']) && file_exists("images/" . $row['image'])) { ?>
                    <img src="images/<?php echo $row['image']; ?>">
                <?php } else { ?>
                    <img src="images/default.jpg">
                <?php } ?>

                <!-- ACTION BUTTONS -->
                <div class="card-actions">
                    <a href="details.php?id=<?php echo $row['id']; ?>">View</a>
                    <a href="places.php?add=<?php echo $row['id']; ?>&go=plan">+ Plan</a>
                </div>

                <!-- OVERLAY -->
                <div class="card-overlay">
                    <span class="badge"><?php echo $row['category']; ?></span>
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['distance']; ?></p>
                </div>

            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>

