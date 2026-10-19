<?php
/**
 * Kit «Minimal»: estudio creativo o profesional independiente. Blanco y
 * negro con un acento, esquinas casi rectas, tipografía grotesca.
 */

use LienzoKits\K;

$P = 'mn-p'; // Botón principal.
$S = 'mn-s'; // Botón de contorno.

$hero = K::hero_split(
	array(
		'eyebrow' => 'Estudio de diseño independiente',
		'title'   => 'Diseño claro para marcas que tienen algo que decir.',
		'lead'    => 'Identidad, sitios web y dirección de arte con un proceso sencillo: escuchar, simplificar y cuidar cada detalle.',
		'buttons' => array( K::button( 'Ver proyectos', '#page:proyectos', $P ), K::button( 'Hablemos', '#page:contacto', $S ) ),
		'image'   => 'hero',
		'alt'     => 'Escritorio de trabajo del estudio',
		'radius'  => 4,
		'size'    => 64,
	)
);

$services = K::features(
	'Servicios',
	'Lo que hacemos',
	'Pocos servicios, hechos con calma y con criterio.',
	array(
		array( 'award', 'Identidad visual', 'Logotipo, tipografía, color y un manual breve que se usa de verdad.' ),
		array( 'globe', 'Sitios web', 'Webs rápidas y fáciles de editar, pensadas primero para el móvil.' ),
		array( 'camera', 'Dirección de arte', 'Fotografía y piezas para redes con una misma voz visual.' ),
	),
	array( 'view' => 'default', 'icon_bg' => 'transparent' )
);

$projects = K::section(
	array_merge(
		K::intro( 'Portafolio', 'Proyectos recientes', 'Una selección de trabajos para marcas pequeñas con grandes ideas.' ),
		array(
			K::el(
				'gallery',
				array(
					'images'  => array_map( static fn( $n ) => K::img( 'proyecto-' . $n, 'Proyecto ' . $n ), range( 1, 6 ) ),
					'columns' => K::px( 3, '' ),
					'columns_mobile' => K::px( 1, '' ),
					'gap'     => K::px( 16 ),
					'ratio'   => '4/3',
					'link'    => 'lightbox',
					'hover'   => 'zoom',
					'radius'  => K::px( 4 ),
				)
			),
		)
	)
);

$about = K::image_text(
	array(
		'eyebrow' => 'El estudio',
		'title'   => 'Pequeño a propósito.',
		'text'    => 'Trabajamos con pocos clientes a la vez para dedicar a cada proyecto la atención que merece. Hablas siempre con quien diseña.',
		'list'    => array( 'Más de 10 años de experiencia', 'Proyectos de 3 a 8 semanas', 'Precios cerrados desde el principio' ),
		'buttons' => array( K::button( 'Conócenos', '#page:estudio', $S ) ),
		'image'   => 'retrato',
		'alt'     => 'Fundadora del estudio',
		'radius'  => 4,
		'reverse' => 'yes',
	)
);

$testimonials = K::testimonials(
	'Opiniones',
	'Lo que dicen nuestros clientes',
	array(
		array( 'Entendieron la marca mejor que nosotros. El resultado es sencillo y se nota en todo lo que hacemos.', 'Andrea Morales', 'Fundadora, Casa Lúa' ),
		array( 'Un proceso claro, sin sorpresas y con entregas puntuales. Repetiríamos sin dudarlo.', 'Jorge Salinas', 'Director, Taller Norte' ),
	)
);

$cta = K::cta_band(
	'¿Tienes un proyecto en mente?',
	'Cuéntanos qué necesitas y te respondemos en menos de 24 horas con una propuesta.',
	array( K::button( 'Empezar un proyecto', '#page:contacto', '', array( 'bg_color' => '#ffffff', 'color' => '#111111' ) ) ),
	array( 'section' => array( 'bg_color' => 'var(--lnz-c-secondary)' ) )
);

$process = K::features(
	'Proceso',
	'Cómo trabajamos',
	'',
	array(
		array( 'message', '1. Escuchar', 'Una llamada para entender tu negocio, tu público y tus objetivos.' ),
		array( 'zap', '2. Proponer', 'Dos caminos creativos bien razonados, no veinte opciones al azar.' ),
		array( 'check-circle', '3. Entregar', 'Archivos listos para usar y una guía para que todo encaje.' ),
	),
	array( 'view' => 'framed', 'icon_bg' => 'transparent' )
);

