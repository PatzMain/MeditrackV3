<?php
// api/chart_data.php
// Chart Data API for Dashboard
require_once 'connection.php';

header('Content-Type: application/json');

try {
    $chartData = [];

    // ========================================
    // 1. DAILY PATIENT CONSULTATIONS TREND
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            DATE(created_at) as consultation_date,
            COUNT(*) as total_consultations
        FROM patients 
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        GROUP BY DATE(created_at)
        ORDER BY consultation_date ASC
    ");
    
    $consultationTrend = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['consultation_trend'] = [
        'labels' => array_map(function($row) {
            return date('M d', strtotime($row['consultation_date']));
        }, $consultationTrend),
        'data' => array_map(function($row) {
            return (int)$row['total_consultations'];
        }, $consultationTrend)
    ];

    // ========================================
    // 2. DAILY CONSULTATIONS BY COURSE (Multiple Lines)
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            DATE(created_at) as consultation_date,
            course,
            COUNT(*) as consultations
        FROM patients 
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        AND course IS NOT NULL 
        AND course != ''
        GROUP BY DATE(created_at), course
        ORDER BY consultation_date ASC, course ASC
    ");
    
    $consultationsByCourse = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Process data for multiple line chart
    $courseData = [];
    $allDates = [];
    
    foreach ($consultationsByCourse as $row) {
        $date = date('M d', strtotime($row['consultation_date']));
        $course = $row['course'];
        $consultations = (int)$row['consultations'];
        
        if (!in_array($date, $allDates)) {
            $allDates[] = $date;
        }
        
        if (!isset($courseData[$course])) {
            $courseData[$course] = [];
        }
        
        $courseData[$course][$date] = $consultations;
    }
    
    // Fill missing dates with 0 for each course
    $datasets = [];
    $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384'];
    $colorIndex = 0;
    
    foreach ($courseData as $course => $data) {
        $courseValues = [];
        foreach ($allDates as $date) {
            $courseValues[] = isset($data[$date]) ? $data[$date] : 0;
        }
        
        $datasets[] = [
            'label' => $course,
            'data' => $courseValues,
            'borderColor' => $colors[$colorIndex % count($colors)],
            'backgroundColor' => $colors[$colorIndex % count($colors)] . '20',
            'tension' => 0.4
        ];
        $colorIndex++;
    }
    
    $chartData['consultations_by_course'] = [
        'labels' => $allDates,
        'datasets' => $datasets
    ];

    // ========================================
    // 3. DAILY CONSULTATIONS BY YEAR LEVEL (Multiple Lines)
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            DATE(created_at) as consultation_date,
            COALESCE(year_level, grade_level) as level,
            student_type,
            COUNT(*) as consultations
        FROM patients 
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        AND (year_level IS NOT NULL OR grade_level IS NOT NULL)
        GROUP BY DATE(created_at), COALESCE(year_level, grade_level), student_type
        ORDER BY consultation_date ASC, level ASC
    ");
    
    $consultationsByLevel = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Process data for year level chart
    $levelData = [];
    $allDatesLevel = [];
    
    foreach ($consultationsByLevel as $row) {
        $date = date('M d', strtotime($row['consultation_date']));
        $level = $row['student_type'] . ' - ' . $row['level'];
        $consultations = (int)$row['consultations'];
        
        if (!in_array($date, $allDatesLevel)) {
            $allDatesLevel[] = $date;
        }
        
        if (!isset($levelData[$level])) {
            $levelData[$level] = [];
        }
        
        $levelData[$level][$date] = $consultations;
    }
    
    // Fill missing dates and create datasets
    $levelDatasets = [];
    $levelColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF', '#4BC0C0'];
    $levelColorIndex = 0;
    
    foreach ($levelData as $level => $data) {
        $levelValues = [];
        foreach ($allDatesLevel as $date) {
            $levelValues[] = isset($data[$date]) ? $data[$date] : 0;
        }
        
        $levelDatasets[] = [
            'label' => $level,
            'data' => $levelValues,
            'borderColor' => $levelColors[$levelColorIndex % count($levelColors)],
            'backgroundColor' => $levelColors[$levelColorIndex % count($levelColors)] . '20',
            'tension' => 0.4
        ];
        $levelColorIndex++;
    }
    
    $chartData['consultations_by_level'] = [
        'labels' => $allDatesLevel,
        'datasets' => $levelDatasets
    ];

    // ========================================
    // 4. PATIENT DISTRIBUTION BY STUDENT TYPE
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            student_type,
            COUNT(*) as count
        FROM patients 
        GROUP BY student_type
    ");
    
    $studentTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['student_distribution'] = [
        'labels' => array_map(function($row) {
            return $row['student_type'];
        }, $studentTypes),
        'data' => array_map(function($row) {
            return (int)$row['count'];
        }, $studentTypes)
    ];

    // ========================================
    // 5. MEDICINE STOCK LEVELS
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            CASE 
                WHEN medicine_stock = 0 THEN 'Out of Stock'
                WHEN medicine_stock < 10 THEN 'Low Stock'
                WHEN medicine_stock < 50 THEN 'Medium Stock'
                ELSE 'High Stock'
            END as stock_level,
            COUNT(*) as count
        FROM medicines 
        GROUP BY stock_level
        ORDER BY 
            CASE stock_level
                WHEN 'Out of Stock' THEN 1
                WHEN 'Low Stock' THEN 2
                WHEN 'Medium Stock' THEN 3
                WHEN 'High Stock' THEN 4
            END
    ");
    
    $stockLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['medicine_stock'] = [
        'labels' => array_map(function($row) {
            return $row['stock_level'];
        }, $stockLevels),
        'data' => array_map(function($row) {
            return (int)$row['count'];
        }, $stockLevels)
    ];

    // ========================================
    // 6. EQUIPMENT CONDITION STATUS
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            equipment_condition,
            COUNT(*) as count
        FROM equipment 
        GROUP BY equipment_condition
    ");
    
    $equipmentConditions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['equipment_condition'] = [
        'labels' => array_map(function($row) {
            return ucfirst($row['equipment_condition']);
        }, $equipmentConditions),
        'data' => array_map(function($row) {
            return (int)$row['count'];
        }, $equipmentConditions)
    ];

    // ========================================
    // 7. ACTIVITY LOGS BY TYPE
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            CASE 
                WHEN logs_item_type IN ('medical_medicine', 'dental_medicine') THEN 'Medicines'
                WHEN logs_item_type IN ('medical_supply', 'dental_supply') THEN 'Supplies'
                WHEN logs_item_type IN ('medical_equipment', 'dental_equipment') THEN 'Equipment'
                WHEN logs_item_type = 'patient' THEN 'Patients'
                WHEN logs_item_type IN ('authentication', 'system') THEN 'System'
                WHEN logs_item_type IN ('vital_signs', 'assessment') THEN 'Medical Records'
                ELSE 'Other'
            END as activity_category,
            COUNT(*) as count
        FROM activity_logs 
        WHERE logs_timestamp >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        GROUP BY activity_category
        ORDER BY count DESC
    ");
    
    $activityLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['activity_logs'] = [
        'labels' => array_map(function($row) {
            return $row['activity_category'];
        }, $activityLogs),
        'data' => array_map(function($row) {
            return (int)$row['count'];
        }, $activityLogs)
    ];

    // ========================================
    // 8. MONTHLY PATIENT ADMISSIONS TREND
    // ========================================
    $stmt = $pdo->query("
        SELECT 
            DATE_FORMAT(created_at, '%Y-%m') as month,
            COUNT(*) as admissions
        FROM patients 
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY DATE_FORMAT(created_at, '%Y-%m')
        ORDER BY month ASC
    ");
    
    $monthlyAdmissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $chartData['monthly_admissions'] = [
        'labels' => array_map(function($row) {
            return date('M Y', strtotime($row['month'] . '-01'));
        }, $monthlyAdmissions),
        'data' => array_map(function($row) {
            return (int)$row['admissions'];
        }, $monthlyAdmissions)
    ];

    echo json_encode($chartData);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>