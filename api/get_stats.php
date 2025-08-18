<?php
/**
 * Statistics Data Fetcher
 * Retrieves all statistical data from the database
 */

// Include database connection
require_once 'connection.php';

// Initialize stats array
$stats = [];

try {
    // =================================================
    // MEDICINES (unified table with type column)
    // =================================================
    $stats['medicines_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines
    ")->fetchColumn();

    $stats['medicines_low'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines WHERE medicine_stock < 10
    ")->fetchColumn();

    $stats['medicines_expired'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines WHERE medicine_expiry_date < CURDATE()
    ")->fetchColumn();

    $stats['medicines_expiring'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines 
        WHERE medicine_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    ")->fetchColumn();

    // Breakdown by type
    $stats['medicines_medical'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines WHERE type = 'Medical'
    ")->fetchColumn();

    $stats['medicines_dental'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medicines WHERE type = 'Dental'
    ")->fetchColumn();

    // =================================================
    // SUPPLIES (unified table with type column)
    // =================================================
    $stats['supplies_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies
    ")->fetchColumn();

    $stats['supplies_low'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies WHERE supply_quantity < 20
    ")->fetchColumn();

    $stats['supplies_expired'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies WHERE supply_expiry_date < CURDATE()
    ")->fetchColumn();

    $stats['supplies_expiring'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies 
        WHERE supply_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    ")->fetchColumn();

    // Breakdown by type
    $stats['supplies_medical'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies WHERE type = 'Medical'
    ")->fetchColumn();

    $stats['supplies_dental'] = (int) $pdo->query("
        SELECT COUNT(*) FROM supplies WHERE type = 'Dental'
    ")->fetchColumn();

    // =================================================
    // EQUIPMENT (unified table with type column)
    // =================================================
    $stats['equipment_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment
    ")->fetchColumn();

    $stats['equipment_available'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment WHERE equipment_condition = 'available'
    ")->fetchColumn();

    $stats['equipment_occupied'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment WHERE equipment_condition = 'occupied'
    ")->fetchColumn();

    $stats['equipment_maintenance'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment WHERE equipment_condition = 'maintenance'
    ")->fetchColumn();

    // Breakdown by type
    $stats['equipment_medical'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment WHERE type = 'Medical'
    ")->fetchColumn();

    $stats['equipment_dental'] = (int) $pdo->query("
        SELECT COUNT(*) FROM equipment WHERE type = 'Dental'
    ")->fetchColumn();

    // =================================================
    // PATIENTS
    // =================================================
    $stats['patients_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients
    ")->fetchColumn();
    
    $stats['patients_admitted'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE patient_status = 'admitted'
    ")->fetchColumn();
    
    $stats['patients_discharged'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE patient_status = 'discharged'
    ")->fetchColumn();
    
    $stats['patients_deceased'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE patient_status = 'deceased'
    ")->fetchColumn();
    
    $stats['patients_transferred'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE patient_status = 'transferred'
    ")->fetchColumn();

    // Patient breakdown by student type
    $stats['patients_college'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE student_type = 'College'
    ")->fetchColumn();
    
    $stats['patients_lshs'] = (int) $pdo->query("
        SELECT COUNT(*) FROM patients WHERE student_type = 'LSHS'
    ")->fetchColumn();

    // =================================================
    // ROOMS AND BEDS
    // =================================================
    $stats['rooms_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM rooms
    ")->fetchColumn();
    
    $stats['beds_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM beds
    ")->fetchColumn();
    
    $stats['beds_available'] = (int) $pdo->query("
        SELECT COUNT(*) FROM beds WHERE bed_status = 'available'
    ")->fetchColumn();
    
    $stats['beds_occupied'] = (int) $pdo->query("
        SELECT COUNT(*) FROM beds WHERE bed_status = 'occupied'
    ")->fetchColumn();
    
    $stats['beds_maintenance'] = (int) $pdo->query("
        SELECT COUNT(*) FROM beds WHERE bed_status = 'maintenance'
    ")->fetchColumn();

    // =================================================
    // USERS
    // =================================================
    $stats['users_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM users
    ")->fetchColumn();
    
    $stats['users_admin'] = (int) $pdo->query("
        SELECT COUNT(*) FROM users WHERE role = 'admin'
    ")->fetchColumn();
    
    $stats['users_superadmin'] = (int) $pdo->query("
        SELECT COUNT(*) FROM users WHERE role = 'superadmin'
    ")->fetchColumn();
    
    $stats['users_recent'] = (int) $pdo->query("
        SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ")->fetchColumn();

    // =================================================
    // MEDICAL RECORDS
    // =================================================
    $stats['vital_signs_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM vital_signs
    ")->fetchColumn();
    
    $stats['assessments_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medical_assessments
    ")->fetchColumn();
    
    $stats['nursing_notes_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM nursing_notes
    ")->fetchColumn();

    // Recent records (last 7 days)
    $stats['vital_signs_recent'] = (int) $pdo->query("
        SELECT COUNT(*) FROM vital_signs WHERE recorded_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ")->fetchColumn();
    
    $stats['assessments_recent'] = (int) $pdo->query("
        SELECT COUNT(*) FROM medical_assessments WHERE assessment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ")->fetchColumn();
    
    $stats['nursing_notes_recent'] = (int) $pdo->query("
        SELECT COUNT(*) FROM nursing_notes WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    ")->fetchColumn();

    // =================================================
    // ACTIVITY LOGS
    // =================================================
    $stats['logs_total'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs
    ")->fetchColumn();
    
    $stats['logs_patient'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type = 'patient'
    ")->fetchColumn();
    
    $stats['logs_system'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('system','authentication')
    ")->fetchColumn();
    
    $stats['logs_medicines'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('medical_medicine','dental_medicine')
    ")->fetchColumn();
    
    $stats['logs_supplies'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('medical_supply','dental_supply')
    ")->fetchColumn();
    
    $stats['logs_equipment'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('medical_equipment','dental_equipment')
    ")->fetchColumn();
    
    $stats['logs_medical'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('vital_signs','medication_admin','lab_test','assessment')
    ")->fetchColumn();

    // Recent logs (last 24 hours)
    $stats['logs_recent'] = (int) $pdo->query("
        SELECT COUNT(*) FROM activity_logs WHERE logs_timestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
    ")->fetchColumn();

    // =================================================
    // RECENT RECORDS (LIMIT 5 EACH)
    // =================================================

    // Recent Patients (last 5 added)
    $stmt = $pdo->query("
        SELECT patient_id, patient_number, first_name, last_name, student_type, patient_status, created_at
        FROM patients 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stats['recent_patients'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Medicines (last 5 added)
    $stmt = $pdo->query("
        SELECT medicine_id, type, medicine_name, medicine_stock, medicine_expiry_date, created_at
        FROM medicines 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stats['recent_medicines'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Supplies (last 5 added)
    $stmt = $pdo->query("
        SELECT supply_id, type, supply_name, supply_quantity, supply_expiry_date, created_at
        FROM supplies 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stats['recent_supplies'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Equipment (last 5 added)
    $stmt = $pdo->query("
        SELECT equipment_id, type, equipment_name, equipment_condition, equipment_location, created_at
        FROM equipment 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stats['recent_equipment'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Vital Signs (last 5 recorded)
    $stmt = $pdo->query("
        SELECT vs.vital_id, vs.patient_id, p.first_name, p.last_name, vs.systolic_bp, vs.diastolic_bp, 
               vs.heart_rate, vs.temperature, vs.recorded_at
        FROM vital_signs vs
        JOIN patients p ON vs.patient_id = p.patient_id
        ORDER BY vs.recorded_at DESC 
        LIMIT 5
    ");
    $stats['recent_vital_signs'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Medical Assessments (last 5)
    $stmt = $pdo->query("
        SELECT ma.assessment_id, ma.patient_id, p.first_name, p.last_name, ma.assessment_type, 
               ma.diagnosis, ma.priority_level, ma.assessment_date
        FROM medical_assessments ma
        JOIN patients p ON ma.patient_id = p.patient_id
        ORDER BY ma.assessment_date DESC 
        LIMIT 5
    ");
    $stats['recent_assessments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Nursing Notes (last 5)
    $stmt = $pdo->query("
        SELECT nn.note_id, nn.patient_id, p.first_name, p.last_name, nn.nursing_shift, 
               nn.nursing_note_type, nn.nursing_priority, nn.created_at
        FROM nursing_notes nn
        JOIN patients p ON nn.patient_id = p.patient_id
        ORDER BY nn.created_at DESC 
        LIMIT 5
    ");
    $stats['recent_nursing_notes'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Activity Logs (last 5)
    $stmt = $pdo->query("
        SELECT al.log_id, al.user_id, u.username, al.patient_id, p.first_name, p.last_name, 
               al.logs_item_type, al.logs_item_name, al.logs_description, al.logs_timestamp
        FROM activity_logs al
        LEFT JOIN users u ON al.user_id = u.user_id
        LEFT JOIN patients p ON al.patient_id = p.patient_id
        ORDER BY al.logs_timestamp DESC 
        LIMIT 5
    ");
    $stats['recent_activity_logs'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Users (last 5 registered)
    $stmt = $pdo->query("
        SELECT user_id, username, role, created_at
        FROM users 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stats['recent_users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Log error and return empty stats
    error_log("Error fetching stats: " . $e->getMessage());
    // Initialize all stats as 0 to prevent errors
    $statsKeys = [
        'medicines_total', 'medicines_low', 'medicines_expired', 'medicines_expiring',
        'supplies_total', 'supplies_low', 'supplies_expired', 'supplies_expiring',
        'equipment_total', 'equipment_available', 'equipment_occupied', 'equipment_maintenance',
        'patients_total', 'patients_admitted', 'patients_discharged', 'patients_transferred',
        'rooms_total', 'beds_total', 'beds_available', 'beds_occupied',
        'users_total', 'users_admin', 'users_superadmin', 'users_recent',
        'vital_signs_total', 'assessments_total', 'nursing_notes_total', 'logs_total',
        'logs_patient', 'logs_system', 'logs_medicines'
    ];
    
    foreach ($statsKeys as $key) {
        if (!isset($stats[$key])) {
            $stats[$key] = 0;
        }
    }
}

// Return stats array (can be used by including this file)
return $stats;