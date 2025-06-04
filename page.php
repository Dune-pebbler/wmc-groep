<?php
get_header();
$get_fields = get_fields();
$snelTitle = get_sub_field('snellink_titel');
?>

<?php if (have_rows('pagebuilder_flex')): ?>
        <?php while (have_rows('pagebuilder_flex')):
                the_row(); ?>
                <?php if (get_row_layout() === 'hero_blok'): ?>
                        <?php get_template_part('template-parts/components/hero', 'hero-component'); ?>
                <?php elseif (get_row_layout() === 'diensten_blok'): ?>
                        <?php get_template_part('template-parts/components/service-tiles'); ?>
                <?php elseif (get_row_layout() === 'klanten'): ?>
                        <?php get_template_part('template-parts/components/clients'); ?>
                <?php elseif (get_row_layout() === 'intro'): ?>
                        <?php get_template_part('template-parts/components/about-us'); ?>
                <?php elseif (get_row_layout() == 'tekstblok'): ?>
                        <?php get_template_part('template-parts/components/tekstblok'); ?>
                <?php elseif (get_row_layout() == 'tekstblok_5050'): ?>
                        <?php get_template_part('template-parts/components/text-5050'); ?>
                <?php elseif (get_row_layout() == 'tekstblok_3070'): ?>
                        <?php get_template_part('template-parts/components/text-3070'); ?>
                <?php elseif (get_row_layout() == 'tekst_+_afbeelding_5050'): ?>
                        <?php get_template_part('template-parts/components/text-image', '5050'); ?>
                <?php elseif (get_row_layout() == 'afbeeldingblok'): ?>
                        <?php get_template_part('template-parts/components/images'); ?>
                <?php elseif (get_row_layout() == 'alle_opdrachtgevers'): ?>
                        <?php get_template_part('template-parts/components/all-clients'); ?>
                <?php elseif (get_row_layout() == 'aanvraag_form'): ?>
                        <?php get_template_part('template-parts/components/aanvraag_form'); ?>
                <?php endif; ?>

        <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer(); ?>