## New Custom Post Type Creation Workflow

EXECUTE IN ORDER — do not skip steps:

1. **Create CPT registration file**
    - Path: inc/cpt/cpt-{name}.php
    - Include: post type + taxonomy in same file
    - Add capabilities, supports, labels array (full)
2. **Create ACF field group**
    - Path: acf-json/group\_{name}.json
    - Enable JSON sync
    - Add minimum fields: title helper, featured image, excerpt override
3. **Register Falang strings**
    - Add icl_register_string() for all static UI strings related to this CPT
    - Register ACF fields in Falang translation settings
4. **Add Yoast SEO schema**
    - Determine appropriate schema type (Article, Course, Event, etc.)
    - Add to wpseo_schema_graph filter
5. **Create archive + single templates**
    - archive-{cpt}.php with WP_Query loop
    - single-{cpt}.php with ACF field display
6. **Include in functions.php**
    - Add require_once get_template_directory() . '/inc/cpt/cpt-{name}.php';
7. **Test checklist**
    - CPT visible in admin ✓
    - Permalink structure works ✓
    - ACF fields display in editor ✓
    - Yoast SEO meta box visible ✓
    - Falang translation tab appears ✓
