<?php
/**
 * Piezas comunes para escribir kits: elementos de Lienzo como arrays.
 * Los colores van con var(--lnz-c-…) para que cada kit las tiña con sus
 * globales; las imágenes, con «{{kit}}/img/…».
 */

namespace LienzoKits;

final class K {

	public static string $prefix = 'k';
	private static int $n        = 0;

	public static function reset( string $prefix ): void {
		self::$prefix = $prefix;
		self::$n      = 0;
	}

	public static function id(): string {
		return self::$prefix . base_convert( (string) ++self::$n, 10, 36 );
	}

	public static function el( string $type, array $settings = array(), ?array $children = null ): array {
		$el = array(
			'id'       => self::id(),
			'type'     => $type,
			'settings' => $settings,
		);
		if ( 'container' === $type ) {
			$el['children'] = $children ?? array();
		}
		return $el;
	}

	public static function px( $size, string $unit = 'px' ): array {
		return array( 'size' => $size, 'unit' => $unit );
	}

	public static function box( int $top, ?int $right = null, ?int $bottom = null, ?int $left = null ): array {
		$right  ??= $top;
		$bottom ??= $top;
		$left   ??= $right;
		return array( 'unit' => 'px', 'top' => $top, 'right' => $right, 'bottom' => $bottom, 'left' => $left, 'linked' => $top === $right && $right === $bottom && $bottom === $left );
	}

	public static function img( string $name, string $alt = '' ): array {
		return array( 'id' => 0, 'url' => '{{kit}}/img/' . $name . '.webp', 'alt' => $alt );
	}

	public static function link( string $url ): array {
		return array( 'url' => $url, 'external' => false );
	}

	/** Sección: ancho de contenido, relleno vertical. */
	public static function section( array $children, array $s = array() ): array {
		return self::el(
			'container',
			array_merge(
				array(
					'tag'            => 'section',
					'content_width'  => 'boxed',
					'padding'        => self::box( 96, 20 ),
					'padding_mobile' => self::box( 64, 20 ),
					'gap'            => self::px( 28 ),
				),
				$s
			),
			$children
		);
	}

	public static function row( array $children, array $s = array() ): array {
		return self::el(
			'container',
			array_merge(
				array(
					'direction'        => 'row',
					'direction_mobile' => 'column',
					'gap'              => self::px( 28 ),
					'align'            => 'stretch',
				),
				$s
			),
			$children
		);
	}

	/** Rejilla: columnas de igual ancho que en móvil pasan a $mobile por fila. */
	public static function grid( array $cols, int $per_row, int $mobile = 2, int $gap = 12 ): array {
		$width = (string) round( 100 / $per_row, 2 );
		$cols  = array_map(
			static fn( $c ) => array_merge(
				$c,
				array( 'settings' => array_merge( $c['settings'], array( 'width' => self::px( $width, '%' ), 'width_mobile' => self::px( round( 100 / $mobile, 2 ), '%' ), 'padding' => self::box( $gap ) ) ) )
			),
			$cols
		);
		return self::row( $cols, array( 'direction_mobile' => 'row', 'wrap' => 'wrap', 'gap' => self::px( 0 ), '_margin' => self::box( -$gap ) ) );
	}

	public static function col( array $children, array $s = array() ): array {
		return self::el( 'container', array_merge( array( 'gap' => self::px( 18 ), 'width' => self::px( 100, '%' ) ), $s ), $children );
	}

	public static function h( string $text, string $tag = 'h2', array $s = array() ): array {
		return self::el( 'heading', array_merge( array( 'text' => $text, 'tag' => $tag ), $s ) );
	}

	public static function p( string $html, array $s = array() ): array {
		return self::el( 'text', array_merge( array( 'content' => str_starts_with( $html, '<' ) ? $html : '<p>' . $html . '</p>' ), $s ) );
	}

