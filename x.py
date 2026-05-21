#!/usr/bin/env python3

from pathlib import Path
import re

ceremonies = {
    "B": "Baptism",
    "C": "Confirmation",
    "D": "Burial",
    "M": "Marriage",
}

root = Path(".")

for path in root.glob("*/*.md"):   # subfolders only, not parent folder
    match = re.search(r"-([BCDM])-", path.name)
    if not match:
        continue

    ceremony = ceremonies[match.group(1)]

    text = path.read_text(encoding="utf-8")
    new_text = re.sub(
        r"(?m)^## Image\s*$",
        f"## {ceremony} Image",
        text
    )

    if new_text != text:
        path.write_text(new_text, encoding="utf-8")
        print(f"Updated: {path}")
