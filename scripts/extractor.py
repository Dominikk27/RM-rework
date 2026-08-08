import unicodedata as unicode
import re

class Extractor:

    @staticmethod
    def brands(products):
        brands = {}

        for product in products:
            brand = product.get("brand")

            if not brand:
                continue

            brand = brand.strip()

            if not brand:
                continue

            brands[brand.lower()] = brand

        return list(brands.values())

    def slug(val):
        val = unicode.normalize('NFKD', val).encode('ascii', 'ignore').decode('ascii')
        val = val.strip().lower()
        val = re.sub(r'[^a-z0-9]+', '-', val)
        return val.strip('-')