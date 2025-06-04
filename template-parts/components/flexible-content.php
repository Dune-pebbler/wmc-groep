<?php
// Haal de flexibele inhoudsgegevens op
$flexible_content_data = get_field("flexible_content");
?>

<section class="uk-section uk-padding-large c-flexible-content"><div class="uk-container uk-container-small">
    
    <?php 
    // Loop door elk flexibel inhoudsblok
    foreach ($flexible_content_data['flexible_content_types'] as $k => $blok): ?>
        <div class="c-contentblok">

            <?php
            // Toon de titel als die bestaat
            if (!empty($blok['titel'])):
                $titel_formaat = !empty($blok['titel_formaat']) ? $blok['titel_formaat'] : 'h2';
                echo '<' . esc_html($titel_formaat) . '>' . esc_html($blok['titel']) . '</' . esc_html($titel_formaat) . '>';
            endif;

            // Kies de lay-out op basis van het bloktype
            switch ($blok['acf_fc_layout']):

                case 'tekstblok_5050':
                    // Toon 50/50 tekstblok
                    echo '<div class="uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                            <div>' . $blok['tekst']['tekstveld_links'] . '</div>
                            <div>' . $blok['tekst']['tekstveld_rechts'] . '</div>
                          </div>';
                    break;

                case 'tekstblok_3070':
                    // Kies lay-out: 30/70 of 70/30
                    $layout_left  = ($blok['layout'] === '30-70') ? 'uk-width-1-3@s' : 'uk-width-2-3@s';
                    $layout_right = ($blok['layout'] === '30-70') ? 'uk-width-2-3@s' : 'uk-width-1-3@s';
                    echo "<div class=\"uk-grid-medium\" uk-grid>
                            <div class=\"$layout_left\">{$blok['tekst']['tekstveld_links']}</div>
                            <div class=\"$layout_right\">{$blok['tekst']['tekstveld_rechts']}</div>
                          </div>";
                    break;

                case 'tekst_+_afbeelding_5050':
                    // Toon tekst en afbeelding naast elkaar (50/50)
                    $text_to_right = ($blok['layout'] === 'afbeelding-tekst') ? 'c-text-to-right' : '';
                    $img_src = esc_url($blok['afbeelding']['sizes']['medium_large']);
                    $img_desc = esc_attr($blok['afbeelding']['description']);
                    echo "<div class=\"uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s $text_to_right\" uk-grid>
                            <div>{$blok['tekst']}</div>
                            <div><img src=\"$img_src\" alt=\"$img_desc\" uk-scrollspy=\"cls:uk-animation-fade\" loading=\"lazy\"></div>
                          </div>";
                    break;

                case 'afbeeldingblok':
                    // Toon een blok met alleen afbeeldingen
                    if (!empty($blok['afbeeldingen'])):
                        $image_count = (count($blok['afbeeldingen']) > 3) ? ' c-wrap-images' : '';
                        echo "<div class=\"uk-flex uk-flex-between c-imageblok $image_count\" uk-lightbox=\"animation:scale;\" uk-scrollspy=\"target:img; cls: uk-animation-slide-bottom-small; delay: 500\">";
                        foreach ($blok['afbeeldingen'] as $afbeelding):
                            $img_url = esc_url($afbeelding['url']);
                            $img_desc = esc_attr($afbeelding['description']);
                            echo "<a href=\"$img_url\" data-caption=\"$img_desc\">
                                    <img src=\"{$afbeelding['sizes']['medium']}\" alt=\"$img_desc\" loading=\"lazy\">
                                  </a>";
                        endforeach;
                        echo "</div>";
                    endif;
                    break;

                default:
                    // Voor onbekende blokken, toon gewoon de tekst
                    echo $blok['tekst'];
                    break;

            endswitch;
            ?>

        </div>
    <?php endforeach; ?>
        
</div></section>

<script>
    jQuery(document).ready(function() {
        jQuery("iframe").attr("uk-responsive", "");
    });
</script>