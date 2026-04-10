<?php
/**
 * Design System block template.
 *
 * @package aceedu
 */

$ub_id         = 'design-system-' . $block['id'];
$ub_class_name = 'design-system-block alignfull ' . ( isset( $block['className'] ) ? $block['className'] : '' );

// Fields.
$ub_show_colors     = get_field( 'show_colors' ) !== false;
$ub_show_typography = get_field( 'show_typography' ) !== false;
$ub_show_buttons    = get_field( 'show_buttons' ) !== false;
$ub_show_cards      = get_field( 'show_cards' ) !== false;

?>

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> py-16 lg:py-24 bg-white">
	<div class="container">
		<div class="mb-16">
			<h1 class="text-4xl lg:text-6xl font-black tracking-tighter text-slate-900 mb-4">Design System</h1>
			<p class="text-lg text-slate-500 max-w-2xl">ACE EDU вэбсайтын дизайны стандартууд болон компонентүүдийн жагсаалт.</p>
		</div>

		<?php if ( $ub_show_colors ) : ?>
			<div class="mb-20">
				<h2 class="text-2xl font-bold mb-8 pb-4 border-b border-slate-100">Colors</h2>
				<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
					<?php
					$ub_colors = array(
						array(
							'name'  => 'Primary',
							'class' => 'bg-primary',
							'hex'   => '#085399',
						),
						array(
							'name'  => 'Secondary',
							'class' => 'bg-secondary',
							'hex'   => '#EC1B24',
						),
						array(
							'name'  => 'Slate 900',
							'class' => 'bg-slate-900',
							'hex'   => '#0F172A',
						),
						array(
							'name'  => 'Slate 500',
							'class' => 'bg-slate-500',
							'hex'   => '#64748B',
						),
						array(
							'name'  => 'Slate 100',
							'class' => 'bg-slate-100',
							'hex'   => '#F1F5F9',
						),
						array(
							'name'  => 'Slate 50',
							'class' => 'bg-slate-50',
							'hex'   => '#F8FAFC',
						),
					);
					foreach ( $ub_colors as $ub_color ) :
						?>
						<div class="flex flex-col gap-3">
							<div class="w-full aspect-square rounded-sm shadow-sm <?php echo esc_attr( $ub_color['class'] ); ?>"></div>
							<div>
								<p class="font-bold text-sm"><?php echo esc_html( $ub_color['name'] ); ?></p>
								<p class="text-xs text-slate-400 font-mono uppercase"><?php echo esc_html( $ub_color['hex'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_typography ) : ?>
			<div class="mb-20">
				<h2 class="text-2xl font-bold mb-8 pb-4 border-b border-slate-100">Typography</h2>
				<div class="flex flex-col gap-12">
					<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
						<div class="md:col-span-1">
							<p class="text-xs font-bold uppercase text-slate-400">Hero Title (h1)</p>
							<p class="text-xs text-slate-400">4xl / 6xl font-black</p>
						</div>
						<div class="md:col-span-2">
							<h1 class="text-4xl lg:text-6xl font-black tracking-tighter text-slate-900 leading-tight">ACE EDU World: Education for Everyone</h1>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
						<div class="md:col-span-1">
							<p class="text-xs font-bold uppercase text-slate-400">Section Title (h2)</p>
							<p class="text-xs text-slate-400">2xl / 3xl font-bold</p>
						</div>
						<div class="md:col-span-2">
							<h2 class="text-2xl lg:text-3xl font-bold tracking-tight text-slate-900 leading-tight">Бидний хэрэгжүүлж буй хөтөлбөрүүд</h2>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
						<div class="md:col-span-1">
							<p class="text-xs font-bold uppercase text-slate-400">Body Large</p>
							<p class="text-xs text-slate-400">text-lg font-medium</p>
						</div>
						<div class="md:col-span-2">
							<p class="text-lg font-medium text-slate-600 leading-relaxed">ACE EDU төв нь 10 гаруй жилийн турш гадаадад суралцах хүсэлтэй залуусыг дэмжин ажиллаж байна.</p>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
						<div class="md:col-span-1">
							<p class="text-xs font-bold uppercase text-slate-400">Body Standard</p>
							<p class="text-xs text-slate-400">text-base font-normal</p>
						</div>
						<div class="md:col-span-2">
							<p class="text-base text-slate-500 leading-relaxed">Гүйцэтгэх үндсэн чиг үүргийн хүрээнд оюутан залууст зөвлөгөө өгөх, сургууль болон визний материалыг бүрдүүлэх зэрэг цогц үйлчилгээг үзүүлдэг.</p>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_buttons ) : ?>
			<div class="mb-20">
				<h2 class="text-2xl font-bold mb-8 pb-4 border-b border-slate-100">Buttons</h2>
				<div class="flex flex-wrap gap-8 items-end">
					<!-- Primary Button (Blue) -->
					<div class="flex flex-col gap-4">
						<p class="text-xs font-bold uppercase text-slate-400">Primary (Blue)</p>
						<a href="#" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white shadow-lg transition-all duration-300 bg-primary hover:bg-primary-dark rounded-xs shadow-primary/20 uppercase no-underline">
							Холбоо барих
							<svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
						</a>
					</div>

					<!-- Ghost / White Button -->
					<div class="flex flex-col gap-4">
						<p class="text-xs font-bold uppercase text-slate-400">White / Shadow</p>
						<a href="#" class="inline-flex items-center justify-center bg-white text-primary px-6 py-2 rounded-xs font-bold transition-all duration-300 hover:bg-slate-100 shadow-xl shadow-black/5 no-underline border border-white min-w-[140px]">
							<span class="uppercase leading-none text-xs text-primary">Чат бичих</span>
						</a>
					</div>

					<!-- Outline Button -->
					<div class="flex flex-col gap-4 p-6 bg-primary rounded-sm">
						<p class="text-xs font-bold uppercase text-white/50">Outline (Dark BG)</p>
						<a href="#" class="inline-flex items-center justify-center bg-transparent border-2 border-white/30 text-white px-6 py-2 rounded-xs font-bold transition-all duration-300 hover:bg-white/10 no-underline min-w-[140px]">
							<span class="uppercase leading-none text-xs text-white">8800-****</span>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_cards ) : ?>
			<div class="mb-20">
				<h2 class="text-2xl font-bold mb-8 pb-4 border-b border-slate-100">Cards</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
					<!-- Example Card -->
					<div class="flex flex-col h-full bg-white rounded-sm overflow-hidden border border-slate-100 transition-all shadow-sm hover:shadow-md">
						<div class="aspect-video bg-slate-200"></div>
						<div class="p-6">
							<div class="text-[0.65rem] text-primary font-bold uppercase mb-2">Зөвлөгөө</div>
							<h3 class="text-lg font-bold mb-4 leading-tight">Солонгос улсад хэрхэн тэтгэлэгтэй суралцах вэ?</h3>
							<div class="text-xs font-bold uppercase text-slate-400 mt-auto pt-4 border-t border-slate-50 flex justify-between items-center">
								<span>Дэлгэрэнгүй</span>
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
