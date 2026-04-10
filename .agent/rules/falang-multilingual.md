## Falang Multilingual Rules

### Setup Requirements
- Active languages: MN (Mongolian primary), EN (English secondary)
- RTL support: NOT required for MN/EN
- URL structure: /mn/ prefix for Mongolian, /en/ for English

### String Registration Pattern
// ALWAYS register in after_setup_theme
icl_register_string('site-theme', 'unique_key_description', $default_string);

// ALWAYS retrieve with
__('string', 'site-theme') wrapped in icl_t() for dynamic strings

### ACF + Falang Integration
- Register ACF text/textarea/wysiwyg fields in Falang settings
- Use falang_translate_post() for programmatic post translation
- Language switcher: [falang-language-switcher style="dropdown"]
- NEVER use WPML functions — Falang has different API

### Template Rules
- Check language: apply_filters('wpml_current_language', null)
- Conditional content: use Falang's native field translation, NOT PHP conditionals
- URLs: use falang_get_permalink() instead of get_permalink() for translated posts
