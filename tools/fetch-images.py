"""
Descarga las fotos de los kits desde picsum.photos (fotos de Unsplash,
licencia Unsplash) y las guarda en WebP en kits/<kit>/img/.

Uso: python tools/fetch-images.py
"""
import io
import os
import urllib.request
from PIL import Image

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

# kit => [(nombre, id de picsum, ancho, alto)]
IMAGES = {
    'minimal': [
        ('hero', 532, 1600, 1000), ('estudio', 9, 1200, 900), ('proyecto-1', 20, 900, 700), ('proyecto-2', 36, 900, 700),
        ('proyecto-3', 1068, 900, 700), ('proyecto-4', 526, 900, 700), ('proyecto-5', 1081, 900, 700), ('proyecto-6', 60, 900, 700),
        ('retrato', 1005, 800, 1000),
    ],
    'corporativo': [
        ('hero', 1031, 1600, 1000), ('equipo', 7, 1200, 900), ('reunion', 3, 1200, 900), ('oficina', 445, 1200, 900),
        ('ciudad', 238, 1600, 900), ('persona-1', 1005, 600, 600), ('persona-2', 1027, 600, 600), ('persona-3', 64, 600, 600),
    ],
    'calido': [
        ('hero', 1060, 1600, 1000), ('cocina', 292, 1200, 900), ('cafe', 431, 900, 700), ('granos', 425, 900, 700),
        ('desayuno', 493, 900, 700), ('frutos', 1080, 900, 700), ('local', 42, 1200, 900), ('terraza', 437, 1200, 900),
        ('mesa', 999, 1200, 900), ('te', 225, 900, 700),
    ],
    'tienda': [
        ('hero', 1059, 1600, 1000), ('accesorios', 26, 900, 900), ('camara', 250, 900, 900), ('taza', 30, 900, 900),
        ('maquina', 486, 900, 900), ('reloj', 357, 900, 900), ('tocadiscos', 39, 900, 900), ('cuadernos', 535, 900, 900),
        ('taller', 528, 1200, 900), ('fotografa', 454, 1200, 900),
    ],
}

for kit, images in IMAGES.items():
    folder = os.path.join(ROOT, 'kits', kit, 'img')
    os.makedirs(folder, exist_ok=True)
    for name, pid, w, h in images:
        path = os.path.join(folder, name + '.webp')
        if os.path.exists(path):
            continue
        data = urllib.request.urlopen(f'https://picsum.photos/id/{pid}/{w}/{h}', timeout=60).read()
        Image.open(io.BytesIO(data)).convert('RGB').save(path, 'WEBP', quality=78, method=6)
        print(kit, name, os.path.getsize(path) // 1024, 'KB')
