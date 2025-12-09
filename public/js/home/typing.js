/**
 * Typewriter effect for rotating words
 * Cycles through an array of words with typing and deleting animation
 */

(function () {
    "use strict";

    // Configuration constants
    const TYPING_SPEED = 100; // milliseconds per character
    const DELETING_SPEED = 50; // milliseconds per character when deleting
    const PAUSE_AFTER_TYPING = 2000; // milliseconds to pause after typing a word
    const PAUSE_AFTER_DELETING = 500; // milliseconds to pause after deleting a word

    // Words to cycle through
    const WORDS = ["a developer", "a creator", "an enthusiast"];

    let currentWordIndex = 0;
    let currentText = "";
    let isDeleting = false;
    let timeoutId = null;

    /**
     * Get the typing element and text container
     */
    function getTypingElements() {
        const typingContainer = document.querySelector(".js-typing");
        const textElement = document.querySelector(".js-typing-text");

        if (!typingContainer || !textElement) {
            return null;
        }

        return { typingContainer, textElement };
    }

    /**
     * Type or delete text character by character
     */
    function typeText() {
        const elements = getTypingElements();
        if (!elements) return;

        const { textElement } = elements;
        const currentWord = WORDS[currentWordIndex];

        if (isDeleting) {
            // Delete characters
            currentText = currentWord.substring(0, currentText.length - 1);
            textElement.textContent = currentText;

            if (currentText === "") {
                // Finished deleting, move to next word
                isDeleting = false;
                currentWordIndex = (currentWordIndex + 1) % WORDS.length;
                timeoutId = setTimeout(typeText, PAUSE_AFTER_DELETING);
            } else {
                timeoutId = setTimeout(typeText, DELETING_SPEED);
            }
        } else {
            // Type characters
            currentText = currentWord.substring(0, currentText.length + 1);
            textElement.textContent = currentText;

            if (currentText === currentWord) {
                // Finished typing, pause then start deleting
                isDeleting = true;
                timeoutId = setTimeout(typeText, PAUSE_AFTER_TYPING);
            } else {
                timeoutId = setTimeout(typeText, TYPING_SPEED);
            }
        }
    }

    /**
     * Initialize the typing animation
     */
    function initTyping() {
        const elements = getTypingElements();
        if (!elements) {
            // Retry if DOM not ready
            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", initTyping);
            }
            return;
        }

        // Start typing animation
        typeText();
    }

    // Clean up timeout on page unload
    window.addEventListener("beforeunload", function () {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initTyping);
    } else {
        initTyping();
    }
})();

