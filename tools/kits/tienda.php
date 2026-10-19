<?php
/**
 * Kit «Tienda»: tienda en línea de objetos y accesorios. Botones de
 * píldora, tarjetas de producto y ventajas de compra. Con WooCommerce
 * añade el carrito en la cabecera y la rejilla de productos reales.
 */

use LienzoKits\K;

$P = 'ti-p';
$S = 'ti-s';
$W = 'ti-w';

$product = static fn( string $img, string $name, string $price ) => K::col(
	array(
		K::el(
			'imagebox',
			array(
				'image'        => K::img( $img, $name ),
				'title_text'   => $name,
				'description'  => $price,
				'link'         => K::link( '#page:coleccion' ),
				'title_tag'    => 'h3',
				'ratio'        => '1/1',
				'image_radius' => K::px( 16 ),
				'align'        => 'left',
				'desc_color'   => 'var(--lnz-c-primary)',
				'font_weight'  => '600',
			)
		),
	)
);

$hero = K::hero_split(
	array(
		'eyebrow' => 'Nueva colección',
		'title'   => 'Objetos bonitos para todos los días.',
		'lead'    => 'Piezas útiles, bien hechas y pensadas para durar. Envío a todo México y cambios sin complicaciones.',
		'buttons' => array( K::button( 'Comprar ahora', '#page:coleccion', $P ), K::button( 'Conócenos', '#page:nosotros', $S ) ),
		'image'   => 'fotografa',
		'alt'     => 'Persona con una cámara de la colección',
		'radius'  => 24,
		'section' => array( 'bg_color' => 'var(--lnz-surface)' ),
	)
);

$perks = K::section(
	array(
		K::row(
			array_map(
				static fn( $i ) => K::col(
					array(
						K::el(
							'iconbox',
							array(
								'icon'        => $i[0],
								'title_text'  => $i[1],
								'description' => $i[2],
								'position'    => 'left',
								'view'        => 'stacked',
								'icon_bg'     => 'var(--lnz-surface-2)',
								'icon_color'  => 'var(--lnz-c-primary)',
								'icon_size'   => K::px( 22 ),
								'title_tag'   => 'h3',
							)
						),
					)
				),
				array(
					array( 'truck', 'Envío gratis', 'En pedidos desde $999 MXN a todo el país.' ),
					array( 'shield', 'Compra segura', 'Paga con tarjeta, OXXO o transferencia.' ),
					array( 'arrow-left', 'Cambios fáciles', 'Tienes 30 días para cambiar tu pedido.' ),
				)
			),
			array( 'gap' => K::px( 32 ) )
		),
	),
	array( 'padding' => K::box( 48, 20 ) )
);

$featured = K::section(
	array_merge(
		K::intro( 'Lo más vendido', 'Favoritos de la temporada', '' ),
		array(
			K::grid(
				array(
					$product( 'camara', 'Cámara clásica', '$2,450 MXN' ),
					$product( 'taza', 'Taza de cerámica', '$290 MXN' ),
					$product( 'reloj', 'Reloj despertador', '$680 MXN' ),
					$product( 'tocadiscos', 'Tocadiscos', '$3,900 MXN' ),
				),
				4
			),
			K::buttons( array( K::button( 'Ver toda la colección', '#page:coleccion', $S ) ), 'center' ),
		)
	)
);

$categories = K::section(
	array_merge(
		K::intro( 'Categorías', 'Encuentra lo que buscas', '' ),
		array(
			K::row(
				array_map(
					static fn( $c ) => K::col(
						array(
							K::el(
								'cta',
								array(
									'image'       => K::img( $c[0], $c[1] ),
									'layout'      => 'cover',
									'title_text'  => $c[1],
									'description' => $c[2],
									'button'      => 'Ver más',
									'link'        => K::link( '#page:coleccion' ),
									'min_height'  => K::px( 340 ),
									'overlay'     => 'rgba(28,25,23,.45)',
									'radius'      => K::px( 20 ),
									'justify'     => 'flex-end',
									'button_style' => $W,
								)
							),
						)
					),
					array(
						array( 'accesorios', 'Accesorios', 'Para llevar contigo.' ),
						array( 'cuadernos', 'Papelería', 'Cuadernos y libretas.' ),
						array( 'maquina', 'Vintage', 'Piezas con historia.' ),
					)
				),
				array( 'gap' => K::px( 24 ) )
			),
		)
	),
	array( 'bg_color' => 'var(--lnz-surface)' )
);

