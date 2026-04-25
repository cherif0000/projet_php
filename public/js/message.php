<?php
/**
 * Message notification system
 * Displays success/error messages with modern styling
 */
?>

<style>
  .toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .toast {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 12px;
    background: white;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    animation: slideIn 0.3s ease-out, slideOut 0.3s ease-in 4.7s forwards;
    max-width: 400px;
    font-family: 'DM Sans', sans-serif;
  }

  .toast-success {
    border-left: 4px solid hsl(140, 50%, 50%);
  }

  .toast-error {
    border-left: 4px solid hsl(0, 70%, 55%);
  }

  .toast-warning {
    border-left: 4px solid hsl(40, 90%, 55%);
  }

  .toast-info {
    border-left: 4px solid hsl(210, 70%, 55%);
  }

  .toast-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .toast-success .toast-icon {
    background: hsl(140, 50%, 90%);
    color: hsl(140, 50%, 40%);
  }

  .toast-error .toast-icon {
    background: hsl(0, 70%, 92%);
    color: hsl(0, 70%, 45%);
  }

  .toast-warning .toast-icon {
    background: hsl(40, 90%, 90%);
    color: hsl(40, 70%, 40%);
  }

  .toast-info .toast-icon {
    background: hsl(210, 70%, 92%);
    color: hsl(210, 70%, 45%);
  }

  .toast-content {
    flex: 1;
  }

  .toast-title {
    font-weight: 600;
    font-size: 0.9rem;
    color: hsl(0, 0%, 18%);
    margin-bottom: 2px;
  }

  .toast-message {
    font-size: 0.85rem;
    color: hsl(0, 0%, 45%);
    line-height: 1.4;
  }

  .toast-close {
    width: 28px;
    height: 28px;
    border: none;
    background: transparent;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: hsl(0, 0%, 60%);
    transition: all 0.2s;
  }

  .toast-close:hover {
    background: hsl(0, 0%, 95%);
    color: hsl(0, 0%, 30%);
  }

  @keyframes slideIn {
    from {
      transform: translateX(100%);
      opacity: 0;
    }

    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes slideOut {
    from {
      transform: translateX(0);
      opacity: 1;
    }

    to {
      transform: translateX(100%);
      opacity: 0;
    }
  }

  /* Dark mode support */
  .dark .toast {
    background: hsl(0, 0%, 14%);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
  }

  .dark .toast-title {
    color: hsl(36, 44%, 96%);
  }

  .dark .toast-message {
    color: hsl(0, 0%, 60%);
  }

  .dark .toast-close:hover {
    background: hsl(0, 0%, 20%);
  }
</style>

<div class="toast-container" id="toastContainer">
  <?php
  // Display session messages if they exist
  if (isset($_SESSION['message']) && isset($_SESSION['message_type'])):
    $type = $_SESSION['message_type'];
    $message = $_SESSION['message'];

    $icons = [
      'success' => '<i class="fas fa-check"></i>',
      'error' => '<i class="fas fa-times"></i>',
      'warning' => '<i class="fas fa-exclamation"></i>',
      'info' => '<i class="fas fa-info"></i>'
    ];

    $titles = [
      'success' => 'Succès',
      'error' => 'Erreur',
      'warning' => 'Attention',
      'info' => 'Information'
    ];

    $icon = $icons[$type] ?? $icons['info'];
    $title = $titles[$type] ?? $titles['info'];
    ?>
    <div class="toast toast-<?= htmlspecialchars($type) ?>" id="toast">
      <div class="toast-icon">
        <?= $icon ?>
      </div>
      <div class="toast-content">
        <div class="toast-title"><?= $title ?></div>
        <div class="toast-message"><?= htmlspecialchars($message) ?></div>
      </div>
      <button class="toast-close" onclick="closeToast(this)">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <?php
    // Clear the message after displaying
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
  endif;
  ?>
</div>

<script>
  function closeToast(button) {
    const toast = button.closest('.toast');
    toast.style.animation = 'slideOut 0.3s ease-in forwards';
    setTimeout(() => toast.remove(), 300);
  }

  // Auto-remove toasts after 5 seconds
  document.querySelectorAll('.toast').forEach(toast => {
    setTimeout(() => {
      if (toast && toast.parentNode) {
        toast.style.animation = 'slideOut 0.3s ease-in forwards';
        setTimeout(() => toast.remove(), 300);
      }
    }, 5000);
  });

  // Function to show toast programmatically
  function showToast(type, message, title = null) {
    const container = document.getElementById('toastContainer');
    const icons = {
      success: '<i class="fas fa-check"></i>',
      error: '<i class="fas fa-times"></i>',
      warning: '<i class="fas fa-exclamation"></i>',
      info: '<i class="fas fa-info"></i>'
    };
    const titles = {
      success: 'Succès',
      error: 'Erreur',
      warning: 'Attention',
      info: 'Information'
    };

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-icon">${icons[type] || icons.info}</div>
        <div class="toast-content">
            <div class="toast-title">${title || titles[type] || titles.info}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="closeToast(this)">
            <i class="fas fa-times"></i>
        </button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
      toast.style.animation = 'slideOut 0.3s ease-in forwards';
      setTimeout(() => toast.remove(), 300);
    }, 5000);
  }
</script>