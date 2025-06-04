<?php
$aanvraag_content = get_sub_field('aanvraag_text_field');
?>
<section class="uk-section uk-padding-large" style="background-color: #ededed; padding:80px 0px">
    <div class="uk-container uk-container-small">

        <div class="aanvraag_form__txt-container" style="margin-bottom: 20px">
            <?= $aanvraag_content; ?>
        </div>
        <div class="form-container">
            <?php echo do_shortcode('[gravityform id="2" title="false"]'); ?>
        </div>

    </div>
</section>