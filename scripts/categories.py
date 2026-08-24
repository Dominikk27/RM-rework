import re
from extractor import Extractor

class CategoryManager:

    CATEGORY_MAPPING = {
        "Píly": [
            "pila",
            "píla",
            "motorova pila",
            "motorová píla",
        ],

        "Krovinorezy": [
            "krovinorez",
        ],

        "Kosačky": [
            "kosa",
            "kosačka",
            "kosacka",
            "zaci stroj",
            "zací stroj",
        ],

        "Traktory": [
            "traktor",
            "malotraktor",
        ],

        "Rotavátory": [
            "rotavator",
            "rotavátor",
        ],

        "Pluhy": [
            "pluh",
        ],

        "Mulčovače": [
            "mulcovac",
            "mulčovač",
        ],

        "Drviče": [
            "drvic",
            "drvič",
        ],

        "Postrekovače": [
            "postrekovac",
            "postrekovač",
        ],

        "Čerpadlá": [
            "cerpadlo",
            "čerpadlo",
        ],

        "Elektrocentrály": [
            "elektrocentrala",
            "elektrocentrála",
        ],

        "Snehová technika": [
            "sneh",
            "snehova radlica",
            "snehová radlica",
            "freza na sneh",
        ],

        "Ochranné pomôcky": [
            "rukavice",
            "prilba",
            "okuliare",
            "sluchadla",
            "zatky do usi",
        ],

        "Oleje a mazivá": [
            "olej",
        ],

        "Silony a struny": [
            "silon",
        ],
    }

    def __init__(self, db_connection):
        self.db = db_connection
        self.category_cache = {}

    def setup_categories(self):
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

    def normalize_text(self, text):
        text = text.lower()
        text = re.sub(r"\s+", " ", text)
        return text.strip()

    def identify_category(self, product_name, description=""):
        """
        Určí kategóriu produktu podľa názvu a popisu.
        """

        text = self.normalize_text(
            f"{product_name} {description}"
        )

        for category, keywords in self.CATEGORY_MAPPING.items():

            for keyword in keywords:
                keyword = self.normalize_text(keyword)

                # celé slovo
                pattern = rf"\b{re.escape(keyword)}\b"

                if re.search(pattern, text):
                    return category

        return "Ostatné"

    def get_category_id(self, product):
        """
        Vráti ID kategórie produktu.
        """

        category_name = self.identify_category(
            product.get("nazov", ""),
            product.get("description", "")
        )

        return self.category_cache.get(category_name)

    def assign_product_category(self, product_id, category_id):
        """
        Priradí produkt ku kategórii v products_category.
        """

        query = """
            INSERT IGNORE INTO products_category
                (product_id, category_id)
            VALUES (%s, %s)
        """

        self.db.execute(
            query,
            (product_id, category_id)
        )