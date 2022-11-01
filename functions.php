<?php
/*
Theme Name: Desert theme
Theme URI: https://joselazo.es
Description: desert based in Blakslate theme
Author: Jose Lazo
Author URI: https://joselazo.es
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: desert
*/
define('TAROT_VERSION', '1.0.0');
add_action( 'after_setup_theme', 'desert_setup' );
function desert_setup() {
load_theme_textdomain( 'desert', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'woocommerce' );
add_theme_support('post-thumbnails');
add_image_size('seer-thumb', 200, 200, true);
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'desert' ) ) );
}
add_action( 'admin_notices', 'desert_notice' );
function desert_notice() {
$user_id = get_current_user_id();
$admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$param = ( count( $_GET ) ) ? '&' : '?';
if ( !get_user_meta( $user_id, 'desert_notice_dismissed_7' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p><a href="' . esc_url( $admin_url ), esc_html( $param ) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'desert' ) . '</big></a>' . wp_kses_post( __( '<big><strong>📝 Thank you for using Desert theme!</strong></big>', 'desert' ) ) . '<br /><br /><a href="https://github.com/jjlazo79/desert-theme/issues" class="button-primary" target="_blank">' . esc_html__( 'Feature Requests & Support', 'desert' ) . '</a> <a href="https://paypal.me/jjlazo79" class="button-primary" target="_blank">' . esc_html__( 'Donate', 'desert' ) . '</a></p></div>';
}
add_action( 'admin_init', 'desert_notice_dismissed' );
function desert_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['dismiss'] ) )
add_user_meta( $user_id, 'desert_notice_dismissed_7', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'desert_enqueue' );
function desert_enqueue() {
wp_enqueue_style( 'desert-style', get_stylesheet_uri(), array(), TAROT_VERSION );
wp_enqueue_style('google-fonts-baskerville', 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@0;1&display=swap', false);
wp_enqueue_style('google-fonts-poiret', 'https://fonts.googleapis.com/css2?family=Poiret+One&display=swap', false);
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'desert_footer' );
function desert_footer() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (deviceAgent.match(/(Android)/)) {
$("html").addClass("android");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'desert_document_title_separator' );
function desert_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'desert_title' );
function desert_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function desert_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'desert_schema_url', 10 );
function desert_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'desert_wp_body_open' ) ) {
function desert_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'desert_skip_link', 5 );
function desert_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'desert' ) . '</a>';
}
add_filter( 'the_content_more_link', 'desert_read_more_link' );
function desert_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'desert' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'desert_excerpt_read_more_link' );
function desert_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'desert' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'desert_image_insert_override' );
function desert_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'desert_widgets_init' );
function desert_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'desert' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar(array(
'name' => esc_html__('Sidebar footer left Area', 'seers-services'),
'id' => 'footer-widget-area_1',
'before_widget' => '<ul style="list-style: none;padding-left: 0;"><li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li></ul>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
));
register_sidebar(array(
'name' => esc_html__('Sidebar footer right Area', 'seers-services'),
'id' => 'footer-widget-area_2',
'before_widget' => '<ul style="list-style: none;padding-left: 0;"><li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li></ul>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
));
}
add_action( 'wp_head', 'desert_pingback_header' );
function desert_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'desert_enqueue_comment_reply_script' );
function desert_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function desert_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'desert_comment_count', 0 );
function desert_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

/**
 * Add custom thumbnail size choices
 *
 * @param array $sizes
 * @return array
 */
function seer_service_sizes($sizes)
{
	return array_merge($sizes, array(
		'seer-thumb' => __('Seer single page', SEERSSERVICES_TEXT_DOMAIN),
	));
}

/**
 * Add custom class to body tag
 */
function desert_body_class( $classes ) {

    $classes[] = 'desert';

    return $classes;

}
add_filter( 'body_class','desert_body_class' );
