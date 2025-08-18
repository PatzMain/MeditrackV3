<?php
require_once '../../api/auth.php';

// Include the stats data fetching
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
    <!-- Sidebar -->
    <?php
    $currentPage = 'medicines';
    include '../includes/navbar.php';
    ?>
    <div class="container">

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <?php
            // Set page title for header
            $pageKey = 'medicines';
            include '../includes/page-header.php';

            // Stats Cards - Set the correct page key for medicines
            $pageKey = 'medicines';
            include '../includes/stats-cards.php';
            ?>
        </main>
    </div>

    <!-- Include your existing scripts -->
    <script src="../js/sort.js"></script>
</body>

</html>