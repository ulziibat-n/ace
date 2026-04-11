# ACE EDU Design System & Style Guide

This document outlines the design tokens and component patterns extracted from the ACE EDU WordPress theme.

## 1. Core Design Tokens

### 1.1 Colors

The color palette is defined in `tailwind/tailwind-theme.css`.

| Token             | Value             | Tailwind Class                   | Usage                                            |
| ----------------- | ----------------- | -------------------------------- | ------------------------------------------------ |
| **Primary**       | `#085399`         | `text-primary`, `bg-primary`     | Main brand color, buttons, links, active states. |
| **Secondary**     | `#EC1B24`         | `text-secondary`, `bg-secondary` | Accent color, highlights.                        |
| **White**         | `#FFFFFF`         | `bg-white`, `text-white`         | Main surface color, text on dark backgrounds.    |
| **Slate 950**     | `#020617`         | `bg-slate-950`                   | Footer background (nested), deep dark areas.     |
| **Slate 900**     | `#0f172a`         | `bg-slate-900`                   | Main footer background.                          |
| **Slate 100**     | `#f1f5f9`         | `bg-slate-100`                   | Light section backgrounds, empty states.         |
| **Slate 50**      | `#f8fafc`         | `bg-slate-50`                    | Extra light backgrounds, card borders.           |
| **Foreground/60** | `rgba(0,0,0,0.6)` | `text-foreground/60`             | Secondary text, descriptions.                    |

### 1.2 Typography

| Element           | Font Family | Weight       | Size (Desktop)         | Spacing / Style                       |
| ----------------- | ----------- | ------------ | ---------------------- | ------------------------------------- |
| **Hero Title**    | Google Sans | Black (900)  | `text-4xl lg:text-6xl` | `leading-tight`, `tracking-tighter`   |
| **Section Title** | Google Sans | Black (900)  | `text-2xl lg:text-3xl` | `leading-tight`, `mb-4`               |
| **Page Title**    | Google Sans | Bold (700)   | `text-4xl`             | `mb-16`                               |
| **Article Title** | Google Sans | Bold (700)   | `text-base`            | `leading-tight`, `hover:text-primary` |
| **Body Text**     | Google Sans | Medium (500) | `text-base`            | `leading-relaxed`                     |
| **Small Meta**    | Google Sans | Bold (700)   | `text-[0.65rem]`       | `uppercase`, `tracking-normal`        |

### 1.3 Shapes & Spacing

- **Border Radius**:
    - `rounded-xs`: 2px (Buttons, badges)
    - `rounded-sm`: 4px (Cards, general blocks)
    - `rounded-xl`: 12px (FAQ items)
    - `rounded-full`: Circular (Avatars, navigation buttons)
- **Container**: Max width defined by Tailwind variables (standard container width is optimized for readability).
- **Section Padding**:
    - Desktop: `py-24` or `py-32`
    - Mobile: `py-16`

## 2. Component Patterns

### 2.1 Buttons

- **Primary Button (Blue)**: `bg-primary text-white rounded-xs px-4 py-2 font-bold shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark`
- **White Button (CTA)**: `bg-white text-primary px-6 py-2 rounded-xs font-bold transition-all duration-300 hover:bg-slate-100 shadow-xl shadow-black/5 border border-white min-w-[140px]`. Inner text: `uppercase leading-none text-xs`.
- **Secondary/Outline (CTA)**: `bg-transparent border-2 border-white/30 text-white rounded-xs px-6 py-2 font-bold transition-all duration-300 hover:bg-white/10 min-w-[140px]`. Inner text: `uppercase leading-none text-xs`.

### 2.2 Cards

- **Post Card**:
    - Outer: `bg-white rounded-sm overflow-hidden border border-slate-50 transition-all hover:shadow-md`
    - Image: `aspect-video object-cover hover:scale-105 transition-transform`
    - Content: `p-6` with meta info followed by title and "Read more" link.

### 2.3 FAQ Accordion

- `details.group` with `bg-slate-50 rounded-xl`.
- `summary` with `font-bold text-slate-900`.
- Transition effects on open/close and arrow rotation.

## 3. Implementation Rules (Design)

1. **Hierarchy**: Always use `h2` for section titles within blocks, and `h1` for page/post titles.
2. **Color Usage**: Stick to theme variables. Avoid hardcoded hex values. Use `text-primary`, `bg-slate-100`, etc.
3. **Spacing**: Use standard horizontal padding (`px-6 lg:px-12`) via the `.container` class.
4. **Icons**: Use pure SVG icons with `stroke="currentColor"` and appropriate `w-h` classes.
5. **Animations**: Use subtle transitions (`duration-300 ease-in-out`) for hover states on interactive elements.
