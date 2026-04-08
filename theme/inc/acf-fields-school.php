<?php
/**
 * Сургууль (School) CPT-д зориулсан ACF талбаруудыг бүртгэх файл.
 * Бүх талбарууд дэлгэрэнгүй тайлбартай ба WYSIWYG редактор хязгаарлагдсан.
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group( array(
		'key' => 'group_school_general',
		'title' => 'Ерөнхий мэдээлэл',
		'fields' => array(
			array(
				'key' => 'field_school_name_en',
				'label' => 'Сургуулийн нэр (EN)',
				'name' => 'school_name_en',
				'type' => 'text',
				'required' => 1,
				'instructions' => 'Сургуулийн албан ёсны англи нэр (жишээ: Yonsei University)',
			),
			array(
				'key' => 'field_school_name_ko',
				'label' => 'Сургуулийн нэр (KO)',
				'name' => 'school_name_ko',
				'type' => 'text',
				'instructions' => 'Сургуулийн солонгос нэр (жишээ: 연세대학교)',
			),
			array(
				'key' => 'field_short_intro',
				'label' => 'Богино танилцуулга',
				'name' => 'short_intro',
				'type' => 'textarea',
				'instructions' => 'Жагсаалт болон карт дээр харагдах 2-3 өгүүлбэр бүхий товч танилцуулга',
				'rows' => 3,
			),
			array(
				'key' => 'field_hero_title',
				'label' => 'Hero гарчиг',
				'name' => 'hero_title',
				'type' => 'text',
				'instructions' => 'Сургуулийн дэлгэрэнгүй хуудасны дээд хэсэгт харагдах том гарчиг',
			),
			array(
				'key' => 'field_hero_subtitle',
				'label' => 'Hero дэд гарчиг',
				'name' => 'hero_subtitle',
				'type' => 'textarea',
				'rows' => 2,
				'instructions' => 'Гарчгийн доор харагдах нэмэлт тайлбар текст',
			),
			array(
				'key' => 'field_official_website',
				'label' => 'Албан ёсны вэбсайт',
				'name' => 'official_website',
				'type' => 'url',
				'instructions' => 'Сургуулийн албан ёсны вэб хуудасны хаяг (http://...)',
			),
			array(
				'key' => 'field_brochure_url',
				'label' => 'Брошур линк',
				'name' => 'brochure_url',
				'type' => 'url',
				'instructions' => 'Танилцуулга брошур эсвэл PDF файлын хаяг',
			),
			array(
				'key' => 'field_school_logo',
				'label' => 'Лого',
				'name' => 'logo',
				'type' => 'image',
				'return_format' => 'id',
				'instructions' => 'Сургуулийн лого (PNG эсвэл SVG форматтай, тунгалаг дэвсгэртэй бол сайн)',
			),
			array(
				'key' => 'field_hero_image',
				'label' => 'Hero зураг',
				'name' => 'hero_image',
				'type' => 'image',
				'return_format' => 'id',
				'instructions' => 'Хуудасны дээд хэсэгт харагдах гол дэвсгэр зураг',
			),
			array(
				'key' => 'field_is_featured',
				'label' => 'Онцлох эсэх?',
				'name' => 'is_featured',
				'type' => 'true_false',
				'ui' => 1,
				'instructions' => 'Хэрэв идэвхжүүлбэл нүүр хуудас болон жагсаалтын эхэнд онцгойлж харагдана',
			),
			array(
				'key' => 'field_school_gallery',
				'label' => 'Сургуулийн зургийн сан',
				'name' => 'school_gallery',
				'type' => 'gallery',
				'return_format' => 'id',
				'instructions' => 'Сургуулийн орчин, хичээлийн байр зэргийг харуулсан зургууд',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 0,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_school_classification',
		'title' => 'Ангилал & Хурдан мэдээлэл',
		'fields' => array(
			array(
				'key' => 'field_accreditation_status',
				'label' => 'Магадлан итгэмжлэл',
				'name' => 'accreditation_status',
				'type' => 'select',
				'instructions' => 'Сургуулийн Солонгос улсын боловсролын яамнаас олгосон магадлан итгэмжлэлийн статус',
				'choices' => array(
					'certified' => 'Магадлан итгэмжлэгдсэн',
					'excellent' => 'Шилдэг магадлан итгэмжлэгдсэн',
					'none' => 'Байхгүй',
				),
			),
			array(
				'key' => 'field_visa_note',
				'label' => 'Визаны тэмдэглэл',
				'name' => 'visa_note',
				'type' => 'text',
				'instructions' => 'Визатай холбоотой онцлох мэдээлэл (жишээ: 100% виза олголт)',
			),
			array(
				'key' => 'field_visa_success_rate_text',
				'label' => 'Виза амжилтын хувь',
				'name' => 'visa_success_rate_text',
				'type' => 'text',
				'instructions' => 'Сүүлийн үеийн виза гаралтын статистик (жишээ: 98.5%)',
			),
			array(
				'key' => 'field_ranking_korea',
				'label' => 'Солонгос дахь эрэмбэ',
				'name' => 'ranking_korea_text',
				'type' => 'text',
				'instructions' => 'Солонгосын их дээд сургуулиудын доторх эрэмбэ (жишээ: Top 10)',
			),
			array(
				'key' => 'field_ranking_global',
				'label' => 'Дэлхийн эрэмбэ',
				'name' => 'ranking_global_text',
				'type' => 'text',
				'instructions' => 'QS эсвэл бусад дэлхийн үнэлгээний эрэмбэ',
			),
			array(
				'key' => 'field_key_badges',
				'label' => 'Оноо / Бэжүүд',
				'name' => 'key_badges',
				'type' => 'repeater',
				'instructions' => 'Картан дээр харагдах жижиг онцлох тэмдэглэгээнүүд',
				'sub_fields' => array(
					array(
						'key' => 'field_badge_text',
						'label' => 'Текст',
						'name' => 'text',
						'type' => 'text',
					),
				),
				'layout' => 'table',
				'button_label' => 'Бэж нэмэх',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 10,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_school_admissions',
		'title' => 'Элсэлт',
		'fields' => array(
			array(
				'key' => 'field_intake_months',
				'label' => 'Элсэлтийн сарууд',
				'name' => 'intake_months',
				'type' => 'checkbox',
				'instructions' => 'Жишээ: Жилд 4 удаа элсэлт авдаг бол бүгдийг сонгоно',
				'choices' => array(
					'3' => '3 сар',
					'6' => '6 сар',
					'9' => '9 сар',
					'12' => '12 сар',
				),
			),
			array(
				'key' => 'field_degree_levels',
				'label' => 'Боловсролын зэрэг',
				'name' => 'degree_levels',
				'type' => 'checkbox',
				'instructions' => 'Энэ сургуульд боломжтой сургалтын шатлалууд',
				'choices' => array(
					'language' => 'Хэлний бэлтгэл',
					'bachelor' => 'Бакалавр',
					'master' => 'Магистр',
					'phd' => 'Доктор',
				),
			),
			array(
				'key' => 'field_topik_requirement',
				'label' => 'TOPIK шаардлага',
				'name' => 'topik_requirement',
				'type' => 'text',
				'instructions' => 'Элсэлтэд шаардагдах Солонгос хэлний оноо (жишээ: 3-р түвшин)',
			),
			array(
				'key' => 'field_english_requirement',
				'label' => 'Англи хэлний шаардлага',
				'name' => 'english_requirement',
				'type' => 'text',
				'instructions' => 'Элсэлтэд шаардагдах Англи хэлний оноо (жишээ: IELTS 5.5)',
			),
			array(
				'key' => 'field_evisa_available',
				'label' => 'E-Visa боломжтой эсэх',
				'name' => 'evisa_available',
				'type' => 'true_false',
				'ui' => 1,
				'instructions' => 'Цахим виза мэдүүлэх боломжтой эсэх',
			),
			array(
				'key' => 'field_application_notes',
				'label' => 'Элсэлтийн тэмдэглэл',
				'name' => 'application_notes',
				'type' => 'wysiwyg',
				'instructions' => 'Элсэлтийн явц, бүрдүүлэх материалтай холбоотой нэмэлт заавар',
				'toolbar' => 'basic',
				'tabs' => 'visual',
				'media_upload' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 20,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_school_tuition',
		'title' => 'Төлбөр & Тусламж',
		'fields' => array(
			array(
				'key' => 'field_tuition_language',
				'label' => 'Хэлний бэлтгэлийн төлбөр',
				'name' => 'tuition_language_course',
				'type' => 'text',
				'instructions' => 'Ойролцоогоор нэг улирлын төлбөр (жишээ: 1,200,000 ₩)',
			),
			array(
				'key' => 'field_tuition_undergrad',
				'label' => 'Бакалаврын төлбөр',
				'name' => 'tuition_undergraduate',
				'type' => 'text',
				'instructions' => 'Ойролцоогоор нэг семестрийн төлбөр (жишээ: 4,500,000 ₩)',
			),
			array(
				'key' => 'field_scholarship_info',
				'label' => 'Тэтгэлэгийн мэдээлэл',
				'name' => 'scholarship_info',
				'type' => 'wysiwyg',
				'instructions' => 'Тэтгэлэг болон хөнгөлөлтийн ерөнхий тайлбар',
				'toolbar' => 'basic',
				'tabs' => 'visual',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_dormitory_info',
				'label' => 'Дотуур байрны мэдээлэл',
				'name' => 'dormitory_info',
				'type' => 'wysiwyg',
				'instructions' => 'Дотуур байрны нөхцөл, өрөөний сонголтын тайлбар',
				'toolbar' => 'basic',
				'tabs' => 'visual',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_meal_fee',
				'label' => 'Хоолны төлбөр',
				'name' => 'meal_fee',
				'type' => 'text',
				'instructions' => 'Сургуулийн гуанзны нэг удаагийн хоолны дундаж төлбөр',
			),
			array(
				'key' => 'field_dormitory_fee',
				'label' => 'Дотуур байрны төлбөр',
				'name' => 'dormitory_fee',
				'type' => 'text',
				'instructions' => 'Сар эсвэл улирлын төлбөр (жишээ: 350,000 ₩ / сар)',
			),
			array(
				'key' => 'field_dormitory_gallery',
				'label' => 'Дотуур байрны зургийн сан',
				'name' => 'dormitory_gallery',
				'type' => 'gallery',
				'return_format' => 'id',
				'instructions' => 'Дотуур байрны орчин, өрөөний зургууд',
			),
			array(
				'key' => 'field_scholarships_list',
				'label' => 'Тэтгэлэгийн нөхцөлүүд',
				'name' => 'scholarships_list',
				'type' => 'repeater',
				'instructions' => 'Тэтгэлэг авах боломжтой нөхцөлүүдийг хүснэгт хэлбэрээр оруулна',
				'sub_fields' => array(
					array(
						'key' => 'field_sch_condition',
						'label' => 'Нөхцөл',
						'name' => 'condition',
						'type' => 'text',
						'instructions' => 'Жишээ: TOPIK 3 буюу түүнээс дээш',
					),
					array(
						'key' => 'field_sch_benefit',
						'label' => 'Төлбөр / Хөнгөлөлт',
						'name' => 'benefit',
						'type' => 'text',
						'instructions' => 'Жишээ: 30 ~ 100%',
					),
				),
				'layout' => 'table',
				'button_label' => 'Нэмэх',
			),
			array(
				'key' => 'field_tuition_bachelor_list',
				'label' => 'Бакалаврын төлбөр (Мэргэжлээр)',
				'name' => 'tuition_bachelor_list',
				'type' => 'repeater',
				'instructions' => 'Мэргэжил тус бүрийн сургалтын төлбөрийг хайлт хийхэд зориулж оруулна',
				'sub_fields' => array(
					array(
						'key' => 'field_bac_dept',
						'label' => 'Тэнхим / Мэргэжил',
						'name' => 'department',
						'type' => 'text',
					),
					array(
						'key' => 'field_bac_fee',
						'label' => 'Төлбөр',
						'name' => 'fee',
						'type' => 'text',
					),
				),
				'layout' => 'table',
				'button_label' => 'Мэргэжил нэмэх',
			),
			array(
				'key' => 'field_tuition_master_list',
				'label' => 'Магистр / Докторын төлбөр (Мэргэжлээр)',
				'name' => 'tuition_master_list',
				'type' => 'repeater',
				'instructions' => 'Мастер / Докторын мэргэжил тус бүрийн төлбөр',
				'sub_fields' => array(
					array(
						'key' => 'field_mas_dept',
						'label' => 'Тэнхим / Мэргэжил',
						'name' => 'department',
						'type' => 'text',
					),
					array(
						'key' => 'field_mas_fee',
						'label' => 'Төлбөр',
						'name' => 'fee',
						'type' => 'text',
					),
				),
				'layout' => 'table',
				'button_label' => 'Мэргэжил нэмэх',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 30,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_school_content',
		'title' => 'Дэлгэрэнгүй контент',
		'fields' => array(
			array(
				'key' => 'field_why_choose',
				'label' => 'Яагаад энэ сургуулийг сонгох вэ?',
				'name' => 'why_choose_this_school',
				'type' => 'wysiwyg',
				'instructions' => 'Сургуулийн гол давуу тал, онцлогийн тухай дэлгэрэнгүй эх бичвэр',
				'toolbar' => 'basic',
				'tabs' => 'visual',
				'media_upload' => 0,
			),
			array(
				'key' => 'field_strengths',
				'label' => 'Давуу талууд',
				'name' => 'strengths_repeater',
				'type' => 'repeater',
				'instructions' => 'Симбол бүхий богино давуу талуудын жагсаалт',
				'sub_fields' => array(
					array(
						'key' => 'field_strength_title',
						'label' => 'Гарчиг',
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_strength_desc',
						'label' => 'Тайлбар',
						'name' => 'description',
						'type' => 'textarea',
						'rows' => 2,
					),
				),
				'layout' => 'block',
			),
			array(
				'key' => 'field_faq',
				'label' => 'Түгээмэл асуултууд',
				'name' => 'faq_repeater',
				'type' => 'repeater',
				'instructions' => 'Сургуультай холбоотой түгээмэл асуулт, хариултууд',
				'sub_fields' => array(
					array(
						'key' => 'field_faq_q',
						'label' => 'Асуулт',
						'name' => 'question',
						'type' => 'text',
					),
					array(
						'key' => 'field_faq_a',
						'label' => 'Хариулт',
						'name' => 'answer',
						'type' => 'textarea',
						'rows' => 3,
						'instructions' => 'Ойлгомжтой товч хариулт',
					),
				),
				'layout' => 'row',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 40,
	) );

	acf_add_local_field_group( array(
		'key' => 'group_school_cta',
		'title' => 'Холбоо барих / CTA',
		'fields' => array(
			array(
				'key' => 'field_cta_title',
				'label' => 'CTA Гарчиг',
				'name' => 'inquiry_cta_title',
				'type' => 'text',
				'default_value' => 'Сургуулиа сонгоход тань тусламж хэрэгтэй байна уу?',
				'instructions' => 'Хуудасны доод хэсэгт харагдах зөвлөгөө авах хэсгийн гарчиг',
			),
			array(
				'key' => 'field_cta_text',
				'label' => 'CTA Текст',
				'name' => 'inquiry_cta_text',
				'type' => 'textarea',
				'rows' => 2,
				'instructions' => 'Гарчгийн доор харагдах уриалга текст',
				'default_value' => 'Манай туршлагатай зөвлөхүүд танд хамгийн тохиромжтой хувилбарыг сонгоход туслах болно.',
			),
			array(
				'key' => 'field_messenger_link',
				'label' => 'Messenger линк',
				'name' => 'messenger_link',
				'type' => 'url',
				'instructions' => 'Facebook Messenger холбоос (жишээ: https://m.me/yourpage)',
			),
			array(
				'key' => 'field_kakao_link',
				'label' => 'KakaoTalk линк',
				'name' => 'kakao_link',
				'type' => 'url',
				'instructions' => 'KakaoTalk холбоос (жишээ: https://pf.kakao.com/... эсвэл id)',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'school',
				),
			),
		),
		'menu_order' => 50,
	) );

endif;
