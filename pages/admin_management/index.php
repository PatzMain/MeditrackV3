<?php include 'api.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management - MediTrack</title>
    <?php include '../includes/styles.php'; ?>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <?php
        $currentPage = 'admin_management';
        include '../includes/navbar.php';
        ?>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <?php
            $pageKey = 'admin_management';
            include '../includes/page-header.php';
            ?>

            <!-- Statistics Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon medicines">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C13.1 2 14 2.9 14 4V6H16C17.1 6 18 6.9 18 8V19C18 20.1 17.1 21 16 21H8C6.9 21 6 20.1 6 19V8C6 6.9 6.9 6 8 6H10V4C10 2.9 10.9 2 12 2ZM12 4V6V4ZM8 8V19H16V8H8ZM10 10H14V12H10V10ZM10 14H14V16H10V14Z" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number"><?php echo $stats['total_admins']; ?></div>
                        <div class="stat-label">Total Admins</div>
                    </div>
                </div>
            </div>

            <!-- Admin List Section -->
            <div class="section-header">
                <h2 class="section-title">Admin List</h2>
                <button class="btn btn-primary" onclick="openAddModal()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    Add Admin
                </button>
            </div>

            <div class="filter-section">
                <input type="text" class="search-input" placeholder="Search admins..." id="searchInput"
                    onkeyup="filterTable()">
            </div>

            <!-- Admin Table -->
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="sortable">Username</th>
                            <th>Role</th>
                            <th>Password Status</th>
                            <th class="sortable">Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($admins)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">N/A</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($admins as $admin): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                                    <td><span class="availability-badge low-stock">Admin</span></td>
                                    <td class="password-cell">
                                        <div class="password-indicator">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z" />
                                            </svg>
                                            Protected
                                        </div>
                                    </td>
                                    <td><?php echo date('M d, Y H:i', strtotime($admin['created_at'])); ?></td>
                                    <td>
                                        <div class="action-buttons-group">
                                            <button class="action-btn edit-btn"
                                                onclick="openEditModal(<?php echo htmlspecialchars(json_encode($admin)); ?>)"
                                                title="Edit Admin">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                                </svg>
                                            </button>
                                            <button class="action-btn delete-btn"
                                                onclick="openDeleteModal(<?php echo $admin['user_id']; ?>, '<?php echo htmlspecialchars($admin['username']); ?>')"
                                                title="Delete Admin">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
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

    <!-- Add Admin Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Admin</h2>
                <span class="close" onclick="closeModal('addModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addAdminForm">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-input" required minlength="3">
                        <div class="input-help">Username must be at least 3 characters long</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-input-container">
                            <input type="password" name="password" class="form-input" id="addPassword" required
                                minlength="6">
                            <button type="button" class="show-password-btn" onclick="togglePassword('addPassword')">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength" id="addPasswordStrength" style="display: none;">
                            <div class="password-strength-bar"></div>
                        </div>
                        <div class="input-help">Password must be at least 6 characters long</div>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Admin</h2>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editAdminForm">
                    <input type="hidden" id="editUserId" name="user_id">
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" id="editUsername" name="username" class="form-input" required minlength="3">
                        <div class="input-help">Username must be at least 3 characters long</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="password-input-container">
                            <input type="password" name="password" class="form-input" id="editPassword" minlength="6">
                            <button type="button" class="show-password-btn" onclick="togglePassword('editPassword')">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                </svg>
                            </button>
                        </div>
                        <div class="password-strength" id="editPasswordStrength" style="display: none;">
                            <div class="password-strength-bar"></div>
                        </div>
                        <div class="input-help">Leave blank to keep current password. If changing, must be at least 6
                            characters.</div>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary"
                            onclick="closeModal('editModal')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal delete-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirm Deletion</h2>
                <span class="close" onclick="closeModal('deleteModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="delete-icon">⚠</div>
                <div class="delete-message">Are you sure you want to delete this admin?</div>
                <div class="delete-submessage">This action cannot be undone.</div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script src="admin.js"></script>
    <script src="../js/navbar.js"></script>
    <script src="../js/sort.js"></script>

</body>

</html>