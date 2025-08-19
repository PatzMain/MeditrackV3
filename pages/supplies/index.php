<?php
require_once '../../api/auth.php';

// Fetch supplies data
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'all';

$params = [];
$where_conditions = [];

// Search functionality
if (!empty($search)) {
    $where_conditions[] = "(supply_name LIKE ? OR supply_brand_name LIKE ?)";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
}

// Filter functionality
if ($filter !== 'all') {
    switch ($filter) {
        case 'medical':
            $where_conditions[] = "type = 'Medical'";
            break;
        case 'dental':
            $where_conditions[] = "type = 'Dental'";
            break;
        case 'low_stock':
            $where_conditions[] = "supply_quantity < 20";
            break;
        case 'expired':
            $where_conditions[] = "supply_expiry_date < CURDATE()";
            break;
        case 'expiring_soon':
            $where_conditions[] = "supply_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
            break;
    }
}

$where_clause = '';
if (!empty($where_conditions)) {
    $where_clause = 'WHERE ' . implode(' AND ', $where_conditions);
}

$stmt = $pdo->prepare("SELECT * FROM supplies {$where_clause} ORDER BY created_at DESC");
$stmt->execute($params);
$supplies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Stats data
$stats = include '../../api/get_stats.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditrack - Supplies</title>
    <?php include '../includes/styles.php'; ?>
    <link rel="stylesheet" href="../css/tablemodal.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar / Navbar -->
        <?php
        $currentPage = 'supplies';
        include '../includes/navbar.php';
        ?>

        <main class="main-content">
            <!-- Page Header -->
            <?php
            $pageKey = 'supplies';
            $pageTitle = 'Supplies'; 
            include '../includes/page-header.php';
            include '../includes/stats-cards.php';
            ?>

            <!-- Alerts -->
            <?php include '../includes/alert.php'; ?>

            <!-- Filter Section -->
            <div class="filter-section">
                <input type="text" class="search-input" placeholder="Search supplies..." 
                       id="searchInput" value="<?= htmlspecialchars($search) ?>" 
                       onkeyup="performSearch()">
                
                <select class="filter-select" id="filterSelect" onchange="performFilter()">
                    <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All Supplies</option>
                    <option value="medical" <?= $filter === 'medical' ? 'selected' : '' ?>>Medical</option>
                    <option value="dental" <?= $filter === 'dental' ? 'selected' : '' ?>>Dental</option>
                    <option value="low_stock" <?= $filter === 'low_stock' ? 'selected' : '' ?>>Low Stock</option>
                    <option value="expired" <?= $filter === 'expired' ? 'selected' : '' ?>>Expired</option>
                    <option value="expiring_soon" <?= $filter === 'expiring_soon' ? 'selected' : '' ?>>Expiring Soon</option>
                </select>

                <button class="btn btn-primary" onclick="openModal('addModal')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    Add Supply
                </button>
            </div>

            <!-- Supply Table -->
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="sortable">Supply Name</th>
                            <th class="sortable">Type</th>
                            <th class="sortable">Brand Name</th>
                            <th class="sortable">Quantity</th>
                            <th class="sortable">Unit</th>
                            <th class="sortable">Expiry Date</th>
                            <th class="sortable">Classification</th>
                            <th class="sortable">Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($supplies)): ?>
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 40px;">
                                    <div style="color: #666; font-style: italic;">
                                        <?php if (!empty($search) || $filter !== 'all'): ?>
                                            No supplies found matching your criteria.
                                        <?php else: ?>
                                            No supplies found. Click "Add Supply" to get started.
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($supplies as $supply): ?>
                                <tr>
                                    <td><?= htmlspecialchars($supply['supply_name']) ?></td>
                                    <td>
                                        <span class="availability-badge <?= strtolower($supply['type']) ?>">
                                            <?= htmlspecialchars($supply['type']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($supply['supply_brand_name'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="stock-badge <?= $supply['supply_quantity'] < 20 ? 'low-stock' : ($supply['supply_quantity'] < 100 ? 'medium-stock' : 'high-stock') ?>">
                                            <?= (int)$supply['supply_quantity'] ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($supply['supply_unit'] ?? 'N/A') ?></td>
                                    <td class="expiry-date">
                                        <?php if ($supply['supply_expiry_date']): ?>
                                            <?php 
                                            $expiry_date = new DateTime($supply['supply_expiry_date']);
                                            $today = new DateTime();
                                            $days_diff = $today->diff($expiry_date)->days;
                                            $is_expired = $expiry_date < $today;
                                            $is_expiring_soon = !$is_expired && $days_diff <= 30;
                                            
                                            $class = '';
                                            if ($is_expired) $class = 'expired';
                                            elseif ($is_expiring_soon) $class = 'expiring-soon';
                                            ?>
                                            <span class="expiry-badge <?= $class ?>">
                                                <?= $expiry_date->format('M d, Y') ?>
                                            </span>
                                        <?php else: ?>
                                            <span style="color: #999;">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($supply['supply_classification'] ?? 'N/A') ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($supply['created_at'])) ?></td>
                                    <td>
                                        <div class="action-buttons-group">
                                            <button class="action-btn view-btn" 
                                                    onclick='viewModal(<?= json_encode($supply) ?>)'
                                                    title="View Details">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                                </svg>
                                            </button>

                                            <button class="action-btn edit-btn" 
                                                    onclick='editModal(<?= json_encode($supply) ?>)'
                                                    title="Edit Supply">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                                </svg>
                                            </button>

                                            <button class="action-btn delete-btn"
                                                    onclick="deleteModal(<?= (int)$supply['supply_id'] ?>)"
                                                    title="Delete Supply">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                                </svg>
                                            </button>
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

    <?php include 'modal.php'; // Include the modals ?>
    
    <script src="../js/sort.js"></script>
    <script>
        function performSearch() {
            const search = document.getElementById('searchInput').value;
            const filter = document.getElementById('filterSelect').value;
            updateURL(search, filter);
        }

        function performFilter() {
            const search = document.getElementById('searchInput').value;
            const filter = document.getElementById('filterSelect').value;
            updateURL(search, filter);
        }

        function updateURL(search, filter) {
            const url = new URL(window.location);
            
            if (search) {
                url.searchParams.set('search', search);
            } else {
                url.searchParams.delete('search');
            }
            
            if (filter && filter !== 'all') {
                url.searchParams.set('filter', filter);
            } else {
                url.searchParams.delete('filter');
            }
            
            window.location.href = url.toString();
        }

        // Auto-search after typing stops
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 500);
        });
    </script>
</body>
</html>