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

	<section class="uk-section c-top<?php echo $no_hero;
									echo (is_front_page()) ? ' c-top-home' : ''; ?>">
		<a href="tel:<?php echo esc_attr($fields['contactgegevens']['telefoonnummer']); ?>" class="c-contact-btn"><?php echo esc_html($fields['contactgegevens']['telefoonnummer']); ?></a>
		<a href="/" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>" class="uk-logo uk-position-center c-logo"></a>
		<div class="uk-container uk-container-large">
			<div uk-sticky>
				<a href="#" class="brand uk-visible@s uk-icon uk-totop" uk-totop uk-scroll><svg width="18" height="10" viewBox="0 0 18 10" xmlns="http://www.w3.org/2000/svg">
						<polyline fill="none" stroke="#000" stroke-width="1.2" points="1 9 9 1 17 9 "></polyline>
					</svg></a>
				<nav class="uk-navbar-container uk-navbar-transparent uk-visible@m uk-margin-remove" uk-navbar>
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