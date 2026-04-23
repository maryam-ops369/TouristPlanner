
<?php
session_start();
include 'db.php';

// REMOVE SINGLE ITEM
if(isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];

    if(($key = array_search($remove_id, $_SESSION['plan'])) !== false) {
        unset($_SESSION['plan'][$key]);
    }

    header("Location: plan.php");
    exit();
}

// CLEAR PLAN
if(isset($_GET['clear'])) {
    unset($_SESSION['plan']);
    header("Location: plan.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Plan</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: #f5f5f5;
            font-family: Arial;
        }

        .plan-container {
            max-width: 900px;
            margin: auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .place {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        img {
            width: 200px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 12px;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .remove-btn {
            background: red;
            color: white;
        }

        .clear-btn {
            background: #444;
            color: white;
        }

        .back-btn {
            background: green;
            color: white;
        }
    </style>
</head>

<body>


   <nav>
    <a href="index.html">Home</a>
    <a href="places.php">Places</a>
    <a href="plan.php">My Plan</a>
    <a href="admin.php">Admin</a>
   </nav>
   <div class="plan-container">

       <h1>My Travel Plan</h1>

   <div class="top-bar">

<?php
$count = isset($_SESSION['plan']) ? count($_SESSION['plan']) : 0;
echo "<p><b>Total Places:</b> $count</p>";
?>

<div>
    <a href="places.php">
        <button class="back-btn">⬅ Back to Places</button>
    </a>

    <?php if($count > 0) { ?>
        <a href="plan.php?clear=true">
            <button class="clear-btn">Clear Plan</button>
        </a>
    <?php } ?>
</div>

</div>

<?php
if($count == 0) {
    echo "<p>No places added to your plan.</p>";
} else {

    foreach($_SESSION['plan'] as $id) {

        $sql = "SELECT * FROM places WHERE id=$id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        echo "<div class='place'>";

        if(!empty($row['image'])) {
            echo "<img src='images/" . $row['image'] . "'>";
        }

        echo "<h3>" . $row['name'] . "</h3>";
        echo "<p><b>Category:</b> " . $row['category'] . "</p>";
        echo "<p><b>Distance:</b> " . $row['distance'] . "</p>";

        echo "<a href='plan.php?remove=".$row['id']."'>
                <button class='remove-btn'>Remove</button>
              </a>";

        echo "</div>";
    }
}
?>

</div>

</body>
</html>


