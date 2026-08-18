import re
from extractor import Extractor

class CategoryManager:

    CATEGORY_MAPPING = {
        "Píly": ["píla", "pila"],
        "Kosačky": ["kosačka", "kosacka", "robotická"],
        "Záhradná technika": ["krovinorez", "vyžínač", "vrták", "nožnice", "fukár", "jamkovač", "traktor", "parková", "parkova", "píla", "pila"],
        "Príslušenstvo": ["silon", "kotúč", "kotuc", "olej", "mazivo", "hlava", "adaptér", "nabíjačka", "akumulátor"],
        "Ochranné pomôcky": ["rukavice", "prilba", "monterky", "obuv", "okuliare", "bunda", "nohavice"],
    }

    def __init__(self, db_connection):
        self.db = db_connection
        self.category_cache = {}

    def setup_categories(self):
        """Vytvorí kategórie so slugmi v DB a načíta ID do cache."""
        all_cats = list(self.CATEGORY_MAPPING.keys()) + ["Ostatné"]
        
        for name in all_cats:
            slug = Extractor.slug(name)
            
            query = """
                INSERT INTO categories (name, slug) 
                VALUES (%s, %s) 
                ON DUPLICATE KEY UPDATE slug = VALUES(slug)
            """
            self.db.execute(query, (name, slug))
            
            res = self.db.fetchone("SELECT id FROM categories WHERE name = %s", (name,))
            if res:
                self.category_cache[name] = res[0]

    def identify_category(self, product_name, description=""):
        text = f"{product_name} {description}".lower()
        for category, keywords in self.CATEGORY_MAPPING.items():
            for word in keywords:
                if re.search(rf"\b{re.escape(word.lower())}", text):
                    return category
        return "Ostatné"

    def get_category_id(self, product):
        name = self.identify_category(product.get('nazov', ''), product.get('description', ''))
        return self.category_cache.get(name)