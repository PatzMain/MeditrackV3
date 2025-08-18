<?php require_once '../../api/auth.php';

$stmt = $pdo->query("SELECT * FROM equipment");
$equipment = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $currentPage = 'equipment';
    include '../includes/navbar.php';
    ?>
    <div class="container">


        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <?php
            $pageKey = 'equipment';
            $pageTitle = 'Equipment';
            include '../includes/page-header.php';
            include '../includes/stats-cards.php';
            include '../includes/search.php';
            ?>

            <!-- Admin Table -->
            <!-- Equipment Table -->
            <div style="margin-bottom: 15px; text-align: right;">
                <button class="add-btn" onclick="openModal('addModal')">➕ Add Equipment</button>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="sortable">Equipment Name</th>
                            <th class="sortable">Type</th>
                            <th class="sortable">Serial Number</th>
                            <th class="sortable">Condition</th>
                            <th class="sortable">Classification</th>
                            <th>Description</th>
                            <th class="sortable">Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($equipment)): ?>
                            <tr>
                                <td colspan="8" style="text-align: center;">No records found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($equipment as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['equipment_name']) ?></td>
                                    <td><?= htmlspecialchars($row['type']) ?></td>
                                    <td><?= htmlspecialchars($row['serial_number']) ?></td>
                                    <td><?= htmlspecialchars($row['equipment_condition']) ?></td>
                                    <td><?= htmlspecialchars($row['equipment_classification']) ?></td>
                                    <td><?= htmlspecialchars($row['equipment_description']) ?></td>
                                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <div class="action-buttons-group">
                                            <button class="action-btn view-btn" onclick='viewModal(<?= json_encode($row) ?>)'
                                                title="View">👁</button>

                                            <button class="action-btn edit-btn" onclick='editModal(<?= json_encode($row) ?>)'
                                                title="Edit">✏</button>

                                            <button class="action-btn delete-btn"
                                                onclick="deleteModal(<?= (int) $row['equipment_id'] ?>)"
                                                title="Delete">🗑</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <?php include 'modal.php'; // Include the modals for view, edit, delete ?>
    <script src="../js/sort.js"></script>
</body>

</html>