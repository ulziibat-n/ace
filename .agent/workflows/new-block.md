## New ACF Gutenberg Block Workflow (MANDATORY)

Бүх AI агентууд шинэ блок үүсгэхдээ доорх дарааллыг хатуу мөрдөнө:

1. **Хавтас үүсгэх**: `theme/blocks/{block-name}/` хавтсыг үүсгэх.
2. **Metadata (block.json)**:
    - `name`: `acf/{block-name}`
    - `category`: `ace-blocks`
    - **MANDATORY**: `example` section заавал байх ёстой.
    - **MANDATORY**: Tailwind ашиглах тул тусдаа CSS файл үүсгэхгүй.
3. **Template (render.php)**:
    - **MANDATORY**: Tailwind CSS utility классуудыг шууд ашиглана.
    - **MANDATORY**: `ub_get_block_example_data( $block )` ашиглан жишээ өгөгдөл унших логик оруулна.
4. **JavaScript (index.js)**:
    - Зөвхөн шаардлагатай бол үүсгэнэ.
    - `theme/inc/template-functions.php` доторх `ub_register_assets` функцад заавал бүртгэнэ.
5. **ACF Field Group**:
    - JSON тохиргоог `theme/acf-json/group_{block_name}.json` файл болгож үүсгэнэ.
6. **Editor Whitelist (CRITICAL)**:
    - **MANDATORY**: Блокыг `theme/inc/editor-settings.php` файл дахь `$acf_blocks` жагсаалтад заавал нэмнэ. Ингэхгүй бол блок редакторт харагдахгүй.
7. **Кодын чанар**:
    - `./vendor/bin/phpcbf` болон `pnpm run lint-fix` ажиллуулж кодыг цэгцэлнэ.
8. **Тест**: Блок редакторт харагдаж байгаа эсэх, болон Frontend дээр зөв ажиллаж байгааг шалгах.
