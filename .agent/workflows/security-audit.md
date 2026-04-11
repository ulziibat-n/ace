## Security Audit Workflow

Scan the entire codebase for:

1. **SQL Injection** — find direct $wpdb->query() without prepare()
2. **XSS** — find echo without esc_html/esc_attr/esc_url/wp_kses
3. **CSRF** — find form submissions without nonce verification
4. **Capability checks** — find admin functions without current_user_can()
5. **File inclusion** — find include/require with user input
6. **Output encoding** — find get_field() results echoed directly

For each issue found:

- Report: FILE:LINE → ISSUE TYPE → CURRENT CODE → FIXED CODE
- Severity: CRITICAL / HIGH / MEDIUM / LOW
- Fix: provide corrected code immediately
