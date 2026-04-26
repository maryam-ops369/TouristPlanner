
<!DOCTYPE html>
<html>
<head>
    <title>Tourist Planner</title>
    <link rel="stylesheet" href="css/style.css?v=3">

    <style>

/* ===== HERO SECTION ===== */
.hero-home {
    position: relative;
    height: 90vh;
    background: url('../images/banner.jpg') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* DARK OVERLAY */
.hero-home::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
}

/* HERO CONTENT */
.hero-content {
    position: relative;
    color: white;
    text-align: center;
    z-index: 1;
}

.hero-content h1 {
    font-size: 48px;
    margin-bottom: 10px;
}

.hero-content p {
    font-size: 18px;
    margin-bottom: 20px;
}

/* BUTTON */
.hero-btn {
    background: linear-gradient(135deg, #3498db, #6dd5fa);
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.hero-btn:hover {
    transform: scale(1.05);
}

/* SECTION */
.section {
    padding: 40px 20px;
    text-align: center;
}

.section h2 {
    margin-bottom: 10px;
}

/* FEATURE BOXES */
.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.feature-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
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

<!-- HERO -->
<div class="hero-home">

    <div class="hero-content">
        <h1>Explore Your Next Adventure</h1>
        <p>Plan your perfect one-day trip with ease</p>

        <a href="places.php" class="hero-btn">Explore Places</a>
    </div>

</div>

<!-- ABOUT SECTION -->
<div class="section">

    <h2>Why Use Tourist Planner?</h2>
    <p>Simple, fast, and designed for travelers</p>

    <div class="features">

        <div class="feature-box">
            <h3>📍 Discover Places</h3>
            <p>Find beautiful locations nearby</p>
        </div>

        <div class="feature-box">
            <h3>🗺️ Plan Your Day</h3>
            <p>Create your own travel plan easily</p>
        </div>

        <div class="feature-box">
            <h3>⚡ Quick Access</h3>
            <p>Everything in one simple platform</p>
        </div>

    </div>

</div>

</body>
</html>

