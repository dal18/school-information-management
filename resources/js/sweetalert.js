import Swal from 'sweetalert2';

// Make Swal globally available
window.Swal = Swal;

// Success alert
window.showSuccess = function(message, title = 'Success!') {
    return Swal.fire({
        icon: 'success',
        title: title,
        text: message,
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        timer: 3000
    });
};

// Error alert
window.showError = function(message, title = 'Error!') {
    return Swal.fire({
        icon: 'error',
        title: title,
        text: message,
        showConfirmButton: true,
        confirmButtonColor: '#d33'
    });
};

// Warning alert
window.showWarning = function(message, title = 'Warning!') {
    return Swal.fire({
        icon: 'warning',
        title: title,
        text: message,
        showConfirmButton: true,
        confirmButtonColor: '#f0ad4e'
    });
};

// Info alert
window.showInfo = function(message, title = 'Info') {
    return Swal.fire({
        icon: 'info',
        title: title,
        text: message,
        showConfirmButton: true,
        confirmButtonColor: '#5bc0de'
    });
};

// Delete confirmation
window.confirmDelete = function(formId, message = 'You won\'t be able to revert this!', title = 'Are you sure?') {
    return Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
};

// Generic confirmation dialog
window.confirmAction = function(callback, message = 'Are you sure you want to proceed?', title = 'Confirm Action') {
    return Swal.fire({
        title: title,
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed && typeof callback === 'function') {
            callback();
        }
        return result.isConfirmed;
    });
};

// Toast notification (small popup)
window.showToast = function(message, icon = 'success', position = 'top-end') {
    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    return Toast.fire({
        icon: icon,
        title: message
    });
};

// Auto-show alerts from session data
document.addEventListener('DOMContentLoaded', function() {
    // Check for session success message
    const successMessage = document.querySelector('[data-success-message]');
    if (successMessage) {
        showSuccess(successMessage.dataset.successMessage);
    }

    // Check for session error message
    const errorMessage = document.querySelector('[data-error-message]');
    if (errorMessage) {
        showError(errorMessage.dataset.errorMessage);
    }

    // Check for session info message
    const infoMessage = document.querySelector('[data-info-message]');
    if (infoMessage) {
        showInfo(infoMessage.dataset.infoMessage);
    }

    // Check for session warning message
    const warningMessage = document.querySelector('[data-warning-message]');
    if (warningMessage) {
        showWarning(warningMessage.dataset.warningMessage);
    }
});
