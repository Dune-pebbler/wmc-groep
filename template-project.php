<?php
/**
 * Template Name: Projecten
 * Description: Template for displaying the Projects archive page
 */

get_header();

// Get the current page's featured image for the hero section
$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>

<section class="uk-section uk-padding-remove c-hero c-service">
    <div class="uk-position-bottom uk-text-center c-content">
        <h1 uk-scrollspy="cls: uk-animation-fade; delay:300"><?php the_title(); ?></h1>
    </div>
    <div class="c-bg-gradient"></div>
    <div class="c-bg-gradient c-bg-gradient-top"></div>
    <?php if ($hero_image): ?>
        <div class="c-bg" sources="srcset:<?php echo esc_url($hero_image); ?>; media:(min-width: 640px)"
            data-src="<?php echo esc_url($hero_image); ?>" uk-img uk-parallax="bgy:-50"></div>
    <?php endif; ?>
</section>

<section class="uk-section uk-padding-large">
    <div class="uk-container uk-container-medium">
        <?php
        // Display the page content if any
        while (have_posts()):
            the_post();
            the_content();
        endwhile;
        ?>

        <!-- Sorting Options -->
        <?php /*
<div class="uk-margin-medium-bottom uk-flex uk-flex-right">
<form method="get" class="uk-grid-small uk-flex-middle" uk-grid>
<div class="uk-width-auto">
<label for="project-sort">Sorteren op:</label>
</div>
<div class="uk-width-auto">
<select name="orderby" id="project-sort" class="uk-select uk-form-small" onchange="this.form.submit()">
<option value="date" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : 'date', 'date'); ?>>Datum
   (oplopend)</option>
   <option value="title" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'title'); ?>>Titel (A-Z)
   </option>
   <option value="title-desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'title-desc'); ?>>
       Titel (Z-A)</option>
   <option value="date-asc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date-asc'); ?>>Datum
       (aflopend)</option>
   </select>
</div>
</form>
</div>
*/ ?>
        <div class="project-intro">
            <?php
            $project_intro = get_field('project_page_intro');
            ?>
            <?php if ($project_intro): ?>
                <div class="project-intro__content-container">
                    <?= $project_intro; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="uk-grid uk-grid-medium uk-child-width-1-1 uk-child-width-1-3@m" uk-grid
            uk-height-match="target: .uk-card">
            <?php
            // Query for projects
            $args = array(
                'post_type' => 'project',
                'posts_per_page' => 9, // Adjust as needed
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            );

            // Handle sorting
            $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'date';

            switch ($orderby) {
                case 'title':
                    $args['orderby'] = 'title';
                    $args['order'] = 'ASC';
                    break;
                case 'title-desc':
                    $args['orderby'] = 'title';
                    $args['order'] = 'DESC';
                    break;
                case 'date-asc':
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                    break;
                case 'date':
                default:
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                    break;
            }

            $projects_query = new WP_Query($args);

            if ($projects_query->have_posts()):
                while ($projects_query->have_posts()):
                    $projects_query->the_post();
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
                    $default_image = get_template_directory_uri() . '/assets/img/placeholder.jpg'; // Add a default placeholder image path
                    if (!$thumbnail) {
                        $thumbnail = $default_image;
                    }
                    ?>
                    <div>
                        <div class="uk-card uk-card-default uk-height-1-1">
                            <div class="uk-card-media-top" style="width: 100%;">
                                <a href="<?php the_permalink(); ?>" style="display: block; width: 100%;">
                                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>"
                                        class="uk-width-1-1" style="height: 200px; object-fit: cover; width: 100%;">
                                </a>
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title"><a href="<?php the_permalink(); ?>"
                                        class="uk-link-reset"><?php the_title(); ?></a></h3>

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
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <div class="uk-width-1-1">
                    <p>Er zijn momenteel geen projecten beschikbaar.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="uk-margin-large-top uk-text-center">
            <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $projects_query->max_num_pages,
                'prev_text' => '<span uk-pagination-previous></span>',
                'next_text' => '<span uk-pagination-next></span>',
                'type' => 'list',
                'end_size' => 3,
                'mid_size' => 3
            ));
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>