
// Enhanced admin management JavaScript
let currentDeleteId = null;

function openAddModal() {
    document.getElementById('addModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function openEditModal(admin) {
    document.getElementById('editUserId').value = admin.user_id;
    document.getElementById('editUsername').value = admin.username;
    document.getElementById('editPassword').value = '';
    document.getElementById('editModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function openDeleteModal(userId, username) {
    currentDeleteId = userId;
    document.querySelector('#deleteModal .delete-message').textContent =
        `Are you sure you want to delete admin "${username}"?`;
    document.getElementById('deleteModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
    document.body.style.overflow = 'auto';

    // Reset forms
    if (modalId === 'addModal') {
        document.getElementById('addAdminForm').reset();
        hidePasswordStrength('addPasswordStrength');
    } else if (modalId === 'editModal') {
        document.getElementById('editAdminForm').reset();
        hidePasswordStrength('editPasswordStrength');
    }
}

function confirmDelete() {
    if (!currentDeleteId) return;

    const formData = new FormData();
    formData.append('action', 'delete_admin');
    formData.append('user_id', currentDeleteId);

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Admin deleted successfully!', 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message || 'Failed to delete admin', 'error');
            }
            closeModal('deleteModal');
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while deleting admin', 'error');
            closeModal('deleteModal');
        });
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const btn = input.parentElement.querySelector('.show-password-btn');

    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.83,9L15,12.16C15,12.11 15,12.05 15,12A3,3 0 0,0 12,9C11.94,9 11.89,9 11.83,9M7.53,9.8L9.08,11.35C9.03,11.56 9,11.77 9,12A3,3 0 0,0 12,15C12.22,15 12.44,14.97 12.65,14.92L14.2,16.47C13.53,16.8 12.79,17 12,17C9.24,17 7,14.76 7,12C7,11.21 7.2,10.47 7.53,9.8M2,4.27L4.28,6.55L4.73,7C3.08,8.3 1.78,10 1,12C2.73,16.39 7,19.5 12,19.5C13.55,19.5 15.03,19.2 16.38,18.66L16.81,19.09L19.73,22L21,20.73L3.27,3M12,7A5,5 0 0,1 17,12C17,12.64 16.87,13.26 16.64,13.82L19.57,16.75C21.07,15.5 22.27,13.86 23,12C21.27,7.61 17,4.5 12,4.5C10.6,4.5 9.26,4.75 8,5.2L10.17,7.35C10.76,7.13 11.37,7 12,7Z"/>
                    </svg>
                `;
    } else {
        input.type = 'password';
        btn.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                `;
    }
}

function checkPasswordStrength(password, strengthElementId) {
    const strengthElement = document.getElementById(strengthElementId);
    const strengthBar = strengthElement.querySelector('.password-strength-bar');

    if (password.length === 0) {
        hidePasswordStrength(strengthElementId);
        return;
    }

    strengthElement.style.display = 'block';

    let strength = 0;
    let strengthClass = '';

    // Length check
    if (password.length >= 6) strength++;
    if (password.length >= 8) strength++;

    // Character variety checks
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    // Determine strength class
    if (strength <= 2) {
        strengthClass = 'strength-weak';
    } else if (strength <= 3) {
        strengthClass = 'strength-fair';
    } else if (strength <= 4) {
        strengthClass = 'strength-good';
    } else {
        strengthClass = 'strength-strong';
    }

    // Remove all strength classes and add current one
    strengthBar.className = 'password-strength-bar ' + strengthClass;
}

function hidePasswordStrength(strengthElementId) {
    const strengthElement = document.getElementById(strengthElementId);
    strengthElement.style.display = 'none';
}

function showAlert(message, type) {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());

    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    ${type === 'success' ?
            '<path d="M9,20.42L2.79,14.21L5.62,11.38L9,14.77L18.88,4.88L21.71,7.71L9,20.42Z"/>' :
            '<path d="M13,14H11V10H13M13,18H11V16H13M1,21H23L12,2L1,21Z"/>'
        }
                </svg>
                ${message}
            `;

    // Insert after page header
    const pageHeader = document.querySelector('.page-header');
    pageHeader.insertAdjacentElement('afterend', alert);

    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}

function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.querySelector('.table tbody');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            const username = cells[0].textContent || cells[0].innerText;
            if (username.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
}

// Form submissions
document.getElementById('addAdminForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append('action', 'add_admin');

    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Creating...';
    submitBtn.disabled = true;

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Admin added successfully!', 'success');
                closeModal('addModal');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message || 'Failed to add admin', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while adding admin', 'error');
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
});

document.getElementById('editAdminForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append('action', 'edit_admin');

    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Updating...';
    submitBtn.disabled = true;

    fetch(window.location.href, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Admin updated successfully!', 'success');
                closeModal('editModal');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message || 'Failed to update admin', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while updating admin', 'error');
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
});

// Password strength checking
document.getElementById('addPassword').addEventListener('input', function () {
    checkPasswordStrength(this.value, 'addPasswordStrength');
});

document.getElementById('editPassword').addEventListener('input', function () {
    checkPasswordStrength(this.value, 'editPasswordStrength');
});

// Close modal with Escape key
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const openModal = document.querySelector('.modal[style*="block"]');
        if (openModal) {
            closeModal(openModal.id);
        }
    }
});

// Input validation styling
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('blur', function () {
        if (this.hasAttribute('required') && !this.value.trim()) {
            this.classList.add('error');
            this.classList.remove('success');
        } else if (this.value.trim()) {
            this.classList.remove('error');
            this.classList.add('success');
        }
    });

    input.addEventListener('input', function () {
        this.classList.remove('error', 'success');
    });
});
