/**
 * CitySync AI Companion - Global Utilities
 */

/**
 * Format number to Indonesian Rupiah currency
 * @param {number} value - The value to format
 * @returns {string} - Formatted currency string
 */
function formatCurrency(value) {
    return new Intl.NumberFormat('id-ID').format(value);
}

/**
 * Initialize tab switching functionality
 * @param {string} containerSelector - CSS selector for tab container
 * @param {string} tabSelector - CSS selector for tab inputs
 * @param {string} paneSelector - CSS selector for tab panes
 */
function initializeTabs(containerSelector = 'input[name="dest-tabs"]', paneSelector = '.tab-pane') {
    const tabs = document.querySelectorAll(containerSelector);
    
    tabs.forEach(tab => {
        tab.addEventListener('change', function() {
            const activeTab = this.value;
            document.querySelectorAll(paneSelector).forEach(pane => {
                pane.classList.add('hidden');
            });
            const activePane = document.getElementById(`tab-${activeTab}`);
            if (activePane) {
                activePane.classList.remove('hidden');
            }
        });
    });
}

/**
 * Format date to Indonesian format
 * @param {Date|string} date - Date to format
 * @returns {string} - Formatted date string
 */
function formatDateID(date) {
    const d = new Date(date);
    const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
    return d.toLocaleDateString('id-ID', options);
}

/**
 * Show notification toast
 * @param {string} message - Message to show
 * @param {string} type - Type: 'success', 'error', 'info', 'warning'
 */
function showNotification(message, type = 'info') {
    console.log(`[${type.toUpperCase()}] ${message}`);
    // Can be extended with actual toast library later
}

/**
 * Initialize page when DOM is ready
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tabs if present
    const tabInputs = document.querySelectorAll('input[name="dest-tabs"]');
    if (tabInputs.length > 0) {
        initializeTabs();
    }
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIconOpen = document.getElementById('menu-icon-open');
    const menuIconClose = document.getElementById('menu-icon-close');
    
    if (mobileMenuBtn && mobileMenu && menuIconOpen && menuIconClose) {
        mobileMenuBtn.addEventListener('click', function() {
            const isOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden', isOpen);
            menuIconOpen.classList.toggle('hidden', !isOpen);
            menuIconClose.classList.toggle('hidden', isOpen);
            this.setAttribute('aria-expanded', String(!isOpen));
        });
    }
});

// Export for global use
window.formatCurrency = formatCurrency;
window.initializeTabs = initializeTabs;
window.formatDateID = formatDateID;
window.showNotification = showNotification;
