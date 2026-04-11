---
name: yoast-schema
description: >
    Trigger when: adding schema markup, custom CPT SEO, LocalBusiness schema,
    Course schema for Tutor LMS, breadcrumb configuration
triggers:
    - 'schema'
    - 'SEO schema'
    - 'Yoast schema'
    - 'structured data'
---

## Yoast SEO Schema Extension Protocol

### Organization + LocalBusiness Schema

add_filter('wpseo_schema_graph', function(array $data, \WPSEO_Schema_Context $context): array {
    foreach ($data as &$piece) {
        if ($piece['@type'] === 'Organization') {
$piece['@type'] = ['Organization', 'LocalBusiness'];
$piece['address'] = [
'@type' => 'PostalAddress',
'addressLocality' => 'Ulaanbaatar',
'addressCountry' => 'MN',
];
$piece['openingHours'] = ['Mo-Fr 09:00-18:00'];
$piece['telephone'] = get_option('site_phone_number', '');
}
}
return $data;
}, 11, 2);

### Course Schema for Tutor LMS

add_filter('wpseo_schema_graph', function(array $data, \WPSEO_Schema_Context $context): array {
if (!is_singular('tutor_course')) { return $data; }

    $course_id = get_the_ID();
    $data[]    = [
        '@type'       => 'Course',
        '@id'         => get_permalink($course_id) . '#course',
        'name'        => get_the_title($course_id),
        'description' => get_field('site_course_description', $course_id) ?: get_the_excerpt($course_id),
        'provider'    => ['@id' => $context->site_url . '#organization'],
        'courseMode'  => 'online',
        'inLanguage'  => ['mn', 'en'],
    ];
    return $data;

}, 11, 2);
