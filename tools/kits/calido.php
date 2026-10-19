<?php
/**
 * Kit «Cálido»: cafetería, restaurante o panadería. Tonos tierra,
 * tipografía con serifa, tarjetas redondeadas y carta de precios.
 */

use LienzoKits\K;

$P = 'ca-p';
$S = 'ca-s';
$W = 'ca-w';

$card = static fn( string $img, string $title, string $text ) => K::col(
	array(
		K::el(
			'imagebox',
			array(
				'image'        => K::img( $img, $title ),
				'title_text'   => $title,
				'description'  => $text,
				'title_tag'    => 'h3',
				'ratio'        => '4/3',
				'image_radius' => K::px( 14 ),
				'align'        => 'left',
			)
		),
	)
);

$hero = K::hero_image(
	array(
		'eyebrow' => 'Café de especialidad · Cocina de temporada',
		'title'   => 'Tu rincón favorito del barrio.',
		'lead'    => 'Desayunos sin prisa, café tostado en casa y pan del día. Abrimos todos los días desde las 8:00.',
		'buttons' => array( K::button( 'Ver la carta', '#page:carta', $P ), K::button( 'Reservar mesa', '#page:reservas', $W ) ),
		'image'   => 'hero',
		'overlay' => 'rgba(43,29,20,.58)',
		'align'   => 'center',
		'size'    => 68,
		'height'  => 680,
	)
);

$story = K::image_text(
	array(
		'eyebrow' => 'Nuestra historia',
		'title'   => 'Hecho a mano, como en casa.',
		'text'    => 'Empezamos con una cafetera y cuatro mesas. Hoy seguimos igual de cerca: productores locales, recetas de la familia y una cocina que cambia con cada temporada.',
		'list'    => array( 'Café tostado cada semana', 'Pan y postres del día', 'Ingredientes de productores locales' ),
		'buttons' => array( K::button( 'Conócenos', '#page:nosotros', $S ) ),
		'image'   => 'cocina',
		'alt'     => 'Ingredientes frescos en la cocina',
		'radius'  => 20,
	)
);

$highlights = K::section(
	array_merge(
		K::intro( 'Lo más pedido', 'Para empezar bien el día', 'Una selección de la carta que cambia según la temporada.' ),
		array(
			K::row(
				array(
					$card( 'cafe', 'Café de olla y lattes', 'Granos de Veracruz y Chiapas tostados en casa, con leche entera o vegetal.' ),
					$card( 'desayuno', 'Desayunos de temporada', 'Fruta fresca, granola casera, chilaquiles y pan recién horneado.' ),
					$card( 'te', 'Tés e infusiones', 'Hojas sueltas y mezclas de la casa, frías o calientes.' ),
				),
				array( 'gap' => K::px( 32 ) )
			),
		)
	),
	array( 'bg_color' => 'var(--lnz-surface)' )
);

$menu_list = static fn( string $title, array $items ) => K::col(
	array(
		K::h( $title, 'h3', array( 'font_size' => K::px( 26 ) ) ),
		K::el(
			'pricelist',
			array(
				'items'       => array_map( static fn( $i ) => array( 'id' => K::id(), 'title' => $i[0], 'price' => $i[1], 'text' => $i[2] ), $items ),
				'leader'      => 'yes',
				'price_color' => 'var(--lnz-c-primary)',
				'gap'         => K::px( 18 ),
			)
		),
	),
	array( 'gap' => K::px( 20 ) )
);

