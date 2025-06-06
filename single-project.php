<?php
get_header();

// Get ACF fields and other necessary data
$project_dienste = get_field('project_dienste');
$project_opdrachtgever = get_field('project_opdrachtgever');
$project_datum = get_field('project_datum');
$project_fotos = get_field('project_fotos');
?>

<section class="uk-section uk-padding-remove c-hero c-service">
    <div class="uk-position-bottom uk-text-center c-content">
        <h1 uk-scrollspy="cls: uk-animation-fade; delay:300"><?php the_title(); ?></h1>
    </div>
    <div class="c-bg-gradient"></div>
    <div class="c-bg-gradient c-bg-gradient-top"></div>
    <?php if (has_post_thumbnail()): ?>
        <div class="c-bg"
            sources="srcset:<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>; media:(min-width: 640px)"
            data-src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>" uk-img
            uk-parallax="bgy:-50"></div>
    <?php endif; ?>
</section>

<section class="uk-section uk-padding-remove c-service c-service-next">
    <div class="uk-container uk-container-small">
        <div class="uk-grid-collapse c-service-next-description" uk-grid>
            <div class="uk-width-2-3@m c-txt c-txt-left">
                <h2 style="font-size: 36px;"><?php the_title(); ?></h2>

                <?php if (!empty($project_opdrachtgever)): ?>
                    <p><strong>Opdrachtgever:</strong> <?php echo esc_html($project_opdrachtgever); ?></p>
                <?php endif; ?>

                <?php if (!empty($project_dienste)):
                    // Check if it's an object/array and get the title(s) with links
                    if (is_array($project_dienste)) {
                        $dienst_links = [];

                        foreach ($project_dienste as $dienst) {
                            if (is_object($dienst)) {
                                $dienst_links[] = '<a href="' . esc_url(get_permalink($dienst->ID)) . '" target="_blank" rel="noopener noreferrer">'
                                    . esc_html(get_the_title($dienst->ID)) . '</a>';
                            } elseif (is_numeric($dienst)) {
                                $dienst_links[] = '<a href="' . esc_url(get_permalink($dienst)) . '" target="_blank" rel="noopener noreferrer">'
                                    . esc_html(get_the_title($dienst)) . '</a>';
                            }
                        }

                        $dienst_output = implode(', ', $dienst_links);
                    } elseif (is_object($project_dienste)) {
                        $dienst_output = '<a href="' . esc_url(get_permalink($project_dienste->ID)) . '" target="_blank" rel="noopener noreferrer">'
                            . esc_html(get_the_title($project_dienste->ID)) . '</a>';
                    } else {
                        $dienst_output = esc_html($project_dienste);
                    }
                    ?>
                    <p><strong>Verzorgde diensten:<br></strong>
                        <?php echo $dienst_output; ?></p>
                <?php endif; ?>


                <?php if (!empty($project_datum)): ?>
                    <p><strong>Uitgevoerd:</strong> <?php echo esc_html($project_datum); ?></p>
                <?php endif; ?>

                <div class="project-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="uk-width-1-3@m c-txt c-txt-right">
                <?php
                // Display project photos in the right sidebar
                if (!empty($project_fotos)): ?>
                    <div>
                        <h3>Project Foto's</h3>
                        <div uk-grid uk-lightbox="animation: slide">
                            <?php foreach ($project_fotos as $photo): ?>
                                <div class="uk-width-1-1 uk-margin-small-bottom">
                                    <a href="<?php echo esc_url($photo['url']); ?>"
                                        data-caption="<?php echo esc_attr($photo['caption']); ?>">
                                        <img src="<?php echo esc_url($photo['sizes']['medium']); ?>"
                                            alt="<?php echo esc_attr($photo['alt']); ?>" class="uk-width-1-1">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="projectbuilder">
    <?php if (have_rows('project_builder')): ?>
        <?php while (have_rows('project_builder')):
            the_row(); ?>

            <?php if (get_row_layout() === 'txt_block'): ?>
                <?php get_template_part('template-parts/blocks/txt_block'); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php
// Get other projects to display in the "Other Projects" section
$args = array(
    'post_type' => 'project',
    'posts_per_page' => 4,
    'post__not_in' => array(get_the_ID()),
);
$related_projects = new WP_Query($args);

if ($related_projects->have_posts()): ?>
    <section class="uk-section uk-padding-medium c-service c-related c-service-grid">
        <div class="uk-container uk-container-small">
            <div class="uk-margin-medium-bottom uk-text-center">
                <h2>Andere Projecten</h2>
            </div>
            <div class="uk-grid-medium uk-flex-center uk-child-width-1-2 uk-child-width-1-4@m" uk-grid
                uk-scrollspy="target: > div; cls: uk-animation-scale-down; delay: 300">
                <?php while ($related_projects->have_posts()):
                    $related_projects->the_post(); ?>
                    <div>
                        <a href="<?php the_permalink(); ?>" class="c-item">
                            <div class="uk-position-center c-content">
                                <p><?php the_title(); ?></p>
                            </div>
                            <?php if (has_post_thumbnail()): ?>
                                <div class="c-bg"
                                    style="background-image:url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>')">
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<section class="return">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="return__content-container">
                    <a href="https://wmc-groep.nl/projecten">
                        <p> >> Naar blogoverzicht</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    @media screen and (max-width: 768px) {
        .c-service-next .c-service-next-description {
            flex-direction: column;
        }
    }
</style>

<?php get_footer(); ?>