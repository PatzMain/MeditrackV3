
<?php require_once '../../api/auth.php';?>

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
            $pageKey = 'supplies';
            $pageTitle = 'Supplies'; 
            include '../includes/page-header.php';
            include '../includes/stats-cards.php';
            include '../includes/search.php'; 
            ?>
        </main>
    </div>
    <script src="../js/sort.js"></script>
</body>
</html>