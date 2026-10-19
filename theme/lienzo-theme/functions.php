<?php
/**
 * Tema Lienzo: lo justo para que WordPress, Lienzo y WooCommerce funcionen
 * bien juntos. El aspecto sale de los globales de Lienzo.
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;

define( 'LIENZO_THEME_VERSION', '1.0.0' );

add_action(
	'after_setup_theme',
	static function () {
		load_theme_textdomain( 'lienzo-theme', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'custom-logo', array( 'height' => 88, 'width' => 280, 'flex-height' => true, 'flex-width' => true ) );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		// Lienzo carga sus globales (colores, fuentes, estilo) en todas las páginas, no solo en las que diseña.
		add_theme_support( 'lienzo' );

		register_nav_menus(
			array(
				'primary' => __( 'Main menu', 'lienzo-theme' ),
				'footer'  => __( 'Footer menu', 'lienzo-theme' ),
			)
		);
	}
);

// Ancho para incrustados e imágenes del contenido.
$GLOBALS['content_width'] = 760;

add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_enqueue_style( 'lienzo-theme', get_stylesheet_uri(), array(), LIENZO_THEME_VERSION );
		wp_enqueue_script( 'lienzo-theme', get_template_directory_uri() . '/assets/theme.js', array(), LIENZO_THEME_VERSION, array( 'in_footer' => true, 'strategy' => 'defer' ) );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

/** ¿La entrada actual está diseñada con Lienzo? */
function lienzo_theme_is_built( int $post_id = 0 ): bool {
	$post_id = $post_id ? $post_id : (int) get_the_ID();
	return $post_id && class_exists( '\Lienzo\Document' ) && \Lienzo\Document::is_built( $post_id );
}

add_filter(
	'body_class',
	static function ( array $classes ): array {
		if ( is_singular() && lienzo_theme_is_built( (int) get_queried_object_id() ) ) {
			$classes[] = 'lt-built';
		}
		return $classes;
	}
);

add_filter( 'excerpt_length', static fn() => 24 );
add_filter( 'excerpt_more', static fn() => '…' );

/** Tarjeta de entrada para listados (blog, archivos, búsqueda). */
function lienzo_theme_card(): void {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'lt-card' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<a class="lt-card-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'medium_large' ); ?></a>
		<?php endif; ?>
		<div class="lt-card-body">
			<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
			<h2 class="lt-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</div>
	</article>
	<?php
}

/** Menú de páginas cuando no hay menú asignado (sin el contenedor de wp_page_menu). */
function lienzo_theme_page_menu(): void {
	echo '<ul class="menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 2,
		)
	);
	echo '</ul>';
}
