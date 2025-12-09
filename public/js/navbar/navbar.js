/**
 * Navbar theme toggle button handler
 * Listens for theme changes and updates button icon visibility
 */

(function () {
    "use strict";

    let themeToggleBtn = null;
    let sunIcon = null;
    let moonIcon = null;

    /**
     * Update icon visibility based on current theme
     */
    function updateIcons() {
        if (!sunIcon || !moonIcon) return;

        const theme = window.currentTheme || "dark";

        if (theme === "dark") {
            // Show sun icon (clicking will switch to light)
            sunIcon.classList.remove("hidden");
            moonIcon.classList.add("hidden");
        } else {
            // Show moon icon (clicking will switch to dark)
            moonIcon.classList.remove("hidden");
            sunIcon.classList.add("hidden");
        }
    }

    /**
     * Handle theme toggle button click
     */
    function handleToggleClick(e) {
        e.preventDefault();
        if (typeof window.toggleTheme === "function") {
            window.toggleTheme();
        }
    }

    /**
     * Initialize navbar theme toggle
     */
    function initNavbar() {
        themeToggleBtn = document.querySelector(".js-theme-toggle");
        sunIcon = document.querySelector(".js-icon-sun");
        moonIcon = document.querySelector(".js-icon-moon");

        if (!themeToggleBtn) return;

        // Set up click handler
        themeToggleBtn.addEventListener("click", handleToggleClick);

        // Initial icon update
        updateIcons();

        // Listen for theme changes
        window.addEventListener("theme:changed", updateIcons);
    }

    // Initialize when DOM is ready
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initNavbar);
    } else {
        initNavbar();
    }
})();
