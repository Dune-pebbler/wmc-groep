<?php
/* Template part: Nieuws */
$get_fields = get_fields();
$image = $get_fields['afbeelding']['sizes']['large'];
$image_m = $get_fields['afbeelding']['sizes']['medium_large'];
?>

<section class="uk-section uk-padding-remove c-hero c-hero-small c-newsitem">
    <div uk-slideshow="ratio:false; pause-on-hover:true;">
        <ul class="uk-slideshow-items">
            <li>
                <div class="uk-container uk-container-small" uk-scrollspy="target:p; cls:uk-animation-slide-left-small; delay:300; repeat:true;">
                    <div class="uk-position-center uk-text-center c-content">
                        <h1><?php the_title(); ?></h1>
                        <small><?php the_date(); ?></small>
                    </div>
                </div>
                <div class="c-bg-blur"></div>
                <div class="c-bg" sources="srcset:<?php echo esc_url($image);?>; media:(min-width: 640px)" data-src="<?php echo esc_url($image_m);?>" title="<?php the_title(); ?>" uk-img uk-parallax="bgy:-50"></div>
            </li>
        </ul>
    </div>    
</section>

<?php get_template_part('template-parts/components/flexible-content', 'flexible-content'); ?>

<!-- PAGINATION -->

<section class="uk-section uk-padding-medium c-item-pagination"><div class="uk-container uk-container-large">
	<?php custom_post_navigation(); ?>
</div></section>

<?php 
function custom_post_navigation() {
    // Huidige URL ophalen
    $current_url = get_permalink(get_the_ID());
    // Basis URL voor het overzicht samenstellen
    $overzicht_url = dirname($current_url) . '/';
    // Vorig en volgend bericht ophalen
    $prev = get_previous_post();
    $next = get_next_post();
    
    // Navigatieelementen opbouwen en weergeven
    echo '<div class="uk-grid-large uk-grid-collapse" uk-grid>';
        echo (!empty($prev)) ? '<div class="uk-width-auto"><a href="'.esc_url(get_permalink($prev->ID)).'">←</a></div>' : '<div class="uk-width-auto">&nbsp;</div>';
        echo '<div class="uk-width-expand"><a href="'.esc_url($overzicht_url).'">Overzicht</a></div>';
        echo (!empty($next)) ? '<div class="uk-width-auto"><a href="'.esc_url(get_permalink($next->ID)).'">→</a></div>' : '<div class="uk-width-auto">&nbsp;</div>';
    echo '</div>';
}
?>