# ACE Project Agent Rules

This document serves as the master rulebook for all AI agents working on this enterprise WordPress project.

## Core Directives

1. **WordPress Coding Standards**: Always write code using strict WordPress Coding Standards (WPCS). Ensure PHP 8.2+ compatibility and use `strict_types=1` on every file.
2. **Artifact-First Workflow**: Before making large code changes, you MUST create an implementation plan as an artifact. This ensures design alignment and reduces errors.
3. **No Destructive Commands**: Never run destructive terminal commands (e.g., `rm -rf /`, `git reset --hard` without explicit confirmation).
4. **Context Preservation**: Keep a `working.md` file in the project root constantly updated with current progress, completed tasks, and next steps to preserve context across sessions.
5. **Separation of Concerns**: Strictly separate content from layouts. Prioritize Full Site Editing (FSE) and block themes capabilities. Rely on `theme.json` for global styling and site-wide configuration.
6. **STRICT SQL RULE**: Never execute direct SQL queries like `DROP`, `DELETE`, or `TRUNCATE` via the terminal or direct `$wpdb` calls for bulk deletion. Any data deletion must be handled through native WordPress functions (e.g., `wp_delete_post`, `wp_delete_attachment`) to ensure hooks and cleanup are triggered correctly.
