<?php get_header(); ?>

<style>.c-not-found .lang-item{display:none;} .c-not-found ul ul{padding:0 0 0 16px !important;}</style>

<section class="uk-section uk-padding-large c-not-found">
    <div class="uk-container uk-container-small">
    
        <h1>
            404<br>
            <span>Pagina niet gevonden</span>
        </h1>
        <p>De pagina die je probeert te bezoeken bestaat niet (meer)...<br> Selecteer één van onderstaande pagina's of keer terug naar de homepage.</p>

        <?php wp_nav_menu(array('theme_location' => 'hoofdmenu', 'container' => false)); ?>
        
        <a href="<?php echo esc_url(home_url('/')); ?>" class="c-linkbtn">Naar home</a>
    </div>
</section>

<?php get_footer(); ?>