	public static function button( string $text, string $url, string $style = '', array $s = array() ): array {
		return self::el( 'button', array_merge( array( 'text' => $text, 'link' => self::link( $url ) ), $style ? array( 'button_style' => $style ) : array(), $s ) );
	}

	public static function image( string $name, string $alt, array $s = array() ): array {
		return self::el( 'image', array_merge( array( 'image' => self::img( $name, $alt ), 'size' => 'full' ), $s ) );
	}

	/** Antetítulo, título y entradilla. */
	public static function intro( string $eyebrow, string $title, string $lead = '', string $align = 'center' ): array {
		$out = array();
		if ( '' !== $eyebrow ) {
			$out[] = self::h( $eyebrow, 'p', array( 'align' => $align, 'color' => 'var(--lnz-c-primary)', 'font_size' => self::px( 14 ), 'font_weight' => '700' ) );
		}
		$out[] = self::h( $title, 'h2', array( 'align' => $align, 'font_size' => self::px( 42 ), 'font_size_mobile' => self::px( 30 ), 'line_height' => self::px( 1.15, 'em' ) ) );
		if ( '' !== $lead ) {
			$out[] = self::p( $lead, array( 'align' => $align, 'color' => 'var(--lnz-muted)', 'font_size' => self::px( 18 ) ) );
		}
		return 'center' === $align ? array( self::col( $out, array( 'align' => 'center', 'gap' => self::px( 12 ), '_margin' => self::box( 0, 0, 16, 0 ) ) ) ) : $out;
	}

	public static function buttons( array $buttons, string $justify = 'flex-start' ): array {
		return self::row( $buttons, array( 'gap' => self::px( 12 ), 'direction_mobile' => 'row', 'wrap' => 'wrap', 'align' => 'center', 'justify' => $justify ) );
	}

	/* ------------------------------------------------------------ cabecera y pie */

	/**
	 * Cabecera: logo, menú y botón. $o: dark (fondo oscuro), bg, extra (elementos tras el menú), cta [texto, url, estilo].
	 */
	public static function header( array $o = array() ): array {
		$dark  = ! empty( $o['dark'] );
		$color = $dark ? '#ffffff' : 'var(--lnz-c-text)';
		$items = array(
			self::el( 'logo', array( 'show' => 'auto', 'color' => $color, 'font_size' => self::px( 22 ), 'font_weight' => '700', 'width' => self::px( 150 ), '_width' => self::px( 240 ) ) ),
			self::el(
				'menu',
				array(
					'justify'      => 'flex-end',
					'gap'          => self::px( 28 ),
					'color'        => $color,
					'hover_color'  => 'var(--lnz-c-primary)',
					'active_color' => 'var(--lnz-c-primary)',
					'font_size'    => self::px( 16 ),
					'font_weight'  => '500',
					'mobile_bg'    => $dark ? 'var(--lnz-c-secondary)' : '#ffffff',
					'toggle_color' => $color,
					'_width'       => self::px( 100, '%' ),
				)
			),
		);
		foreach ( $o['extra'] ?? array() as $extra ) {
			$items[] = $extra;
		}
		if ( ! empty( $o['cta'] ) ) {
			$items[] = self::button( $o['cta'][0], $o['cta'][1], $o['cta'][2] ?? '', array( '_hide_mobile' => 'yes' ) );
		}
		return array(
			self::el(
				'container',
				array(
					'tag'              => 'header',
					'content_width'    => 'boxed',
					'direction'        => 'row',
					'direction_mobile' => 'row',
					'align'            => 'center',
					'justify'          => 'space-between',
					'gap'              => self::px( 24 ),
					'padding'          => self::box( 16, 20 ),
					'bg_color'         => $o['bg'] ?? ( $dark ? 'var(--lnz-c-secondary)' : '#ffffff' ),
					'border_style'     => $dark ? '' : 'solid',
					'border_width'     => self::box( 0, 0, 1, 0 ),
					'border_color'     => 'var(--lnz-line)',
					'_sticky'          => 'yes',
					'_stuck_shadow'    => 'yes',
				),
				$items
			),
		);
	}

