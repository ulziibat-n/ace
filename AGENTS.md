# ACE Project Agent Rules

This document serves as the master rulebook for all AI agents working on this enterprise WordPress project.

## Core Directives

1. **WordPress Coding Standards**: Always write code using strict WordPress Coding Standards (WPCS). Ensure PHP 8.2+ compatibility. **STRICTLY FORBIDDEN**: Never use `declare(strict_types=1);` in any PHP files as per user request.
2. **Artifact-First Workflow**: Before making large code changes, you MUST create an implementation plan as an artifact. This ensures design alignment and reduces errors.
3. **No Destructive Commands**: Never run destructive terminal commands (e.g., `rm -rf /`, `git reset --hard` without explicit confirmation).
4. **Context Preservation**: Keep a `working.md` file in the project root constantly updated with current progress, completed tasks, and next steps to preserve context across sessions.
5. **Separation of Concerns**: Strictly separate content from layouts. Prioritize Full Site Editing (FSE) and block themes capabilities. Rely on `theme.json` for global styling and site-wide configuration.
6. **STRICT SQL RULE**: Never execute direct SQL queries like `DROP`, `DELETE`, or `TRUNCATE` via the terminal or direct `$wpdb` calls for bulk deletion. Any data deletion must be handled through native WordPress functions (e.g., `wp_delete_post`, `wp_delete_attachment`) to ensure hooks and cleanup are triggered correctly.
7. **Modular Block Assets**: All custom Gutenberg blocks must use modular, block-level JS files registered via `block.json`. **STRICTLY FORBIDDEN**: Never create separate CSS files for blocks. All styling MUST be implemented using Tailwind CSS utility classes directly within the block's PHP template. **MANDATORY**: Every new block MUST be manually registered in `theme/inc/acf-blocks.php` immediately after creation to ensure reliable visibility in the Gutenberg editor.
8. **STRICT VANILLA JS**: All JavaScript MUST be written in pure Vanilla JS (ES2022+). **jQuery is STRICTLY FORBIDDEN** for any new features or block assets. Use native DOM APIs (`document.querySelector`, `addEventListener`, etc.) and ensure the code works in both the block editor and frontend without jQuery dependencies.
9. **MONGOLIAN COMMENTS**: Бүх кодны комментийг заавал МОНГОЛ хэл дээр бичнэ. Inline коммент (`//`) нь заавал цэгээр (.) төгссөн байна.
10. **CODE QUALITY CONTROL**: Даалгавар эсвэл фичер дуусгах бүрт заавал `./vendor/bin/phpcbf` болон `pnpm run lint-fix` команд ажиллуулж, кодыг автоматаар цэгцэлнэ. PHP-ийн стандартыг (WPCS) шалгахдаа заавал `./vendor/bin/phpcs` ашиглана. Энэ нь Tailwind-ийн шинэ стандарт (canonical classes), JS болон PHP-ийн стандартыг бүрэн баталгаажуулж, гарсан warning-уудыг автоматаар засах үүрэгтэй.
11. **MONGOLIAN COMMITS**: Бүх Git commit мессежүүдийг заавал МОНГОЛ хэл дээр бичнэ. Мессеж нь товч бөгөөд утга төгс байна.
12. **EDITOR FIDELITY & USABILITY**: Блок редактор дээрх харагдац нь Frontend-тэй ижил байхаас гадна, хэт их хоосон зай (padding/margin) үүсгэхгүй байх ёстой. Үүний тулд `tailwind-editor.css` дээр `:where()` ашиглан ерөнхий гарчгуудын зайг reset хийж, блокийн өндрийг редакторт зориулж оновчтой болгоно. Мөн блокийн тохиргоог (fields) заавал Gutenberg-ийн хажуугийн самбарт (Sidebar) харагдахуйц байхаар тохируулж, Repeater талбаруудыг `layout: block` хэлбэрээр шийднэ. Картууд болон давтагдаж буй элементүүд хоорондын зайг тогтмол 10px (`gap-[10px]`) байхаар тохируулна.

## Naming Conventions

- Function prefix: `site_`
- CPT prefix: `site_`
- Meta key prefix: `_site_`
- Hook names: `site/feature/action`
- File names: `kebab-case.php`