$story = K::image_text(
	array(
		'eyebrow' => 'Nuestra historia',
		'title'   => 'Elegimos cada pieza a mano.',
		'text'    => 'Somos un equipo pequeño que busca objetos útiles y bonitos en talleres de todo México. Si no lo usaríamos en casa, no lo vendemos.',
		'list'    => array( 'Talleres y marcas independientes', 'Empaques reciclables', 'Atención por WhatsApp' ),
		'buttons' => array( K::button( 'Leer más', '#page:nosotros', $S ) ),
		'image'   => 'taller',
		'alt'     => 'Mesa de trabajo de un taller',
		'radius'  => 24,
	)
);

$testimonials = K::testimonials(
	'Opiniones',
	'Más de 3,000 clientes felices',
	array(
		array( 'Llegó en dos días y el empaque es precioso. La taza es todavía más bonita en persona.', 'Mariana G.', 'Guadalajara' ),
		array( 'Me equivoqué de talla y el cambio fue facilísimo. Así da gusto comprar en línea.', 'Luis A.', 'Monterrey' ),
		array( 'Siempre encuentro el regalo perfecto. Atención rápida y muy amable por WhatsApp.', 'Paola C.', 'Puebla' ),
	)
);

$newsletter = K::section(
	array(
		K::col(
			array(
				K::h( 'Un 10 % en tu primera compra', 'h2', array( 'align' => 'center', 'color' => '#ffffff', 'font_size' => K::px( 40 ), 'font_size_mobile' => K::px( 30 ) ) ),
				K::p( 'Suscríbete y recibe novedades, lanzamientos y ofertas antes que nadie. Sin spam.', array( 'align' => 'center', 'color' => 'rgba(255,255,255,.85)', 'font_size' => K::px( 18 ) ) ),
				K::el(
					'form',
					array(
						'form_name'    => 'Boletín',
						'fields'       => array( array( 'id' => K::id(), 'label' => 'Correo electrónico', 'type' => 'email', 'required' => 'yes', 'placeholder' => 'tu@correo.com', 'newsletter' => 'yes' ) ),
						'submit_text'  => 'Quiero mi descuento',
						'success'      => '¡Listo! Revisa tu correo para ver tu código.',
						'button_style' => $W,
						'label_color'  => '#ffffff',
						'button_full'  => 'yes',
						'_width'       => K::px( 460 ),
					)
				),
			),
			array( 'align' => 'center', 'gap' => K::px( 18 ) )
		),
	),
	array( 'align' => 'center', 'bg_color' => 'var(--lnz-c-secondary)' )
);

$shop = K::section(
	array_merge(
		K::intro( 'Colección', 'Todos los productos', '' ),
		array(
			// Con WooCommerce, los productos reales; sin él, tarjetas de ejemplo.
			array_merge( K::el( 'wcproducts', array( 'source' => 'latest', 'count' => 12, 'columns' => K::px( 4, '' ), 'columns_mobile' => K::px( 2, '' ), 'pagination' => 'more', 'show_rating' => 'yes', 'button_style' => $P ) ), array( 'if' => 'woocommerce' ) ),
			array_merge(
				K::grid(
					array(
						$product( 'camara', 'Cámara clásica', '$2,450 MXN' ),
						$product( 'taza', 'Taza de cerámica', '$290 MXN' ),
						$product( 'reloj', 'Reloj despertador', '$680 MXN' ),
						$product( 'tocadiscos', 'Tocadiscos', '$3,900 MXN' ),
						$product( 'accesorios', 'Kit de viaje', '$890 MXN' ),
						$product( 'cuadernos', 'Libretas cosidas', '$240 MXN' ),
						$product( 'maquina', 'Máquina de escribir', '$4,200 MXN' ),
						$product( 'taza', 'Set de dos tazas', '$540 MXN' ),
					),
					4
				),
				array( 'unless' => 'woocommerce' )
			),
		)
	)
);

$contact_info = array(
	array( 'whatsapp', 'WhatsApp: +52 55 0000 0000', 'https://wa.me/525500000000' ),
	array( 'mail', 'hola@tutienda.com', 'mailto:hola@tutienda.com' ),
	array( 'clock', 'Lunes a sábado, de 10:00 a 19:00' ),
);

$header_extra = array( K::el( 'wccart', array() ) );