	/**
	 * Pie: marca + texto, enlaces, contacto y redes; línea final.
	 *
	 * @param array $o about, links [[texto, url]], contact [[icono, texto]], social [red => url], bg, copy.
	 */
	public static function footer( array $o ): array {
		$white = '#ffffff';
		$soft  = 'rgba(255,255,255,.72)';
		$title = static fn( string $t ) => self::h( $t, 'h3', array( 'color' => $white, 'font_size' => self::px( 16 ), 'font_weight' => '700' ) );
		$list  = static fn( array $items ) => self::el(
			'list',
			array(
				'items'      => array_map(
					static fn( $i ) => array( 'id' => self::id(), 'text' => $i[1], 'icon' => $i[0], 'link' => isset( $i[2] ) ? self::link( $i[2] ) : self::link( '' ) ),
					$items
				),
				'gap'        => self::px( 10 ),
				'color'      => $soft,
				'icon_color' => 'var(--lnz-c-accent)',
				'icon_size'  => self::px( 16 ),
			)
		);
		$cols = array(
			self::col(
				array(
					self::el( 'logo', array( 'show' => 'title', 'color' => $white, 'font_size' => self::px( 22 ), 'font_weight' => '700' ) ),
					self::p( $o['about'], array( 'color' => $soft ) ),
					self::el( 'social', array( 'items' => array_map( static fn( $net, $url ) => array( 'id' => self::id(), 'network' => $net, 'link' => self::link( $url ) ), array_keys( $o['social'] ), $o['social'] ), 'shape' => 'circle', 'colors' => 'custom', 'color' => 'rgba(255,255,255,.12)', 'size' => self::px( 16 ) ) ),
				),
				array( 'width' => self::px( 40, '%' ), 'width_mobile' => self::px( 100, '%' ) )
			),
			self::col( array( $title( $o['links_title'] ?? 'Enlaces' ), $list( array_map( static fn( $l ) => array( 'chevron-right', $l[0], $l[1] ), $o['links'] ) ) ), array( 'width' => self::px( 25, '%' ), 'width_mobile' => self::px( 100, '%' ) ) ),
			self::col( array( $title( $o['contact_title'] ?? 'Contacto' ), $list( $o['contact'] ) ), array( 'width' => self::px( 35, '%' ), 'width_mobile' => self::px( 100, '%' ) ) ),
		);
		return array(
			self::el(
				'container',
				array(
					'tag'            => 'footer',
					'content_width'  => 'boxed',
					'padding'        => self::box( 72, 20, 32, 20 ),
					'gap'            => self::px( 40 ),
					'bg_color'       => $o['bg'] ?? 'var(--lnz-c-secondary)',
				),
				array(
					self::row( $cols, array( 'gap' => self::px( 48 ) ) ),
					self::el( 'divider', array( 'color' => 'rgba(255,255,255,.14)', 'space' => self::px( 0 ) ) ),
					self::p( $o['copy'], array( 'color' => 'rgba(255,255,255,.55)', 'font_size' => self::px( 14 ) ) ),
				)
			),
		);
	}

	/* ------------------------------------------------------------ secciones */

