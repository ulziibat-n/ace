---
name: acf-block-creator
description: Custom ACF Gutenberg block үүгсэх чадвартай skill. Зураг эсвэл тайлбар дээр үндэслэн ACF blocks үүсгэнэ.
---

# ACF Gutenberg Block Creator

Энэхүү skill нь WordPress вэбсайтад ACF (Advanced Custom Fields) Pro ашиглан Gutenberg-ийн custom block-уудыг үүсгэхэд ашиглагдана.

## Ажлын дараалал

1. **Анализ хийх**: Хавсаргасан зураг эсвэл текстийг шинжилж, ямар талбарууд (ACF fields) шаардлагатай болохыг тодорхойлно.
2. **Блокын хавтас үүсгэх**: `theme/blocks/[slug]/` хавтсыг үүсгэнэ.
3. **Metadata (block.json)**: Блокын нэр, гарчиг, тохиргоог `block.json` файлд бичнэ. Уг файл нь `acf-blocks.php`-ээр дамжин автоматаар бүртгэгдэнэ.
4. **Template ([slug].php)**: Блокын PHP бүтцийг боловсруулна.
5. **ACF JSON үүсгэх**: Талбаруудын тохиргоог `theme/acf-json/group_[unique_id].json` хэлбэрээр үүсгэж, блоктой холбоно.

## Техникийн шаардлагууд

### 1. Файлын бүтэц
- `theme/blocks/[slug]/block.json` (Registration)
- `theme/blocks/[slug]/[slug].php` (PHP Template)
- `theme/blocks/[slug]/[slug].css` (Optional - хэрэв Tailwind-ээс гадуур css хэрэгтэй бол)
- `theme/acf-json/group_[unique_id].json` (Field sync)

### 2. Layout & Design
- **Full Width**: Хэрэв өөрөөр заагаагүй бол бүх блок `alignfull` класс болон `section` бүтэцтэй байна.
- **Container**: Блокын агуулга нь `container mx-auto px-6 lg:px-12` гэсэн класс дотор байрлана.
- **Variable Naming**: Template-ийн үндсэн түвшинд зарлагдаж буй хувьсагчид заавал `$ub_` prefix-тэй байна. (Жишээ: `$ub_title`, `$ub_image`).
- **Typography & Spacing**: Сайтын ерөнхий загвар хэв маягийг (Tailwind config-д заасан colors, fonts, spacing) чанд баримтална.
- **Preview Mode**: Блок хоосон байх үед Admin editor дээр placeholder харуулна.

### 3. ACF Field Group
- `key`: `group_` + санамсаргүй ID.
- `location`: `acf/block == acf/[slug]`.
- Талбарууд нь цэгцтэй, `repeater`, `image` (array), `link` (array) зэрэг тохиромжтой төрлүүдийг ашиглана.

## Жишээ код (Template)

```php
<?php
$ub_id         = 'block-slug-' . $block['id'];
$ub_class_name = 'block-slug alignfull ' . ( $block['className'] ?? '' );

// Fields
$ub_title       = get_field( 'title' );
$ub_description = get_field( 'description' );

if ( ! $ub_title && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Блокын мэдээллийг оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-12 lg:py-24">
	<div class="container mx-auto px-6 lg:px-12">
		<div class="max-w-3xl flex flex-col items-center mx-auto text-center">
			<h2 class="text-3xl lg:text-5xl font-bold mb-6"><?php echo esc_html( $ub_title ); ?></h2>
			<div class="text-lg text-neutral-600"><?php echo wp_kses_post( $ub_description ); ?></div>
		</div>
	</div>
</section>
```

## Чухал санамж
- Блокыг үүсгэсний дараа `theme/acf-json/` дотор шинэ JSON файл үүссэн эсэхийг заавал шалга.
- Талбаруудын нэрийг (slug) утга учиртай, ойлгомжтой өгөх.
- Өнгө, зай хэмжээг `theme/tailwind.css` болон бусад тохиргоотой уялдуулна.
