/**
 * Theme management system
 * Handles dark/light theme switching with localStorage persistence
 */

(function () {
    "use strict";

    // Defensive check for localStorage
    const hasLocalStorage = (function () {
        try {
            const test = "__theme_test__";
            localStorage.setItem(test, test);
            localStorage.removeItem(test);
            return true;
        } catch (e) {
            return false;
        }
    })();

    /**
     * Get initial theme from localStorage or default to 'dark'
     */
    function getInitialTheme() {
        if (hasLocalStorage) {
            const stored = localStorage.getItem("theme");
            if (stored === "dark" || stored === "light") {
                return stored;
            }
        }
        return "dark";
    }

    /**
     * Apply theme to <html> element
     */
    function applyTheme(theme) {
        const html = document.documentElement;
        if (theme === "dark") {
            html.classList.add("dark");
        } else {
            html.classList.remove("dark");
        }
    }

    /**
     * Save theme to localStorage
     */
    function saveTheme(theme) {
        if (hasLocalStorage) {
            try {
                localStorage.setItem("theme", theme);
            } catch (e) {
                // Silently fail if localStorage is unavailable
            }
        }
    }

    /**
     * Dispatch theme:changed event
     */
    function dispatchThemeChanged(theme) {
        const event = new CustomEvent("theme:changed", {
            detail: { theme: theme },
        });
        window.dispatchEvent(event);
    }

    /**
     * Toggle theme between dark and light
     */
    function toggleTheme() {
        const current = window.currentTheme || "dark";
        const newTheme = current === "dark" ? "light" : "dark";

        window.currentTheme = newTheme;
        applyTheme(newTheme);
        saveTheme(newTheme);
        dispatchThemeChanged(newTheme);
    }

    /**
     * Initialize theme on page load
     */
    function initTheme() {
        const initialTheme = getInitialTheme();
        window.currentTheme = initialTheme;
        applyTheme(initialTheme);
        dispatchThemeChanged(initialTheme);
    }

    // Expose toggleTheme globally
    window.toggleTheme = toggleTheme;

    // Initialize immediately (before DOMContentLoaded) to prevent flash
    // This runs synchronously if script is in <head> or with defer
    if (document.documentElement) {
        initTheme();
    } else {
        // Fallback if HTML element doesn't exist yet
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", initTheme);
        } else {
            initTheme();
        }
    }
})();
