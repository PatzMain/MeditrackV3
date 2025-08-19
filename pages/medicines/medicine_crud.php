<?php
require_once '../../api/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if it's an add operation (no action field, just form submission)
        if (!isset($_POST['action'])) {
            // ADD operation
            $stmt = $pdo->prepare("INSERT INTO medicines 
                (type, medicine_name, medicine_dosage, medicine_unit, medicine_stock, 
                 medicine_expiry_date, medicine_classification, medicine_brand_name, 
                 medicine_generic_name, medicine_description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                $_POST['type'],
                $_POST['medicine_name'],
                $_POST['medicine_dosage'] ?? null,
                $_POST['medicine_unit'] ?? null,
                (int)($_POST['medicine_stock'] ?? 0),
                $_POST['medicine_expiry_date'] ?? null,
                $_POST['medicine_classification'] ?? null,
                $_POST['medicine_brand_name'] ?? null,
                $_POST['medicine_generic_name'] ?? null,
                $_POST['medicine_description'] ?? null
            ]);

            // Log activity
            if (isset($_SESSION['user_id'])) {
                $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                    (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                    VALUES (?, ?, ?, ?, ?, ?)");
                $log_stmt->execute([
                    $_SESSION['user_id'],
                    strtolower($_POST['type']) . '_medicine',
                    $pdo->lastInsertId(),
                    $_POST['medicine_name'],
                    "Added new medicine: {$_POST['medicine_name']}",
                    'add'
                ]);
            }
        } else {
            $action = $_POST['action'];
            
            switch ($action) {
                // ================= EDIT =================
                case 'edit':
                    $stmt = $pdo->prepare("UPDATE medicines 
                        SET type = ?, 
                            medicine_name = ?, 
                            medicine_dosage = ?, 
                            medicine_unit = ?, 
                            medicine_stock = ?, 
                            medicine_expiry_date = ?, 
                            medicine_classification = ?, 
                            medicine_brand_name = ?, 
                            medicine_generic_name = ?, 
                            medicine_description = ?
                        WHERE medicine_id = ?");

                    $stmt->execute([
                        $_POST['type'],
                        $_POST['medicine_name'],
                        $_POST['medicine_dosage'] ?? null,
                        $_POST['medicine_unit'] ?? null,
                        (int)($_POST['medicine_stock'] ?? 0),
                        $_POST['medicine_expiry_date'] ?? null,
                        $_POST['medicine_classification'] ?? null,
                        $_POST['medicine_brand_name'] ?? null,
                        $_POST['medicine_generic_name'] ?? null,
                        $_POST['medicine_description'] ?? null,
                        $_POST['medicine_id']
                    ]);

                    // Log activity
                    if (isset($_SESSION['user_id'])) {
                        $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                            (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                            VALUES (?, ?, ?, ?, ?, ?)");
                        $log_stmt->execute([
                            $_SESSION['user_id'],
                            strtolower($_POST['type']) . '_medicine',
                            $_POST['medicine_id'],
                            $_POST['medicine_name'],
                            "Updated medicine: {$_POST['medicine_name']}",
                            'edit'
                        ]);
                    }
                    break;

                // ================= DELETE =================
                case 'delete':
                    // Get medicine name before deletion for logging
                    $get_stmt = $pdo->prepare("SELECT medicine_name, type FROM medicines WHERE medicine_id = ?");
                    $get_stmt->execute([$_POST['medicine_id']]);
                    $medicine_data = $get_stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $pdo->prepare("DELETE FROM medicines WHERE medicine_id = ?");
                    $stmt->execute([$_POST['medicine_id']]);

                    // Log activity
                    if (isset($_SESSION['user_id']) && $medicine_data) {
                        $log_stmt = $pdo->prepare("INSERT INTO activity_logs 
                            (user_id, logs_item_type, logs_item_id, logs_item_name, logs_description, logs_status) 
                            VALUES (?, ?, ?, ?, ?, ?)");
                        $log_stmt->execute([
                            $_SESSION['user_id'],
                            strtolower($medicine_data['type']) . '_medicine',
                            $_POST['medicine_id'],
                            $medicine_data['medicine_name'],
                            "Deleted medicine: {$medicine_data['medicine_name']}",
                            'delete'
                        ]);
                    }
                    break;

                default:
                    throw new Exception("Invalid action: $action");
            }
        }

        // ✅ Redirect back to medicines page
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