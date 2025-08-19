<?php
require_once '../../api/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if it's an add operation (no action field, just form submission)
        if (!isset($_POST['action'])) {
            // ADD operation
            $stmt = $pdo->prepare("INSERT INTO supplies 
                (type, supply_name, supply_quantity, supply_unit, supply_expiry_date, 
                 supply_classification, supply_brand_name, supply_description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $_POST['type'],
                $_POST['supply_name'],
                (int)($_POST['supply_quantity'] ?? 0),
                $_POST['supply_unit'] ?? null,
                $_POST['supply_expiry_date'] ?? null,
                $_POST['supply_classification'] ?? null,
                $_POST['supply_brand_name'] ?? null,
                $_POST['supply_description'] ?? null
            ]);

            // Log activity
            if (isset($_SESSION['user_id'])) {
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                    (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                    VALUES (?, ?, ?, ?, ?, ?)");
                $log_stmt->execute([
                    $_SESSION['user_id'],
                    strtolower($_POST['type']) . '_supply',
                    $pdo->lastInsertId(),
                    $_POST['supply_name'],
                    "Added new supply: {$_POST['supply_name']}",
                    'add'
                ]);
            }
        } else {
            $action = $_POST['action'];
            
            switch ($action) {
                // ================= EDIT =================
                case 'edit':
                    $stmt = $pdo->prepare("UPDATE supplies 
                        SET type = ?, 
                            supply_name = ?, 
                            supply_quantity = ?, 
                            supply_unit = ?, 
                            supply_expiry_date = ?, 
                            supply_classification = ?, 
                            supply_brand_name = ?, 
                            supply_description = ?
                        WHERE supply_id = ?");

                    $stmt->execute([
                        $_POST['type'],
                        $_POST['supply_name'],
                        (int)($_POST['supply_quantity'] ?? 0),
                        $_POST['supply_unit'] ?? null,
                        $_POST['supply_expiry_date'] ?? null,
                        $_POST['supply_classification'] ?? null,
                        $_POST['supply_brand_name'] ?? null,
                        $_POST['supply_description'] ?? null,
                        $_POST['supply_id']
                    ]);

                    // Log activity
                    if (isset($_SESSION['user_id'])) {
                        $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                            (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                            VALUES (?, ?, ?, ?, ?, ?)");
                        $log_stmt->execute([
                            $_SESSION['user_id'],
                            strtolower($_POST['type']) . '_supply',
                            $_POST['supply_id'],
                            $_POST['supply_name'],
                            "Updated supply: {$_POST['supply_name']}",
                            'edit'
                        ]);
                    }
                    break;

                // ================= DELETE =================
                case 'delete':
                    // Get supply name before deletion for logging
                    $get_stmt = $pdo->prepare("SELECT supply_name, type FROM supplies WHERE supply_id = ?");
                    $get_stmt->execute([$_POST['supply_id']]);
                    $supply_data = $get_stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $pdo->prepare("DELETE FROM supplies WHERE supply_id = ?");
                    $stmt->execute([$_POST['supply_id']]);

                    // Log activity
                    if (isset($_SESSION['user_id']) && $supply_data) {
                        $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                            (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                            VALUES (?, ?, ?, ?, ?, ?)");
                        $log_stmt->execute([
                            $_SESSION['user_id'],
                            strtolower($supply_data['type']) . '_supply',
                            $_POST['supply_id'],
                            $supply_data['supply_name'],
                            "Deleted supply: {$supply_data['supply_name']}",
                            'delete'
                        ]);
                    }
                    break;

                default:
                    throw new Exception("Invalid action: $action");
            }
        }

        // ✅ Redirect back to supplies page
        header("Location: index.php?success=1");
        exit;

    } catch (Exception $e) {
        // Handle errors gracefully
        header("Location: index.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Invalid request
    header("Location: index.php?error=Invalid request");
    exit;
}