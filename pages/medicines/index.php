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
    
    <!-- Additional styles for stats cards if not in styles.php -->
    <style>
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        padding: 1.5rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-icon svg {
        width: 32px;
        height: 32px;
    }
    
    .stat-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1f2937;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    
    /* Action Buttons Styling */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background-color: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2563eb;
    }
    
    .btn-secondary {
        background-color: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #4b5563;
    }
    
    .btn-success {
        background-color: #10b981;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #059669;
    }
    
    /* Search and Filter Section */
    .controls-section {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .search-filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }
    
    .search-box {
        flex: 1;
        min-width: 200px;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    
    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background-color: white;
    }
    
    /* Table Section */
    .table-section {
        background: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    </style>
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

            <!-- Controls Section -->
            <div class="controls-section">
                <!-- Search and Filters -->
                <div class="search-filters">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search medicines by name, generic, or brand..." onkeyup="searchTable()">
                    </div>
                    
                    <select class="filter-select" id="stockFilter" onchange="filterTable()">
                        <option value="">All Stock Levels</option>
                        <option value="low">Low Stock (< 10)</option>
                        <option value="normal">Normal Stock</option>
                        <option value="high">High Stock (> 100)</option>
                    </select>
                    
                    <select class="filter-select" id="expiryFilter" onchange="filterTable()">
                        <option value="">All Expiry Status</option>
                        <option value="expired">Expired</option>
                        <option value="expiring">Expiring Soon (30 days)</option>
                        <option value="valid">Valid</option>
                    </select>
                    
                    <select class="filter-select" id="typeFilter" onchange="filterTable()">
                        <option value="">All Types</option>
                        <option value="Medical">Medical</option>
                        <option value="Dental">Dental</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <!-- Add Button -->
                    <button class="btn btn-primary" onclick="openAddMedicineModal()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        Add Medicine
                    </button>

                    <!-- Print Button -->
                    <button class="btn btn-secondary" onclick="printMedicineList()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                        Print List
                    </button>

                    <!-- Export Button to CSV -->
                    <button class="btn btn-success" onclick="exportToCSV()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Export CSV
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <table id="medicinesTable" class="data-table">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">ID <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(1)">Medicine Name <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(2)">Generic Name <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(3)">Brand <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(4)">Type <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(5)">Stock <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(6)">Unit <span class="sort-icon">↕</span></th>
                            <th onclick="sortTable(7)">Expiry Date <span class="sort-icon">↕</span></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch medicines data
                        try {
                            $stmt = $pdo->query("
                                SELECT * FROM medicines 
                                ORDER BY medicine_name ASC
                            ");
                            $medicines = $stmt->fetchAll();
                            
                            foreach ($medicines as $medicine):
                                // Determine stock status
                                $stockClass = '';
                                if ($medicine['medicine_stock'] < 10) {
                                    $stockClass = 'text-danger';
                                } elseif ($medicine['medicine_stock'] > 100) {
                                    $stockClass = 'text-success';
                                }
                                
                                // Determine expiry status
                                $expiryDate = new DateTime($medicine['medicine_expiry_date']);
                                $today = new DateTime();
                                $interval = $today->diff($expiryDate);
                                $daysUntilExpiry = $interval->days * ($interval->invert ? -1 : 1);
                                
                                $expiryClass = '';
                                if ($daysUntilExpiry < 0) {
                                    $expiryClass = 'text-danger';
                                } elseif ($daysUntilExpiry <= 30) {
                                    $expiryClass = 'text-warning';
                                }
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($medicine['medicine_id']) ?></td>
                            <td><?= htmlspecialchars($medicine['medicine_name']) ?></td>
                            <td><?= htmlspecialchars($medicine['medicine_generic'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($medicine['medicine_brand'] ?? 'N/A') ?></td>
                            <td>
                                <span class="badge <?= $medicine['type'] === 'Medical' ? 'badge-primary' : 'badge-info' ?>">
                                    <?= htmlspecialchars($medicine['type']) ?>
                                </span>
                            </td>
                            <td class="<?= $stockClass ?>">
                                <?= htmlspecialchars($medicine['medicine_stock']) ?>
                            </td>
                            <td><?= htmlspecialchars($medicine['medicine_unit'] ?? 'pcs') ?></td>
                            <td class="<?= $expiryClass ?>">
                                <?= $expiryDate->format('Y-m-d') ?>
                                <?php if ($daysUntilExpiry < 0): ?>
                                    <small class="text-danger">(Expired)</small>
                                <?php elseif ($daysUntilExpiry <= 30): ?>
                                    <small class="text-warning">(<?= $daysUntilExpiry ?> days)</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn-action btn-edit" onclick="editMedicine(<?= $medicine['medicine_id'] ?>)" title="Edit">
                                    ✏️
                                </button>
                                <button class="btn-action btn-delete" onclick="deleteMedicine(<?= $medicine['medicine_id'] ?>)" title="Delete">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                        <?php 
                            endforeach;
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='9' class='text-center'>Error loading medicines: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    
    <!-- Include your existing scripts -->
    <script src="../js/sort.js"></script>
    
    <!-- Additional JavaScript for functionality -->
    <script>
    // Search function
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('medicinesTable');
        const tr = table.getElementsByTagName('tr');
        
        for (let i = 1; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName('td');
            let txtValue = '';
            
            // Search in name, generic, and brand columns
            for (let j = 1; j <= 3; j++) {
                if (td[j]) {
                    txtValue += td[j].textContent || td[j].innerText;
                }
            }
            
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
    
    // Filter function
    function filterTable() {
        // Implementation for filters
        console.log('Filter function to be implemented');
    }
    
    // Add Medicine Modal
    function openAddMedicineModal() {
        // Implementation for add modal
        alert('Add Medicine Modal - To be implemented');
    }
    
    // Edit Medicine
    function editMedicine(id) {
        // Implementation for edit
        alert('Edit Medicine ID: ' + id + ' - To be implemented');
    }
    
    // Delete Medicine
    function deleteMedicine(id) {
        if (confirm('Are you sure you want to delete this medicine?')) {
            // Implementation for delete
            alert('Delete Medicine ID: ' + id + ' - To be implemented');
        }
    }
    
    // Print function
    function printMedicineList() {
        window.print();
    }
    
    // Export to CSV
    function exportToCSV() {
        const table = document.getElementById('medicinesTable');
        let csv = [];
        
        // Get headers
        const headers = [];
        const headerCells = table.querySelectorAll('thead th');
        for (let i = 0; i < headerCells.length - 1; i++) { // Exclude Actions column
            headers.push(headerCells[i].textContent.replace(/[↕↑↓]/g, '').trim());
        }
        csv.push(headers.join(','));
        
        // Get data rows
        const rows = table.querySelectorAll('tbody tr');
        for (const row of rows) {
            const rowData = [];
            const cells = row.querySelectorAll('td');
            for (let i = 0; i < cells.length - 1; i++) { // Exclude Actions column
                rowData.push('"' + cells[i].textContent.trim().replace(/"/g, '""') + '"');
            }
            csv.push(rowData.join(','));
        }
        
        // Download CSV
        const csvContent = csv.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.setAttribute('hidden', '');
        a.setAttribute('href', url);
        a.setAttribute('download', 'medicines_' + new Date().toISOString().split('T')[0] + '.csv');
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    </script>
</body>
</html>