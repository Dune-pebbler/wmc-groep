<?php
$fields = get_fields("options");
$hero_settings = get_field("hero_settings");
$current_url = home_url(add_query_arg(null, null));
$no_hero = (isset($hero_settings) && is_array($hero_settings) && array_key_exists('hero_tonen', $hero_settings) && $hero_settings['hero_tonen'] === false) || preg_match("#/team/.+$#", $current_url) ? " c-no-hero" : "";
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <meta name="copyright" content="©<?php echo date("Y"); ?> - Dennis Guijt, Katwijk" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>


<style>
.uk-grid-medium>div>:first-child {
    margin-top: 0;
}

.gform_required_legend {
    display: none;
}

.gform_wrapper.gravity-theme .gform_footer .gform_button {
    padding: 8px 40px !important;
    margin-bottom: 0;
    font-size: 1rem;
    color: #a18a6e !important;
    font-weight: 600;
    background: #151515 !important;
    border: 0 !important;
    border-radius: 20px;
    box-shadow: none !important;
    transition: 0.3s ease;
    cursor: pointer;
}

.gform_wrapper.gravity-theme .gform_footer .gform_button:hover {
    color: #fff !important;
    background: #111 !important;
    padding: 8px 42px !important;
}

.gform_validation_errors h2 {
    letter-spacing: unset !important;
}

.gfield_validation_message {
    display: none;
}

.main-logo {
    transform: translate(0, -25%);
    margin-left: 16px
}

@media only screen and (max-width: 768px) {
    .main-logo {
        transform: translate(-50%, 0);
        left: 50%;
    }
}
</style>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <section class="uk-section hi-tim c-top<?php echo $no_hero;
	echo (is_front_page()) ? ' c-top-home' : ''; ?>">
        <a href="tel:<?php echo esc_attr($fields['contactgegevens']['telefoonnummer']); ?>"
            class="c-contact-btn"><?php echo esc_html($fields['contactgegevens']['telefoonnummer']); ?></a>
        <div class="uk-container uk-container-large" style="position:relative;">
            <a href="/" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>"
                class="uk-logo uk-position-left c-logo main-logo"></a>
        </div>

        <div class="uk-container uk-container-large">
            <div uk-sticky>
                <a href="#" class="brand uk-visible@s uk-icon uk-top-center" uk-totop uk-scroll>
                    <svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 665.16 331.86">
                        <defs>
                            <style>
                            .cls-1 {
                                fill: #fff;
                                stroke-width: 0px;
                            }
                            </style>
                        </defs>
                        <g id="Layer_1-2" data-name="Layer 1">
                            <g>
                                <polygon class="cls-1"
                                    points="581.63 0 521.83 0 409.09 143.79 300.45 0 267.79 40.47 409.09 223.53 581.63 0" />
                                <polygon class="cls-1"
                                    points="249.56 123.78 409.09 331.86 665.16 0 609.53 0 409.09 264.02 248.66 63.01 172.54 151.75 53.22 0 0 0 118.32 153.27 172.54 223.53 249.56 123.78" />
                            </g>
                        </g>
                    </svg>
                </a>
                <nav class="uk-navbar-container uk-navbar-transparent uk-visible@m uk-margin-remove uk-flex uk-flex-right"
                    uk-navbar>
                    <?php wp_nav_menu(array('theme_location' => 'hoofdmenu', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s uk-navbar-nav uk-width-1-1">%3$s</ul>')); ?>
                </nav>
            </div>
        </div>
    </section>

    <a class="uk-hidden@m c-hamburger" uk-toggle="target:#mobile-nav" aria-label="Hoofdnavigatie">
        <span></span>
        <span></span>
        <span></span>
    </a>