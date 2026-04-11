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

<section id="<?php echo esc_attr( $ub_id ); ?>" class="<?php echo esc_attr( $ub_class_name ); ?> bg-white py-16 lg:py-24">
	<div class="container">
		<div class="mb-16">
			<h1 class="mb-4 text-4xl font-black tracking-tighter text-slate-900 lg:text-6xl">Design System</h1>
			<p class="max-w-2xl text-lg text-slate-500">ACE EDU вэбсайтын дизайны стандартууд болон компонентүүдийн жагсаалт.</p>
		</div>

		<?php if ( $ub_show_colors ) : ?>
			<div class="mb-20">
				<h2 class="mb-8 border-b border-slate-100 pb-4 text-2xl font-bold">Colors</h2>
				<div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-5">
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
							<div class="<?php echo esc_attr( $ub_color['class'] ); ?> aspect-square w-full rounded-sm shadow-sm"></div>
							<div>
								<p class="text-sm font-bold"><?php echo esc_html( $ub_color['name'] ); ?></p>
								<p class="font-mono text-xs text-slate-400 uppercase"><?php echo esc_html( $ub_color['hex'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_typography ) : ?>
			<div class="mb-20">
				<h2 class="mb-8 border-b border-slate-100 pb-4 text-2xl font-bold">Typography</h2>
				<div class="flex flex-col gap-12">
					<div class="grid grid-cols-1 items-start gap-8 md:grid-cols-3">
						<div class="md:col-span-1">
							<p class="text-xs font-bold text-slate-400 uppercase">Hero Title (h1)</p>
							<p class="text-xs text-slate-400">4xl / 6xl font-black</p>
						</div>
						<div class="md:col-span-2">
							<h1 class="text-4xl leading-tight font-black tracking-tighter text-slate-900 lg:text-6xl">ACE EDU World: Education for Everyone</h1>
						</div>
					</div>

					<div class="grid grid-cols-1 items-start gap-8 md:grid-cols-3">
						<div class="md:col-span-1">
							<p class="text-xs font-bold text-slate-400 uppercase">Section Title (h2)</p>
							<p class="text-xs text-slate-400">2xl / 3xl font-bold</p>
						</div>
						<div class="md:col-span-2">
							<h2 class="text-2xl leading-tight font-bold tracking-tight text-slate-900 lg:text-3xl">Бидний хэрэгжүүлж буй хөтөлбөрүүд</h2>
						</div>
					</div>

					<div class="grid grid-cols-1 items-start gap-8 md:grid-cols-3">
						<div class="md:col-span-1">
							<p class="text-xs font-bold text-slate-400 uppercase">Body Large</p>
							<p class="text-xs text-slate-400">text-lg font-medium</p>
						</div>
						<div class="md:col-span-2">
							<p class="text-lg leading-relaxed font-medium text-slate-600">ACE EDU төв нь 10 гаруй жилийн турш гадаадад суралцах хүсэлтэй залуусыг дэмжин ажиллаж байна.</p>
						</div>
					</div>

					<div class="grid grid-cols-1 items-start gap-8 md:grid-cols-3">
						<div class="md:col-span-1">
							<p class="text-xs font-bold text-slate-400 uppercase">Body Standard</p>
							<p class="text-xs text-slate-400">text-base font-normal</p>
						</div>
						<div class="md:col-span-2">
							<p class="text-base leading-relaxed text-slate-500">Гүйцэтгэх үндсэн чиг үүргийн хүрээнд оюутан залууст зөвлөгөө өгөх, сургууль болон визний материалыг бүрдүүлэх зэрэг цогц үйлчилгээг үзүүлдэг.</p>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_buttons ) : ?>
			<div class="mb-20">
				<h2 class="mb-8 border-b border-slate-100 pb-4 text-2xl font-bold">Buttons</h2>
				<div class="flex flex-wrap items-end gap-8">
					<!-- Primary Button (Blue) -->
					<div class="flex flex-col gap-4">
						<p class="text-xs font-bold text-slate-400 uppercase">Primary (Blue)</p>
						<a href="#" class="inline-flex items-center rounded-xs bg-primary px-4 py-2 text-xs font-bold text-white uppercase no-underline shadow-lg shadow-primary/20 transition-all duration-300 hover:bg-primary-dark">
							Холбоо барих
							<svg class="ml-2 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
						</a>
					</div>

					<!-- Ghost / White Button -->
					<div class="flex flex-col gap-4">
						<p class="text-xs font-bold text-slate-400 uppercase">White / Shadow</p>
						<a href="#" class="inline-flex min-w-[140px] items-center justify-center rounded-xs border border-white bg-white px-6 py-2 font-bold text-primary no-underline shadow-xl shadow-black/5 transition-all duration-300 hover:bg-slate-100">
							<span class="text-xs leading-none text-primary uppercase">Чат бичих</span>
						</a>
					</div>

					<!-- Outline Button -->
					<div class="flex flex-col gap-4 rounded-sm bg-primary p-6">
						<p class="text-xs font-bold text-white/50 uppercase">Outline (Dark BG)</p>
						<a href="#" class="inline-flex min-w-[140px] items-center justify-center rounded-xs border-2 border-white/30 bg-transparent px-6 py-2 font-bold text-white no-underline transition-all duration-300 hover:bg-white/10">
							<span class="text-xs leading-none text-white uppercase">8800-****</span>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $ub_show_cards ) : ?>
			<div class="mb-20">
				<h2 class="mb-8 border-b border-slate-100 pb-4 text-2xl font-bold">Cards</h2>
				<div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
					<!-- Example Card -->
					<div class="flex h-full flex-col overflow-hidden rounded-sm border border-slate-100 bg-white shadow-sm transition-all hover:shadow-md">
						<div class="aspect-video bg-slate-200"></div>
						<div class="p-6">
							<div class="mb-2 text-[0.65rem] font-bold text-primary uppercase">Зөвлөгөө</div>
							<h3 class="mb-4 text-lg leading-tight font-bold">Солонгос улсад хэрхэн тэтгэлэгтэй суралцах вэ?</h3>
							<div class="mt-auto flex items-center justify-between border-t border-slate-50 pt-4 text-xs font-bold text-slate-400 uppercase">
								<span>Дэлгэрэнгүй</span>
								<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
