<?php
include 'connection.php';

$stats = [];

// =================================================
// MEDICAL MEDICINES
// =================================================
$stats['medical_medicines_total'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_medicines")->fetchColumn();
$stats['medical_medicines_low'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_medicines WHERE medicine_stock < 10")->fetchColumn();
$stats['medical_medicines_expired'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_medicines WHERE medicine_expiry_date < CURDATE()")->fetchColumn();
$stats['medical_medicines_expiring'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_medicines WHERE medicine_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)")->fetchColumn();

// =================================================
// DENTAL MEDICINES
// =================================================
$stats['dental_medicines_total'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_medicines")->fetchColumn();
$stats['dental_medicines_low'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_medicines WHERE medicine_stock < 10")->fetchColumn();
$stats['dental_medicines_expired'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_medicines WHERE medicine_expiry_date < CURDATE()")->fetchColumn();
$stats['dental_medicines_expiring'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_medicines WHERE medicine_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)")->fetchColumn();

// =================================================
// MEDICAL SUPPLIES
// =================================================
$stats['medical_supplies_total'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_supplies")->fetchColumn();
$stats['medical_supplies_low'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_supplies WHERE supply_quantity < 20")->fetchColumn();
$stats['medical_supplies_expired'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_supplies WHERE supply_expiry_date < CURDATE()")->fetchColumn();
$stats['medical_supplies_expiring'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_supplies WHERE supply_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)")->fetchColumn();

// =================================================
// DENTAL SUPPLIES
// =================================================
$stats['dental_supplies_total'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_supplies")->fetchColumn();
$stats['dental_supplies_low'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_supplies WHERE supply_quantity < 20")->fetchColumn();
$stats['dental_supplies_expired'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_supplies WHERE supply_expiry_date < CURDATE()")->fetchColumn();
$stats['dental_supplies_expiring'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_supplies WHERE supply_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)")->fetchColumn();

// =================================================
// MEDICAL EQUIPMENT
// =================================================
$stats['medical_equipment_total'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_equipment")->fetchColumn();
$stats['medical_equipment_available'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_equipment WHERE equipment_condition = 'available'")->fetchColumn();
$stats['medical_equipment_occupied'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_equipment WHERE equipment_condition = 'occupied'")->fetchColumn();
$stats['medical_equipment_maintenance'] = (int) $pdo->query("SELECT COUNT(*) FROM medical_equipment WHERE equipment_condition = 'maintenance'")->fetchColumn();

// =================================================
// DENTAL EQUIPMENT
// =================================================
$stats['dental_equipment_total'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_equipment")->fetchColumn();
$stats['dental_equipment_available'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_equipment WHERE equipment_condition = 'available'")->fetchColumn();
$stats['dental_equipment_occupied'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_equipment WHERE equipment_condition = 'occupied'")->fetchColumn();
$stats['dental_equipment_maintenance'] = (int) $pdo->query("SELECT COUNT(*) FROM dental_equipment WHERE equipment_condition = 'maintenance'")->fetchColumn();

// =================================================
// PATIENTS
// =================================================
$stats['patients_total'] = (int) $pdo->query("SELECT COUNT(*) FROM patients")->fetchColumn();
$stats['patients_admitted'] = (int) $pdo->query("SELECT COUNT(*) FROM patients WHERE patient_status = 'admitted'")->fetchColumn();
$stats['patients_discharged'] = (int) $pdo->query("SELECT COUNT(*) FROM patients WHERE patient_status = 'discharged'")->fetchColumn();
$stats['patients_deceased'] = (int) $pdo->query("SELECT COUNT(*) FROM patients WHERE patient_status = 'deceased'")->fetchColumn();

// =================================================
// USERS
// =================================================
$stats['users_total'] = (int) $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$stats['users_admin'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'")->fetchColumn();
$stats['users_superadmin'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'superadmin'")->fetchColumn();
$stats['users_recent'] = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)")->fetchColumn();

// =================================================
// ACTIVITY LOGS
// =================================================
$stats['logs_total'] = (int) $pdo->query("SELECT COUNT(*) FROM activity_logs")->fetchColumn();
$stats['logs_patient'] = (int) $pdo->query("SELECT COUNT(*) FROM activity_logs WHERE logs_item_type = 'patient'")->fetchColumn();
$stats['logs_system'] = (int) $pdo->query("SELECT COUNT(*) FROM activity_logs WHERE logs_item_type = 'system' OR logs_item_type = 'authentication'")->fetchColumn();
$stats['logs_medicines'] = (int) $pdo->query("SELECT COUNT(*) FROM activity_logs WHERE logs_item_type IN ('medical_medicine', 'dental_medicine')")->fetchColumn();

return $stats;
