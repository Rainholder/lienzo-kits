# Lienzo Kits

Kits de diseño y tema para [Lienzo](https://github.com/Rainholder), el constructor visual ligero para WordPress.

- `kits/index.json`: catálogo de kits que lee el plugin (nombre, descripción, miniatura, versión).
- `kits/<id>/kit.json`: el kit (globales, estilo del sitio, cabecera, pie, secciones y páginas).
- `kits/<id>/preview.webp`: miniatura para la galería.
- `theme/`: tema «Lienzo», 100 % compatible con el plugin.

El plugin descarga los archivos desde jsDelivr:
`https://cdn.jsdelivr.net/gh/Rainholder/lienzo-kits@main/kits/index.json`
