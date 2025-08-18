<?php
/**
 * Stats Cards Configuration
 * Defines the layout and appearance of stat cards for each section
 */

return [
    // ========================
    // MEDICINES
    // ========================
    'medicines' => [
        ['key' => 'medicines_total', 'label' => 'Total Medicines', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.5L19.5 6.5C20.6 6.5 21.5 7.4 21.5 8.5V19.5C21.5 20.6 20.6 21.5 19.5 21.5H4.5C3.4 21.5 2.5 20.6 2.5 19.5V8.5C2.5 7.4 3.4 6.5 4.5 6.5Z" stroke="#3b82f6" stroke-width="2"/><path d="M7 6.5V4.5C7 3.4 7.9 2.5 9 2.5H15C16.1 2.5 17 3.4 17 4.5V6.5" stroke="#3b82f6" stroke-width="2"/><circle cx="12" cy="14" r="3" fill="#3b82f6"/><path d="M12 11v6M9 14h6" stroke="white" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'medicines_low', 'label' => 'Low Stock', 'bgColor' => '#fed7aa', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.5L19.5 6.5C20.6 6.5 21.5 7.4 21.5 8.5V19.5C21.5 20.6 20.6 21.5 19.5 21.5H4.5C3.4 21.5 2.5 20.6 2.5 19.5V8.5C2.5 7.4 3.4 6.5 4.5 6.5Z" stroke="#ea580c" stroke-width="2"/><path d="M7 6.5V4.5C7 3.4 7.9 2.5 9 2.5H15C16.1 2.5 17 3.4 17 4.5V6.5" stroke="#ea580c" stroke-width="2"/><path d="M12 10v4M10 12h4" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/><path d="M12 16.5h.01" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'medicines_expired', 'label' => 'Expired', 'bgColor' => '#fecaca', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.5L19.5 6.5C20.6 6.5 21.5 7.4 21.5 8.5V19.5C21.5 20.6 20.6 21.5 19.5 21.5H4.5C3.4 21.5 2.5 20.6 2.5 19.5V8.5C2.5 7.4 3.4 6.5 4.5 6.5Z" stroke="#dc2626" stroke-width="2"/><path d="M7 6.5V4.5C7 3.4 7.9 2.5 9 2.5H15C16.1 2.5 17 3.4 17 4.5V6.5" stroke="#dc2626" stroke-width="2"/><path d="M9 11l6 6M15 11l-6 6" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'medicines_expiring', 'label' => 'Expiring Soon', 'bgColor' => '#fef3c7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.5L19.5 6.5C20.6 6.5 21.5 7.4 21.5 8.5V19.5C21.5 20.6 20.6 21.5 19.5 21.5H4.5C3.4 21.5 2.5 20.6 2.5 19.5V8.5C2.5 7.4 3.4 6.5 4.5 6.5Z" stroke="#d97706" stroke-width="2"/><path d="M7 6.5V4.5C7 3.4 7.9 2.5 9 2.5H15C16.1 2.5 17 3.4 17 4.5V6.5" stroke="#d97706" stroke-width="2"/><circle cx="12" cy="14" r="4" stroke="#d97706" stroke-width="2"/><path d="M12 12v2l1.5 1.5" stroke="#d97706" stroke-width="2" stroke-linecap="round"/></svg>'],
    ],

    // ========================
    // SUPPLIES
    // ========================
    'supplies' => [
        ['key' => 'supplies_total', 'label' => 'Total Supplies', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7v10c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V7c0-2.2-1.8-4-4-4H7c-2.2 0-4 1.8-4 4z" stroke="#3b82f6" stroke-width="2"/><path d="M8 9h8M8 12h8M8 15h5" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'supplies_low', 'label' => 'Low Stock', 'bgColor' => '#fed7aa', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7v10c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V7c0-2.2-1.8-4-4-4H7c-2.2 0-4 1.8-4 4z" stroke="#ea580c" stroke-width="2"/><path d="M8 9h8M8 12h4M8 15h2" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/><path d="M12 10v4M10 12h4" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'supplies_expired', 'label' => 'Expired', 'bgColor' => '#fecaca', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7v10c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V7c0-2.2-1.8-4-4-4H7c-2.2 0-4 1.8-4 4z" stroke="#dc2626" stroke-width="2"/><path d="M9 9l6 6M15 9l-6 6" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'supplies_expiring', 'label' => 'Expiring Soon', 'bgColor' => '#fef3c7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7v10c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V7c0-2.2-1.8-4-4-4H7c-2.2 0-4 1.8-4 4z" stroke="#d97706" stroke-width="2"/><path d="M8 9h8M8 12h6M8 15h4" stroke="#d97706" stroke-width="2" stroke-linecap="round"/><circle cx="18" cy="18" r="4" stroke="#d97706" stroke-width="1.5"/><path d="M18 16v2l1 1" stroke="#d97706" stroke-width="1.5" stroke-linecap="round"/></svg>'],
    ],

    // ========================
    // EQUIPMENT
    // ========================
    'equipment' => [
        ['key' => 'equipment_total', 'label' => 'Total Equipment', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#3b82f6" stroke-width="2"/><rect x="6" y="8" width="12" height="8" rx="1" stroke="#3b82f6" stroke-width="1.5"/><path d="M8 12h8M12 10v4" stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round"/><circle cx="18" cy="4" r="2" fill="#3b82f6"/></svg>'],
        ['key' => 'equipment_available', 'label' => 'Available', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#16a34a" stroke-width="2"/><rect x="6" y="8" width="12" height="8" rx="1" stroke="#16a34a" stroke-width="1.5"/><path d="M9 12l2 2 4-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'equipment_occupied', 'label' => 'In Use', 'bgColor' => '#fef9c3', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#ca8a04" stroke-width="2"/><rect x="6" y="8" width="12" height="8" rx="1" stroke="#ca8a04" stroke-width="1.5"/><circle cx="10" cy="11" r="1" fill="#ca8a04"/><circle cx="14" cy="11" r="1" fill="#ca8a04"/><path d="M10 14c0 1.1.9 2 2 2s2-.9 2-2" stroke="#ca8a04" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'equipment_maintenance', 'label' => 'Under Maintenance', 'bgColor' => '#fecaca', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#dc2626" stroke-width="2"/><rect x="6" y="8" width="12" height="8" rx="1" stroke="#dc2626" stroke-width="1.5"/><path d="M12 10v2M12 14h.01" stroke="#dc2626" stroke-width="2" stroke-linecap="round"/><path d="M14 2l1 2 2-1-1 2 2 1-2 1 1 2-2-1-1 2-1-2-2 1 1-2-2-1 2-1-1-2 2 1 1-2z" fill="#dc2626" stroke="#dc2626" stroke-width="0.5"/></svg>'],
    ],

    // ========================
    // PATIENTS
    // ========================
    'patients' => [
        ['key' => 'patients_total', 'label' => 'Total Patients', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#3b82f6" stroke-width="2"/><circle cx="12" cy="7" r="4" stroke="#3b82f6" stroke-width="2"/></svg>'],
        ['key' => 'patients_admitted', 'label' => 'Admitted', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#16a34a" stroke-width="2"/><circle cx="12" cy="7" r="4" stroke="#16a34a" stroke-width="2"/><path d="M9 12h6M12 9v6" stroke="#16a34a" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'patients_discharged', 'label' => 'Discharged', 'bgColor' => '#e0e7ff', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#4f46e5" stroke-width="2"/><circle cx="12" cy="7" r="4" stroke="#4f46e5" stroke-width="2"/><path d="M14 12l2 2-2 2M16 14H8" stroke="#4f46e5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'patients_transferred', 'label' => 'Transferred', 'bgColor' => '#fef3c7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#d97706" stroke-width="2"/><circle cx="12" cy="7" r="4" stroke="#d97706" stroke-width="2"/><path d="M7 12l3-3m0 0l3 3m-3-3v6" stroke="#d97706" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 12l-3 3m0 0l-3-3m3 3v-6" stroke="#d97706" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
    ],

    // ========================
    // ROOMS AND BEDS
    // ========================
    'rooms_beds' => [
        ['key' => 'rooms_total', 'label' => 'Total Rooms', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 9v.01M9 12v.01M9 15v.01" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'beds_total', 'label' => 'Total Beds', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 4v16M2 20h20v-2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/><path d="M2 8h20M6 4v4M10 4v4M14 4v4M18 4v4" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'beds_available', 'label' => 'Available Beds', 'bgColor' => '#f0fdf4', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 4v16M2 20h20v-2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/><path d="M2 8h20M6 4v4M10 4v4M14 4v4M18 4v4" stroke="#22c55e" stroke-width="2" stroke-linecap="round"/><path d="M8 12l2 2 4-4" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'beds_occupied', 'label' => 'Occupied Beds', 'bgColor' => '#fef9c3', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 4v16M2 20h20v-2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z" stroke="#ca8a04" stroke-width="2" stroke-linecap="round"/><path d="M2 8h20M6 4v4M10 4v4M14 4v4M18 4v4" stroke="#ca8a04" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="2" stroke="#ca8a04" stroke-width="2"/></svg>'],
    ],

    // ========================
    // USERS
    // ========================
    'users' => [
        ['key' => 'users_total', 'label' => 'Total Users', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#3b82f6" stroke-width="2"/><circle cx="9" cy="7" r="4" stroke="#3b82f6" stroke-width="2"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="#3b82f6" stroke-width="2"/></svg>'],
        ['key' => 'users_admin', 'label' => 'Admins', 'bgColor' => '#e0e7ff', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#4f46e5" stroke-width="2"/><circle cx="9" cy="7" r="4" stroke="#4f46e5" stroke-width="2"/><path d="M22 12l-3-3v2h-4v2h4v2l3-3z" fill="#4f46e5"/></svg>'],
        ['key' => 'users_superadmin', 'label' => 'Superadmins', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#16a34a" stroke-width="2"/><circle cx="9" cy="7" r="4" stroke="#16a34a" stroke-width="2"/><path d="M12 2l1.5 3 3.5.5-2.5 2.5.5 3.5-3-1.5-3 1.5.5-3.5L6.5 5.5 10 5 12 2z" fill="#16a34a" stroke="#16a34a" stroke-width="0.5"/></svg>'],
        ['key' => 'users_recent', 'label' => 'New (7 days)', 'bgColor' => '#fef3c7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#d97706" stroke-width="2"/><circle cx="9" cy="7" r="4" stroke="#d97706" stroke-width="2"/><path d="M22 4v6h-6" stroke="#d97706" stroke-width="2"/><path d="M16 4l4 4" stroke="#d97706" stroke-width="2" stroke-linecap="round"/></svg>'],
    ],

    // ========================
    // MEDICAL RECORDS
    // ========================
    'medical_records' => [
        ['key' => 'vital_signs_total', 'label' => 'Vital Signs', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'assessments_total', 'label' => 'Medical Assessments', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11H3a2 2 0 0 0-2 2v3c0 1.1.9 2 2 2h6m4-6h8a2 2 0 0 1 2 2v3c0 1.1-.9 2-2 2h-8m-4-6V9a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m-6 0v6m0 0v-6" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'nursing_notes_total', 'label' => 'Nursing Notes', 'bgColor' => '#fef3c7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#d97706" stroke-width="2"/><path d="M14 2v6h6" stroke="#d97706" stroke-width="2"/><path d="M8 13h8M8 17h8M8 9h2" stroke="#d97706" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'logs_total', 'label' => 'Activity Logs', 'bgColor' => '#e0e7ff', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#4f46e5" stroke-width="2"/><path d="M14 2v6h6" stroke="#4f46e5" stroke-width="2"/><path d="M8 13h8M8 17h8M8 9h2" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/><circle cx="18" cy="18" r="2" fill="#4f46e5"/></svg>'],
    ],

    // ========================
    // ACTIVITY LOGS
    // ========================
    'activity_logs' => [
        ['key' => 'logs_total', 'label' => 'Total Logs', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#3b82f6" stroke-width="2"/><path d="M14 2v6h6" stroke="#3b82f6" stroke-width="2"/><path d="M8 13h8M8 17h8M8 9h2" stroke="#3b82f6" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'logs_patient', 'label' => 'Patient Logs', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#16a34a" stroke-width="2"/><path d="M14 2v6h6" stroke="#16a34a" stroke-width="2"/><circle cx="12" cy="13" r="2" stroke="#16a34a" stroke-width="1.5"/><path d="M8 17h8" stroke="#16a34a" stroke-width="1.5" stroke-linecap="round"/></svg>'],
        ['key' => 'logs_system', 'label' => 'System/Auth Logs', 'bgColor' => '#e0e7ff', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#4f46e5" stroke-width="2"/><path d="M14 2v6h6" stroke="#4f46e5" stroke-width="2"/><rect x="9" y="11" width="6" height="4" rx="1" stroke="#4f46e5" stroke-width="1.5"/><path d="M10 11v-1a2 2 0 1 1 4 0v1" stroke="#4f46e5" stroke-width="1.5"/></svg>'],
        ['key' => 'logs_medicines', 'label' => 'Medicine Logs', 'bgColor' => '#fecaca', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#dc2626" stroke-width="2"/><path d="M14 2v6h6" stroke="#dc2626" stroke-width="2"/><circle cx="12" cy="13" r="2" stroke="#dc2626" stroke-width="1.5"/><path d="M12 11v4M10 13h4" stroke="#dc2626" stroke-width="1" stroke-linecap="round"/><path d="M8 17h8" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round"/></svg>'],
    ],

    // ========================
    // DASHBOARD (Main Overview)
    // ========================
    'dashboard' => [
        ['key' => 'patients_total', 'label' => 'Total Patients', 'bgColor' => '#dbeafe', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#3b82f6" stroke-width="2"/><circle cx="12" cy="7" r="4" stroke="#3b82f6" stroke-width="2"/></svg>'],
        ['key' => 'beds_available', 'label' => 'Available Beds', 'bgColor' => '#dcfce7', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 4v16M2 20h20v-2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/><path d="M2 8h20M6 4v4M10 4v4M14 4v4M18 4v4" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/><path d="M8 12l2 2 4-4" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
        ['key' => 'medicines_low', 'label' => 'Low Stock Medicines', 'bgColor' => '#fed7aa', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.5L19.5 6.5C20.6 6.5 21.5 7.4 21.5 8.5V19.5C21.5 20.6 20.6 21.5 19.5 21.5H4.5C3.4 21.5 2.5 20.6 2.5 19.5V8.5C2.5 7.4 3.4 6.5 4.5 6.5Z" stroke="#ea580c" stroke-width="2"/><path d="M7 6.5V4.5C7 3.4 7.9 2.5 9 2.5H15C16.1 2.5 17 3.4 17 4.5V6.5" stroke="#ea580c" stroke-width="2"/><path d="M12 10v4M10 12h4" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/><path d="M12 16.5h.01" stroke="#ea580c" stroke-width="2" stroke-linecap="round"/></svg>'],
        ['key' => 'equipment_available', 'label' => 'Available Equipment', 'bgColor' => '#e0e7ff', 'svg' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="6" width="16" height="12" rx="2" stroke="#4f46e5" stroke-width="2"/><rect x="6" y="8" width="12" height="8" rx="1" stroke="#4f46e5" stroke-width="1.5"/><path d="M9 12l2 2 4-4" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'],
    ],
];