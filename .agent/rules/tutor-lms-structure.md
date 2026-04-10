## Tutor LMS Development Rules

### Post Type Hierarchy
tutor_course (parent)
├── tutor_lesson (child post)
├── tutor_quiz (child post)
│   └── tutor_quiz_question (post meta)
└── topics (tutor_course_topic taxonomy)

### Template Override Pattern
// Source: /plugins/tutor/templates/{template}.php
// Override: /themes/site-theme/tutor/{template}.php
// NEVER edit plugin files directly

### Custom Course Meta
- Register via acf_add_local_field_group() with post_type => 'tutor_course'
- Access in templates: get_field('field_name', $course_id)
- Instructor data: tutor_get_instructors_by_course($course_id)

### Enrollment & Access Control
// Check enrollment
tutor_utils()->is_enrolled($course_id, $user_id)

// Check completion
tutor_utils()->is_completed_course($course_id, $user_id)

// Restrict content
if (!tutor_utils()->is_enrolled($course_id)) {
    wp_redirect(get_permalink($course_id));
    exit;
}

### Yoast SEO + Tutor LMS
- Add Course schema type to tutor_course CPT via Yoast
- Map: course name → _yoast_wpseo_title
- Map: course description → _yoast_wpseo_metadesc
