<div class="c-contentblok">
    <?php if (!empty(get_sub_field('titel'))): 
        $titel_formaat = !empty(get_sub_field('titel_formaat')) ? get_sub_field('titel_formaat') : 'h2';
        echo '<' . esc_html($titel_formaat) . '>' . esc_html(get_sub_field('titel')) . '</' . esc_html($titel_formaat) . '>';
    endif; ?>
    
    <div class="uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
        <div><?php echo get_sub_field('tekst')['tekstveld_links']; ?></div>
        <div><?php echo get_sub_field('tekst')['tekstveld_rechts']; ?></div>
    </div>
</div>