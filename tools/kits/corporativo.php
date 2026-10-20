<?php
/**
 * Kit «Corporativo»: despacho, consultora o empresa de servicios. Azul de
 * confianza, tarjetas con sombra suave y cifras.
 */

use LienzoKits\K;

$P = 'co-p';
$S = 'co-s';
$W = 'co-w'; // Blanco sobre fondo oscuro.

$hero = K::hero_image(
	array(
		'eyebrow' => 'Consultoría para empresas en crecimiento',
		'title'   => 'Decisiones claras para crecer con seguridad.',
		'lead'    => 'Acompañamos a pymes y empresas medianas en estrategia, finanzas y procesos, con un equipo senior que habla tu idioma.',
		'buttons' => array( K::button( 'Agenda una llamada', '#page:contacto', $P ), K::button( 'Nuestros servicios', '#page:servicios', $W ) ),
		'image'   => 'hero',
		'overlay' => 'rgba(11,27,63,.72)',
		'size'    => 60,
	)
);

$stats = K::stats(
	array( array( 250, '+', 'Empresas asesoradas' ), array( 18, '', 'Años de experiencia' ), array( 35, '%', 'Crecimiento medio' ), array( 4.9, '', 'Valoración de clientes' ) )
);

$services = K::features(
	'Servicios',
	'Soluciones a la medida de tu empresa',
	'Elegimos contigo lo que de verdad mueve tus resultados.',
	array(
		array( 'briefcase', 'Estrategia', 'Plan de negocio, objetivos y prioridades para los próximos 12 meses.' ),
		array( 'zap', 'Procesos', 'Menos pasos, menos errores: operaciones más ágiles y medibles.' ),
		array( 'shield', 'Finanzas y riesgos', 'Flujo de caja, costos y controles para decidir con datos.' ),
		array( 'users', 'Talento', 'Estructura, perfiles y liderazgo para el equipo que necesitas.' ),
		array( 'globe', 'Expansión', 'Nuevos mercados y canales con un plan realista.' ),
		array( 'award', 'Calidad', 'Certificaciones y mejora continua sin burocracia.' ),
	),
	array( 'view' => 'stacked', 'icon_bg' => 'var(--lnz-surface-2)', 'section' => array( 'bg_color' => '#ffffff' ) )
);

$why = K::image_text(
	array(
		'eyebrow' => 'Por qué elegirnos',
		'title'   => 'Un socio, no un informe más.',
		'text'    => 'Trabajamos dentro de tu empresa, con tu equipo y con metas concretas. Medimos cada mes y ajustamos el rumbo cuando hace falta.',
		'list'    => array( 'Consultores con experiencia directiva', 'Resultados medibles desde el primer trimestre', 'Honorarios claros y sin letra pequeña' ),
		'buttons' => array( K::button( 'Conoce al equipo', '#page:nosotros', $S ) ),
		'image'   => 'reunion',
		'alt'     => 'Reunión de trabajo con un cliente',
		'radius'  => 12,
	)
);

$testimonials = K::testimonials(
	'Casos de éxito',
	'Empresas que ya crecen con nosotros',
	array(
		array( 'En seis meses ordenamos las finanzas y abrimos una segunda sucursal sin perder el control.', 'Laura Méndez', 'Directora general, Grupo Alba', 'persona-2' ),
		array( 'Nos ayudaron a dejar de apagar fuegos. Hoy el equipo sabe qué es prioritario cada semana.', 'Ricardo Torres', 'Socio, Torres & Asociados', 'persona-1' ),
		array( 'Profesionales, cercanos y muy prácticos. Las reuniones siempre terminan con tareas claras.', 'Sofía Ramírez', 'COO, Nexo Logística', 'persona-3' ),
	)
);

