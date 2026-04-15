# Progress Tracking - ACE Project

## ✅ Completed Tasks
- [x] Mega Menu архитектурыг динамик болгож сайжруулав.
- [x] Falang плагинаас үүдэлтэй 404 хуудасны алдааг theme-ийн түвшинд засварлав.
- [x] **Featured Posts Slider** блокыг шинээр үүсгэв.
    - [x] Стандарт нэршил (`featured-posts-slider.php`, `featured-posts-slider.js`)
    - [x] Swiper Styles-ийг Tailwind классуудаар шийдэв (Rule 7).
    - [x] `editor-settings.php` whitelisting-д нэмэв.
- [x] **Typography Alignment**: Слайдерын постын мэдээллийг `content-single.php`-ийн Header-тэй ижил болгов.
- [x] **Excerpt Full Width**: Тайвбарыг үгийн хязгааргүй болгов.
- [x] **Latest Posts Grid** блокыг шинээр үүсгэв.
    - [x] 4 баганатай Grid болон стандарт тоон хуудаслалт (Pagination) хэрэгжүүлэв.
    - [x] Постын тоог WordPress-ийн глобал тохиргооноос (`posts_per_page`) авдаг болгов.
    - [x] Загварыг `testimonials` блоктой (Typography, Max-width) жигдлэв.
    - [x] `acf-json` бүртгэл болон `editor-settings.php` whitelisting хийв.

## 📌 Next Steps
- [ ] Бусад блокуудын Rule 7 (Tailwind-only) нийцлийг шалгах.
- [ ] Олон хэлний орчуулга (Falang) шинэ блокууд дээр зөв ажиллаж байгааг баталгаажуулах.
- [ ] Кодын стандартыг (`phpcs`) бүх файл дээр тогтмол шалгах.

## ⚠️ Critical Notes
- Блок үүсгэхэд `editor-settings.php` заавал шинэчлэгдэх ёстой.
- `phpcs` шалгалт хийх бүрт Exit code 0 байх ёстой.
