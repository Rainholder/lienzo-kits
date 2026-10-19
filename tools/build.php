<?php
/**
 * Genera kits/<id>/kit.json y kits/index.json a partir de tools/kits/*.php.
 * Se ejecuta dentro de un WordPress con Lienzo para comprobar cada kit con
 * su saneador: avisa de los ajustes que Lienzo no reconoce.
 *
 * Uso (desde la carpeta de WordPress):
 *   wp eval-file C:/lienzo-kits/tools/build.php
 */

require __DIR__ . '/lib.php';

use LienzoKits\K;

$root      = dirname( __DIR__ );
$sanitizer = new Lienzo\Sanitizer( Lienzo\Plugin::instance()->widgets );
$index     = array();
$warnings  = 0;

/** Compara lo escrito con lo saneado y avisa de lo que se pierde. */
$check = static function ( array $raw, array $clean, string $where ) use ( &$check, &$warnings ): void {
	$by_id = array();
	foreach ( $clean as $el ) {
		$by_id[ $el['id'] ] = $el;
	}
	foreach ( $raw as $el ) {
		if ( ! isset( $by_id[ $el['id'] ] ) ) {
			echo "  ! $where: elemento {$el['type']} ({$el['id']}) descartado\n";
			++$warnings;
			continue;
		}
		$got = $by_id[ $el['id'] ]['settings'];
		foreach ( $el['settings'] as $key => $value ) {
			if ( ! array_key_exists( $key, $got ) ) {
				echo "  ! $where: {$el['type']}.$key descartado\n";
				++$warnings;
			} elseif ( is_scalar( $value ) && (string) $value !== (string) $got[ $key ] ) {
				echo "  ! $where: {$el['type']}.$key = " . var_export( $value, true ) . ' → ' . var_export( $got[ $key ], true ) . "\n";
				++$warnings;
			} elseif ( is_array( $value ) && isset( $value[0] ) && is_array( $value[0] ) && is_array( $got[ $key ] ) ) {
				foreach ( $value as $i => $item ) {
					foreach ( $item as $k => $v ) {
						if ( 'id' !== $k && ! array_key_exists( $k, $got[ $key ][ $i ] ?? array() ) ) {
							echo "  ! $where: {$el['type']}.$key" . "[$i].$k descartado\n";
							++$warnings;
						} elseif ( is_scalar( $v ) && ! str_contains( (string) $v, '{{kit}}' ) && (string) $v !== (string) ( $got[ $key ][ $i ][ $k ] ?? '' ) ) {
							echo "  ! $where: {$el['type']}.$key" . "[$i].$k = " . var_export( $v, true ) . ' → ' . var_export( $got[ $key ][ $i ][ $k ] ?? null, true ) . "\n";
							++$warnings;
						}
					}
				}
			}
		}
		if ( ! empty( $el['children'] ) ) {
			$check( $el['children'], $by_id[ $el['id'] ]['children'] ?? array(), $where );
		}
	}
};

foreach ( glob( __DIR__ . '/kits/*.php' ) as $file ) {
	$id = basename( $file, '.php' );
	K::reset( substr( $id, 0, 2 ) );
	$kit = require $file;
	echo "$id\n";
	foreach ( $kit['templates'] as $tpl ) {
		$check( $tpl['elements'], $sanitizer->elements( $tpl['elements'] ), $tpl['title'] );
	}
	foreach ( $kit['pages'] as $page ) {
		$check( $page['elements'], $sanitizer->elements( $page['elements'] ), $page['title'] );
	}
	$out = array(
		'format'    => 'lienzo-design-kit',
		'version'   => 1,
		'name'      => $kit['meta']['name'],
		'globals'   => $kit['globals'],
		'templates' => $kit['templates'],
		'pages'     => $kit['pages'],
	);
	wp_mkdir_p( "$root/kits/$id" );
	file_put_contents( "$root/kits/$id/kit.json", wp_json_encode( $out, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) );
	$colors = array();
	foreach ( $kit['globals']['colors'] as $c ) {
		$colors[] = $c['value'];
	}
	$index[] = array_merge(
		array( 'id' => $id ),
		$kit['meta'],
		array(
			'colors'  => array_slice( $colors, 0, 5 ),
			'preview' => 'preview.webp',
			'pages'   => array_column( $kit['pages'], 'title' ),
		)
	);
	printf( "  %d KB\n", filesize( "$root/kits/$id/kit.json" ) / 1024 );
}

usort( $index, static fn( $a, $b ) => ( $a['order'] ?? 99 ) <=> ( $b['order'] ?? 99 ) );
file_put_contents(
	"$root/kits/index.json",
	wp_json_encode(
		array(
			'format'  => 'lienzo-kits',
			'version' => 1,
			'kits'    => $index,
		),
		JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
	) . "\n"
);
echo count( $index ) . " kits · $warnings avisos\n";
