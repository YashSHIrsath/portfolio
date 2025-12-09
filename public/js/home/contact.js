/**
 * Contact modal and CV download handler
 * Manages modal open/close, Esc key, focus management, and CV download
 */

(function () {
    "use strict";

    let contactBtn = null;
    let contactModal = null;
    let closeBtn = null;
    let downloadBtn = null;
    let previousActiveElement = null;

    /**
     * Get DOM elements
     */
    function getElements() {
        contactBtn = document.querySelector(".js-contact-btn");
        contactModal = document.querySelector(".js-contact-modal");
        closeBtn = document.querySelector(".js-contact-close");
        downloadBtn = document.querySelector(".js-download-cv");

        return {
            contactBtn,
            contactModal,
            closeBtn,
            downloadBtn,
        };
    }

    /**
     * Show the contact modal
     */
    function showModal() {
        if (!contactModal) return;

        // Store the previously active element for focus return
        previousActiveElement = document.activeElement;

        // Show modal
        contactModal.classList.remove("hidden");
        contactModal.classList.add("flex");

        // Add blur to body
        document.body.classList.add("is-blurred");

        // Focus the close button
        if (closeBtn) {
            setTimeout(() => {
                closeBtn.focus();
            }, 100);
        }

        // Prevent body scroll
        document.body.style.overflow = "hidden";
    }

    /**
     * Hide the contact modal
     */
    function hideModal() {
        if (!contactModal) return;

        // Hide modal
        contactModal.classList.add("hidden");
        contactModal.classList.remove("flex");

        // Remove blur from body
        document.body.classList.remove("is-blurred");

        // Restore body scroll
        document.body.style.overflow = "";

        // Return focus to the contact button
        if (previousActiveElement && typeof previousActiveElement.focus === "function") {
            previousActiveElement.focus();
        } else if (contactBtn) {
            contactBtn.focus();
        }
    }

    /**
     * Handle Esc key press to close modal
     */
    function handleEscKey(e) {
        if (e.key === "Escape" || e.keyCode === 27) {
            if (contactModal && !contactModal.classList.contains("hidden")) {
                hideModal();
            }
        }
    }

    /**
     * Handle Download CV button click
     */
    function handleDownloadCV(e) {
        e.preventDefault();

        const cvPath = "/resume/Yash_Shirsath_CV.pdf";

        try {
            // Create a temporary anchor element to trigger download
            const link = document.createElement("a");
            link.href = cvPath;
            link.download = "Yash_Shirsath_CV.pdf";
            link.style.display = "none";

            // Append to body, click, then remove
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // If download fails, log a warning (but don't throw)
            setTimeout(() => {
                // Note: We can't reliably detect if download succeeded,
                // but if the file doesn't exist, browser will handle it
                if (console && console.warn) {
                    console.warn(
                        "If the download didn't start, please check that the file exists at:",
                        cvPath
                    );
                }
            }, 1000);
        } catch (error) {
            // Gracefully handle any errors
            if (console && console.warn) {
                console.warn("Could not initiate CV download:", error.message);
            }
        }
    }

    /**
     * Handle Contact Me button click
     */
    function handleContactClick(e) {
        e.preventDefault();
        showModal();
    }

    /**
     * Initialize event listeners
     */
    function initContact() {
        const elements = getElements();

        // Set up download CV button
        if (elements.downloadBtn) {
            elements.downloadBtn.addEventListener("click", handleDownloadCV);
        }

        // Set up contact button
        if (elements.contactBtn) {
            elements.contactBtn.addEventListener("click", handleContactClick);
        }

        // Set up close button
        if (elements.closeBtn) {
            elements.closeBtn.addEventListener("click", hideModal);
        }

        // Set up Esc key listener
        document.addEventListener("keydown", handleEscKey);

        // Close modal when clicking backdrop
        if (elements.contactModal) {
            elements.contactModal.addEventListener("click", function (e) {
                // Close if clicking the backdrop (not the modal content)
                if (e.target === elements.contactModal || e.target.classList.contains("backdrop-blur-sm")) {
                    hideModal();
                }
            });
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initContact);
    } else {
        initContact();
    }
})();

