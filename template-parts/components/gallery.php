<?php
// Haal gallery instellingen en inhoud op
$gallery_settings = get_field('gallery_settings');
$gallery_content = get_field('gallery_content');

// Controleer of de galerij moet worden getoond
if (isset($gallery_settings['gallery_tonen']) && $gallery_settings['gallery_tonen'] === true):

	echo '<section class="uk-section uk-padding-large c-gallery"><div class="uk-container uk-container-large">';

		echo '<h2 class="uk-text-center">Gallery</h2>';

		// Controleer of er foto's beschikbaar zijn voor de galerij
		if (isset($gallery_content['gallery_fotos']) && !empty($gallery_content['gallery_fotos'])):
			echo '<div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-medium" uk-grid="masonry:true; parallax:70;" uk-lightbox="animation:scale;">';

			// Loop door elke foto in de galerij
			foreach ($gallery_content['gallery_fotos'] as $afbeelding):
				// Veilige waardes ophalen voor afbeeldingsattributen
				$img_url = isset($afbeelding['url']) ? esc_url($afbeelding['url']) : '';
				$img_desc = isset($afbeelding['description']) ? esc_attr($afbeelding['description']) : '';
				$img_src = isset($afbeelding['sizes']['medium_large']) ? esc_url($afbeelding['sizes']['medium_large']) : '';

				echo '<div>';
				// Controleer of de foto een beschrijving heeft en toon deze
				if ($img_desc) {
					echo '<a href="'.$img_url.'" data-caption="'.$img_desc.'" class="c-item">';
					echo '<div class="c-gallery-desc">'.$img_desc.'</div>';
				} else {
					echo '<a href="'.$img_url.'" class="c-item">';
				}
				echo '<img src="'.$img_src.'" alt="'.$img_desc.'" loading="lazy">';
				echo '</a>';
				echo '</div>';

			endforeach;

			echo '</div>';
		endif;

	echo '</div></section>';

endif;
?>
