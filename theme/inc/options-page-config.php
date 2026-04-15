<?php
/**
 * Global Options Page and Settings
 *
 * @package aceedu
 */

if ( function_exists( 'acf_add_options_page' ) ) {

	// Register top level options page
	acf_add_options_page(
		array(
			'page_title' => 'Сайтын тохиргоо',
			'menu_title' => 'Сайтын тохиргоо',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-generic',
		)
	);

	// Add School Archive settings group
	add_action( 'acf/init', 'ub_register_options_fields' );
}

function ub_register_options_fields() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {

		acf_add_local_field_group(
			array(
				'key'      => 'group_school_archive_settings',
				'title'    => 'Сургуулиуд хуудасны тохиргоо',
				'fields'   => array(
					array(
						'key'           => 'field_school_archive_title',
						'label'         => 'Гарчиг',
						'name'          => 'school_archive_title',
						'type'          => 'text',
						'instructions'  => 'Сургуулиудын жагсаалт хуудасны үндсэн гарчиг (жишээ: Сургуулиуд)',
						'default_value' => 'Сургуулиуд',
					),
					array(
						'key'           => 'field_school_archive_description',
						'label'         => 'Тайлбар',
						'name'          => 'school_archive_description',
						'type'          => 'textarea',
						'instructions'  => 'Гарчгийн доор харагдах богино тайлбар текст',
						'rows'          => 3,
						'default_value' => 'БНСУ-ын шилдэг Их Дээд Сургуулиудын нэгдсэн мэдээлэл.',
					),
					array(
						'key'           => 'field_school_archive_bg',
						'label'         => 'Header Background Image',
						'name'          => 'school_archive_bg',
						'type'          => 'image',
						'instructions'  => 'Хуудасны дээд хэсэгт харагдах дэвсгэр зураг',
						'return_format' => 'id',
						'preview_size'  => 'medium',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'theme-general-settings',
						),
					),
				),
			)
		);
	}
}
