<?php declare(strict_types=1);
/**
 * Hero Registration Block Template.
 *
 * @package aceedu
 */

$ub_id         = 'hero-reg-' . $block['id'];
$ub_class_name = 'block-hero-reg alignfull relative min-h-[90vh] flex items-center overflow-hidden py-16 lg:py-0 ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_super_title   = get_field( 'super_title' );
$ub_headline      = get_field( 'headline' );
$ub_sub_headline  = get_field( 'sub_headline' );
$ub_bullets       = get_field( 'bullets' );
$ub_primary_cta   = get_field( 'primary_cta' );
$ub_secondary_cta = get_field( 'secondary_cta' );
$ub_bg_image      = get_field( 'bg_image' );
$ub_form_title    = get_field( 'form_title' ) ?: 'Үнэгүй зөвлөгөө авах';

if ( ! $ub_headline && $is_preview ) {
	echo '<div class="p-12 text-center bg-slate-100 border-2 border-dashed border-slate-300 rounded-sm">Мэдээллээ оруулна уу.</div>';
	return;
}
?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?>">
	<!-- Background Media with Overlay. -->
	<div class="absolute inset-0 z-0">
		<?php if ( $ub_bg_image ) : ?>
			<?php echo wp_get_attachment_image( $ub_bg_image['ID'], 'full', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
		<?php else : ?>
			<div class="w-full h-full bg-slate-100"></div>
		<?php endif; ?>
		<div class="absolute inset-0 bg-white/70 lg:bg-gradient-to-r lg:from-white/95 lg:to-white/40"></div>
	</div>

	<div class="container relative z-10 px-6 lg:px-12">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center">
			
			<!-- Left Column: Content -->
			<div class="max-w-2xl py-8 lg:py-24">
				<?php if ( $ub_super_title ) : ?>
					<span class="inline-block bg-primary/10 text-primary px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">
						<?php echo esc_html( (string) $ub_super_title ); ?>
					</span>
				<?php endif; ?>

				<h1 class="text-4xl lg:text-6xl font-black text-slate-950 leading-[1.1] tracking-tighter mb-6">
					<?php echo nl2br( esc_html( (string) $ub_headline ) ); ?>
				</h1>

				<p class="text-slate-600 text-lg lg:text-xl font-medium mb-10 leading-relaxed">
					<?php echo esc_html( (string) $ub_sub_headline ); ?>
				</p>

				<?php if ( $ub_bullets ) : ?>
					<ul class="space-y-4 mb-10">
						<?php foreach ( $ub_bullets as $bullet ) : ?>
							<li class="flex items-start gap-3">
								<div class="mt-1 w-5 h-5 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
									<svg class="w-3 h-3 text-primary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
								</div>
								<span class="text-slate-700 font-bold text-sm lg:text-base"><?php echo esc_html( $bullet['text'] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div class="flex flex-wrap gap-4">
					<?php if ( $ub_primary_cta ) : ?>
						<a href="<?php echo esc_url( $ub_primary_cta['url'] ); ?>" target="<?php echo esc_attr( $ub_primary_cta['target'] ); ?>" class="bg-primary text-white rounded-xs px-8 py-4 text-xs font-black shadow-xl shadow-primary/20 transition-all duration-300 hover:bg-primary/90 hover:-translate-y-1 uppercase tracking-widest">
							<?php echo esc_html( $ub_primary_cta['title'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $ub_secondary_cta ) : ?>
						<a href="<?php echo esc_url( $ub_secondary_cta['url'] ); ?>" target="<?php echo esc_attr( $ub_secondary_cta['target'] ); ?>" class="bg-transparent border-2 border-primary text-primary rounded-xs px-8 py-4 text-xs font-black transition-all duration-300 hover:bg-primary/5 hover:-translate-y-1 uppercase tracking-widest">
							<?php echo esc_html( $ub_secondary_cta['title'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Right Column: Registration Form -->
			<div class="w-full max-w-md mx-auto lg:mr-0">
				<div class="bg-white/80 backdrop-blur-xl p-8 lg:p-10 rounded-sm shadow-2xl shadow-slate-900/10 border border-white relative">
					<h3 class="text-2xl font-black text-slate-950 mb-8 border-b border-slate-100 pb-4">
						<?php echo esc_html( (string) $ub_form_title ); ?>
					</h3>

					<form id="hero-lead-form" class="space-y-4">
						<?php wp_nonce_field( 'site_lead_form_nonce', 'security' ); ?>
						<input type="hidden" name="action" value="site_submit_lead_form">
						<input type="hidden" name="lead_source_url" value="<?php echo esc_url( get_permalink() ); ?>">

						<div>
							<label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Таны нэр</label>
							<input type="text" name="lead_name" required class="w-full bg-slate-50 border border-slate-200 rounded-xs px-4 py-3 text-sm focus:outline-none focus:border-primary transition-colors" placeholder="Жишээ: Соном">
						</div>

						<div>
							<label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Утасны дугаар</label>
							<input type="tel" name="lead_phone" required class="w-full bg-slate-50 border border-slate-200 rounded-xs px-4 py-3 text-sm focus:outline-none focus:border-primary transition-colors" placeholder="Жишээ: 99XXXXXX">
						</div>

						<div>
							<label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">И-мэйл хаяг</label>
							<input type="email" name="lead_email" class="w-full bg-slate-50 border border-slate-200 rounded-xs px-4 py-3 text-sm focus:outline-none focus:border-primary transition-colors" placeholder="Жишээ: email@example.com">
						</div>

						<div>
							<label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Хөтөлбөр сонгох</label>
							<select name="lead_program" class="w-full bg-slate-50 border border-slate-200 rounded-xs px-4 py-3 text-sm focus:outline-none focus:border-primary transition-colors appearance-none">
								<option value="Language Course">Хэлний бэлтгэл</option>
								<option value="Degree Program">Их сургууль (Бакалавр/Магистр)</option>
								<option value="GKS Scholarship">GKS Тэтгэлэг</option>
								<option value="Visa Service">Визний зөвлөгөө</option>
							</select>
						</div>

						<button type="submit" class="w-full bg-primary text-white rounded-xs py-4 text-xs font-black shadow-lg shadow-primary/20 transition-all hover:bg-primary/90 uppercase tracking-widest mt-4 flex justify-center items-center gap-2">
							<span>Хүсэлт илгээх</span>
							<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
						</button>

						<div id="form-response" class="hidden mt-4 p-3 rounded-xs text-xs font-bold text-center"></div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const form = document.querySelector('#hero-lead-form');
	const responseDiv = document.querySelector('#form-response');

	if (form) {
		form.addEventListener('submit', async function(e) {
			e.preventDefault();
			
			const submitBtn = form.querySelector('button[type="submit"]');
			const originalBtnText = submitBtn.innerHTML;
			
			// Loading state
			submitBtn.disabled = true;
			submitBtn.innerHTML = 'Түр хүлээнэ үү...';
			responseDiv.className = 'hidden mt-4 p-3 rounded-xs text-xs font-bold text-center';

			const formData = new FormData(form);

			try {
				const response = await fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
					method: 'POST',
					body: formData
				});
				const result = await response.json();

				if (result.success) {
					responseDiv.textContent = result.data.message;
					responseDiv.className = 'mt-4 p-3 rounded-xs text-xs font-bold text-center bg-green-50 text-green-600 block';
					form.reset();
				} else {
					responseDiv.textContent = result.data.message;
					responseDiv.className = 'mt-4 p-3 rounded-xs text-xs font-bold text-center bg-red-50 text-red-600 block';
				}
			} catch (error) {
				responseDiv.textContent = 'Алдаа гарлаа. Та дахин оролдоно уу.';
				responseDiv.className = 'mt-4 p-3 rounded-xs text-xs font-bold text-center bg-red-50 text-red-600 block';
			} finally {
				submitBtn.disabled = false;
				submitBtn.innerHTML = originalBtnText;
			}
		});
	}
});
</script>