$menu = K::section(
	array_merge(
		K::intro( 'La carta', 'Café, desayunos y algo dulce', '' ),
		array(
			K::row(
				array(
					$menu_list(
						'Café y bebidas',
						array(
							array( 'Espresso', '$45', 'Doble carga, notas a cacao.' ),
							array( 'Latte', '$65', 'Con leche entera, deslactosada o de avena.' ),
							array( 'Café de olla', '$55', 'Con piloncillo y canela.' ),
							array( 'Chocolate caliente', '$70', 'Cacao de Tabasco y leche espumada.' ),
							array( 'Té de la casa', '$50', 'Pregunta por la mezcla de la semana.' ),
						)
					),
					$menu_list(
						'Desayunos',
						array(
							array( 'Chilaquiles verdes', '$145', 'Con huevo, crema, queso fresco y frijoles.' ),
							array( 'Molletes', '$110', 'Pan de la casa, frijoles, queso y pico de gallo.' ),
							array( 'Bowl de fruta', '$95', 'Fruta de temporada, yogur y granola casera.' ),
							array( 'Pan francés', '$120', 'Con frutos rojos y miel de agave.' ),
							array( 'Concha del día', '$35', 'Vainilla o chocolate, recién horneada.' ),
						)
					),
				),
				array( 'gap' => K::px( 64 ) )
			),
		)
	)
);

$gallery = K::section(
	array_merge(
		K::intro( 'El lugar', 'Ven a quedarte un rato', '' ),
		array(
			K::el(
				'gallery',
				array(
					'images'         => array( K::img( 'local', 'Interior del café' ), K::img( 'terraza', 'Terraza' ), K::img( 'mesa', 'Mesa servida' ), K::img( 'granos', 'Café en grano' ), K::img( 'frutos', 'Fresas de temporada' ), K::img( 'cafe', 'Latte' ) ),
					'columns'        => K::px( 3, '' ),
					'columns_mobile' => K::px( 2, '' ),
					'gap'            => K::px( 12 ),
					'ratio'          => '1/1',
					'radius'         => K::px( 16 ),
					'link'           => 'lightbox',
					'hover'          => 'zoom',
				)
			),
		)
	)
);

$testimonials = K::testimonials(
	'Opiniones',
	'Nuestros clientes lo dicen mejor',
	array(
		array( 'El mejor café de la colonia y un ambiente que invita a quedarse toda la tarde.', 'Daniela R.', 'Clienta desde 2019' ),
		array( 'Los chilaquiles son de otro nivel. Atención cálida y siempre con una sonrisa.', 'Óscar M.', 'Vecino del barrio' ),
		array( 'Perfecto para trabajar un rato: buen wifi, buena música y mejor pan.', 'Fernanda L.', 'Diseñadora' ),
	)
);

$hours = array(
	array( 'clock', 'Lunes a viernes: 8:00 – 20:00' ),
	array( 'clock', 'Sábado y domingo: 9:00 – 21:00' ),
	array( 'map-pin', 'Av. Álvaro Obregón 120, Roma Norte, CDMX' ),
	array( 'phone', '+52 55 0000 0000', 'tel:+525500000000' ),
);

$visit = K::section(
	array(
		K::row(
			array(
				K::col(
					array_merge(
						K::intro( 'Visítanos', 'Te esperamos', 'Sin reservación entre semana; los fines de semana te recomendamos apartar mesa.', 'left' ),
						array(
							K::el( 'list', array( 'items' => array_map( static fn( $i ) => array( 'id' => K::id(), 'icon' => $i[0], 'text' => $i[1], 'link' => K::link( $i[2] ?? '' ) ), $hours ), 'gap' => K::px( 12 ), 'icon_color' => 'var(--lnz-c-primary)', 'font_size' => K::px( 17 ) ) ),
							K::buttons( array( K::button( 'Reservar mesa', '#page:reservas', $P ) ) ),
						)
					),
					array( 'justify' => 'center', 'gap' => K::px( 18 ) )
				),
				K::col( array( K::el( 'map', array( 'provider' => 'osm', 'address' => 'Av. Álvaro Obregón 120, Roma Norte, Ciudad de México', 'zoom' => K::px( 16, '' ), 'height' => K::px( 380 ), 'radius' => K::px( 20 ) ) ) ) ),
			),
			array( 'gap' => K::px( 56 ), 'align' => 'center' )
		),
	),
	array( 'bg_color' => 'var(--lnz-surface)' )
);

