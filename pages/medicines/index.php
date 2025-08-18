<?php
require_once '../../api/auth.php';      // user authentication check

// Stats data
$stats = include '../../api/get_stats.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditrack - Medicines</title>
    <?php include '../includes/styles.php'; ?>
</head>
<body>
    <!-- Sidebar / Navbar -->
    <?php
    $currentPage = 'medicines';
    include '../includes/navbar.php';
    ?>

    <div class="container">
        <main class="main-content">
            <!-- Page Header -->
            <?php
            $pageKey = 'medicines';
            $pageTitle = 'Medicines'; 
            include '../includes/page-header.php';
            include '../includes/stats-cards.php';
            include '../includes/search.php'; 
            ?>
        </main>
    </div>
    <script src="../js/sort.js"></script>
</body>
</html>
