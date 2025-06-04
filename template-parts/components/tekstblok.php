<div class="uk-section uk-padding-large" style="background-color:white;">
<div class="uk-container uk-container-small">
    <div class="c-contentblok">
        <?php if (!empty(get_sub_field('titel'))):
            $titel_formaat = !empty(get_sub_field('titel_formaat')) ? get_sub_field('titel_formaat') : 'h2';
            echo '<' . esc_html($titel_formaat) . '>' . esc_html(get_sub_field('titel')) . '</' . esc_html($titel_formaat) . '>';
        endif; ?>

        <div class="uk-text-content">
            <?php echo get_sub_field('tekst'); ?>
        </div>
    </div>
</div>
</div>