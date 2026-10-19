<?php
/**
 * Páginas de WooCommerce que no pinta Lienzo (tienda, categorías, ficha).
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="lt-main" class="lt-main">
	<div class="lt-container">
		<?php woocommerce_content(); ?>
	</div>
</main>
<?php
get_footer();
