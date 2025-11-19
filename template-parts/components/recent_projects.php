<?php
// Query for 2 most recent projects
$args = array(
    'post_type' => 'project',
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'DESC'
);

$recent_projects = new WP_Query($args);

if ($recent_projects->have_posts()): ?>
    <section class="uk-section uk-padding-large">
        <div class="uk-container uk-container-medium">
            <div class="uk-text-center uk-margin-large-bottom">
                <h2>Recente Projecten</h2>
            </div>

            <div class="uk-grid uk-grid-medium uk-child-width-1-1 uk-child-width-1-2@m" uk-grid
                uk-height-match="target: .uk-card">
                <?php while ($recent_projects->have_posts()):
                    $recent_projects->the_post();

                    // Get ACF fields
                    $project_dienste = get_field('project_dienste');
                    $project_opdrachtgever = get_field('project_opdrachtgever');

                    // Handle dienst post object
                    $dienst_title = '';
                    if (!empty($project_dienste)) {
                        if (is_array($project_dienste)) {
                            $dienst_titles = [];
                            foreach ($project_dienste as $dienst) {
                                if (is_object($dienst)) {
                                    $dienst_titles[] = get_the_title($dienst->ID);
                                } elseif (is_numeric($dienst)) {
                                    $dienst_titles[] = get_the_title($dienst);
                                }
                            }
                            $dienst_title = implode(', ', $dienst_titles);
                        } elseif (is_object($project_dienste)) {
                            $dienst_title = get_the_title($project_dienste->ID);
                        } else {
                            $dienst_title = $project_dienste;
                        }
                    }

                    // Get thumbnail
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    $default_image = get_template_directory_uri() . '/assets/img/placeholder.jpg';
                    if (!$thumbnail) {
                        $thumbnail = $default_image;
                    }
                    ?>
                    <div>
                        <div class="uk-card uk-card-default uk-height-1-1">
                            <div class="uk-card-media-top" style="max-height:200px;">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>"
                                        class="uk-width-1-1" style="height: 100%; width:100%; object-fit: cover;">
                                </a>
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">
                                    <a href="<?php the_permalink(); ?>" class="uk-link-reset">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <?php if (!empty($project_opdrachtgever)): ?>
                                    <p><strong>Opdrachtgever:</strong> <?php echo esc_html($project_opdrachtgever); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($dienst_title)): ?>
                                    <p><?php echo esc_html($dienst_title); ?></p>
                                <?php endif; ?>

                                <div class="uk-margin-small-top">
                                    <a href="<?php the_permalink(); ?>" class="c-linkbtn">Bekijk project</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Link to all projects -->
            <div class="uk-text-center uk-margin-large-top">
                <a href="<?php echo get_permalink(get_page_by_path('projecten')); ?>" class="c-linkbtn">
                    Alle projecten bekijken
                </a>
            </div>
        </div>
    </section>

    <?php
    wp_reset_postdata();
endif;
?>