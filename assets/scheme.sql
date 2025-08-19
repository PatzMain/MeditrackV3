CREATE DATABASE meditrack_system;
USE meditrack_system;

-- Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'superadmin') NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Rooms Table (Fixed University Clinic Rooms)
CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_name ENUM('Treatment Room', 'Records Room', 'Dental Room', 'Medical Ward Room') NOT NULL,
    total_beds INT DEFAULT 0
);

-- Beds Table (Only for Medical Ward)
CREATE TABLE beds (
    bed_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    bed_number VARCHAR(10) NOT NULL,
    bed_status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
    FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE
);

-- Unified Medicines Table
CREATE TABLE medicines (
    medicine_id INT AUTO_INCREMENT PRIMARY KEY,
    medicine_code VARCHAR(50) NOT NULL UNIQUE,
    medicine_generic_name VARCHAR(100) NOT NULL,
    medicine_brand_name VARCHAR(100),
    medicine_type ENUM('Medical', 'Dental') NOT NULL,
    medicine_classification TEXT,
    medicine_dosage VARCHAR(50),
    medicine_unit VARCHAR(50),
    medicine_stock INT DEFAULT 0,
    medicine_expiry_date DATE,
    medicine_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE supplies (
    supply_id INT AUTO_INCREMENT PRIMARY KEY,
    supply_code VARCHAR(50) NOT NULL UNIQUE,
    supply_generic_name VARCHAR(100) NOT NULL,
    supply_brand_name VARCHAR(100),
    supply_type ENUM('Medical', 'Dental') NOT NULL,
    supply_classification TEXT,
    supply_stock INT DEFAULT 0,
    supply_expiry_date DATE,
    supply_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE equipments (
    equipment_id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_code VARCHAR(50) NOT NULL UNIQUE,
    equipment_generic_name VARCHAR(100) NOT NULL,
    equipment_brand_name VARCHAR(100),
    equipment_type ENUM('Medical', 'Dental') NOT NULL,
    equipment_classification TEXT,
    equipment_condition ENUM('available','occupied','maintenance') DEFAULT 'available',
    equipment_stock INT DEFAULT 0,
    equipment_expiry_date DATE,
    equipment_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Patients Table with University-specific fields
CREATE TABLE patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_number VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F', 'Other') NOT NULL,
    blood_group VARCHAR(5),
    phone VARCHAR(20),
    email VARCHAR(100),
    student_type ENUM('College', 'LSHS') NOT NULL,
    course VARCHAR(100),                           
    year_level INT,                                
    grade_level INT,                               
    strand VARCHAR(100),                           
    patient_address TEXT,
    emergency_contact_name VARCHAR(100),
    emergency_contact_phone VARCHAR(20),
    allergies TEXT,
    medical_conditions TEXT,
    admission_date DATE,
    discharge_date DATE,
    patient_status ENUM('admitted', 'discharged', 'deceased', 'transferred') DEFAULT 'admitted',
    room_id INT,
    bed_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE SET NULL,
    FOREIGN KEY (bed_id) REFERENCES beds(bed_id) ON DELETE SET NULL
);

-- Vital Signs Table
CREATE TABLE vital_signs (
    vital_id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    systolic_bp INT,
    diastolic_bp INT,
    heart_rate INT,
    respiratory_rate INT,
    temperature DECIMAL(4,2),
    temperature_unit ENUM('C', 'F') DEFAULT 'C',
    oxygen_saturation INT,
    blood_glucose DECIMAL(5,2),
    v_weight DECIMAL(5,2),
    v_height DECIMAL(5,2),
    pain_scale INT CHECK (pain_scale BETWEEN 0 AND 10),
    consciousness_level ENUM('alert', 'drowsy', 'unconscious', 'confused'),
    notes TEXT,
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE
);

CREATE TABLE activity_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,      
    patient_id INT NULL,           
    module VARCHAR(50) NOT NULL,   
    action VARCHAR(50) NOT NULL,   
    description TEXT NOT NULL,     
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE SET NULL
);

-- Insert predefined rooms
INSERT INTO rooms (room_name, total_beds) VALUES
('Treatment Room', 0),
('Records Room', 0),
('Dental Room', 0),
('Medical Ward Room', 4);

-- Insert Medical Ward Beds
INSERT INTO beds (room_id, bed_number) VALUES
(4, 'Bed 1'),
(4, 'Bed 2'),
(4, 'Bed 3'),
(4, 'Bed 4');