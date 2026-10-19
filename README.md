# Lienzo Kits

Kits de diseño y tema para Lienzo, el constructor visual ligero para WordPress.

## Kits

| Kit | Para | Estilo |
|---|---|---|
| Minimal | Estudios creativos, fotógrafos, freelance | Blanco y negro, un acento, esquinas rectas |
| Corporativo | Despachos, consultoras, empresas de servicios | Azul, cifras, casos de éxito y planes |
| Cálido | Cafeterías, restaurantes, panaderías | Tonos tierra, serifa, carta y reservas |
| Tienda | Tiendas en línea (mejor con WooCommerce) | Píldoras, tarjetas de producto, boletín |

Cada kit trae colores, fuentes, estilos de botón, estilo del sitio, cabecera, pie, secciones para «Mis diseños» y 4 páginas.

## Estructura

- `kits/index.json`: catálogo que lee el plugin (nombre, descripción, colores, miniatura, versión).
- `kits/<id>/kit.json`: el kit (formato `lienzo-design-kit`). Las imágenes van como `{{kit}}/img/…` y el plugin las copia a la biblioteca de medios al aplicar el kit.
- `kits/<id>/preview.webp`: miniatura de la galería (800×600).
- `kits/<id>/img/`: fotos del kit en WebP.
- `tools/`: generador de kits.
- `theme/lienzo-theme/`: tema «Lienzo», 100 % compatible con el plugin; `theme/lienzo-theme.zip` es lo que instala el plugin (se genera con `python tools/build-theme.py`).

El plugin lee de `https://cdn.jsdelivr.net/gh/Rainholder/lienzo-kits@main/kits/`.

## Tema Lienzo

Tema clásico ligero (unos 13 KB de código; el zip pesa unos 110 KB por la captura): usa los colores, fuentes y estilo del sitio de Lienzo en todas las páginas (declara `add_theme_support( 'lienzo' )`) y deja que Lienzo pinte cabecera, pie y páginas; si no hay plantillas de Lienzo, trae su propia cabecera, pie, blog, entrada, 404, comentarios y WooCommerce. Traducido al español. El plugin lo sugiere en un aviso con instalación y activación en un clic.

Al cambiar el tema: sube `Version` en `style.css` y `LIENZO_THEME_VERSION` en `functions.php`, regenera el zip y, si cambian textos, el `.pot`/`.po`/`.mo` de `languages/`.

## Generar los kits

Los kits se escriben en PHP (`tools/kits/<id>.php`, con las piezas de `tools/lib.php`) y se generan dentro de un WordPress con Lienzo, que comprueba cada ajuste con su saneador:

```
wp eval-file C:/lienzo-kits/tools/build.php
```

Si un ajuste no existe o Lienzo lo cambia, el generador lo avisa. Al publicar un cambio, sube la versión del kit en su archivo (`meta.version`): el plugin guarda cada versión en caché.

Las fotos se descargan con `python tools/fetch-images.py`.

## Créditos

Las fotos son de [Unsplash](https://unsplash.com) (servidas por [Lorem Picsum](https://picsum.photos)) y se usan bajo la [licencia de Unsplash](https://unsplash.com/license): libres para uso comercial y personal, sin atribución obligatoria. Los ids de cada foto están en `tools/fetch-images.py`.

Fuentes: Google Fonts (licencia SIL Open Font License), alojadas en el servidor de cada sitio por Lienzo.
