<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        overflow: auto;
    }

    .modal.show {
        display: block;
    }

    .modal-content {
        background: #fff;
        margin: 5% auto;
        padding: 0;
        width: 90%;
        max-width: 800px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        position: relative;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .modal-body {
        padding: 20px;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 24px;
        cursor: pointer;
        color: white;
        transition: opacity 0.3s ease;
    }

    .close:hover {
        opacity: 0.7;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-row-three {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(15, 123, 15, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #e0e0e0;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #545b62;
        transform: translateY(-1px);
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .view-field {
        margin-bottom: 15px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid var(--primary-color);
    }

    .view-field strong {
        color: var(--primary-color);
        display: block;
        margin-bottom: 5px;
    }

    .vitals-history {
        margin-top: 20px;
    }

    .vitals-history h4 {
        color: var(--primary-color);
        margin-bottom: 15px;
        border-bottom: 2px solid rgba(15, 123, 15, 0.1);
        padding-bottom: 5px;
    }

    .vital-record {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
    }

    .vital-record-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .vital-record-date {
        font-weight: 600;
        color: var(--primary-color);
    }

    .vital-record-time {
        font-size: 12px;
        color: #666;
    }

    .vital-items {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
    }

    .vital-item {
        background: white;
        padding: 8px;
        border-radius: 6px;
        text-align: center;
        border: 1px solid #e9ecef;
    }

    .vital-item-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 4px;
    }

    .vital-item-value {
        font-weight: 600;
        color: var(--text-primary);
    }

    .delete-confirmation {
        text-align: center;
        padding: 20px;
    }

    .delete-confirmation h3 {
        color: #dc3545;
        margin-bottom: 15px;
    }

    .patient-badges {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .patient-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .student-badge {
        background: linear-gradient(135deg, #17a2b8, #138496);
    }

    .status-badge {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }

    .blood-badge {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }

    .no-vitals-message {
        text-align: center;
        padding: 20px;
        color: #666;
        font-style: italic;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px dashed #dee2e6;
    }

    .student-type-fields {
        display: none;
    }

    .student-type-fields.show {
        display: block;
    }

    @media (max-width: 768px) {
        .modal-content {
            width: 95%;
            margin: 10px auto;
        }
        
        .form-row,
        .form-row-three {
            grid-template-columns: 1fr;
        }
        
        .vital-items {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<!-- ========== Add Patient Modal ========== -->
<div id="addPatientModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New Patient</h2>
            <span class="close" onclick="closeModal('addPatientModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form method="POST" action="patient_crud.php">
                <div class="form-row">
                    <div class="form-group">
                        <label for="add-first-name">First Name *</label>
                        <input type="text" id="add-first-name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-last-name">Last Name *</label>
                        <input type="text" id="add-last-name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row-three">
                    <div class="form-group">
                        <label for="add-dob">Date of Birth *</label>
                        <input type="date" id="add-dob" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="add-gender">Gender *</label>
                        <select id="add-gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add-blood-group">Blood Group</label>
                        <select id="add-blood-group" name="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="add-phone">Phone</label>
                        <input type="tel" id="add-phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="add-email">Email</label>
                        <input type="email" id="add-email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="add-student-type">Student Type *</label>
                    <select id="add-student-type" name="student_type" required onchange="toggleStudentFields('add')">
                        <option value="">Select Student Type</option>
                        <option value="College">College</option>
                        <option value="LSHS">LSHS (Senior High School)</option>
                    </select>
                </div>

                <div id="add-college-fields" class="student-type-fields">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="add-course">Course</label>
                            <input type="text" id="add-course" name="course" placeholder="e.g., BS Computer Science">
                        </div>
                        <div class="form-group">
                            <label for="add-year-level">Year Level</label>
                            <select id="add-year-level" name="year_level">
                                <option value="">Select Year</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="5">5th Year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="add-lshs-fields" class="student-type-fields">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="add-strand">Strand</label>
                            <input type="text" id="add-strand" name="strand" placeholder="e.g., STEM, ABM, HUMSS">
                        </div>
                        <div class="form-group">
                            <label for="add-grade-level">Grade Level</label>
                            <select id="add-grade-level" name="grade_level">
                                <option value="">Select Grade</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="add-address">Address</label>
                    <textarea id="add-address" name="patient_address" placeholder="Patient's address"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="add-emergency-name">Emergency Contact Name</label>
                        <input type="text" id="add-emergency-name" name="emergency_contact_name">
                    </div>
                    <div class="form-group">
                        <label for="add-emergency-phone">Emergency Contact Phone</label>
                        <input type="tel" id="add-emergency-phone" name="emergency_contact_phone">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="add-allergies">Allergies</label>
                        <textarea id="add-allergies" name="allergies" placeholder="Known allergies"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="add-medical-conditions">Medical Conditions</label>
                        <textarea id="add-medical-conditions" name="medical_conditions" placeholder="Existing medical conditions"></textarea>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addPatientModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========== View Patient Modal ========== -->
<div id="viewPatientModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Patient Details</h2>
            <span class="close" onclick="closeModal('viewPatientModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="patient-badges">
                <span id="view-student-badge" class="patient-badge student-badge"></span>
                <span id="view-status-badge" class="patient-badge status-badge"></span>
                <span id="view-blood-badge" class="patient-badge blood-badge"></span>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Patient Number:</strong>
                    <span id="view-patient-number"></span>
                </div>
                <div class="view-field">
                    <strong>Full Name:</strong>
                    <span id="view-full-name"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Date of Birth:</strong>
                    <span id="view-dob"></span>
                </div>
                <div class="view-field">
                    <strong>Age:</strong>
                    <span id="view-age"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Gender:</strong>
                    <span id="view-gender"></span>
                </div>
                <div class="view-field">
                    <strong>Blood Group:</strong>
                    <span id="view-blood-group"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Phone:</strong>
                    <span id="view-phone"></span>
                </div>
                <div class="view-field">
                    <strong>Email:</strong>
                    <span id="view-email"></span>
                </div>
            </div>

            <div class="view-field">
                <strong>Academic Information:</strong>
                <span id="view-academic"></span>
            </div>

            <div class="view-field">
                <strong>Address:</strong>
                <span id="view-address"></span>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Emergency Contact:</strong>
                    <span id="view-emergency"></span>
                </div>
                <div class="view-field">
                    <strong>Emergency Phone:</strong>
                    <span id="view-emergency-phone"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="view-field">
                    <strong>Allergies:</strong>
                    <span id="view-allergies"></span>
                </div>
                <div class="view-field">
                    <strong>Medical Conditions:</strong>
                    <span id="view-medical-conditions"></span>
                </div>
            </div>

            <div class="vitals-history">
                <h4>Vital Signs History</h4>
                <div id="vitals-history-content">
                    <!-- Vital signs will be loaded here -->
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewPatientModal')">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- ========== Edit Patient Modal ========== -->
<div id="editPatientModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Patient</h2>
            <span class="close" onclick="closeModal('editPatientModal')">&times;</span>
        </div>
        <div class="modal-body">
            <form method="POST" action="patient_crud.php">
                <input type="hidden" name="action" value="edit_patient">
                <input type="hidden" id="edit-patient-id" name="patient_id">

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-first-name">First Name *</label>
                        <input type="text" id="edit-first-name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-last-name">Last Name *</label>
                        <input type="text" id="edit-last-name" name="last_name" required>
                    </div>
                </div>

                <div class="form-row-three">
                    <div class="form-group">
                        <label for="edit-dob">Date of Birth *</label>
                        <input type="date" id="edit-dob" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-gender">Gender *</label>
                        <select id="edit-gender" name="gender" required>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-blood-group">Blood Group</label>
                        <select id="edit-blood-group" name="blood_group">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-phone">Phone</label>
                        <input type="tel" id="edit-phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" id="edit-email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit-student-type">Student Type *</label>
                    <select id="edit-student-type" name="student_type" required onchange="toggleStudentFields('edit')">
                        <option value="College">College</option>
                        <option value="LSHS">LSHS (Senior High School)</option>
                    </select>
                </div>

                <div id="edit-college-fields" class="student-type-fields">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-course">Course</label>
                            <input type="text" id="edit-course" name="course">
                        </div>
                        <div class="form-group">
                            <label for="edit-year-level">Year Level</label>
                            <select id="edit-year-level" name="year_level">
                                <option value="">Select Year</option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                                <option value="5">5th Year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="edit-lshs-fields" class="student-type-fields">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="edit-strand">Strand</label>
                            <input type="text" id="edit-strand" name="strand">
                        </div>
                        <div class="form-group">
                            <label for="edit-grade-level">Grade Level</label>
                            <select id="edit-grade-level" name="grade_level">
                                <option value="">Select Grade</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="edit-status">Patient Status</label>
                    <select id="edit-status" name="patient_status">
                        <option value="admitted">Admitted</option>
                        <option value="discharged">Discharged</option>
                        <option value="transferred">Transferred</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit-address">Address</label>
                    <textarea id="edit-address" name="patient_address"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-emergency-name">Emergency Contact Name</label>
                        <input type="text" id="edit-emergency-name" name="emergency_contact_name">
                    </div>
                    <div class="form-group">
                        <label for="edit-emergency-phone">Emergency Contact Phone</label>
                        <input type="tel" id="edit-emergency-phone" name="emergency_contact_phone">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-allergies">Allergies</label>
                        <textarea id="edit-allergies" name="allergies"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-medical-conditions">Medical Conditions</label>
                        <textarea id="edit-medical-conditions" name="medical_conditions"></textarea>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editPatientModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========== Add Vital Signs Modal ========== -->
<div id="addVitalsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Vital Signs</h2>
            <span class="close" onclick="closeModal('addVitalsModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="view-field">
                <strong>Patient:</strong>
                <span id="vitals-patient-name"></span>
            </div>

            <form method="POST" action="patient_crud.php">
                <input type="hidden" name="action" value="add_vitals">
                <input type="hidden" id="vitals-patient-id" name="patient_id">

                <div class="form-row">
                    <div class="form-group">
                        <label for="systolic-bp">Systolic BP (mmHg)</label>
                        <input type="number" id="systolic-bp" name="systolic_bp" min="0" max="300">
                    </div>
                    <div class="form-group">
                        <label for="diastolic-bp">Diastolic BP (mmHg)</label>
                        <input type="number" id="diastolic-bp" name="diastolic_bp" min="0" max="200">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="heart-rate">Heart Rate (bpm)</label>
                        <input type="number" id="heart-rate" name="heart_rate" min="0" max="300">
                    </div>
                    <div class="form-group">
                        <label for="respiratory-rate">Respiratory Rate (/min)</label>
                        <input type="number" id="respiratory-rate" name="respiratory_rate" min="0" max="100">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="number" id="temperature" name="temperature" step="0.1" min="30" max="45">
                    </div>
                    <div class="form-group">
                        <label for="temperature-unit">Temperature Unit</label>
                        <select id="temperature-unit" name="temperature_unit">
                            <option value="C">Celsius (°C)</option>
                            <option value="F">Fahrenheit (°F)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="oxygen-saturation">Oxygen Saturation (%)</label>
                        <input type="number" id="oxygen-saturation" name="oxygen_saturation" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="blood-glucose">Blood Glucose (mg/dL)</label>
                        <input type="number" id="blood-glucose" name="blood_glucose" step="0.1" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" name="v_weight" step="0.1" min="0">
                    </div>
                    <div class="form-group">
                        <label for="height">Height (cm)</label>
                        <input type="number" id="height" name="v_height" step="0.1" min="0">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="pain-scale">Pain Scale (0-10)</label>
                        <select id="pain-scale" name="pain_scale">
                            <option value="">Select Pain Level</option>
                            <option value="0">0 - No Pain</option>
                            <option value="1">1 - Minimal</option>
                            <option value="2">2 - Mild</option>
                            <option value="3">3 - Uncomfortable</option>
                            <option value="4">4 - Moderate</option>
                            <option value="5">5 - Distracting</option>
                            <option value="6">6 - Distressing</option>
                            <option value="7">7 - Unmanageable</option>
                            <option value="8">8 - Intense</option>
                            <option value="9">9 - Severe</option>
                            <option value="10">10 - Unable to Move</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="consciousness-level">Consciousness Level</label>
                        <select id="consciousness-level" name="consciousness_level">
                            <option value="">Select Level</option>
                            <option value="alert">Alert</option>
                            <option value="drowsy">Drowsy</option>
                            <option value="unconscious">Unconscious</option>
                            <option value="confused">Confused</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="vitals-notes">Notes</label>
                    <textarea id="vitals-notes" name="notes" placeholder="Additional notes or observations"></textarea>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addVitalsModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Vital Signs</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========== Delete Patient Modal ========== -->
<div id="deletePatientModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Confirm Deletion</h2>
            <span class="close" onclick="closeModal('deletePatientModal')">&times;</span>
        </div>
        <div class="modal-body">
            <div class="delete-confirmation">
                <h3>⚠️ Delete Patient</h3>
                <p>Are you sure you want to delete this patient?</p>
                <p><strong>This will also delete all associated vital signs and medical records.</strong></p>
                <p><strong>This action cannot be undone.</strong></p>
                
                <form method="POST" action="patient_crud.php">
                    <input type="hidden" name="action" value="delete_patient">
                    <input type="hidden" id="delete-patient-id" name="patient_id">
                    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('deletePatientModal')">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Open modal by id
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add("show");
            document.body.style.overflow = "hidden";
        }
    }

    // Close modal by id
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove("show");
            document.body.style.overflow = "auto";
        }
    }

    // Toggle student type fields
    function toggleStudentFields(prefix) {
        const studentType = document.getElementById(prefix + '-student-type').value;
        const collegeFields = document.getElementById(prefix + '-college-fields');
        const lshsFields = document.getElementById(prefix + '-lshs-fields');
        
        collegeFields.classList.remove('show');
        lshsFields.classList.remove('show');
        
        if (studentType === 'College') {
            collegeFields.classList.add('show');
        } else if (studentType === 'LSHS') {
            lshsFields.classList.add('show');
        }
    }

    // View Patient Modal
    function viewPatientModal(patient) {
        // Calculate age
        let age = 'N/A';
        if (patient.date_of_birth) {
            const birthDate = new Date(patient.date_of_birth);
            const today = new Date();
            age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            age += ' years old';
        }

        // Academic info
        let academic = patient.student_type;
        if (patient.student_type === 'College' && patient.course) {
            academic += ' - ' + patient.course;
            if (patient.year_level) {
                academic += ' (Year ' + patient.year_level + ')';
            }
        } else if (patient.student_type === 'LSHS' && patient.strand) {
            academic += ' - ' + patient.strand;
            if (patient.grade_level) {
                academic += ' (Grade ' + patient.grade_level + ')';
            }
        }

        // Set badges
        document.getElementById('view-student-badge').textContent = patient.student_type;
        document.getElementById('view-status-badge').textContent = patient.patient_status.charAt(0).toUpperCase() + patient.patient_status.slice(1);
        document.getElementById('view-blood-badge').textContent = patient.blood_group || 'Unknown Blood Type';
        document.getElementById('view-blood-badge').style.display = patient.blood_group ? 'inline-block' : 'none';

        // Set basic info
        document.getElementById('view-patient-number').textContent = patient.patient_number;
        document.getElementById('view-full-name').textContent = patient.first_name + ' ' + patient.last_name;
        document.getElementById('view-dob').textContent = patient.date_of_birth ? new Date(patient.date_of_birth).toLocaleDateString() : 'N/A';
        document.getElementById('view-age').textContent = age;
        document.getElementById('view-gender').textContent = patient.gender === 'M' ? 'Male' : patient.gender === 'F' ? 'Female' : patient.gender;
        document.getElementById('view-blood-group').textContent = patient.blood_group || 'N/A';
        document.getElementById('view-phone').textContent = patient.phone || 'N/A';
        document.getElementById('view-email').textContent = patient.email || 'N/A';
        document.getElementById('view-academic').textContent = academic;
        document.getElementById('view-address').textContent = patient.patient_address || 'N/A';
        document.getElementById('view-emergency').textContent = patient.emergency_contact_name || 'N/A';
        document.getElementById('view-emergency-phone').textContent = patient.emergency_contact_phone || 'N/A';
        document.getElementById('view-allergies').textContent = patient.allergies || 'None specified';
        document.getElementById('view-medical-conditions').textContent = patient.medical_conditions || 'None specified';

        // Load vital signs
        loadPatientVitals(patient.patient_id);

        openModal('viewPatientModal');
    }

    // Edit Patient Modal
    function editPatientModal(patient) {
        document.getElementById('edit-patient-id').value = patient.patient_id;
        document.getElementById('edit-first-name').value = patient.first_name;
        document.getElementById('edit-last-name').value = patient.last_name;
        document.getElementById('edit-dob').value = patient.date_of_birth;
        document.getElementById('edit-gender').value = patient.gender;
        document.getElementById('edit-blood-group').value = patient.blood_group || '';
        document.getElementById('edit-phone').value = patient.phone || '';
        document.getElementById('edit-email').value = patient.email || '';
        document.getElementById('edit-student-type').value = patient.student_type;
        document.getElementById('edit-course').value = patient.course || '';
        document.getElementById('edit-year-level').value = patient.year_level || '';
        document.getElementById('edit-strand').value = patient.strand || '';
        document.getElementById('edit-grade-level').value = patient.grade_level || '';
        document.getElementById('edit-status').value = patient.patient_status;
        document.getElementById('edit-address').value = patient.patient_address || '';
        document.getElementById('edit-emergency-name').value = patient.emergency_contact_name || '';
        document.getElementById('edit-emergency-phone').value = patient.emergency_contact_phone || '';
        document.getElementById('edit-allergies').value = patient.allergies || '';
        document.getElementById('edit-medical-conditions').value = patient.medical_conditions || '';

        toggleStudentFields('edit');
        openModal('editPatientModal');
    }

    // Add Vitals Modal
    function addVitalsModal(patientId, patientName) {
        document.getElementById('vitals-patient-id').value = patientId;
        document.getElementById('vitals-patient-name').textContent = patientName;
        
        // Clear form
        const form = document.querySelector('#addVitalsModal form');
        const inputs = form.querySelectorAll('input[type="number"], select, textarea');
        inputs.forEach(input => input.value = '');
        
        openModal('addVitalsModal');
    }

    // Delete Patient Modal
    function deletePatientModal(patientId) {
        document.getElementById('delete-patient-id').value = patientId;
        openModal('deletePatientModal');
    }

    // Load patient vital signs
    async function loadPatientVitals(patientId) {
        try {
            const response = await fetch(`get_vitals.php?patient_id=${patientId}`);
            const vitals = await response.json();
            
            const container = document.getElementById('vitals-history-content');
            
            if (vitals.length === 0) {
                container.innerHTML = '<div class="no-vitals-message">No vital signs recorded for this patient.</div>';
                return;
            }
            
            let html = '';
            vitals.forEach(vital => {
                const date = new Date(vital.recorded_at);
                html += `
                    <div class="vital-record">
                        <div class="vital-record-header">
                            <span class="vital-record-date">${date.toLocaleDateString()}</span>
                            <span class="vital-record-time">${date.toLocaleTimeString()}</span>
                        </div>
                        <div class="vital-items">
                            ${vital.systolic_bp && vital.diastolic_bp ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Blood Pressure</div>
                                    <div class="vital-item-value">${vital.systolic_bp}/${vital.diastolic_bp} mmHg</div>
                                </div>
                            ` : ''}
                            ${vital.heart_rate ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Heart Rate</div>
                                    <div class="vital-item-value">${vital.heart_rate} bpm</div>
                                </div>
                            ` : ''}
                            ${vital.respiratory_rate ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Respiratory Rate</div>
                                    <div class="vital-item-value">${vital.respiratory_rate}/min</div>
                                </div>
                            ` : ''}
                            ${vital.temperature ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Temperature</div>
                                    <div class="vital-item-value">${vital.temperature}°${vital.temperature_unit}</div>
                                </div>
                            ` : ''}
                            ${vital.oxygen_saturation ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">SpO2</div>
                                    <div class="vital-item-value">${vital.oxygen_saturation}%</div>
                                </div>
                            ` : ''}
                            ${vital.v_weight ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Weight</div>
                                    <div class="vital-item-value">${vital.v_weight} kg</div>
                                </div>
                            ` : ''}
                            ${vital.v_height ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Height</div>
                                    <div class="vital-item-value">${vital.v_height} cm</div>
                                </div>
                            ` : ''}
                            ${vital.pain_scale !== null ? `
                                <div class="vital-item">
                                    <div class="vital-item-label">Pain Scale</div>
                                    <div class="vital-item-value">${vital.pain_scale}/10</div>
                                </div>
                            ` : ''}
                        </div>
                        ${vital.notes ? `<div style="margin-top: 10px; font-style: italic; color: #666;">Notes: ${vital.notes}</div>` : ''}
                    </div>
                `;
            });
            
            container.innerHTML = html;
        } catch (error) {
            console.error('Error loading vital signs:', error);
            document.getElementById('vitals-history-content').innerHTML = '<div class="no-vitals-message">Error loading vital signs.</div>';
        }
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                closeModal(openModal.id);
            }
        }
    });
</script>