$pricing = K::pricing(
	'Planes',
	'Formas de trabajar juntos',
	'Empieza por un diagnóstico y sigue solo si te aporta valor.',
	array(
		array( 'plan' => 'Diagnóstico', 'desc' => 'Para saber por dónde empezar', 'price' => '9,900', 'period' => 'MXN', 'features' => array( 'Análisis de 2 semanas', 'Informe con prioridades', 'Sesión de presentación', '-Acompañamiento mensual' ), 'button' => 'Solicitar' ),
		array( 'plan' => 'Acompañamiento', 'desc' => 'El más elegido por pymes', 'price' => '24,900', 'period' => 'MXN/mes', 'badge' => 'Recomendado', 'features' => array( 'Consultor asignado', '4 sesiones al mes', 'Panel de indicadores', 'Soporte por correo' ), 'button' => 'Empezar' ),
		array( 'plan' => 'Proyecto', 'desc' => 'Un objetivo concreto con fecha', 'price' => 'A medida', 'currency' => '', 'period' => '', 'features' => array( 'Equipo dedicado', 'Plan y calendario cerrados', 'Informe de resultados', 'Garantía de entrega' ), 'button' => 'Hablemos' ),
	),
	array( 'primary' => $P, 'secondary' => $S, 'section' => array( 'bg_color' => 'var(--lnz-surface)' ) )
);

$team = K::team(
	'Equipo',
	'Las personas detrás de cada proyecto',
	array(
		array( 'Ricardo Peña', 'Socio director', 'persona-1', 'Veinte años dirigiendo empresas de servicios.' ),
		array( 'Mariana Ortiz', 'Finanzas', 'persona-2', 'Especialista en flujo de caja y costos.' ),
		array( 'Lucía Herrera', 'Procesos y talento', 'persona-3', 'Convierte el caos en rutinas que funcionan.' ),
	),
	array( 'shape' => 'circle' )
);

$faq = K::faq(
	'Preguntas frecuentes',
	'Lo que suelen preguntarnos',
	array(
		array( '¿Con qué tamaño de empresa trabajan?', 'Sobre todo con empresas de 10 a 250 personas, aunque hacemos diagnósticos para negocios más pequeños.' ),
		array( '¿Cuánto tarda en notarse el cambio?', 'Las primeras mejoras suelen verse en el primer trimestre; fijamos indicadores desde el inicio para medirlo.' ),
		array( '¿Trabajan de forma remota?', 'Sí. Combinamos sesiones en línea con visitas presenciales cuando aportan valor.' ),
		array( '¿Firman acuerdo de confidencialidad?', 'Siempre, antes de recibir cualquier información de tu empresa.' ),
	)
);

$cta = K::cta_band(
	'Hablemos de tus objetivos',
	'Una llamada de 30 minutos, sin compromiso, para entender tu situación y decirte si podemos ayudarte.',
	array( K::button( 'Agenda una llamada', '#page:contacto', $W ) ),
	array( 'section' => array( 'bg_color' => 'var(--lnz-c-secondary)' ) )
);

$contact_info = array(
	array( 'map-pin', 'Paseo de la Reforma 222, Ciudad de México' ),
	array( 'phone', '+52 55 0000 0000', 'tel:+525500000000' ),
	array( 'mail', 'contacto@tuempresa.com', 'mailto:contacto@tuempresa.com' ),
	array( 'clock', 'Lunes a viernes, de 9:00 a 18:00' ),
);