return array(
	'meta'      => array(
		'order'       => 4,
		'name'        => 'Tienda',
		'description' => 'Para tiendas en línea de productos y regalos. Tarjetas de producto, categorías, ventajas de compra y boletín. Con WooCommerce añade carrito y catálogo real.',
		'version'     => '1.0.0',
		'tags'        => array( 'Tienda', 'WooCommerce', 'Productos' ),
	),
	'globals'   => array(
		'colors'  => array(
			array( 'id' => 'primary', 'value' => '#ea580c' ),
			array( 'id' => 'secondary', 'value' => '#1c1917' ),
			array( 'id' => 'text', 'value' => '#1c1917' ),
			array( 'id' => 'accent', 'value' => '#facc15' ),
		),
		'fonts'   => array(
			array( 'id' => 'primary', 'family' => 'outfit' ),
			array( 'id' => 'text', 'family' => 'dm-sans' ),
		),
		'buttons' => array(
			array( 'id' => $P, 'name' => 'Tienda: principal', 'bg' => 'var(--lnz-c-primary)', 'color' => '#ffffff', 'hoverBg' => 'var(--lnz-c-secondary)', 'radius' => '100', 'padY' => '14', 'padX' => '28', 'weight' => '600' ),
			array( 'id' => $S, 'name' => 'Tienda: contorno', 'bg' => 'transparent', 'color' => 'var(--lnz-c-secondary)', 'border' => '2', 'borderColor' => 'var(--lnz-c-secondary)', 'hoverBg' => 'var(--lnz-c-secondary)', 'hoverColor' => '#ffffff', 'radius' => '100', 'padY' => '12', 'padX' => '26', 'weight' => '600' ),
			array( 'id' => $W, 'name' => 'Tienda: blanco', 'bg' => '#ffffff', 'color' => 'var(--lnz-c-secondary)', 'hoverBg' => 'var(--lnz-c-accent)', 'radius' => '100', 'padY' => '12', 'padX' => '24', 'weight' => '600' ),
		),
		'style'   => array(
			'radius'         => '12',
			'shadow'         => 'sm',
			'cardBorder'     => 'none',
			'line'           => '#e7e5e4',
			'lineStrong'     => '#d6d3d1',
			'surface'        => '#fafaf9',
			'surface2'       => '#f5f0e8',
			'muted'          => '#78716c',
			'textColor'      => '#1c1917',
			'textSize'       => '17',
			'textLine'       => '1.6',
			'linkColor'      => 'var(--lnz-c-primary)',
			'headingWeight'  => '700',
			'headingSpacing' => '-0.02em',
			'headingLine'    => '1.1',
		),
	),
	'templates' => array(
		array(
			'title'      => 'Tienda: cabecera',
			'type'       => 'header',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::header( array( 'extra' => $header_extra ) ),
		),
		array(
			'title'      => 'Tienda: pie',
			'type'       => 'footer',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::footer(
				array(
					'about'         => 'Objetos útiles y bonitos de talleres independientes. Envío a todo México.',
					'social'        => array( 'instagram' => 'https://instagram.com/', 'tiktok' => 'https://tiktok.com/', 'pinterest' => 'https://pinterest.com/' ),
					'links_title'   => 'Tienda',
					'links'         => array( array( 'Colección', '#page:coleccion' ), array( 'Nosotros', '#page:nosotros' ), array( 'Contacto', '#page:contacto' ) ),
					'contact_title' => 'Ayuda',
					'contact'       => $contact_info,
					'copy'          => '© ' . gmdate( 'Y' ) . ' Tu tienda. Precios en pesos mexicanos con IVA incluido.',
				)
			),
		),
		array( 'title' => 'Tienda: portada', 'type' => 'section', 'conditions' => array(), 'elements' => array( $hero ) ),
		array( 'title' => 'Tienda: ventajas', 'type' => 'section', 'conditions' => array(), 'elements' => array( $perks ) ),
		array( 'title' => 'Tienda: destacados', 'type' => 'section', 'conditions' => array(), 'elements' => array( $featured ) ),
		array( 'title' => 'Tienda: categorías', 'type' => 'section', 'conditions' => array(), 'elements' => array( $categories ) ),
		array( 'title' => 'Tienda: boletín', 'type' => 'section', 'conditions' => array(), 'elements' => array( $newsletter ) ),
	),
	'pages'     => array(
		array( 'key' => 'home', 'title' => 'Inicio', 'front' => 'yes', 'elements' => array( $hero, $perks, $featured, $categories, $story, $testimonials, $newsletter ) ),
		array( 'key' => 'coleccion', 'title' => 'Colección', 'elements' => array( K::page_header( 'Colección', 'Todo lo que tenemos, elegido a mano.', array( 'section' => array( 'bg_color' => 'var(--lnz-c-secondary)' ) ) ), $shop, $perks ) ),
		array( 'key' => 'nosotros', 'title' => 'Nosotros', 'elements' => array( K::page_header( 'Nosotros', 'Un equipo pequeño que busca objetos con historia.', array( 'image' => 'taller' ) ), $story, $testimonials, $newsletter ) ),
		array(
			'key'      => 'contacto',
			'title'    => 'Contacto',
			'elements' => array( K::contact( 'Ayuda', '¿Tienes dudas con tu pedido?', 'Escríbenos y te respondemos el mismo día en horario de atención.', $contact_info, array( 'button' => $P, 'section' => array( 'padding' => K::box( 96, 20 ) ) ) ) ),
		),
	),
);
