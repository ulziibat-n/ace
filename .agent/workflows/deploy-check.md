## Pre-Deployment Checklist Workflow

Run before EVERY deployment:

1. PHP syntax check: php -l on all modified files
2. WordPress Coding Standards: phpcs --standard=WordPress
3. Security scan: use security-audit workflow
4. Database: check for pending ACF JSON sync
5. Performance: run query monitor — flag queries > 100ms
6. Falang: verify all new strings are registered + translated
7. Yoast: check schema output on key pages
8. Mobile: test responsive breakpoints (375px, 768px, 1024px)
9. Accessibility: check color contrast, aria labels, tab order
10. Backup: confirm staging backup before pushing to production
