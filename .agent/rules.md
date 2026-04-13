# Төслийн Дүрэм (Project Rules)

Энэхүү файл нь төслийн хөгжүүлэлтийн явцад баримтлах тусгай дүрмүүдийг агуулна.

## 1. Кодын Тайлбар (Documentation)

- **Бүх функцийн тайлбар Монгол хэл дээр байх ёстой.**
- Тайлбар нь маш ойлгомжтой, дэлгэрэнгүй, тухайн функц юу хийдэг, ямар оролт авч юу буцаадаг талаар тодорхой бичигдсэн байна.
- PHP DocBlock стандарт ( `/** ... */` ) ашиглана.

## 2. Мөр доторх тайлбар (Inline Comments)

- **Мөр доторх тайлбар (inline comment) бүр заавал цэгээр ( . ) төгсөх ёстой.**
- Жишээ: `// Custom filter needed.` эсвэл `// Handle in CSS.`

## 3. PHP Файлын Зохион Байгуулалт (File Structure)

`ub_` prefix-тэй PHP функцуудыг байрлал нь ашиглах чиглэлээс нь шалтгаалан дараах файлуудад байрлуулна:

### `theme/functions.php`

- Зөвхөн `require` мэдэгдлүүд болон **`ub_setup`** функц байна.
- `ub_setup` функцийг `add_action( 'after_setup_theme', 'ub_setup' )` hook-ын хамт **зөвхөн энд** байрлуулна.
- Бусад функц, логик энд байрлуулж болохгүй.

### `theme/inc/template-functions.php`

- `ub_` prefix-тэй бөгөөд **`add_action` эсвэл `add_filter` hook ашигладаг** функцуудыг энд байрлуулна.
- Жишээ: `ub_pingback_header`, `ub_body_classes`, `ub_scripts`, `ub_enqueue_block_editor_script` гэх мэт.

### `theme/inc/template-tags.php`

- `ub_` prefix-тэй бөгөөд **hook ашиглаагүй**, зөвхөн template дотор дуудагддаг utility болон output функцуудыг энд байрлуулна.
- Жишээ: `ub_can_show_post_thumbnail`, `ub_html5_comment`, `ub_language_switcher` гэх мэт.

### Дүрмийн хүснэгт

| Нөхцөл                                        | Байрлах файл             |
| --------------------------------------------- | ------------------------ |
| `ub_setup` + `after_setup_theme` hook         | `functions.php`          |
| `ub_` + `add_action` / `add_filter` ашигладаг | `template-functions.php` |
| `ub_` + hook байхгүй, output/utility          | `template-tags.php`      |

## 4. Хувьсагчийн Нэршил (Variable Naming)

### Функцын гадна (template scope)

- **Функцын гадна зарлагдсан хувьсагч заавал `$ub_` prefix-ээр эхлэх ёстой.**
- Энэ нь глобал namespace-д нэр мөргөлдөхөөс сэргийлнэ.
- Жишээ: `$ub_header_button`, `$ub_current_post`, `$ub_args`

### Функцын дотор (local scope)

- Функцын дотор зарлагдсан хувьсагчид prefix шаардлагагүй — энгийн нэршлийг ашиглана.
- Жишээ: `$classes`, `$html`, `$url`, `$count`

### Хувьсагч зарлах байрлал

- **Хувьсагчийг файлын эхэнд бус, ашиглагдах газартаа ойр буюу хамт зарлана.**
- Энэ нь кодыг унших, засварлах, хайх үед хаана зарлагдсаныг тухайн газраасаа шууд харах боломжийг олгоно.

**✅ Зөв жишээ** — хувьсагч ашиглагдах газрынхаа ойролцоо зарлагдсан:

```php
<?php
$ub_header_button = function_exists( 'get_field' ) ? get_field( 'header_button', 'option' ) : null;
if ( $ub_header_button ) : ?>
    <a href="<?php echo esc_url( $ub_header_button['url'] ); ?>">
        <?php echo esc_html( $ub_header_button['title'] ); ?>
    </a>
<?php endif; ?>
```

**❌ Буруу жишээ** — хувьсагч файлын эхэнд зарлагдсан, ашиглагдах газраасаа алслагдсан:

```php
<?php
// Файлын эхэнд...
$ub_header_button = get_field( 'header_button', 'option' );
$ub_title = get_the_title();
// ... олон мөр код ...

// Хэдэн арав мөрийн дараа...
if ( $ub_header_button ) { ... }
```

## 5. Дизайн Систем (Design System)

Шинээр блок болон хуудас хөгжүүлэхдээ `DESIGN_SYSTEM.md` файлд заасан стандартыг чанд мөрдөнө.

### 5.1 Өнгө (Colors)

- Үндсэн өнгө: `--color-primary` (Blue)
- Туслах өнгө: `--color-secondary` (Red)
- Background: `bg-white`, `bg-slate-50`, `bg-slate-100` ашиглана.
- Hardcoded hex value ашиглахыг хориглоно. Tailwind variables ашиглана.

### 5.2 Типограф (Typography)

- Font: **Google Sans**
- Section Header: `text-2xl lg:text-3xl font-bold tracking-tight`
- Body Text: `text-base font-medium leading-relaxed`
- Meta Text: `text-[0.65rem] font-bold uppercase`

### 5.3 Компонент загвар (Component Patterns)

- **Buttons**:
    - Primary (Blue): `bg-primary`, `rounded-xs`, `px-4 py-2`, `text-xs font-bold`, `shadow-lg shadow-primary/20`.
    - White (CTA): `bg-white`, `text-primary`, `px-6 py-2`, `min-w-[140px]`, `shadow-xl shadow-black/5`.
    - Outline: `bg-transparent`, `border-2 border-white/30`, `min-w-[140px]`.
    - Доторх текст: `uppercase leading-none text-xs`.
- **Cards**: `bg-white`, `rounded-sm`, `border-slate-50`, `hover:shadow-md`.
- **Spacing**: Section padding-д `py-16 lg:py-24` эсвэл `py-32` ашиглана.
- **Container**: Давхар гадуур нь заавал `.container` класс ашиглана. **АНХААР**: `.container` ашиглахдаа Tailwind-ийн `px-` болон `mx-` классуудыг давхар ашиглахыг хатуу хориглоно.
