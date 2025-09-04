import './bootstrap'
import Alpine from 'alpinejs'
import AOS from 'aos'
import 'aos/dist/aos.css'

// Make Alpine available globally
window.Alpine = Alpine

// Initialize Alpine.js
Alpine.start()

// Initialize AOS after DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize AOS once
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic',
            offset: 50,
            disable: false,
            startEvent: 'DOMContentLoaded',
            useClassNames: false,
            disableMutationObserver: false,
            debounceDelay: 50,
            throttleDelay: 99,
        })
    }
})

// Add global utilities for debugging
if (import.meta.env.DEV) {
    window.debug = {
        alpine: Alpine,
        aos: AOS
    }
}