<?php $introTitel = get_sub_field('intro_titel');
$introDesc = get_sub_field('intro_omschrijving');
$introFoto = get_sub_field('intro_foto');
$introButton = get_sub_field('intro_button');
$introButtonTwee = get_sub_field('intro_button_twee');
$image = get_sub_field('intro_image');
?>

<section class="uk-section uk-padding-large c-about-us">
    <div class="uk-container uk-container-large">
        <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
            <div>
                <img src="<?= $introFoto['sizes']['medium_large']; ?>" uk-scrollspy="cls:uk-animation-slide-left-small; offset-top:-200; delay:500;">
            </div>
            <div>
                <h1><?= $introTitel ?></h1>
                <?= $introDesc ?>
                <?php if ($introButton) : ?>
                    <a href="<?php echo esc_url($introButton['url']); ?>" target="<?php echo $introButton['target']; ?>" class="c-linkbtn"><?php echo $introButton['title']; ?></a>
                <?php endif; ?>
                <?php if ($introButtonTwee) : ?>
                    <a href="<?php echo esc_url($introButtonTwee['url']); ?>" target="<?php echo $introButtonTwee['target']; ?>" class="c-linkbtn c-linkbtn-color"><?php echo $introButtonTwee['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="uk-section uk-padding-large uk-padding-remove-top c-about-us">
    <div class="uk-container uk-container-large">
        <div class="uk-child-width-1-2@s uk-grid-collapse <?= !$image ? 'uk-flex uk-flex-middle uk-flex-center' : '' ?>" uk-grid uk-scrollspy="cls:uk-animation-slide-left-small; offset-top:-200; delay:300;">
            <div class="uk-first-column <?= !$image ? 'uk-width-1-1' : '' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
                <div class="<?= $image ? 'uk-width-2-3@l uk-align-right' : 'uk-width-1-1 uk-text-center' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
                    <h3>Laatste nieuws</h3>
                    <p>Benieuwd naar het reilen en zeilen van WMC? Via onze LinkedIn pagina houden we u graag op de hoogte van het laatste nieuws en recent gerealiseerde projecten.</p>
                    <a href="https://nl.linkedin.com/company/wijnands-milieu-consultancy1?trk=public_profile_topcard-current-company" target="_blank" class="c-linkbtn c-linkbtn-color">Nieuws <span></span></a>
                </div>
            </div>
            
            <?php if ($image) : ?>
                <div class="uk-visible@s" style="height: 400px;">
                    <img src="<?= esc_url($image['url']) ?>" 
                         alt="<?= esc_attr($image['alt']) ?>" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>