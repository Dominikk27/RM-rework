import json
from pathlib import Path


class SaveSystem:

    @staticmethod
    def save(products, file_name):
        path = "./output/" + file_name
        with open(path, "w", encoding="utf-8") as f:
            json.dump(products, f, ensure_ascii=False, indent=4)