$cta = K::cta_band(
	'¿Celebras algo especial?',
	'Organizamos desayunos para grupos, cumpleaños y reuniones de trabajo. Escríbenos y armamos un menú a tu medida.',
	array( K::button( 'Pedir información', '#page:reservas', $W ) ),
	array( 'section' => array( 'bg_color' => 'var(--lnz-c-primary)' ) )
);

$booking = K::section(
	array(
		K::row(
			array(
				K::col(
					array_merge(
						K::intro( 'Reservas', 'Aparta tu mesa', 'Te confirmamos por teléfono o WhatsApp en menos de una hora en horario de apertura.', 'left' ),
						array( K::el( 'list', array( 'items' => array_map( static fn( $i ) => array( 'id' => K::id(), 'icon' => $i[0], 'text' => $i[1], 'link' => K::link( $i[2] ?? '' ) ), $hours ), 'gap' => K::px( 12 ), 'icon_color' => 'var(--lnz-c-primary)' ) ) )
					),
					array( 'gap' => K::px( 18 ) )
				),
				K::col(
					array(
						K::el(
							'form',
							array(
								'form_name'    => 'Reserva',
								'fields'       => array(
									array( 'id' => K::id(), 'label' => 'Nombre', 'type' => 'text', 'required' => 'yes', 'width' => '50' ),
									array( 'id' => K::id(), 'label' => 'Teléfono', 'type' => 'tel', 'required' => 'yes', 'width' => '50' ),
									array( 'id' => K::id(), 'label' => 'Fecha', 'type' => 'date', 'required' => 'yes', 'width' => '50' ),
									array( 'id' => K::id(), 'label' => 'Personas', 'type' => 'select', 'options' => "2\n3\n4\n5\n6\nMás de 6", 'width' => '50' ),
									array( 'id' => K::id(), 'label' => 'Comentarios', 'type' => 'textarea', 'width' => '100' ),
								),
								'submit_text'  => 'Reservar',
								'success'      => '¡Gracias! Te confirmamos la reserva muy pronto.',
								'button_style' => $P,
								'button_full'  => 'yes',
							)
						),
					),
					array( 'padding' => K::box( 32 ), 'padding_mobile' => K::box( 20 ), 'bg_color' => 'var(--lnz-card-bg)', 'radius' => K::box( 20 ), '_shadow' => 'md' )
				),
			),
			array( 'gap' => K::px( 56 ) )
		),
	),
	array( 'bg_color' => 'var(--lnz-surface)' )
);