	/** Portada con foto de fondo y capa oscura. */
	public static function hero_image( array $o ): array {
		$white = '#ffffff';
		$align = $o['align'] ?? 'left';
		$kids  = array();
		if ( ! empty( $o['eyebrow'] ) ) {
			$kids[] = self::h( $o['eyebrow'], 'p', array( 'align' => $align, 'color' => 'var(--lnz-c-accent)', 'font_size' => self::px( 15 ), 'font_weight' => '700' ) );
		}
		$kids[] = self::h( $o['title'], 'h1', array( 'align' => $align, 'color' => $white, 'font_size' => self::px( $o['size'] ?? 64 ), 'font_size_mobile' => self::px( 38 ), 'line_height' => self::px( 1.05, 'em' ) ) );
		$kids[] = self::p( $o['lead'], array( 'align' => $align, 'color' => 'rgba(255,255,255,.85)', 'font_size' => self::px( 20 ), 'font_size_mobile' => self::px( 18 ) ) );
		$kids[] = self::buttons( $o['buttons'], 'center' === $align ? 'center' : 'flex-start' );
		return self::el(
			'container',
			array(
				'tag'               => 'section',
				'content_width'     => 'boxed',
				'min_height'        => self::px( $o['height'] ?? 640 ),
				'min_height_mobile' => self::px( 520 ),
				'justify'           => 'center',
				'align'             => 'center' === $align ? 'center' : 'flex-start',
				'padding'           => self::box( 96, 20 ),
				'bg_image'          => self::img( $o['image'] ),
				'bg_size'           => 'cover',
				'bg_position'       => 'center center',
				'bg_overlay'        => $o['overlay'] ?? 'rgba(15,23,42,.55)',
				'bg_color'          => 'var(--lnz-c-secondary)',
				'gap'               => self::px( 20 ),
			),
			array( self::col( $kids, array( 'width' => self::px( $o['width'] ?? 760 ), 'width_mobile' => self::px( 100, '%' ), 'gap' => self::px( 22 ), 'align' => 'center' === $align ? 'center' : 'flex-start' ) ) )
		);
	}

	/** Portada en dos columnas: texto y foto. */
	public static function hero_split( array $o ): array {
		$kids = array();
		if ( ! empty( $o['eyebrow'] ) ) {
			$kids[] = self::h( $o['eyebrow'], 'p', array( 'color' => 'var(--lnz-c-primary)', 'font_size' => self::px( 15 ), 'font_weight' => '700' ) );
		}
		$kids[] = self::h( $o['title'], 'h1', array( 'font_size' => self::px( $o['size'] ?? 60 ), 'font_size_mobile' => self::px( 38 ), 'line_height' => self::px( 1.05, 'em' ) ) );
		$kids[] = self::p( $o['lead'], array( 'font_size' => self::px( 20 ), 'font_size_mobile' => self::px( 18 ), 'color' => 'var(--lnz-muted)' ) );
		if ( ! empty( $o['list'] ) ) {
			$kids[] = self::checklist( $o['list'] );
		}
		$kids[] = self::buttons( $o['buttons'] );
		return self::section(
			array(
				self::row(
					array(
						self::col( $kids, array( 'justify' => 'center', 'gap' => self::px( 22 ) ) ),
						self::col( array( self::image( $o['image'], $o['alt'] ?? '', array( 'radius' => self::box( $o['radius'] ?? 16 ) ) ) ), array( 'justify' => 'center' ) ),
					),
					array( 'gap' => self::px( 64 ), 'align' => 'center' )
				),
			),
			array_merge( array( 'padding' => self::box( 80, 20 ) ), $o['section'] ?? array() )
		);
	}

	public static function checklist( array $items, string $icon = 'check' ): array {
		return self::el(
			'list',
			array(
				'items'      => array_map( static fn( $t ) => array( 'id' => self::id(), 'text' => $t, 'icon' => $icon ), $items ),
				'icon_color' => 'var(--lnz-c-primary)',
				'gap'        => self::px( 10 ),
			)
		);
	}

	/** Rejilla de cajas con icono. */
	public static function features( string $eyebrow, string $title, string $lead, array $items, array $o = array() ): array {
		$boxes = array_map(
			static fn( $i ) => self::el(
				'iconbox',
				array(
					'icon'        => $i[0],
					'title_text'  => $i[1],
					'description' => $i[2],
					'view'        => $o['view'] ?? 'stacked',
					'icon_color'  => $o['icon_color'] ?? 'var(--lnz-c-primary)',
					'icon_bg'     => $o['icon_bg'] ?? 'var(--lnz-surface-2)',
					'icon_size'   => self::px( 26 ),
					'align'       => $o['align'] ?? 'left',
					'title_tag'   => 'h3',
				)
			),
			$items
		);
		$rows = array_chunk( $boxes, $o['cols'] ?? 3 );
		return self::section(
			array_merge(
				self::intro( $eyebrow, $title, $lead ),
				array_map( static fn( $r ) => self::row( array_map( static fn( $b ) => self::col( array( $b ) ), $r ), array( 'gap' => self::px( 32 ) ) ), $rows )
			),
			$o['section'] ?? array()
		);
	}

