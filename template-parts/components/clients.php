<?php
$titel = get_sub_field('titel');
$desc = get_sub_field('omschrijving');
$image = get_sub_field('client_afbeelding');
$opdrachtgevers = get_field('opdrachtgevers', 'option');

// Randomize opdrachtgevers if they exist
if ($opdrachtgevers) {
    shuffle($opdrachtgevers);
}
?>

<section class="uk-section uk-padding-large c-clients">
    <div class="uk-container uk-container-large" style="padding-bottom:64px;">
        <div class="uk-grid-collapse uk-child-width-1-1 uk-child-width-1-2@m <?= !$image ? 'uk-flex uk-flex-middle uk-flex-center' : '' ?>" uk-grid>
            <?php if ($image) : ?>
                <div class="uk-visible@m" style="height: 400px;">
                    <img src="<?= esc_url($image['url']) ?>"
                        alt="<?= esc_attr($image['alt']) ?>"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
            <div class="uk-first-column <?= !$image ? 'uk-width-1-1' : '' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
                <div class="<?= $image ? 'uk-width-2-3@l uk-align-right' : 'uk-width-1-1 uk-text-center' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
                    <h2><?php echo $titel; ?></h2>
                    <?php echo $desc; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-container uk-container-medium">
        <div class="owl-carousel">
            <?php
            if ($opdrachtgevers):
                foreach ($opdrachtgevers as $opdrachtgever) {
                    $logo = $opdrachtgever['logo'];
                    $link = $opdrachtgever['website_link'];
            ?>
                    <div class="item">
                        <div class="c-item">
                            <?php if (!empty($link)): ?>
                                <a href="<?php echo esc_url($link['url']); ?>" target="_blank">
                            <?php endif; ?>

                            <?php if ($logo): ?>
                                <img loading="lazy" style="object-fit:cover; width:100%; width:auto;" 
                                     src="<?php echo esc_url($logo['sizes']['medium_large']); ?>" 
                                     alt="<?php echo esc_attr($logo['alt']); ?>" />
                            <?php endif; ?>

                            <?php if (!empty($link)): ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php
                }
            endif; ?>
        </div>

        <script>
            jQuery(document).ready(function($) {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 20,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    responsive: {
                        0: {
                            items: 2
                        },
                        640: {
                            items: 3
                        },
                        960: {
                            items: 4
                        }
                    }
                });
            });
        </script>
    </div>
</section>