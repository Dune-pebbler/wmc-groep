<?php
get_header();

$get_fields = get_fields();
$get_contact = get_fields("options");
$current_id = get_the_ID();
?>

<section class="uk-section uk-padding-remove c-hero c-service">
	<div class="uk-position-bottom uk-text-center c-content">
		<h1 uk-scrollspy="cls: uk-animation-fade; delay:300"><?php the_title(); ?></h1>
	</div>
	<div class="c-bg-gradient"></div>
	<div class="c-bg-gradient c-bg-gradient-top"></div>
	<div class='c-bg' sources='srcset:<?php echo esc_url($get_fields['dienst_afbeelding']['sizes']['large']); ?>; media:(min-width: 640px)' data-src='<?php echo esc_url($get_fields['dienst_afbeelding']['sizes']['medium_large']); ?>' uk-img uk-parallax='bgy:-50'></div>
</section>

<?php /* 
<section class="uk-section uk-padding-remove c-service c-service-intro">
	<div class="uk-container uk-container-large">
		<div class="uk-grid-collapse" uk-grid>
			<div class="uk-width-2-3@m c-txt c-txt-left">
				<h2>Onze diensten</h2>
				<ul class="uk-list c-buttons">
					<?php $i = 1;
					foreach ($get_fields['dienst_omschrijving'] as $diensten_buttons) {
						$urlSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $diensten_buttons['button_titel'])));
					?>
						<li><a href="#<?php echo $urlSlug; ?>" uk-scroll="offset:50">
								<?php echo $i . '. ' . $diensten_buttons['button_titel']; ?>
							</a></li>
					<?php $i++;
					} ?>
				</ul>
			</div>
			<div class="uk-width-1-3@m c-txt c-txt-right">
				<h3>Onze<br> Voordelen</h3>
				<ul class="uk-list" uk-scrollspy="target: > li; cls: uk-animation-fade; delay:500">
					<?php foreach ($get_fields['dienst_voordelen'] as $voordelen): ?>
						<li>
							<?php echo $voordelen['voordeel_icoon']; ?> <?php echo esc_html($voordelen['voordeel_titel']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
 */ ?>

<section class="uk-section uk-padding-remove c-service c-service-next">
	<div class="uk-container uk-container-large">
		<div class="uk-grid-collapse c-service-next-description" uk-grid>
			<div class="uk-width-2-3@m c-txt c-txt-left">
				<?php echo $get_fields['dienst_werkwijze']; ?>

				<?php foreach ($get_fields['dienst_omschrijving'] as $subdiensten):
					$urlSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $subdiensten['button_titel'])));
				?>
					<div class="c-subservice" id="<?php echo $urlSlug; ?>">
						<?php echo $subdiensten['omschrijving']; ?>
					</div>
				<?php endforeach; ?>

			</div>
			<div class="uk-width-1-3@m c-txt c-txt-right">

				<h3><?php echo $get_fields['contact_titel']; ?></h3>
				<p><?php echo $get_fields['contact_omschrijving']; ?></p>

				<div uk-sticky="end:!.uk-container; offset:50; media:@m">
					<div class="c-contacter" id="form">
						<div class="uk-grid-medium uk-child-width-1-1 c-contacts" uk-grid>
							<div>
								<a href="tel:<?php echo esc_attr($get_contact['contactgegevens']['telefoonnummer']); ?>" class="c-contact-btn">
									<?php echo do_shortcode('[icon name="mobile-screen" prefix="fas"]'); ?>
									<?php echo esc_html($get_contact['contactgegevens']['telefoonnummer']); ?>
									<small>Maandag t/m vrijdag</small>
								</a>
								<a href="https://wa.me/<?php echo esc_attr($get_contact['contactgegevens']['telefoonnummer']); ?>text=Hier een default tekst?" class="c-whatsapp"><?php echo do_shortcode('[icon name="whatsapp" prefix="fab"]'); ?></a>
							</div>
							<div>
								<a style="cursor:default">
									<?php echo do_shortcode('[icon name="envelope" prefix="far"]'); ?>
									Formulier
									<small>Reactie binnen één werkdag</small>
								</a>
							</div>
						</div>
						<?= do_shortcode('[gravityform id="1" title="false"]') ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<?php if (!empty($get_fields['dienst_extra_content'])) { ?>
	<section class="uk-section uk-padding-large" style="background:white;">
		<div class="uk-container uk-container-small">
			<?php echo $get_fields['dienst_extra_content']; ?>
		</div>
	</section>
<?php } 

$opdrachtgevers = get_field('opdrachtgevers', 'option');
?>

