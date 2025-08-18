<?php
// ========================================
// ADMIN MANAGEMENT - ENHANCED VERSION
// ========================================
include '../../api/auth.php';

// Check if user is logged in and is a superadmin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../../login/');
    exit();
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    try {
        switch ($_POST['action']) {
            case 'add_admin':
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $role = 'admin';
                
                // Basic validation
                if (strlen($username) < 3) {
                    throw new Exception('Username must be at least 3 characters long');
                }
                if (strlen($password) < 6) {
                    throw new Exception('Password must be at least 6 characters long');
                }
                
                $check_stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
                $check_stmt->execute([$username]);
                
                if ($check_stmt->rowCount() > 0) {
                    throw new Exception('Username already exists');
                }
                
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
                $insert_stmt->execute([$username, $hashed_password, $role]);
                
                // Log activity
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, logs_item_type, logs_description, logs_status) VALUES (?, 'system', ?, 'add_admin')");
                $log_stmt->execute([$_SESSION['user_id'], "Added new admin: {$username}"]);
                
                echo json_encode(['success' => true, 'message' => 'Admin added successfully']);
                break;
                
            case 'edit_admin':
                $user_id = (int)$_POST['user_id'];
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                
                if (strlen($username) < 3) {
                    throw new Exception('Username must be at least 3 characters long');
                }
                
                if (!empty($password)) {
                    if (strlen($password) < 6) {
                        throw new Exception('Password must be at least 6 characters long');
                    }
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $update_stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE user_id = ? AND role = 'admin'");
                    $update_stmt->execute([$username, $hashed_password, $user_id]);
                } else {
                    $update_stmt = $pdo->prepare("UPDATE users SET username = ? WHERE user_id = ? AND role = 'admin'");
                    $update_stmt->execute([$username, $user_id]);
                }
                
                // Log activity
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, logs_item_type, logs_description, logs_status) VALUES (?, 'system', ?, 'edit_admin')");
                $log_stmt->execute([$_SESSION['user_id'], "Updated admin: {$username}"]);
                
                echo json_encode(['success' => true, 'message' => 'Admin updated successfully']);
                break;
                
            case 'delete_admin':
                $user_id = (int)$_POST['user_id'];
                
                // Get admin username before deletion for logging
                $get_stmt = $pdo->prepare("SELECT username FROM users WHERE user_id = ? AND role = 'admin'");
                $get_stmt->execute([$user_id]);
                $admin_data = $get_stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$admin_data) {
                    throw new Exception('Admin not found');
                }
                
                $delete_stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ? AND role = 'admin'");
                $delete_stmt->execute([$user_id]);
                
                // Log activity
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, logs_item_type, logs_description, logs_status) VALUES (?, 'system', ?, 'delete_admin')");
                $log_stmt->execute([$_SESSION['user_id'], "Deleted admin: {$admin_data['username']}"]);
                
                echo json_encode(['success' => true, 'message' => 'Admin deleted successfully']);
                break;
                
            default:
                throw new Exception('Invalid action');
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}

// Get admin list
$search = $_GET['search'] ?? '';
$params = [];
$where_clause = "WHERE role = 'admin'";

if (!empty($search)) {
    $where_clause .= " AND username LIKE ?";
    $params[] = "%{$search}%";
}

$stmt = $pdo->prepare("SELECT user_id, username, role, created_at FROM users {$where_clause} ORDER BY created_at DESC");
$stmt->execute($params);
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get statistics
$stats_result = $pdo->query("SELECT COUNT(*) as total_admins FROM users WHERE role = 'admin'");
$stats = $stats_result->fetch(PDO::FETCH_ASSOC);
?>