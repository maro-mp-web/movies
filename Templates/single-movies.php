<?php
/**
 * Template Name: Single Movies
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
?>
        <div class="entry-content">
            

<?php include_once 'login-form.php'; ?>


<?php 
if ( isset( $_COOKIE['qss_access_token'] ) ) {
    $token = $_COOKIE['qss_access_token'];
    echo 'Your QSS API token is: ' . $token;
} else {
    echo 'Please log in to view your QSS API token.';
}
?>

            <?php the_content(); ?>
        </div>

        <div class="movie-title">
            <?php echo get_post_meta(get_the_ID(), 'movie_title', true); ?>
        </div>
<?php
    endwhile;
endif;

get_footer();