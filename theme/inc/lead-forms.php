<?php declare(strict_types=1);
/**
 * Lead Form Handler
 *
 * Processes AJAX submissions for the Hero Registration block.
 *
 * @package aceedu
 */

/**
 * Handle Lead Form AJAX submission.
 */
function site_handle_lead_form_submission() {
	// 1. Security check (Nonce).
	check_ajax_referer( 'site_lead_form_nonce', 'security' );

	// 2. Sanitize and validate inputs.
	$name    = sanitize_text_field( $_POST['lead_name'] ?? '' );
	$phone   = sanitize_text_field( $_POST['lead_phone'] ?? '' );
	$email   = sanitize_email( $_POST['lead_email'] ?? '' );
	$program = sanitize_text_field( $_POST['lead_program'] ?? '' );
	$source  = sanitize_text_field( $_POST['lead_source_url'] ?? home_url() );

	if ( empty( $name ) || empty( $phone ) ) {
		wp_send_json_error( array( 'message' => 'Нэр болон утасны дугаараа оруулна уу.' ) );
	}

	// 3. Prepare email content.
	$to      = get_option( 'admin_email' ); // Send to admin by default.
	$subject = 'Шинэ хүсэлт: ' . $name . ' (Hero Registration)';
	$body    = "Танд шинэ хүсэлт ирлээ:\n\n" .
				"Нэр: $name\n" .
				"Утас: $phone\n" .
				"И-мэйл: $email\n" .
				"Сонгосон хөтөлбөр: $program\n" .
				"Ирсэн хуудас: $source\n\n" .
				'Төслийн нэр: ACE EDU WORLD';
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	// 4. Send email.
	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success( array( 'message' => 'Таны хүсэлтийг хүлээн авлаа. Бид тун удахгүй холбогдох болно.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'И-мэйл илгээхэд алдаа гарлаа. Та дахин оролдоно уу.' ) );
	}

	wp_die();
}
add_action( 'wp_ajax_site_submit_lead_form', 'site_handle_lead_form_submission' );
add_action( 'wp_ajax_nopriv_site_submit_lead_form', 'site_handle_lead_form_submission' );