	/** Foto a un lado y texto al otro. */
	public static function image_text( array $o ): array {
		$text = array_merge(
			self::intro( $o['eyebrow'] ?? '', $o['title'], '', 'left' ),
			array( self::p( $o['text'], array( 'font_size' => self::px( 18 ), 'color' => 'var(--lnz-muted)' ) ) ),
			! empty( $o['list'] ) ? array( self::checklist( $o['list'] ) ) : array(),
			! empty( $o['buttons'] ) ? array( self::buttons( $o['buttons'] ) ) : array()
		);
		$cols = array(
			self::col( array( self::image( $o['image'], $o['alt'] ?? '', array( 'radius' => self::box( $o['radius'] ?? 16 ) ) ) ), array( 'justify' => 'center' ) ),
			self::col( $text, array( 'justify' => 'center', 'gap' => self::px( 16 ) ) ),
		);
		return self::section( array( self::row( ! empty( $o['reverse'] ) ? array_reverse( $cols ) : $cols, array( 'gap' => self::px( 64 ), 'align' => 'center' ) ) ), $o['section'] ?? array() );
	}

	/** Cifras. */
	public static function stats( array $items, array $o = array() ): array {
		$dark  = ! empty( $o['dark'] );
		$items = array_map(
			static fn( $i ) => self::col(
				array(
					self::el(
						'counter',
						array(
							'end'          => $i[0],
							'prefix'       => $i[3] ?? '',
							'suffix'       => $i[1],
							'title'        => $i[2],
							'decimals'     => is_float( $i[0] ) ? '1' : '0',
							'align'        => 'center',
							'number_color' => $dark ? '#ffffff' : 'var(--lnz-c-primary)',
							'title_color'  => $dark ? 'rgba(255,255,255,.75)' : 'var(--lnz-muted)',
							'font_size'    => self::px( 48 ),
							'font_weight'  => '700',
						)
					),
				)
			),
			$items
		);
		$share = (string) round( 100 / max( 1, count( $items ) ), 2 );
		$items = array_map( static fn( $c ) => array_merge( $c, array( 'settings' => array_merge( $c['settings'], array( 'width' => self::px( $share, '%' ), 'width_mobile' => self::px( 50, '%' ), 'padding' => self::box( 12, 8 ) ) ) ) ), $items );
		return self::section( array( self::row( $items, array( 'direction_mobile' => 'row', 'wrap' => 'wrap', 'gap' => self::px( 0 ) ) ) ), array_merge( array( 'padding' => self::box( 72, 20 ), 'bg_color' => $dark ? 'var(--lnz-c-secondary)' : 'var(--lnz-surface)' ), $o['section'] ?? array() ) );
	}

	public static function testimonials( string $eyebrow, string $title, array $items, array $o = array() ): array {
		return self::section(
			array_merge(
				self::intro( $eyebrow, $title ),
				array(
					self::el(
						'testimonials',
						array(
							'items'      => array_map( static fn( $i ) => array( 'id' => self::id(), 'quote' => $i[0], 'name' => $i[1], 'role' => $i[2], 'rating' => 5, 'photo' => isset( $i[3] ) ? self::img( $i[3], $i[1] ) : array( 'id' => 0, 'url' => '', 'alt' => '' ) ), $items ),
							'layout'     => 'grid',
							'columns'    => self::px( count( $items ) >= 3 ? 3 : 2, '' ),
							'star_color' => 'var(--lnz-c-accent)',
						)
					),
				)
			),
			$o['section'] ?? array( 'bg_color' => 'var(--lnz-surface)' )
		);
	}

