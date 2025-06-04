<?php
$hero_settings = get_sub_field('hero_settings');
$hero_content = get_sub_field('hero_content');

// Bepaal grootte van hero
$small_hero = ($hero_settings['hero_formaat'] === 'klein') ? ' c-hero-small' : '';

// Bepaal of autoplay is ingeschakeld
$hero_autoplay = ($hero_settings['hero_autoplay'] === true) ? ' autoplay:true;' : '';

// Bepaal autoplay snelheid (indien ingeschakeld)
$hero_snelheid = (!empty($hero_settings['hero_snelheid']) && $hero_settings['hero_autoplay'] === true) ? ' autoplay-interval:'.$hero_settings['hero_snelheid'].'000;' : '';

// Check of het de startpagina is
$home_class = (is_front_page() || is_home()) ? ' c-hero-home' : '';

if (isset($hero_content) && is_array($hero_content) && $hero_settings['hero_tonen'] === true):
	echo '<section class="uk-section uk-padding-remove c-hero'.$home_class.$small_hero.'">';
		echo '<div uk-slideshow="ratio:false; pause-on-hover:false;'.$hero_autoplay.$hero_snelheid.'">';

			if ($hero_settings['hero_formaat'] === 'groot') {echo'<a class="c-scroller"><span></span></a>';}

			echo '<ul class="uk-slideshow-items">';
            
            // loop video bij 1 slide
            $videoLoop = count($hero_content) > 1 ? '' : 'loop';
			
            foreach ($hero_content as $hero):
				echo '<li>';

					echo '<div class="uk-container uk-container-large" uk-scrollspy="target:p; cls:uk-animation-slide-left-small; delay:300; repeat:true;">';
						echo '<div class="uk-position-bottom uk-text-center c-content">';
						if (!empty($hero['hero_titel'])) {
							echo '<p class="c-title">' . $hero['hero_titel'] . '</p>';
						}
						if ($hero_settings['hero_formaat'] === 'groot') {
							if (!empty($hero['hero_onderregel'])) {
								echo '<p>' . $hero['hero_onderregel'] . '</p>';
							}
							if (!empty($hero['hero_button'])) {
								// Zorg voor veilige output van links
								$btn_url = esc_url($hero['hero_button']['url']);
								$btn_target = esc_attr($hero['hero_button']['target']);
								$btn_title = esc_html($hero['hero_button']['title']);
								echo "<a href='{$btn_url}' target='{$btn_target}' class='c-linkbtn c-linkbtn-color' uk-scrollspy='cls:uk-animation-scale-up; delay:900; repeat:true;'>{$btn_title}</a>";
							}
						}
						echo '</div>';
					echo '</div>';

                    echo '<div class="c-bg-gradient"></div>';
                    echo '<div class="c-bg-gradient c-bg-gradient-top"></div>';

					// Bepaal of het een video of afbeelding is
					if (empty($hero['hero_afbeelding']['hero_video'])){
                        
						$mobile_image = !empty($hero['hero_afbeelding']['hero_afbeelding_mobiel']) ? $hero['hero_afbeelding']['hero_afbeelding_mobiel']['sizes']['medium'] : $hero['hero_afbeelding']['hero_afbeelding_desktop']['sizes']['medium'];
						$large_image = esc_url($hero['hero_afbeelding']['hero_afbeelding_desktop']['sizes']['large']);
						$alt_desc = esc_attr($hero['hero_afbeelding']['hero_afbeelding_desktop']['description']);
						echo "<div class='c-bg' sources='srcset:{$large_image}; media:(min-width: 640px)' data-src='{$mobile_image}' title='{$alt_desc}' uk-img uk-parallax='bgy:-50'></div>";
                        
					} else {
                        
						$video_src = esc_url($hero['hero_afbeelding']['hero_video']);
                        if(!empty($hero['hero_afbeelding']['hero_video_mobiel'])){
                            $video_src_m = esc_url($hero['hero_afbeelding']['hero_video_mobiel']);
                        }else{
                            $video_src_m = esc_url($hero['hero_afbeelding']['hero_video']);
                        }
                        
                        echo'<div class="c-bg">';
                            echo '<video id="video" uk-video playsinline muted uk-cover '.$videoLoop.'></video>';
                        echo'</div>';
                        ?>
                        <script>
                            // laad responsive video							
							function setVideoSource() {
                                const video = document.getElementById('video');
                                const desktopSrc = '<?php echo $video_src; ?>';
                                const mobileSrc = '<?php echo $video_src_m; ?>';
                                // Verwijder huidige bronnen
                                video.innerHTML = ''; 
                                if (window.innerWidth > 768) {
                                    video.append(createSource(desktopSrc));
                                } else {
                                    video.append(createSource(mobileSrc));
                                }
                                // Verwijder de vorige 'canplaythrough' listener indien aanwezig
                                video.removeEventListener('canplaythrough', playVideo);
                                // Voeg een nieuwe listener toe
                                video.addEventListener('canplaythrough', playVideo, { once: true });
                            }
                            function playVideo() {
                                this.play().catch(error => console.error('Failed to play the video:', error));
                            }
                            function createSource(src) {
                                const source = document.createElement('source');
                                source.src = src;
                                source.type = 'video/mp4';
                                return source;
                            }
                            window.addEventListener('DOMContentLoaded', setVideoSource);
							
							// negeer autoplay, toon volledige video
                            const slideshow = UIkit.slideshow('[uk-slideshow]');
                            slideshow.$el.addEventListener('beforeitemshow', (event) => {
                                const videoElement = event.target.querySelector('video');
                                if (videoElement) {
                                    slideshow.stopAutoplay();
                                    videoElement.onended = () => {
                                        slideshow.startAutoplay();
                                        slideshow.show('next');
                                    }
                                } else {
                                    slideshow.startAutoplay();
                                }
                            });
                        </script>
                        <?php
					}
				echo '</li>';
			endforeach;

			echo '</ul>';
            // arrows
			echo '<a class="uk-position-center-left uk-position-small uk-hidden-hover uk-light uk-visible@s" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>';
			echo '<a class="uk-position-center-right uk-position-small uk-hidden-hover uk-light uk-visible@s" href="#" uk-slidenav-next uk-slideshow-item="next"></a>';
		echo '</div>';
	echo '</section>';
endif;
?>
