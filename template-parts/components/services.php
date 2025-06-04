<?php
$snelTitle = get_sub_field('snellink_titel');
$snelDesc = get_sub_field('snellink_omschrijving');
$snelImage = get_sub_field('snellink_afbeelding');
?>

<section class="uk-section uk-padding-large uk-padding-remove-bottom c-services-intro">
    <div class="uk-container uk-container-large">
        <div class="hi uk-child-width-1-1 uk-child-width-1-2@m uk-grid-collapse" uk-grid>
            <div>
                <div class="<?= $snelImage ? 'uk-width-2-3@l uk-align-right' : 'uk-width-1-1 uk-text-center' ?>">
                    <h2><?= $snelTitle ?></h2>
                    <?= $snelDesc; ?>
                </div>
            </div>
            <?php if ($snelImage) : ?>
                <div class="uk-visible@m" style="min-height: 600px;">
                    <img src="<?= esc_url($snelImage['url']) ?>" 
                         alt="<?= esc_attr($snelImage['alt']) ?>" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>