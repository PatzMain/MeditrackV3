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
        margin: 10% auto;
        padding: 20px;
        width: 600px;
        max-width: 90%;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        position: relative;
        max-height: 80vh;
        overflow-y: auto;
    }

    .modal-content h2 {
        margin-top: 0;
        color: var(--primary-color);
        border-bottom: 2px solid rgba(15, 123, 15, 0.1);
        padding-bottom: 10px;
    }

    .modal-content .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 22px;
        cursor: pointer;
        color: #999;
        transition: color 0.3s ease;
    }

    .modal-content .close:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
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

    .delete-confirmation {
        text-align: center;
        padding: 20px;
    }

    .delete-confirmation h3 {
        color: #dc3545;
        margin-bottom: 15px;
    }

    .stock-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .low-stock { background: #dc3545; }
    .medium-stock { background: #ffc107; color: #000; }
    .high-stock { background: #28a745; }

    .expiry-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .expired { background: #dc3545; color: white; }
    .expiring-soon { background: #ffc107; color: #000; }

    .availability-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        color: white;
    }

    .medical { background: #17a2b8; }
    .dental { background: #6f42c1; }
</style>

<!-- ========== Add Modal ========== -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h2>Add New Medicine</h2>
        <form method="POST" action="medicine_crud.php">
            <div class="form-group">
                <label for="add-medicine-name">Medicine Name *</label>
                <input type="text" id="add-medicine-name" name="medicine_name" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="add-type">Type *</label>
                    <select id="add-type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="Medical">Medical</option>
                        <option value="Dental">Dental</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="add-stock">Stock Quantity</label>
                    <input type="number" id="add-stock" name="medicine_stock" min="0" value="0">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="add-brand-name">Brand Name</label>
                    <input type="text" id="add-brand-name" name="medicine_brand_name">
                </div>

                <div class="form-group">
                    <label for="add-generic-name">Generic Name</label>
                    <input type="text" id="add-generic-name" name="medicine_generic_name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="add-dosage">Dosage</label>
                    <input type="text" id="add-dosage" name="medicine_dosage" placeholder="e.g., 500mg">
                </div>

                <div class="form-group">
                    <label for="add-unit">Unit</label>
                    <input type="text" id="add-unit" name="medicine_unit" placeholder="e.g., tablets, ml">
                </div>
            </div>

            <div class="form-group">
                <label for="add-expiry-date">Expiry Date</label>
                <input type="date" id="add-expiry-date" name="medicine_expiry_date">
            </div>

            <div class="form-group">
                <label for="add-classification">Classification</label>
                <textarea id="add-classification" name="medicine_classification" placeholder="Medicine classification/category"></textarea>
            </div>

            <div class="form-group">
                <label for="add-description">Description</label>
                <textarea id="add-description" name="medicine_description" placeholder="Additional medicine details"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Medicine</button>
            </div>
        </form>
    </div>
</div>

<!-- ========== View Modal ========== -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h2>Medicine Details</h2>
        
        <div class="view-field">
            <strong>Medicine Name:</strong>
            <span id="view-medicine-name"></span>
        </div>

        <div class="view-field">
            <strong>Type:</strong>
            <span id="view-type"></span>
        </div>

        <div class="view-field">
            <strong>Brand Name:</strong>
            <span id="view-brand-name"></span>
        </div>

        <div class="view-field">
            <strong>Generic Name:</strong>
            <span id="view-generic-name"></span>
        </div>

        <div class="view-field">
            <strong>Dosage:</strong>
            <span id="view-dosage"></span>
        </div>

        <div class="view-field">
            <strong>Stock:</strong>
            <span id="view-stock"></span>
        </div>

        <div class="view-field">
            <strong>Unit:</strong>
            <span id="view-unit"></span>
        </div>

        <div class="view-field">
            <strong>Expiry Date:</strong>
            <span id="view-expiry-date"></span>
        </div>

        <div class="view-field">
            <strong>Classification:</strong>
            <span id="view-classification"></span>
        </div>

        <div class="view-field">
            <strong>Description:</strong>
            <span id="view-description"></span>
        </div>

        <div class="view-field">
            <strong>Created At:</strong>
            <span id="view-created"></span>
        </div>

        <div class="modal-actions">
            <button type="button" class="btn btn-secondary" onclick="closeModal('viewModal')">Close</button>
        </div>
    </div>
</div>

<!-- ========== Edit Modal ========== -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Edit Medicine</h2>
        <form method="POST" action="medicine_crud.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="edit-medicine-id" name="medicine_id">

            <div class="form-group">
                <label for="edit-medicine-name">Medicine Name *</label>
                <input type="text" id="edit-medicine-name" name="medicine_name" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-type">Type *</label>
                    <select id="edit-type" name="type" required>
                        <option value="Medical">Medical</option>
                        <option value="Dental">Dental</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit-stock">Stock Quantity</label>
                    <input type="number" id="edit-stock" name="medicine_stock" min="0">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-brand-name">Brand Name</label>
                    <input type="text" id="edit-brand-name" name="medicine_brand_name">
                </div>

                <div class="form-group">
                    <label for="edit-generic-name">Generic Name</label>
                    <input type="text" id="edit-generic-name" name="medicine_generic_name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edit-dosage">Dosage</label>
                    <input type="text" id="edit-dosage" name="medicine_dosage">
                </div>

                <div class="form-group">
                    <label for="edit-unit">Unit</label>
                    <input type="text" id="edit-unit" name="medicine_unit">
                </div>
            </div>

            <div class="form-group">
                <label for="edit-expiry-date">Expiry Date</label>
                <input type="date" id="edit-expiry-date" name="medicine_expiry_date">
            </div>

            <div class="form-group">
                <label for="edit-classification">Classification</label>
                <textarea id="edit-classification" name="medicine_classification"></textarea>
            </div>

            <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea id="edit-description" name="medicine_description"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ========== Delete Modal ========== -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('deleteModal')">&times;</span>
        <div class="delete-confirmation">
            <h3>⚠️ Confirm Deletion</h3>
            <p>Are you sure you want to delete this medicine?</p>
            <p><strong>This action cannot be undone.</strong></p>
            
            <form method="POST" action="medicine_crud.php">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" id="delete-medicine-id" name="medicine_id">
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('deleteModal')">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Open modal by id
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add("show");
            document.body.style.overflow = "hidden"; // prevent background scroll
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

    // ========== View Modal ==========
    function viewModal(data) {
        document.getElementById("view-medicine-name").innerText = data.medicine_name;
        document.getElementById("view-type").innerHTML = `<span class="availability-badge ${data.type.toLowerCase()}">${data.type}</span>`;
        document.getElementById("view-brand-name").innerText = data.medicine_brand_name || "N/A";
        document.getElementById("view-generic-name").innerText = data.medicine_generic_name || "N/A";
        document.getElementById("view-dosage").innerText = data.medicine_dosage || "N/A";
        
        // Stock with badge
        const stockClass = data.medicine_stock < 10 ? 'low-stock' : (data.medicine_stock < 50 ? 'medium-stock' : 'high-stock');
        document.getElementById("view-stock").innerHTML = `<span class="stock-badge ${stockClass}">${data.medicine_stock}</span>`;
        
        document.getElementById("view-unit").innerText = data.medicine_unit || "N/A";
        
        // Expiry date with badge
        if (data.medicine_expiry_date) {
            const expiryDate = new Date(data.medicine_expiry_date);
            const today = new Date();
            const daysDiff = Math.ceil((expiryDate - today) / (1000 * 60 * 60 * 24));
            
            let expiryClass = '';
            if (daysDiff < 0) expiryClass = 'expired';
            else if (daysDiff <= 30) expiryClass = 'expiring-soon';
            
            const formattedDate = expiryDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
            
            document.getElementById("view-expiry-date").innerHTML = 
                `<span class="expiry-badge ${expiryClass}">${formattedDate}</span>`;
        } else {
            document.getElementById("view-expiry-date").innerText = "N/A";
        }
        
        document.getElementById("view-classification").innerText = data.medicine_classification || "N/A";
        document.getElementById("view-description").innerText = data.medicine_description || "N/A";
        document.getElementById("view-created").innerText = new Date(data.created_at).toLocaleString();

        openModal("viewModal");
    }

    // ========== Edit Modal ==========
    function editModal(data) {
        document.getElementById("edit-medicine-id").value = data.medicine_id;
        document.getElementById("edit-medicine-name").value = data.medicine_name;
        document.getElementById("edit-type").value = data.type;
        document.getElementById("edit-brand-name").value = data.medicine_brand_name || '';
        document.getElementById("edit-generic-name").value = data.medicine_generic_name || '';
        document.getElementById("edit-dosage").value = data.medicine_dosage || '';
        document.getElementById("edit-stock").value = data.medicine_stock;
        document.getElementById("edit-unit").value = data.medicine_unit || '';
        document.getElementById("edit-expiry-date").value = data.medicine_expiry_date || '';
        document.getElementById("edit-classification").value = data.medicine_classification || '';
        document.getElementById("edit-description").value = data.medicine_description || '';

        openModal("editModal");
    }

    // ========== Delete Modal ==========
    function deleteModal(id) {
        document.getElementById("delete-medicine-id").value = id;
        openModal("deleteModal");
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