<section class="uk-section uk-padding-large c-clients">
    <div class="uk-container uk-container-large" style="padding-bottom:64px;">
        <div class="uk-grid-collapse uk-child-width-1-1 uk-child-width-1-2@m <?= !$image ? 'uk-flex uk-flex-middle uk-flex-center' : '' ?>" uk-grid>
            <?php if ($image) : ?>
                <div class="uk-visible@m" style="height: 400px;">
                    <img src="<?= esc_url($image['url']) ?>"
                        alt="<?= esc_attr($image['alt']) ?>"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            <?php endif; ?>
            <div class="uk-first-column <?= !$image ? 'uk-width-1-1' : '' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
                <div class="<?= $image ? 'uk-width-2-3@l uk-align-right' : 'uk-width-1-1 uk-text-center' ?>" <?= !$image ? 'style="max-width: 600px;"' : '' ?>>
				<h2><?php echo $get_fields['dienst_klanten']['titel']; ?></h2>
				<p><?php echo $get_fields['dienst_klanten']['omschrijving']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-container uk-container-medium">
        <div class="owl-carousel">
            <?php
            if ($opdrachtgevers):
                foreach ($opdrachtgevers as $opdrachtgever) {
                    $logo = $opdrachtgever['logo'];
                    $link = $opdrachtgever['website_link'];
            ?>
                    <div class="item">
                        <div class="c-item">
                            <?php if (!empty($link)): ?>
                                <a href="<?php echo esc_url($link['url']); ?>" target="_blank">
                                <?php endif; ?>

                                <?php if ($logo): ?>
                                    <img loading="lazy" style="object-fit:cover; width:100%; width:auto;" src="<?php echo esc_url($logo['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
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

        <script>
            jQuery(document).ready(function($) {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 20,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    responsive: {
                        0: {
                            items: 2
                        },
                        640: {
                            items: 3
                        },
                        960: {
                            items: 4
                        }
                    }
                });
            });
        </script>
    </div>
</section>


<?php
// Haal andere diensten op
$args = array(
	'post_type'      => 'dienst',
	'posts_per_page' => -1,
	'post__not_in'   => array($current_id)
);
$services = new WP_Query($args);

if ($services->have_posts()) { ?>
	<section class="uk-section uk-padding-medium c-service c-related c-service-grid">
		<div class="uk-container uk-container-large">
			<div class="uk-margin-medium-bottom uk-text-center">
				<h2>Andere diensten</h2>
			</div>
			<div class="uk-grid-medium uk-flex-center uk-child-width-1-2 uk-child-width-1-4@m" uk-grid uk-scrollspy="target: > div; cls: uk-animation-scale-down; delay: 300">
				<?php
				while ($services->have_posts()) : $services->the_post();
					$title = get_the_title();
					$permalink = get_permalink();
					$dienst_icoon = get_field('dienst_icoon');
					$dienst_afbeelding = get_field('dienst_afbeelding');

					echo '<div>';
					echo '<a href="' . esc_url($permalink) . '" class="c-item">';
					echo '<div class="uk-position-center c-content"><span style="background-image:url(' . esc_url($dienst_icoon['sizes']['medium_large']) . ');"></span> <p>' . esc_html($title) . '</p></div>';
					echo '<div class="c-bg" style="background-image:url(' . esc_url($dienst_afbeelding['sizes']['medium_large']) . ');"></div>';
					echo '</a>';
					echo '</div>';

				endwhile;
				?>
			</div>
		</div>
	</section>
<?php } ?>


<section class="uk-section c-ctabar">
	<div class="uk-container uk-container-large">
		<div class="uk-grid-large uk-flex-middle" uk-grid>
			<div class="uk-width-auto@s">
				<div class="c-image" style="background-image:url(/wp-content/uploads/2024/02/profiel-jesse.jpg)"></div>
			</div>
			<div class="uk-width-expand@s">
				<div class="c-txt">
					<p class="c-title"><?php echo $get_fields['cta_bar']['cta_titel']; ?></h2>
					<p><?php echo $get_fields['cta_bar']['cta_omschrijving']; ?></p>
				</div>
			</div>
			<div class="uk-width-auto@s">
				<div class="uk-grid-medium uk-child-width-1-1 c-contacts" uk-grid>
					<div>
						<a href="tel:<?php echo esc_attr($get_contact['contactgegevens']['telefoonnummer']); ?>" class="c-contact-btn">
							<?php echo do_shortcode('[icon name="mobile-screen" prefix="fas"]'); ?>
							<?php echo esc_html($get_contact['contactgegevens']['telefoonnummer']); ?>
							<small>Maandag t/m vrijdag</small>
						</a>
						<a href="https://wa.me/<?php echo esc_attr($get_contact['contactgegevens']['telefoonnummer']); ?>text=Hier een default tekst?" class="c-whatsapp"><?php echo do_shortcode('[icon name="whatsapp" prefix="fab"]'); ?></a>
					</div>
					<div>
						<a href="#form" uk-scroll="offset:50">
							<?php echo do_shortcode('[icon name="envelope" prefix="far"]'); ?>
							Formulier
							<small>Reactie binnen één werkdag</small>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer(); ?>