"""
Empaqueta theme/lienzo-theme en theme/lienzo-theme.zip (con la carpeta
lienzo-theme/ dentro, como la espera WordPress).

Uso: python tools/build-theme.py
"""
import os
import zipfile

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SRC = os.path.join(ROOT, 'theme', 'lienzo-theme')
OUT = os.path.join(ROOT, 'theme', 'lienzo-theme.zip')

with zipfile.ZipFile(OUT, 'w', zipfile.ZIP_DEFLATED) as z:
    for folder, _, files in os.walk(SRC):
        for name in sorted(files):
            path = os.path.join(folder, name)
            z.write(path, os.path.join('lienzo-theme', os.path.relpath(path, SRC)).replace(os.sep, '/'))
print(OUT, os.path.getsize(OUT) // 1024, 'KB')
