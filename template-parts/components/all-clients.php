<?php
$opdrachtgevers = get_field('opdrachtgevers', 'option');

// Randomize the array if it exists
if ($opdrachtgevers) {
    shuffle($opdrachtgevers);
}
?>

<section class="uk-section uk-padding-large c-clients" style="padding-top:0px!important;">
    <div class="uk-container uk-container-medium">
        <div class="uk-grid uk-grid-small uk-child-width-1-4@m uk-flex-center" uk-grid >
            <?php
            if ($opdrachtgevers):
                foreach ($opdrachtgevers as $opdrachtgever) {
                    $logo = $opdrachtgever['logo'];
                    $link = $opdrachtgever['website_link'];
            ?>
                    <div>
                        <div class="c-item">
                            <?php if (!empty($link)): ?>
                                <a href="<?php echo esc_url($link['url']); ?>" target="_blank">
                            <?php endif; ?>

                            <?php if ($logo): ?>
                                <img loading="lazy" 
                                     style="object-fit:contain; width:100%; height:auto;" 
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
    </div>
</section>