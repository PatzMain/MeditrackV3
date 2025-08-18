<?php
require_once '../../api/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    try {
        switch ($action) {
            // ================= ADD =================
            case 'add':
                $stmt = $pdo->prepare("INSERT INTO equipment 
                    (type, equipment_name, serial_number, equipment_condition, equipment_classification, equipment_description) 
                    VALUES (?, ?, ?, ?, ?, ?)");

                $stmt->execute([
                    $_POST['type'],
                    $_POST['equipment_name'],
                    $_POST['serial_number'] ?? null,
                    $_POST['equipment_condition'] ?? 'available',
                    $_POST['equipment_classification'] ?? null,
                    $_POST['equipment_description'] ?? null
                ]);
                break;

            // ================= EDIT =================
            case 'edit':
                $stmt = $pdo->prepare("UPDATE equipment 
                    SET type = ?, 
                        equipment_name = ?, 
                        serial_number = ?, 
                        equipment_condition = ?, 
                        equipment_classification = ?, 
                        equipment_description = ?
                    WHERE equipment_id = ?");

                $stmt->execute([
                    $_POST['type'],
                    $_POST['equipment_name'],
                    $_POST['serial_number'] ?? null,
                    $_POST['equipment_condition'],
                    $_POST['equipment_classification'] ?? null,
                    $_POST['equipment_description'] ?? null,
                    $_POST['equipment_id']
                ]);
                break;

            // ================= DELETE =================
            case 'delete':
                $stmt = $pdo->prepare("DELETE FROM equipment WHERE equipment_id = ?");
                $stmt->execute([$_POST['equipment_id']]);
                break;

            default:
                throw new Exception("Invalid action: $action");
        }

        // ✅ Redirect back to equipment page
        header("Location: ../pages/equipment.php?success=1");
        exit;

    } catch (Exception $e) {
        // Handle errors gracefully
        header("Location: ../pages/equipment.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Invalid request
    header("Location: ../pages/equipment.php?error=Invalid request");
    exit;
}
