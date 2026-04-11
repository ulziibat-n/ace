# Changelog

Бүх мэдэгдэхүйц өөрчлөлтүүдийг энэ файлд бүртгэнэ.
Төсөл нь [Semantic Versioning](https://semver.org/lang/mn/) стандартыг баримтална.

## [0.2.0] - 2026-03-16

### Нэмэгдсэн

- **Custom Post Types**: Сургууль, Үйлчилгээ, Амжилтын түүх, Эвент, Түгээмэл асуулт хариулт (FAQ) гэсэн төрлүүд нэмэгдэв.
- **Gutenberg Блокууд**: Hero, Roadmap, FAQ, Social Proof, Feature Grid, Contact Form гэсэн 6 шинэ блок ACE брэнд өнгө төрхтэйгөөр нэмэгдэв.
- **ACF JSON Sync**: Бүх талбарууд автоматаар JSON файлаар хадгалагдаж, синк хийгдэхээр тохируулагдав.
- **Дизайн**: Google Sans (Outfit) фонтыг систем даяар тохируулж, Tailwind CSS v4 болон ACE-ийн брэнд өнгө төрхийг оруулж өгөв.
- **Локал хөгжүүлэлт**: BrowserSync тохиргоог `ace.local` дээр хийж, `npm run watch` комманд нэмэгдэв.
- **Систем**: TutorLMS-ийн дэмжлэг болон Loco Translate ашиглан олон хэл (Солонгос, Монгол) дээр ажиллах боломжтой болов.
- **Хөгжүүлэгчид зориулав**: WordPress болон ACF Pro-ийн PHP Stubs суулгаж, IDE-д илүү хялбар код бичих боломж бүрдэв.

### Өөрчлөгдсөн

- **Editor Cleanup**: Gutenberg редактор дээрх хэрэгцээгүй блокуудыг (Design, Widgets, Theme, Embeds) хасаж, илүү цэвэрхэн болгов.
- **`theme.json`**: Дизайны тохиргоог `theme.json`-оос хасаж, Tailwind болон Classic PHP руу шилжүүлэв.

---

## [0.1.0] - 2026-03-15

### Нэмэгдсэн

- Initial project setup with Tailwind CSS and WordPress theme structure.
- Git Flow workflow configuration for Antigravity.
- Automatic production bundling and ZIP creation.
