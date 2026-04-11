---
name: acf-block-creator
description: Custom ACF Gutenberg block үүсгэх чадвартай skill. Зураг эсвэл тайлбар дээр үндэслэн ACF blocks үүсгэнэ.
---

# ACF Gutenberg Block Creator

Энэхүү skill нь WordPress вэбсайтад ACF (Advanced Custom Fields) Pro ашиглан Gutenberg-ийн custom block-уудыг үүсгэхэд ашиглагдана.

## Ажлын дараалал

1. **Анализ хийх**: Хавсаргасан зураг эсвэл текстийг шинжилж, ямар талбарууд (ACF fields) шаардлагатай болохыг тодорхойлно.
2. **Блокын хавтас үүсгэх**: `theme/blocks/[slug]/` хавтсыг үүсгэнэ.
3. **Metadata (block.json)**: Блокын нэр, гарчиг, тохиргоог `block.json` файлд бичнэ.
4. **Template ([slug].php)**: Блокын PHP бүтцийг боловсруулна.
5. **ACF JSON үүсгэх**: Талбаруудын тохиргоог `theme/acf-json/group_[unique_id].json` хэлбэрээр үүсгэж, блоктой холбоно.
6. **Editor Settings**: Шинэ блокыг `theme/inc/editor-settings.php` файл дахь зөвшөөрөгдөх блокуудын жагсаалтад нэмнэ.

## Техникийн шаардлагууд

### 1. Файлын бүтэц

- `theme/blocks/[slug]/block.json` (Registration & Post Type restriction)
- `theme/blocks/[slug]/[slug].php` (PHP Template)
- `theme/acf-json/group_[unique_id].json` (Field sync)

### 2. Layout & Post Type Restriction

- **Post Type**: Блокыг зөвхөн тодорхой төрлийн хуудсанд ашиглах бол `block.json` файл дотор `"postTypes": ["page"]` гэж заана.
- **Full Width**: Хэрэв өөрөөр заагаагүй бол бүх блок `alignfull` класс болон `section` бүтэцтэй байна.
- **Container**: Блокын агуулга нь зөвхөн `.container` класс дотор байрлана. (mx-auto, px-6 гэх мэт классууд хэрэггүй).

### 3. Кодын стандарт (PHP & Tailwind)

- **Variable Naming**: Template-ийн үндсэн түвшинд зарлагдаж буй хувьсагчид заавал `$ub_` prefix-тэй байна. (Жишээ: `$ub_title`).
- **Short Ternaries**: `?:` ашиглахыг хориглоно. Оронд нь `? :` (бүрэн ternary) эсвэл `if` ашиглана.
- **Inline Comments**: Мөр доторх тайлбар бүр заавал цэгээр ( . ) төгсөх ёстой.
- **@package**: PHP файлын DocBlock-д `@package aceedu` заавал оруулна.
- **Preview Mode**: Блок хоосон байх үед Admin editor дээр placeholder харуулна.

## Жишээ код (Template)

```php
<?php
/**
 * Block Description.
 *
 * @package aceedu
 */

$ub_id         = 'block-slug-' . $block['id'];
$ub_class_name = 'block-slug alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_title = get_field( 'title' );

if ( ! $ub_title ) {
	$ub_title = 'Өгөгдмөл гарчиг';
}

if ( ! $ub_title && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мэдээллээ оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-12 lg:py-24">
	<div class="container">
		<!-- Content. -->
		<h2 class="text-3xl lg:text-5xl font-bold"><?php echo esc_html( $ub_title ); ?></h2>
	</div>
</section>
```

## Чухал санамж

- Блокыг үүсгэсний дараа `theme/acf-json/` дотор шинэ JSON файл үүссэн эсэхийг заавал шалга.
- Талбаруудын нэрийг (slug) утга учиртай, ойлгомжтой өгөх.
- Өнгө, зай хэмжээг `theme/tailwind.css` болон бусад тохиргоотой уялдуулна.