return array(
	'meta'      => array(
		'order'       => 1,
		'name'        => 'Minimal',
		'description' => 'Para estudios creativos, fotógrafos y profesionales independientes. Blanco y negro, mucho aire y un solo acento.',
		'version'     => '1.0.0',
		'tags'        => array( 'Portafolio', 'Estudio', 'Freelance' ),
	),
	'globals'   => array(
		'colors'  => array(
			array( 'id' => 'primary', 'value' => '#111111' ),
			array( 'id' => 'secondary', 'value' => '#18181b' ),
			array( 'id' => 'text', 'value' => '#18181b' ),
			array( 'id' => 'accent', 'value' => '#e11d48' ),
		),
		'fonts'   => array(
			array( 'id' => 'primary', 'family' => 'space-grotesk' ),
			array( 'id' => 'text', 'family' => 'inter' ),
		),
		'buttons' => array(
			array( 'id' => $P, 'name' => 'Minimal: principal', 'bg' => 'var(--lnz-c-primary)', 'color' => '#ffffff', 'hoverBg' => 'var(--lnz-c-accent)', 'radius' => '2', 'padY' => '14', 'padX' => '26', 'weight' => '600' ),
			array( 'id' => $S, 'name' => 'Minimal: contorno', 'bg' => 'transparent', 'color' => 'var(--lnz-c-primary)', 'border' => '1', 'borderColor' => 'var(--lnz-c-primary)', 'hoverBg' => 'var(--lnz-c-primary)', 'hoverColor' => '#ffffff', 'radius' => '2', 'padY' => '13', 'padX' => '25', 'weight' => '600' ),
		),
		'style'   => array(
			'radius'           => '2',
			'shadow'           => 'none',
			'line'             => '#e4e4e7',
			'lineStrong'       => '#a1a1aa',
			'surface'          => '#fafafa',
			'surface2'         => '#f4f4f5',
			'muted'            => '#71717a',
			'textColor'        => '#18181b',
			'textSize'         => '17',
			'textLine'         => '1.65',
			'linkColor'        => 'var(--lnz-c-accent)',
			'headingWeight'    => '600',
			'headingSpacing'   => '-0.03em',
			'headingLine'      => '1.1',
		),
	),
	'templates' => array(
		array(
			'title'      => 'Minimal: cabecera',
			'type'       => 'header',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::header( array( 'cta' => array( 'Hablemos', '#page:contacto', $P ) ) ),
		),
		array(
			'title'      => 'Minimal: pie',
			'type'       => 'footer',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::footer(
				array(
					'about'   => 'Estudio de diseño independiente. Identidad, web y dirección de arte para marcas con carácter.',
					'social'  => array( 'instagram' => 'https://instagram.com/', 'linkedin' => 'https://linkedin.com/' ),
					'links'   => array( array( 'Estudio', '#page:estudio' ), array( 'Proyectos', '#page:proyectos' ), array( 'Contacto', '#page:contacto' ) ),
					'contact' => array( array( 'mail', 'hola@tuestudio.com', 'mailto:hola@tuestudio.com' ), array( 'phone', '+52 55 0000 0000', 'tel:+525500000000' ), array( 'map-pin', 'Ciudad de México' ) ),
					'copy'    => '© ' . gmdate( 'Y' ) . ' Tu estudio. Hecho con Lienzo.',
					'bg'      => 'var(--lnz-c-secondary)',
				)
			),
		),
		array( 'title' => 'Minimal: portada', 'type' => 'section', 'conditions' => array(), 'elements' => array( $hero ) ),
		array( 'title' => 'Minimal: servicios', 'type' => 'section', 'conditions' => array(), 'elements' => array( $services ) ),
		array( 'title' => 'Minimal: proyectos', 'type' => 'section', 'conditions' => array(), 'elements' => array( $projects ) ),
		array( 'title' => 'Minimal: proceso', 'type' => 'section', 'conditions' => array(), 'elements' => array( $process ) ),
		array( 'title' => 'Minimal: llamada a la acción', 'type' => 'section', 'conditions' => array(), 'elements' => array( $cta ) ),
	),
	'pages'     => array(
		array( 'key' => 'home', 'title' => 'Inicio', 'front' => 'yes', 'elements' => array( $hero, $services, $projects, $about, $testimonials, $cta ) ),
		array(
			'key'      => 'estudio',
			'title'    => 'Estudio',
			'elements' => array(
				K::page_header( 'El estudio', 'Diseñamos marcas y sitios web con un proceso sencillo y cercano.' ),
				$about,
				$process,
				K::stats( array( array( 120, '+', 'Proyectos' ), array( 10, '', 'Años' ), array( 98, '%', 'Clientes que repiten' ) ) ),
				$cta,
			),
		),
		array(
			'key'      => 'proyectos',
			'title'    => 'Proyectos',
			'elements' => array( K::page_header( 'Proyectos', 'Identidades, sitios web y campañas para marcas pequeñas con grandes ideas.' ), $projects, $testimonials, $cta ),
		),
		array(
			'key'      => 'contacto',
			'title'    => 'Contacto',
			'elements' => array(
				K::contact(
					'Contacto',
					'Hablemos de tu proyecto',
					'Cuéntanos qué necesitas. Respondemos en menos de 24 horas en días laborables.',
					array( array( 'mail', 'hola@tuestudio.com', 'mailto:hola@tuestudio.com' ), array( 'phone', '+52 55 0000 0000', 'tel:+525500000000' ), array( 'clock', 'Lunes a viernes, de 9:00 a 18:00' ) ),
					array( 'button' => $P, 'section' => array( 'padding' => K::box( 96, 20 ) ) )
				),
			),
		),
	),
);
