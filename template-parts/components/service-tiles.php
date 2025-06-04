<?php
$args = array(
    'post_type'      => 'dienst',
    'posts_per_page' => -1
);
$services = new WP_Query($args);

$snelTitle = get_sub_field('snellink_titel');
$snelDesc = get_sub_field('snellink_omschrijving');
$snelImage = get_sub_field('snellink_afbeelding');
?>

<section class="uk-section uk-padding-large uk-padding-remove-bottom c-services-intro">
    <div class="uk-container uk-container-large">
        <div class="hi uk-child-width-1-1 uk-child-width-1-2@m uk-grid-collapse <?= !$snelImage ? 'uk-flex uk-flex-middle uk-flex-center' : '' ?>" uk-grid>
            <div class="uk-first-column <?= !$snelImage ? 'uk-width-1-1' : '' ?>" <?= !$snelImage ? 'style="max-width: 700px;"' : '' ?>>
                <div class="<?= $snelImage ? 'uk-width-2-3@l uk-align-right' : 'uk-width-1-1 uk-text-center' ?>" <?= !$snelImage ? 'style="max-width: 700px;"' : '' ?>>
                    <h2><?= $snelTitle ?></h2>
                    <?= $snelDesc; ?>
                </div>
            </div>
            <?php if ($snelImage) : ?>
                <div class="uk-visible@m" style="height: 400px;">
                    <img src="<?= esc_url($snelImage['url']) ?>" 
                         alt="<?= esc_attr($snelImage['alt']) ?>" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if ($services->have_posts()) : 
    // Create array to store posts with their positions
    $sorted_posts = array();
    $unpositioned_posts = array();

    while ($services->have_posts()) : $services->the_post();
        $position = get_field('dienst_positie');
        
        if (!empty($position)) {
            $sorted_posts[$position] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'dienst_icoon' => get_field('dienst_icoon'),
                'dienst_afbeelding' => get_field('dienst_afbeelding')
            );
        } else {
            $unpositioned_posts[] = array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'dienst_icoon' => get_field('dienst_icoon'),
                'dienst_afbeelding' => get_field('dienst_afbeelding')
            );
        }
    endwhile;

    // Sort positioned posts
    ksort($sorted_posts);
?>
    <section class="uk-section uk-padding-medium c-service-grid">
        <div class="uk-container uk-container-medium">
            <div class="uk-grid-medium uk-flex-center uk-child-width-1-2 uk-child-width-1-4@m"
                uk-grid
                uk-scrollspy="target: > div; cls: uk-animation-scale-down; delay: 300">
                <?php
                // Output positioned posts first
                foreach ($sorted_posts as $post) : ?>
                    <div>
                        <a href="<?php echo esc_url($post['permalink']); ?>" class="c-item">
                            <div class="uk-position-center c-content">
                                <?php if (!empty($post['dienst_icoon']['sizes']['medium_large'])) : ?>
                                    <span style="background-image:url('<?php echo esc_url($post['dienst_icoon']['sizes']['medium_large']); ?>')" uk-image></span>
                                <?php endif; ?>
                                <p><?php echo esc_html($post['title']); ?></p>
                            </div>
                            <?php if (!empty($post['dienst_afbeelding']['sizes']['medium_large'])) : ?>
                                <div class="c-bg" style="background-image:url('<?php echo esc_url($post['dienst_afbeelding']['sizes']['medium_large']); ?>')" uk-image></div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach;

                // Output unpositioned posts after
                foreach ($unpositioned_posts as $post) : ?>
                    <div>
                        <a href="<?php echo esc_url($post['permalink']); ?>" class="c-item">
                            <div class="uk-position-center c-content">
                                <?php if (!empty($post['dienst_icoon']['sizes']['medium_large'])) : ?>
                                    <span style="background-image:url('<?php echo esc_url($post['dienst_icoon']['sizes']['medium_large']); ?>')" uk-image></span>
                                <?php endif; ?>
                                <p><?php echo esc_html($post['title']); ?></p>
                            </div>
                            <?php if (!empty($post['dienst_afbeelding']['sizes']['medium_large'])) : ?>
                                <div class="c-bg" style="background-image:url('<?php echo esc_url($post['dienst_afbeelding']['sizes']['medium_large']); ?>')" uk-image></div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php
endif;

wp_reset_postdata();
?>