return array(
	'meta'      => array(
		'order'       => 2,
		'name'        => 'Corporativo',
		'premium'     => true,
		'description' => 'Para despachos, consultoras y empresas de servicios. Azul de confianza, cifras, casos de éxito y planes.',
		'version'     => '1.0.0',
		'tags'        => array( 'Empresa', 'Consultoría', 'Servicios' ),
	),
	'globals'   => array(
		'colors'  => array(
			array( 'id' => 'primary', 'value' => '#1d4ed8' ),
			array( 'id' => 'secondary', 'value' => '#0b1b3f' ),
			array( 'id' => 'text', 'value' => '#0f172a' ),
			array( 'id' => 'accent', 'value' => '#f59e0b' ),
		),
		'fonts'   => array(
			array( 'id' => 'primary', 'family' => 'manrope' ),
			array( 'id' => 'text', 'family' => 'inter' ),
		),
		'buttons' => array(
			array( 'id' => $P, 'name' => 'Corporativo: principal', 'bg' => 'var(--lnz-c-primary)', 'color' => '#ffffff', 'hoverBg' => 'var(--lnz-c-secondary)', 'radius' => '8', 'padY' => '14', 'padX' => '26', 'weight' => '700' ),
			array( 'id' => $S, 'name' => 'Corporativo: contorno', 'bg' => 'transparent', 'color' => 'var(--lnz-c-primary)', 'border' => '2', 'borderColor' => 'var(--lnz-c-primary)', 'hoverBg' => 'var(--lnz-c-primary)', 'hoverColor' => '#ffffff', 'radius' => '8', 'padY' => '12', 'padX' => '24', 'weight' => '700' ),
			array( 'id' => $W, 'name' => 'Corporativo: blanco', 'bg' => '#ffffff', 'color' => 'var(--lnz-c-secondary)', 'hoverBg' => 'var(--lnz-c-accent)', 'radius' => '8', 'padY' => '14', 'padX' => '26', 'weight' => '700' ),
		),
		'style'   => array(
			'radius'         => '8',
			'shadow'         => 'sm',
			'line'           => '#e2e8f0',
			'surface'        => '#f5f7fb',
			'surface2'       => '#e8eefc',
			'muted'          => '#5b6b84',
			'textColor'      => '#1e293b',
			'textSize'       => '17',
			'textLine'       => '1.65',
			'linkColor'      => 'var(--lnz-c-primary)',
			'headingColor'   => '#0b1b3f',
			'headingWeight'  => '800',
			'headingSpacing' => '-0.015em',
			'headingLine'    => '1.15',
		),
	),
	'templates' => array(
		array(
			'title'      => 'Corporativo: cabecera',
			'type'       => 'header',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::header( array( 'cta' => array( 'Contáctanos', '#page:contacto', $P ) ) ),
		),
		array(
			'title'      => 'Corporativo: pie',
			'type'       => 'footer',
			'conditions' => array( array( 'rule' => 'all' ) ),
			'elements'   => K::footer(
				array(
					'about'   => 'Consultoría en estrategia, finanzas y procesos para empresas que quieren crecer con orden.',
					'social'  => array( 'linkedin' => 'https://linkedin.com/', 'x' => 'https://x.com/', 'youtube' => 'https://youtube.com/' ),
					'links'   => array( array( 'Servicios', '#page:servicios' ), array( 'Nosotros', '#page:nosotros' ), array( 'Contacto', '#page:contacto' ) ),
					'contact' => $contact_info,
					'copy'    => '© ' . gmdate( 'Y' ) . ' Tu empresa. Todos los derechos reservados.',
				)
			),
		),
		array( 'title' => 'Corporativo: portada', 'type' => 'section', 'conditions' => array(), 'elements' => array( $hero ) ),
		array( 'title' => 'Corporativo: cifras', 'type' => 'section', 'conditions' => array(), 'elements' => array( $stats ) ),
		array( 'title' => 'Corporativo: servicios', 'type' => 'section', 'conditions' => array(), 'elements' => array( $services ) ),
		array( 'title' => 'Corporativo: casos de éxito', 'type' => 'section', 'conditions' => array(), 'elements' => array( $testimonials ) ),
		array( 'title' => 'Corporativo: planes', 'type' => 'section', 'conditions' => array(), 'elements' => array( $pricing ) ),
		array( 'title' => 'Corporativo: preguntas frecuentes', 'type' => 'section', 'conditions' => array(), 'elements' => array( $faq ) ),
	),
	'pages'     => array(
		array( 'key' => 'home', 'title' => 'Inicio', 'front' => 'yes', 'elements' => array( $hero, $stats, $services, $why, $testimonials, $cta ) ),
		array(
			'key'      => 'servicios',
			'title'    => 'Servicios',
			'elements' => array( K::page_header( 'Servicios', 'Estrategia, finanzas, procesos y talento para empresas en crecimiento.', array( 'image' => 'oficina' ) ), $services, $pricing, $faq, $cta ),
		),
		array(
			'key'      => 'nosotros',
			'title'    => 'Nosotros',
			'elements' => array( K::page_header( 'Nosotros', 'Un equipo senior con una forma de trabajar cercana y práctica.', array( 'image' => 'equipo' ) ), $why, $stats, $team, $cta ),
		),
		array(
			'key'      => 'contacto',
			'title'    => 'Contacto',
			'elements' => array(
				K::contact( 'Contacto', 'Agenda una llamada', 'Cuéntanos tu situación y te proponemos el siguiente paso en menos de un día hábil.', $contact_info, array( 'button' => $P, 'address' => 'Paseo de la Reforma 222, Ciudad de México' ) ),
			),
		),
	),
);
