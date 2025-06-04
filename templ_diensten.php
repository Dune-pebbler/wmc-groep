<?php
/* Template name: Diensten Overzicht */
get_header();

// Verkrijg het "diensten" ACF-veld (een object relationeel veld)
$diensten_ids = get_field('diensten');

// Als er geen diensten zijn geselecteerd, gebruik dan de standaard query
if (!$diensten_ids) {
    $args = array(
        'post_type' => 'dienst',
        'posts_per_page' => -1
    );
    $services = new WP_Query($args);
} else {
    // Gebruik de geselecteerde diensten in de opgegeven volgorde
    $args = array(
        'post_type' => 'dienst',
        'posts_per_page' => -1,
        'post__in' => $diensten_ids,
        'orderby' => 'post__in' // Behoud de volgorde van post__in
    );
    $services = new WP_Query($args);
}

// Haal de huidige pagina-velden op
$get_fields = get_fields();
?>

<section class="uk-section uk-padding-remove c-hero c-service">
    <div class="uk-position-bottom uk-text-center c-content">
        <h1 uk-scrollspy="cls: uk-animation-fade; delay:300"><?php the_title(); ?></h1>
    </div>
    <div class="c-bg-gradient"></div>
    <div class="c-bg-gradient c-bg-gradient-top"></div>
    <div class='c-bg'
        sources='srcset:<?php echo esc_url($get_fields['dienst_afbeelding']['sizes']['large']); ?>; media:(min-width: 640px)'
        data-src='<?php echo esc_url($get_fields['dienst_afbeelding']['sizes']['medium_large']); ?>' uk-image
        uk-parallax='bgy:-50'></div>
</section>

<section class="uk-section uk-padding-remove c-services">
    <?php
    if ($services->have_posts()):
        while ($services->have_posts()):
            $services->the_post();
            $title = get_the_title();
            $intro = get_field('dienst_summary');
            $permalink = get_permalink();
            $dienst_afbeelding = get_field('dienst_afbeelding');
            ?>
            <div class="uk-child-width-1-2@m uk-grid-collapse uk-grid" uk-grid>
                <div class="c-image"
                    style="background-image:url(<?php echo esc_url($dienst_afbeelding['sizes']['medium_large']); ?>)" uk-image>
                </div>
                <div class="c-txt">
                    <h2><?php echo esc_html($title); ?></h2>
                    <p><?php echo $intro; ?></p>
                    <a href="<?php echo esc_url($permalink); ?>" class="c-linkbtn">Meer info</a>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Geen diensten gevonden.</p>';
    endif;
    ?>
</section>

<?php get_footer(); ?>