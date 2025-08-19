<?php require_once '../../api/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditrack - Dashboard</title>
    <?php include '../includes/styles.php'; ?>
    <link rel="stylesheet" href="../css/charts.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    $currentPage = 'dashboard'; // Set the current page for the sidebar
    include '../includes/navbar.php';
    ?>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <?php
            $pageKey = 'dashboard'; // Set the page key for stats cards
            include '../includes/page-header.php';
            include '../includes/stats-cards.php';
            ?>
            <?php include 'charts.php'; // Include the charts file ?>
        </main>
    </div>
</body>

</html>