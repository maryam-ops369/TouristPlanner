
<?php
include 'db.php';

$id = (int) $_GET['id'];

$sql = "SELECT * FROM places WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['name']; ?></title>
    <link rel="stylesheet" href="css/style.css?v=2">

    <style>

/* ===== HERO IMAGE ===== */
.hero {
    position: relative;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 20px;
}

.hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* DARK OVERLAY */
.hero-overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 20px;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    color: white;
}

/* CONTENT BOX */
.details-container {
    max-width: 900px;
    margin: auto;
}

/* INFO CARD */
.info-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
}

/* LABELS */
.info-box p {
    margin: 10px 0;
    font-size: 15px;
}

/* BUTTONS */
.action-buttons {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.action-buttons a {
    text-decoration: none;
}

.action-buttons button {
    padding: 10px 16px;
}

/* BACK BUTTON */
.back-btn {
    background: #7f8c8d;
}

/* ADD BUTTON */
.plan-btn {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
}

    </style>
</head>

<body>

<div class="container">

    <!-- HERO IMAGE -->
    <div class="hero">

        <?php if(!empty($row['image'])) { ?>
            <img src="images/<?php echo $row['image']; ?>">
        <?php } else { ?>
            <img src="images/default.jpg">
        <?php } ?>

        <div class="hero-overlay">
            <h1><?php echo $row['name']; ?></h1>
            <p><?php echo $row['category']; ?></p>
        </div>

    </div>

    <!-- DETAILS -->
    <div class="details-container">

        <div class="info-box">

            <p><b>📍 Distance:</b> <?php echo $row['distance']; ?></p>

            <p><b>📝 Description:</b><br>
            <?php echo $row['description']; ?></p>
            <?php if(!empty($row['latitude']) && !empty($row['longitude'])) { ?>

    <br>
    <h3>📍 Location on Map</h3>

    <iframe
        src="https://www.google.com/maps?q=<?php echo $row['latitude']; ?>,<?php echo $row['longitude']; ?>&output=embed"
        width="100%"
        height="350"
        style="border:0; border-radius:12px; margin-top:10px;">
    </iframe>

<?php } ?>

            <!-- BUTTONS -->
            <div class="action-buttons">

                <a href="places.php">
                    <button class="back-btn">← Back</button>
                </a>

                <a href="places.php?add=<?php echo $row['id']; ?>&go=plan">
                    <button class="plan-btn">+ Add to Plan</button>
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>

