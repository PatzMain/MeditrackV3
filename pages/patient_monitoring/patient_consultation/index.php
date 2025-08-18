<?php require_once '../../../api/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditrack - Medicines</title>
    <?php include '../../includes/styles.php'; ?>
</head>

<body>
    <!-- Sidebar -->
    <?php
    $currentPage = 'patient_consultation';
    include '../../includes/navbar.php';
    ?>
    <div class="container">


        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <?php
            $pageKey = 'patient_consultation';
            include '../../includes/page-header.php';
            ?>
            <?php
            $pageKey = 'patients'; // Set the page key for stats cards
            include '../../includes/stats-cards.php';
            ?>
            

            <!-- Simple Preview Button -->
            <a href="Consultation-Form.pdf" target="_blank">
                <button type="button">Print Patient Consultation Form</button>
            </a>

            <!-- Search and Filters -->

            <!-- Add Button -->

            <!-- Export Button to csv-->

            <!-- Table Section -->
        </main>
    </div>
    <script src="../../js/sort.js"></script>
</body>

</html>