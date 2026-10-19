"""
Empaqueta theme/lienzo-theme en theme/lienzo-theme.zip (con la carpeta
lienzo-theme/ dentro, como la espera WordPress) y escribe theme/version.json,
que el plugin consulta para avisar de versiones nuevas.

El zip de cada versión se descarga de su etiqueta de git (theme-v<versión>),
así la caché de jsDelivr nunca sirve uno viejo. Después de generar:

    git add -A && git commit -m "Tema X.Y.Z" && git tag theme-vX.Y.Z && git push --follow-tags

Uso: python tools/build-theme.py "Novedades de esta versión"
"""
import json
import os
import re
import sys
import zipfile

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SRC = os.path.join(ROOT, 'theme', 'lienzo-theme')
OUT = os.path.join(ROOT, 'theme', 'lienzo-theme.zip')

with zipfile.ZipFile(OUT, 'w', zipfile.ZIP_DEFLATED) as z:
    for folder, _, files in os.walk(SRC):
        for name in sorted(files):
            path = os.path.join(folder, name)
            z.write(path, os.path.join('lienzo-theme', os.path.relpath(path, SRC)).replace(os.sep, '/'))

style = open(os.path.join(SRC, 'style.css'), encoding='utf-8').read()
header = lambda name: re.search(r'^' + name + r':\s*(.+)$', style, re.M).group(1).strip()
version = header('Version')
manifest = {
    'version': version,
    'package': f'https://cdn.jsdelivr.net/gh/Rainholder/lienzo-kits@theme-v{version}/theme/lienzo-theme.zip',
    'url': 'https://github.com/Rainholder/lienzo-kits',
    'requires': header('Requires at least'),
    'requires_php': header('Requires PHP'),
    'changes': sys.argv[1] if len(sys.argv) > 1 else '',
}
with open(os.path.join(ROOT, 'theme', 'version.json'), 'w', encoding='utf-8', newline='\n') as f:
    json.dump(manifest, f, ensure_ascii=False, indent='\t')
    f.write('\n')
print(OUT, os.path.getsize(OUT) // 1024, 'KB · versión', version)