	public static function pricing( string $eyebrow, string $title, string $lead, array $plans, array $o = array() ): array {
		$cards = array_map(
			static fn( $pl ) => self::col(
				array(
					self::el(
						'pricing',
						array(
							'plan'         => $pl['plan'],
							'description'  => $pl['desc'],
							'currency'     => $pl['currency'] ?? '$',
							'price'        => $pl['price'],
							'period'       => $pl['period'] ?? '/mes',
							'badge'        => $pl['badge'] ?? '',
							'featured'     => ! empty( $pl['badge'] ) ? 'yes' : '',
							'features'     => array_map( static fn( $f ) => array( 'id' => self::id(), 'text' => ltrim( $f, '-' ), 'excluded' => str_starts_with( $f, '-' ) ? 'yes' : '' ), $pl['features'] ),
							'button'       => $pl['button'] ?? 'Empezar',
							'link'         => self::link( $pl['url'] ?? '#page:contacto' ),
							'button_style' => ! empty( $pl['badge'] ) ? ( $o['primary'] ?? '' ) : ( $o['secondary'] ?? '' ),
						)
					),
				)
			),
			$plans
		);
		return self::section( array_merge( self::intro( $eyebrow, $title, $lead ), array( self::row( $cards, array( 'align' => 'stretch' ) ) ) ), $o['section'] ?? array() );
	}

	public static function team( string $eyebrow, string $title, array $people, array $o = array() ): array {
		$cards = array_map(
			static fn( $m ) => self::col(
				array(
					self::el(
						'team',
						array(
							'photo'      => self::img( $m[2], $m[0] ),
							'member'     => $m[0],
							'role'       => $m[1],
							'bio'        => $m[3] ?? '',
							'shape'      => $o['shape'] ?? 'rounded',
							'role_color' => 'var(--lnz-c-primary)',
							'profiles'   => array( array( 'id' => self::id(), 'network' => 'linkedin', 'link' => self::link( 'https://www.linkedin.com/' ) ) ),
						)
					),
				)
			),
			$people
		);
		return self::section( array_merge( self::intro( $eyebrow, $title ), array( self::row( $cards ) ) ), $o['section'] ?? array() );
	}

	public static function faq( string $eyebrow, string $title, array $items, array $o = array() ): array {
		return self::section(
			array_merge(
				self::intro( $eyebrow, $title ),
				array(
					self::el(
						'accordion',
						array(
							'items'      => array_map( static fn( $i ) => array( 'id' => self::id(), 'title' => $i[0], 'content' => '<p>' . $i[1] . '</p>' ), $items ),
							'open_first' => 'yes',
							'exclusive'  => 'yes',
							'faq_schema' => 'yes',
							'icon_type'  => 'plus',
							'_width'     => self::px( 820 ),
						)
					),
				)
			),
			array_merge( array( 'align' => 'center' ), $o['section'] ?? array() )
		);
	}

	/** Franja de llamada a la acción. */
	public static function cta_band( string $title, string $text, array $buttons, array $o = array() ): array {
		$white = '#ffffff';
		return self::section(
			array(
				self::col(
					array(
						self::h( $title, 'h2', array( 'align' => 'center', 'color' => $white, 'font_size' => self::px( 40 ), 'font_size_mobile' => self::px( 30 ) ) ),
						self::p( $text, array( 'align' => 'center', 'color' => 'rgba(255,255,255,.85)', 'font_size' => self::px( 18 ) ) ),
						self::buttons( $buttons, 'center' ),
					),
					array( 'align' => 'center', 'gap' => self::px( 18 ), 'width' => self::px( 760 ), 'width_mobile' => self::px( 100, '%' ) )
				),
			),
			array_merge( array( 'align' => 'center', 'bg_color' => 'var(--lnz-c-primary)', 'padding' => self::box( 88, 20 ) ), $o['section'] ?? array() )
		);
	}

