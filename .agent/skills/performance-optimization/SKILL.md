---
name: performance-optimization
description: >
    Trigger when: optimizing page speed, reducing database queries, 
    implementing caching, lazy loading, Core Web Vitals improvement
triggers:
    - 'slow'
    - 'performance'
    - 'optimize'
    - 'cache'
    - 'speed'
---

## Performance Optimization Protocol

### Query Optimization

// BAD — N+1 query problem
$courses = get_posts(['post_type' => 'tutor_course']);
foreach ($courses as $course) {
$instructor = get_field('instructor', $course->ID); // NEW QUERY each time!
}

// GOOD — Pre-fetch with meta query
$courses = get_posts([
'post_type' => 'tutor_course',
'meta_query' => [['key' => '_site_featured', 'value' => '1']],
'update_post_meta_cache' => true, // Pre-loads all meta
'update_post_term_cache' => true, // Pre-loads all terms
]);

### Transient Caching Pattern

function site_get_featured_courses(): array {
$cache_key = 'site_featured_courses_v1';
    $cached    = get_transient($cache_key);

    if ($cached !== false) { return $cached; }

    $courses = get_posts([/* expensive query */]);
    $result  = array_map('site_format_course_data', $courses);

    set_transient($cache_key, $result, HOUR_IN_SECONDS * 6);

    return $result;

}

// Invalidate on save
add_action('save_post_tutor_course', fn() => delete_transient('site_featured_courses_v1'));
