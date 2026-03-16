<?php
/**
 * Feature Grid Block Template.
 */

$id = 'feature-grid-' . $block['id'];
$title    = get_field( 'title' );
$subtitle = get_field( 'subtitle' );
$items    = get_field( 'items' );
$columns  = get_field( 'columns' ) ?: '3';

$grid_cols = array(
    '2' => 'md:grid-cols-2',
    '3' => 'md:grid-cols-2 lg:grid-cols-3',
    '4' => 'md:grid-cols-2 lg:grid-cols-4',
);

$cols_class = isset( $grid_cols[$columns] ) ? $grid_cols[$columns] : $grid_cols['3'];

?>

<section id="<?php echo esc_attr( $id ); ?>" class="py-20 bg-white">
    <div class="container mx-auto px-4 text-center">
        <?php if ( $title || $subtitle ) : ?>
            <div class="max-w-3xl mx-auto mb-16">
                <?php if ( $title ) : ?>
                    <h2 class="text-3xl md:text-5xl font-black text-neutral-900 mb-6"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $subtitle ) : ?>
                    <p class="text-xl text-neutral-500"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 <?php echo esc_attr( $cols_class ); ?> gap-8">
            <?php if ( $items ) : ?>
                <?php foreach ( $items as $item ) : ?>
                    <div class="group p-10 bg-neutral-50 rounded-[2rem] border border-neutral-100 hover:border-primary/20 hover:bg-primary/5 transition-all duration-300 flex flex-col items-center">
                        <div class="w-20 h-20 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300 mb-8">
                            <?php if ( $item['image'] ) : ?>
                                <?php echo wp_get_attachment_image( $item['image'], 'thumbnail', false, array( 'class' => 'w-10 h-10 object-contain' ) ); ?>
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-4"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="text-neutral-600 leading-relaxed"><?php echo esc_html( $item['description'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Placeholder items -->
                <?php for($i=1; $i<=3; $i++) : ?>
                     <div class="p-10 bg-neutral-50 rounded-[2rem] border border-neutral-100 flex flex-col items-center">
                        <div class="w-20 h-20 bg-white rounded-2xl mb-8"></div>
                        <h3 class="text-2xl font-bold text-neutral-900 mb-4">Жишээ гарчиг</h3>
                        <p class="text-neutral-600">Энд тайлбар текстээ оруулна уу.</p>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