	/** Contacto: datos y formulario (y mapa si hay dirección). */
	public static function contact( string $eyebrow, string $title, string $lead, array $info, array $o = array() ): array {
		$details = self::el(
			'list',
			array(
				'items'      => array_map( static fn( $i ) => array( 'id' => self::id(), 'icon' => $i[0], 'text' => $i[1], 'link' => self::link( $i[2] ?? '' ) ), $info ),
				'gap'        => self::px( 14 ),
				'icon_color' => 'var(--lnz-c-primary)',
				'icon_size'  => self::px( 20 ),
				'font_size'  => self::px( 17 ),
			)
		);
		$form = self::el(
			'form',
			array(
				'form_name'    => 'Contacto',
				'fields'       => array(
					array( 'id' => self::id(), 'label' => 'Nombre', 'type' => 'text', 'required' => 'yes', 'width' => '50' ),
					array( 'id' => self::id(), 'label' => 'Correo electrónico', 'type' => 'email', 'required' => 'yes', 'width' => '50' ),
					array( 'id' => self::id(), 'label' => 'Teléfono', 'type' => 'tel', 'width' => '100' ),
					array( 'id' => self::id(), 'label' => 'Mensaje', 'type' => 'textarea', 'required' => 'yes', 'width' => '100' ),
				),
				'submit_text'  => $o['submit'] ?? 'Enviar mensaje',
				'success'      => '¡Gracias! Te respondemos muy pronto.',
				'button_style' => $o['button'] ?? '',
				'button_full'  => 'yes',
			)
		);
		$left = array_merge( self::intro( $eyebrow, $title, $lead, 'left' ), array( $details ) );
		if ( ! empty( $o['address'] ) ) {
			$left[] = self::el( 'map', array( 'provider' => 'osm', 'address' => $o['address'], 'zoom' => self::px( 15, '' ), 'height' => self::px( 260 ), 'radius' => self::px( 12 ) ) );
		}
		return self::section(
			array(
				self::row(
					array(
						self::col( $left, array( 'gap' => self::px( 18 ) ) ),
						self::col( array( $form ), array( 'padding' => self::box( 32 ), 'padding_mobile' => self::box( 20 ), 'bg_color' => 'var(--lnz-card-bg)', 'radius' => self::box( 16 ), '_shadow' => 'md' ) ),
					),
					array( 'gap' => self::px( 56 ) )
				),
			),
			$o['section'] ?? array( 'bg_color' => 'var(--lnz-surface)' )
		);
	}

	/** Encabezado de página interior. */
	public static function page_header( string $title, string $lead, array $o = array() ): array {
		$white = '#ffffff';
		$image = $o['image'] ?? '';
		return self::el(
			'container',
			array_merge(
				array(
					'tag'           => 'section',
					'content_width' => 'boxed',
					'padding'       => self::box( 96, 20, 80, 20 ),
					'padding_mobile' => self::box( 64, 20, 56, 20 ),
					'gap'           => self::px( 14 ),
					'align'         => 'center',
					'bg_color'      => 'var(--lnz-c-secondary)',
				),
				$image ? array(
					'bg_image'    => self::img( $image ),
					'bg_size'     => 'cover',
					'bg_position' => 'center center',
					'bg_overlay'  => 'rgba(15,23,42,.6)',
				) : array(),
				$o['section'] ?? array()
			),
			array(
				self::h( $title, 'h1', array( 'align' => 'center', 'color' => $white, 'font_size' => self::px( 52 ), 'font_size_mobile' => self::px( 36 ) ) ),
				self::p( $lead, array( 'align' => 'center', 'color' => 'rgba(255,255,255,.82)', 'font_size' => self::px( 19 ), '_width' => self::px( 680 ) ) ),
			)
		);
	}
}
