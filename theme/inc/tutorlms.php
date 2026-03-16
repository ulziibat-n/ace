<?php
/**
 * TutorLMS Integration
 */

/**
 * Declare TutorLMS support
 */
add_theme_support( 'tutor-lms' );

/**
 * Remove sidebar from TutorLMS pages if needed
 */
add_filter( 'tutor_lms_should_display_sidebar', '__return_false' );

/**
 * Custom styling for TutorLMS elements to match ACE theme
 */
function ub_tutor_lms_custom_css() {
    ?>
    <style>
        :root {
            --tutor-color-primary: #1e3a8a; /* Our Navy Blue */
            --tutor-color-secondary: #f59e0b; /* Our Amber */
        }
        .tutor-course-card {
            border-radius: 1.5rem !important;
            overflow: hidden !important;
            border: 1px solid #f1f5f9 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05) !important;
        }
        .tutor-btn-primary {
            background-color: var(--tutor-color-primary) !important;
            border-radius: 9999px !important;
            padding: 0.75rem 1.5rem !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'ub_tutor_lms_custom_css' );