return array(
	'meta'      => array(
		'order'       => 3,
		'name'        => 'Cálido',
		'description' => 'Para cafeterías, restaurantes y panaderías. Tonos tierra, tipografía con serifa, carta de precios y reservas.',
		'version'     => '1.0.0',
		'tags'        => array( 'Restaurante', 'Cafetería', 'Comida' ),
	),
	'globals'   => array(
		'colors'  => array(
			array( 'id' => 'primary', 'value' => '#b45309' ),
			array( 'id' => 'secondary', 'value' => '#2b1d14' ),
			array( 'id' => 'text', 'value' => '#292524' ),
			array( 'id' => 'accent', 'value' => '#f2b55b' ),
		),
		'fonts'   => array(
			array( 'id' => 'primary', 'family' => 'fraunces' ),
			array( 'id' => 'text', 'family' => 'work-sans' ),
		),
		'buttons' => array(
			array( 'id' => $P, 'name' => 'Cálido: principal', 'bg' => 'var(--lnz-c-primary)', 'color' => '#ffffff', 'hoverBg' => 'var(--lnz-c-secondary)', 'radius' => '100', 'padY' => '14', 'padX' => '28', 'weight' => '600' ),
			array( 'id' => $S, 'name' => 'Cálido: contorno', 'bg' => 'transparent', 'color' => 'var(--lnz-c-primary)', 'border' => '2', 'borderColor' => 'var(--lnz-c-primary)', 'hoverBg' => 'var(--lnz-c-primary)', 'hoverColor' => '#ffffff', 'radius' => '100', 'padY' => '12', 'padX' => '26', 'weight' => '600' ),
			array( 'id' => $W, 'name' => 'Cálido: crema', 'bg' => '#fff7ed', 'color' => 'var(--lnz-c-secondary)', 'hoverBg' => 'var(--lnz-c-accent)', 'radius' => '100', 'padY' => '14', 'padX' => '28', 'weight' => '600' ),
		),
		'style'   => array(
			'radius'         => '14',
			'shadow'         => 'md',
			'cardBorder'     => 'none',
			'cardBg'         => '#fffdf9',
			'line'           => '#eadfd2',
			'lineStrong'     => '#d6c4b0',
			'surface'        => '#faf5ee',
			'surface2'       => '#f3e8da',
			'fieldBg'        => '#fffdf9',
			'muted'          => '#78716c',
			'textColor'      => '#292524',
			'textSize'       => '17',
			'textLine'       => '1.7',
			'linkColor'      => 'var(--lnz-c-primary)',
			'headingColor'   => '#2b1d14',
			'headingWeight'  => '600',
			'headingSpacing' => '-0.015em',
			'headingLine'    => '1.12',
		),
	),
	'templates' => array(
		array(
			'title'      => 'Cálido: cabecera',
			'type'       => 'header',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::header( array( 'bg' => '#fffdf9', 'cta' => array( 'Reservar', '#page:reservas', $P ) ) ),
		),
		array(
			'title'      => 'Cálido: pie',
			'type'       => 'footer',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::footer(
				array(
					'about'         => 'Café de especialidad y cocina de temporada en el corazón del barrio.',
					'social'        => array( 'instagram' => 'https://instagram.com/', 'facebook' => 'https://facebook.com/', 'tiktok' => 'https://tiktok.com/' ),
					'links_title'   => 'Visítanos',
					'links'         => array( array( 'La carta', '#page:carta' ), array( 'Nosotros', '#page:nosotros' ), array( 'Reservas', '#page:reservas' ) ),
					'contact_title' => 'Horario',
					'contact'       => $hours,
					'copy'          => '© ' . gmdate( 'Y' ) . ' Tu café. Hecho con cariño (y con Lienzo).',
				)
			),
		),
		array( 'title' => 'Cálido: portada', 'type' => 'section', 'conditions' => array(), 'elements' => array( $hero ) ),
		array( 'title' => 'Cálido: lo más pedido', 'type' => 'section', 'conditions' => array(), 'elements' => array( $highlights ) ),
		array( 'title' => 'Cálido: carta', 'type' => 'section', 'conditions' => array(), 'elements' => array( $menu ) ),
		array( 'title' => 'Cálido: galería', 'type' => 'section', 'conditions' => array(), 'elements' => array( $gallery ) ),
		array( 'title' => 'Cálido: horario y mapa', 'type' => 'section', 'conditions' => array(), 'elements' => array( $visit ) ),
	),
	'pages'     => array(
		array( 'key' => 'home', 'title' => 'Inicio', 'front' => 'yes', 'elements' => array( $hero, $story, $highlights, $gallery, $testimonials, $visit ) ),
		array(
			'key'      => 'carta',
			'title'    => 'La carta',
			'elements' => array( K::page_header( 'La carta', 'Café tostado en casa, desayunos y postres del día.', array( 'image' => 'mesa', 'section' => array( 'bg_overlay' => 'rgba(43,29,20,.6)' ) ) ), $menu, $highlights, $cta ),
		),
		array(
			'key'      => 'nosotros',
			'title'    => 'Nosotros',
			'elements' => array( K::page_header( 'Nosotros', 'Una cafetería de barrio con alma de cocina familiar.', array( 'image' => 'local', 'section' => array( 'bg_overlay' => 'rgba(43,29,20,.6)' ) ) ), $story, $gallery, $testimonials ),
		),
		array( 'key' => 'reservas', 'title' => 'Reservas', 'elements' => array( $booking, $cta ) ),
	),
);
