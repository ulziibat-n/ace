## WordPress Architecture Rules

### Directory Structure (ENFORCE)

/wp-content/themes/site-theme/
├── inc/
│ ├── cpt/ ← CPT registration files (cpt-_.php)
│ ├── acf/ ← ACF field group JSON sync files
│ ├── blocks/ ← Block registration (block-_.php)
│ ├── api/ ← REST API endpoints
│ └── helpers/ ← Shared utility functions
├── blocks/
│ └── {block-name}/
│ ├── block.json
│ ├── render.php
│ ├── block.css
│ └── block.js
├── template-parts/
├── assets/
│ ├── css/
│ ├── js/
│ └── images/
└── functions.php ← ONLY includes, no direct logic

### CPT Registration Pattern

- Always use register_post_type() inside init hook with priority 0
- Support: title, editor, thumbnail, custom-fields, revisions
- Always register corresponding taxonomy in same file
- Flush rewrite rules ONLY on plugin/theme activation hook

### ACF Integration Pattern

- Field groups MUST have JSON sync enabled (.agent/acf-json/ directory)
- Use acf_register_block_type() for Gutenberg blocks
- Field keys format: field*site*{feature}\_{name}
- Always use get_field() with fallback: get_field('key') ?: 'default'
