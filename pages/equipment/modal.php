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
        width: 500px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .modal-content h2 {
        margin-top: 0;
    }

    .modal-content .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 22px;
        cursor: pointer;
    }

    .add-btn {
        background: #28a745;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .add-btn:hover {
        background: #218838;
    }
</style>
<!-- ========== Add Modal ========== -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('addModal')">&times;</span>
        <h2>Add New Equipment</h2>
        <form method="POST" action="equipment_crud.php">
            <label>Name</label>
            <input type="text" name="equipment_name" required>

            <label>Type</label>
            <select name="type" required>
                <option value="Medical">Medical</option>
                <option value="Dental">Dental</option>
            </select>

            <label>Serial No</label>
            <input type="text" name="serial_number">

            <label>Condition</label>
            <select name="equipment_condition">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <label>Classification</label>
            <textarea name="equipment_classification"></textarea>

            <label>Description</label>
            <textarea name="equipment_description"></textarea>

            <button type="submit">Add Equipment</button>
        </form>
    </div>
</div>


<!-- ========== View Modal ========== -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h2>View Equipment</h2>
        <p><strong>Name:</strong> <span id="view-equipment-name"></span></p>
        <p><strong>Type:</strong> <span id="view-type"></span></p>
        <p><strong>Serial No:</strong> <span id="view-serial"></span></p>
        <p><strong>Condition:</strong> <span id="view-condition"></span></p>
        <p><strong>Classification:</strong> <span id="view-classification"></span></p>
        <p><strong>Description:</strong> <span id="view-description"></span></p>
        <p><strong>Created At:</strong> <span id="view-created"></span></p>
    </div>
</div>

<!-- ========== Edit Modal ========== -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Edit Equipment</h2>
        <form method="POST" action="equipment_crud.php">
            <input type="hidden" id="edit-equipment-id" name="equipment_id">

            <label>Name</label>
            <input type="text" id="edit-equipment-name" name="equipment_name" required>

            <label>Type</label>
            <select id="edit-type" name="type">
                <option value="Medical">Medical</option>
                <option value="Dental">Dental</option>
            </select>

            <label>Serial No</label>
            <input type="text" id="edit-serial" name="serial_number">

            <label>Condition</label>
            <select id="edit-condition" name="equipment_condition">
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>

            <label>Classification</label>
            <textarea id="edit-classification" name="equipment_classification"></textarea>

            <label>Description</label>
            <textarea id="edit-description" name="equipment_description"></textarea>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>

<!-- ========== Delete Modal ========== -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('deleteModal')">&times;</span>
        <h2>Delete Equipment</h2>
        <p>Are you sure you want to delete this equipment?</p>
        <form method="POST" action="equipment_crud.php">
            <input type="hidden" id="delete-equipment-id" name="equipment_id">
            <button type="submit" class="delete-confirm">Yes, Delete</button>
            <button type="button" onclick="closeModal('deleteModal')">Cancel</button>
        </form>
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

    // ========== View ==========
    function viewModal(data) {
        document.getElementById("view-equipment-name").innerText = data.equipment_name;
        document.getElementById("view-type").innerText = data.type;
        document.getElementById("view-serial").innerText = data.serial_number || "N/A";
        document.getElementById("view-condition").innerText = data.equipment_condition;
        document.getElementById("view-classification").innerText = data.equipment_classification || "N/A";
        document.getElementById("view-description").innerText = data.equipment_description || "N/A";
        document.getElementById("view-created").innerText = data.created_at;

        openModal("viewModal");
    }

    // ========== Edit ==========
    function editModal(data) {
        document.getElementById("edit-equipment-id").value = data.equipment_id;
        document.getElementById("edit-equipment-name").value = data.equipment_name;
        document.getElementById("edit-type").value = data.type;
        document.getElementById("edit-serial").value = data.serial_number;
        document.getElementById("edit-condition").value = data.equipment_condition;
        document.getElementById("edit-classification").value = data.equipment_classification;
        document.getElementById("edit-description").value = data.equipment_description;

        openModal("editModal");
    }

    // ========== Delete ==========
    function deleteModal(id) {
        document.getElementById("delete-equipment-id").value = id;
        openModal("deleteModal");
    }
</script>