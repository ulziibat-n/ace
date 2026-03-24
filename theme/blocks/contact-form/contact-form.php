<?php
/**
 * Contact Form Block Template.
 */

$id        = 'contact-form-' . $block['id'];
$title     = get_field( 'title' ) ?: 'Өөрийн Солонгосын замналын талаар ярилцъя.';
$subtitle  = get_field( 'subtitle' ) ?: 'Доорх мэдээллээ үлдээвэл ACE-ийн зөвлөх 24 цагийн дотор холбогдоно.';
$form_type = get_field( 'form_type' ) ?: 'consultation';

?>

<section id="<?php echo esc_attr( $id ); ?>" class="py-20 bg-neutral-50 relative overflow-hidden">
	<div class="container relative z-10">
		<div class="max-w-5xl mx-auto bg-white rounded-[3rem] shadow-2xl shadow-primary/5 overflow-hidden flex flex-col md:flex-row">
			
			<!-- Left Info Side -->
			<div class="md:w-2/5 bg-primary p-12 text-white flex flex-col justify-between">
				<div>
					<h2 class="text-3xl md:text-4xl font-black mb-6 leading-tight"><?php echo esc_html( $title ); ?></h2>
					<p class="text-white/70 mb-8"><?php echo esc_html( $subtitle ); ?></p>
				</div>

				<div class="space-y-6">
					<div class="flex items-center gap-4">
						<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">✓</div>
						<span class="text-sm font-bold">Үнэгүй зөвлөгөө</span>
					</div>
					<div class="flex items-center gap-4">
						<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">✓</div>
						<span class="text-sm font-bold">1:1 Хувийн төлөвлөгөө</span>
					</div>
					<div class="flex items-center gap-4">
						<div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">✓</div>
						<span class="text-sm font-bold">24 цагт хариу өгөх</span>
					</div>
				</div>
			</div>

			<!-- Right Form Side -->
			<div class="md:w-3/5 p-12">
				<form action="#" class="space-y-6">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div class="space-y-2">
							<label class="text-sm font-bold text-neutral-900 uppercase tracking-wider">Нэр</label>
							<input type="text" class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 focus:outline-none focus:border-primary transition-colors" placeholder="Таны нэр...">
						</div>
						<div class="space-y-2">
							<label class="text-sm font-bold text-neutral-900 uppercase tracking-wider">Утас</label>
							<input type="tel" class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 focus:outline-none focus:border-primary transition-colors" placeholder="+976...">
						</div>
					</div>

					<div class="space-y-2">
						<label class="text-sm font-bold text-neutral-900 uppercase tracking-wider">Одоогийн боловсролын түвшин</label>
						<select class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 focus:outline-none focus:border-primary transition-colors">
							<option>11-р анги</option>
							<option>12-р анги</option>
							<option>Бакалавр</option>
							<option>Магистр</option>
							<option>Бусад</option>
						</select>
					</div>

					<div class="space-y-2">
						<label class="text-sm font-bold text-neutral-900 uppercase tracking-wider">Мессеж (Optional)</label>
						<textarea rows="4" class="w-full bg-neutral-50 border border-neutral-200 rounded-xl px-4 py-3 focus:outline-none focus:border-primary transition-colors" placeholder="Таны асуухыг хүссэн зүйл..."></textarea>
					</div>

					<button type="submit" class="w-full bg-secondary hover:bg-neutral-900 text-white font-black py-5 rounded-2xl transition-all duration-300 transform hover:scale-[1.02] shadow-xl shadow-secondary/20 uppercase tracking-widest">
						Зөвлөгөөний цаг товлох
					</button>
					
					<p class="text-[10px] text-neutral-400 text-center uppercase tracking-wider">
						Таны мэдээллийг зөвхөн зөвлөгөө өгөх зорилгоор ашиглана.
					</p>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Decorative background elements -->
	<div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 -skew-x-12 translate-x-1/2"></div>
</section>
