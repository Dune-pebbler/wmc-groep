<?php
$fields = get_fields("options");
?>

<section class="uk-section uk-padding-large c-footer"><div class="uk-container uk-container-large">
    <div class="uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m c-footercontent" uk-grid>
        <div>
            <div class="c-title">Bedrijfsinfo</div>
            <p>
                <strong><?php echo esc_html($fields['bedrijfsgegevens']['bedrijfsnaam']); ?></strong><br>
                <?php 
                $bedrijfsgegevens = $fields['bedrijfsgegevens'];
                echo esc_html($bedrijfsgegevens['adres']).'<br>';
                echo esc_html($bedrijfsgegevens['postcode']).' '.esc_html($bedrijfsgegevens['plaats']).'<br><br>';
                echo 'KvK '.esc_html($bedrijfsgegevens['kvk']).'<br>';
                echo 'BTW '.esc_html($bedrijfsgegevens['btw']);
                ?>
            </p>
            <div class="c-socials">
                <a href="<?php echo esc_url($fields['socials']['linkedin']); ?>" aria-label="LinkedIn" target="_blank" class="c-social">
                    <svg class="uk-position-center" x="0px" y="0px" viewBox="0 0 420 401.4">
                        <path d="M5.3,130.6h90v270.9h-90V130.6z M50.9,0C20.1,0,0,20.2,0,46.8c0,26,19.5,46.8,49.8,46.8h0.6c31.4,0,50.9-20.8,50.9-46.8 C100.7,20.2,81.7,0,50.9,0z M316.3,124.2c-47.8,0-69.2,26.3-81.1,44.7v-38.3h-90c1.2,25.4,0,270.9,0,270.9h90V250.2 c0-8.1,0.6-16.2,3-22c6.5-16.2,21.3-32.9,46.2-32.9c32.6,0,45.6,24.9,45.6,61.2v144.9h90V246.1C420,162.9,375.6,124.2,316.3,124.2z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div>
            <div class="c-title"><?php echo esc_html($fields['footer_kolom_1']['kolom_1_titel']); ?></div>
            <?php wp_nav_menu(array('theme_location'=>'footermenu', 'container'=>false, 'items_wrap'=>'<ul id="%1$s" class="%2$s uk-list">%3$s</ul>')); ?>
        </div>
        <div>
            <div class="c-title"><?php echo esc_html($fields['footer_kolom_2']['kolom_2_titel']); ?></div>
            <?php wp_nav_menu(array('theme_location'=>'dienstenmenu', 'container'=>false, 'items_wrap'=>'<ul id="%1$s" class="%2$s uk-list">%3$s</ul>')); ?>
        </div>
        <div>
            <div class="c-title"><?php echo $fields['footer_kolom_3']['kolom_3_titel']; ?></div>
            <a href="tel:<?php echo esc_attr($fields['contactgegevens']['telefoonnummer']); ?>"><?php echo do_shortcode('[icon name="phone" prefix="fas"]'); ?> <?php echo esc_html($fields['contactgegevens']['telefoonnummer']); ?></a><br>
            <a href="mailto:<?php echo esc_attr($fields['contactgegevens']['emailadres']); ?>"><?php echo do_shortcode('[icon name="envelope" prefix="fas"]'); ?> <?php echo esc_html($fields['contactgegevens']['emailadres']); ?></a><br><br>
            <strong>Bereikbaarheid:</strong><br>
            Maandag t/m vrijdag
        </div>
    </div>
</div></section>

<section class="uk-section c-bottom">
    <div class="uk-container uk-container-large">
        <p>
            ©<?php echo date("Y"); ?> <?php bloginfo('name'); ?>
            <span>
                <?php 
                $links = [
                    'privacybeleid' => 'privacybeleid_titel',
                    'cookiebeleid'  => 'cookiebeleid_titel',
                    'voorwaarden'   => 'voorwaarden_titel'
                ];

                foreach ($links as $key => $title) {
                    if (!empty($fields[$key][$title])) {
                        echo '<a href="'.esc_url($fields[$key][$key.'_link']).'">'.esc_html($fields[$key][$title]).'</a>';
                    }
                }
                ?>
            </span>
        </p>
        <p>Webontwikkeling: <a href="https://www.dunepebbler.nl" target="_blank" rel="noopener noreferrer">Dune Pebbler</a></p>
    </div>
</section>

<!-- hamburger nav -->
<div id="mobile-nav" uk-offcanvas="overlay:true; mode:reveal; flip:true;">
    <div class="uk-offcanvas-bar c-mob-navigation">
        <?php wp_nav_menu(array('theme_location'=>'hoofdmenu', 'container'=>false, 'items_wrap'=>'<ul id="%1$s" class="%2$s" uk-nav="toggle:span;">%3$s</ul>')); ?>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>