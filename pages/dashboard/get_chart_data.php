<?php
/**
 * Chart Data API - MySQLi Implementation
 * File: api/get_chart_data.php
 * Fetches data for dashboard charts from database
 */

// Include MySQLi connection
require_once 'mysqli_connection.php';

// Set JSON response header
header('Content-Type: application/json');

// Initialize response array
$chartData = [];

try {
    // ========================================
    // 1. INVENTORY OVERVIEW DATA
    // ========================================
    $inventoryData = [];
    
    // Get medicines count
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM medicines");
    $row = fetchSingleRow($result);
    $inventoryData['medicines'] = (int)$row['count'];
    
    // Get medical supplies count
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM supplies WHERE type = 'Medical'");
    $row = fetchSingleRow($result);
    $inventoryData['medical_supplies'] = (int)$row['count'];
    
    // Get dental supplies count
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM supplies WHERE type = 'Dental'");
    $row = fetchSingleRow($result);
    $inventoryData['dental_supplies'] = (int)$row['count'];
    
    // Get equipment count
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM equipment");
    $row = fetchSingleRow($result);
    $inventoryData['equipment'] = (int)$row['count'];
    
    $chartData['inventory'] = [
        'labels' => ['Medicines', 'Medical Supplies', 'Dental Supplies', 'Equipment'],
        'data' => [
            $inventoryData['medicines'],
            $inventoryData['medical_supplies'],
            $inventoryData['dental_supplies'],
            $inventoryData['equipment']
        ]
    ];

    // ========================================
    // 2. EQUIPMENT STATUS DATA
    // ========================================
    $equipmentStatus = [];
    
    // Get equipment by status
    $result = executeQuery($mysqli, "
        SELECT equipment_condition, COUNT(*) as count 
        FROM equipment 
        GROUP BY equipment_condition
    ");
    
    $rows = fetchAllRows($result);
    foreach ($rows as $row) {
        $equipmentStatus[$row['equipment_condition']] = (int)$row['count'];
    }
    
    $chartData['equipment_status'] = [
        'labels' => ['Available', 'Occupied', 'Maintenance'],
        'data' => [
            $equipmentStatus['available'] ?? 0,
            $equipmentStatus['occupied'] ?? 0,
            $equipmentStatus['maintenance'] ?? 0
        ]
    ];

    // ========================================
    // 3. MONTHLY ACTIVITY DATA (Last 8 months)
    // ========================================
    $activityData = [
        'labels' => [],
        'medical_consultations' => [],
        'dental_consultations' => [],
        'emergency_cases' => []
    ];
    
    // Generate last 8 months
    for ($i = 7; $i >= 0; $i--) {
        $date = date('Y-m', strtotime("-$i months"));
        $monthName = date('M', strtotime("-$i months"));
        $activityData['labels'][] = $monthName;
        
        // Medical consultations (from medical_assessments table)
        $result = executeQuery($mysqli, "
            SELECT COUNT(*) as count 
            FROM medical_assessments 
            WHERE DATE_FORMAT(assessment_date, '%Y-%m') = '$date'
        ");
        $row = fetchSingleRow($result);
        $activityData['medical_consultations'][] = (int)$row['count'];
        
        // Dental consultations (assuming dental patients)
        $result = executeQuery($mysqli, "
            SELECT COUNT(*) as count 
            FROM patients p
            JOIN medical_assessments ma ON p.patient_id = ma.patient_id
            WHERE DATE_FORMAT(ma.assessment_date, '%Y-%m') = '$date'
            AND ma.assessment_type = 'consultation'
        ");
        $row = fetchSingleRow($result);
        $activityData['dental_consultations'][] = (int)$row['count'];
        
        // Emergency cases
        $result = executeQuery($mysqli, "
            SELECT COUNT(*) as count 
            FROM medical_assessments 
            WHERE DATE_FORMAT(assessment_date, '%Y-%m') = '$date'
            AND assessment_type = 'emergency'
        ");
        $row = fetchSingleRow($result);
        $activityData['emergency_cases'][] = (int)$row['count'];
    }
    
    $chartData['monthly_activity'] = $activityData;

    // ========================================
    // 4. STOCK ALERTS DATA
    // ========================================
    $stockAlerts = [];
    
    // Low stock medicines (stock < 10)
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM medicines WHERE medicine_stock < 10");
    $row = fetchSingleRow($result);
    $stockAlerts['low_stock'] = (int)$row['count'];
    
    // Expired items
    $result = executeQuery($mysqli, "
        SELECT 
            (SELECT COUNT(*) FROM medicines WHERE medicine_expiry_date < CURDATE()) +
            (SELECT COUNT(*) FROM supplies WHERE supply_expiry_date < CURDATE()) as count
    ");
    $row = fetchSingleRow($result);
    $stockAlerts['expired'] = (int)$row['count'];
    
    // Expiring soon (within 30 days)
    $result = executeQuery($mysqli, "
        SELECT 
            (SELECT COUNT(*) FROM medicines WHERE medicine_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) +
            (SELECT COUNT(*) FROM supplies WHERE supply_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) as count
    ");
    $row = fetchSingleRow($result);
    $stockAlerts['expiring_soon'] = (int)$row['count'];
    
    $chartData['stock_alerts'] = [
        'labels' => ['Low Stock', 'Expired', 'Expiring Soon'],
        'data' => [
            $stockAlerts['low_stock'],
            $stockAlerts['expired'],
            $stockAlerts['expiring_soon']
        ]
    ];

    // ========================================
    // 5. PATIENT STATUS DATA
    // ========================================
    $patientStatus = [];
    
    $result = executeQuery($mysqli, "
        SELECT patient_status, COUNT(*) as count 
        FROM patients 
        GROUP BY patient_status
    ");
    
    $rows = fetchAllRows($result);
    foreach ($rows as $row) {
        $patientStatus[$row['patient_status']] = (int)$row['count'];
    }
    
    $chartData['patient_status'] = [
        'labels' => ['Admitted', 'Discharged', 'Transferred'],
        'data' => [
            $patientStatus['admitted'] ?? 0,
            $patientStatus['discharged'] ?? 0,
            $patientStatus['transferred'] ?? 0
        ]
    ];

    // ========================================
    // 6. WEEKLY VITAL SIGNS DATA
    // ========================================
    $vitalSignsData = [
        'labels' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        'data' => []
    ];
    
    // Get vital signs for each day of the current week
    for ($i = 1; $i <= 7; $i++) {
        $result = executeQuery($mysqli, "
            SELECT COUNT(*) as count 
            FROM vital_signs 
            WHERE DAYOFWEEK(recorded_at) = $i 
            AND WEEK(recorded_at) = WEEK(CURDATE())
            AND YEAR(recorded_at) = YEAR(CURDATE())
        ");
        $row = fetchSingleRow($result);
        $vitalSignsData['data'][] = (int)$row['count'];
    }
    
    $chartData['vital_signs'] = $vitalSignsData;

    // ========================================
    // 7. ADDITIONAL STATISTICS
    // ========================================
    
    // Bed occupancy
    $result = executeQuery($mysqli, "
        SELECT bed_status, COUNT(*) as count 
        FROM beds 
        GROUP BY bed_status
    ");
    
    $bedStatus = [];
    $rows = fetchAllRows($result);
    foreach ($rows as $row) {
        $bedStatus[$row['bed_status']] = (int)$row['count'];
    }
    
    $chartData['bed_occupancy'] = [
        'labels' => ['Available', 'Occupied', 'Maintenance'],
        'data' => [
            $bedStatus['available'] ?? 0,
            $bedStatus['occupied'] ?? 0,
            $bedStatus['maintenance'] ?? 0
        ]
    ];
    
    // Medicine types breakdown
    $result = executeQuery($mysqli, "
        SELECT type, COUNT(*) as count 
        FROM medicines 
        GROUP BY type
    ");
    
    $medicineTypes = [];
    $rows = fetchAllRows($result);
    foreach ($rows as $row) {
        $medicineTypes[$row['type']] = (int)$row['count'];
    }
    
    $chartData['medicine_types'] = [
        'labels' => ['Medical', 'Dental'],
        'data' => [
            $medicineTypes['Medical'] ?? 0,
            $medicineTypes['Dental'] ?? 0
        ]
    ];

    // Recent activity summary
    $result = executeQuery($mysqli, "
        SELECT COUNT(*) as count 
        FROM activity_logs 
        WHERE DATE(logs_timestamp) = CURDATE()
    ");
    $row = fetchSingleRow($result);
    $chartData['daily_activity'] = (int)$row['count'];
    
    // Total registered patients
    $result = executeQuery($mysqli, "SELECT COUNT(*) as count FROM patients");
    $row = fetchSingleRow($result);
    $chartData['total_patients'] = (int)$row['count'];

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error fetching chart data: ' . $e->getMessage()]);
    exit();
}

// Close connection
closeMysqliConnection($mysqli);

// Return JSON response
echo json_encode($chartData, JSON_PRETTY_PRINT);
?>