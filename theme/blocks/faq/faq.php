<?php
/**
 * FAQ Block Template.
 */

$id       = 'faq-' . $block['id'];
$title    = get_field( 'title' ) ?: 'Түгээмэл асуулт хариулт';
$category = get_field( 'category' ); // Taxonomy term ID

$args = array(
	'post_type'      => 'faq',
	'posts_per_page' => -1,
);

if ( $category ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'faq_category',
			'field'    => 'term_id',
			'terms'    => $category,
		),
	);
}

$query = new WP_Query( $args );

?>

<section id="<?php echo esc_attr( $id ); ?>" class="py-20 bg-white">
	<div class="container max-w-4xl">
		<div class="text-center mb-12">
			<h2 class="text-3xl font-bold text-neutral-900"><?php echo esc_html( $title ); ?></h2>
		</div>

		<div class="space-y-4">
			<?php if ( $query->have_posts() ) : ?>
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<details class="group bg-neutral-50 rounded-xl border border-neutral-200 overflow-hidden transition-all duration-300">
						<summary class="flex items-center justify-between p-6 cursor-pointer list-none font-bold text-lg text-neutral-900 focus:outline-none">
							<span><?php the_title(); ?></span>
							<span class="ml-4 transition-transform duration-300 group-open:rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="WaitMsBeforeAsync:0 19l-7-7 7-7" />
								</svg>
							</span>
						</summary>
						<div class="px-6 pb-6 text-neutral-600 prose prose-neutral max-w-none">
							<?php the_content(); ?>
						</div>
					</details>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<p class="text-center text-neutral-500">Асуулт олдсонгүй.</p>
			<?php endif; ?>
		</div>
	</div>
</section>
