import json
from datetime import datetime

from product_parser import SupaXMLParser, StihlXMLParser
from group import ProductGrouper, GroupingRule
from save import SaveSystem

from extractor import Extractor
from categories import CategoryManager

from database import MYSQLDatabase as Database

RULES = [
    GroupingRule("SILON", group_by=["farba", "prevedenie"], variant_by=["priemer", "dlzka"]),
    GroupingRule("RUKAVICE", group_by=[], variant_by=["velkost"]),
    GroupingRule("rezný kotúč", group_by=["oznacenie"], variant_by=["rozmer"]),
    GroupingRule("rozbrusovaci kotuc", group_by=["typ"], variant_by=["priemer_kotuca", "hrubka"]),
]

def main():
    parserSupa = SupaXMLParser()
    productsSupa = parserSupa.parse_file("./data/productsSupa.xml")
    print(f"{len(productsSupa)}")

    SaveSystem.save(productsSupa, "supa.json")

    parserStihl = StihlXMLParser()
    productsStihl = parserStihl.parse_file("./data/productsStihl.xml")
    print(f"{len(productsStihl)}")

    SaveSystem.save(productsStihl, "stihl.json")

    combine = productsSupa + productsStihl
    print(f"{len(combine)}")
    SaveSystem.save(combine, "combined.json")

    grouper = ProductGrouper(RULES)
    groups = grouper.group(combine)

    print(f"po zgrupneni: {len(groups)}")

    SaveSystem.save([g.to_dict() for g in groups], "grouped.json")

    brands = Extractor.brands(combine)
    print(f"Brands: {len(brands)}")

    db = Database()
    db.connect()

    uniqueBrands = Extractor.brands(combine)
    brand_map = {}
    
    for brand in brands:
    
            slug = Extractor.slug(brand)
    
            success = db.execute(
                """
                INSERT IGNORE INTO brands_new
                    (name, slug)
                VALUES
                    (%s, %s)
                """,
                (brand, slug)
            )

            res = db.fetchone("SELECT id FROM brands WHERE name = %s", (brand,))

            if res:
                brand_map[brand] = res[0]
                print(f"Značka: {brand} -> ID: {res[0]}")
    
            if success:
                print(f"Inserted brand: {brand}")

    cat_manager = CategoryManager(db)
    cat_manager.setup_categories()

    for p in combine:
        sku = p.get('kod_produktu')
        brand_id = brand_map.get(p.get('brand'))


    print("Ukladám produkty do novej štruktúry...")
    for p in combine:
        product_code = p.get('kod_produktu')
        brand_id = brand_map.get(p.get('brand'))
        category_id = cat_manager.get_category_id(p)
        
        # Príprava JSON polí (podľa tvojho dumpu vyzerajú ako JSON polia/objekty)
        images_json = json.dumps(p.get('images', []), ensure_ascii=False)
        params_json = json.dumps(p.get('technical_description', {}), ensure_ascii=False)
        
        now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

        # Vloženie/Aktualizácia produktu
        query = """
            INSERT INTO products 
                (product_code, name, brand_id, price, price_b2c, description, images, parameters, source, created_at, updated_at)
            VALUES 
                (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
            ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                brand_id = VALUES(brand_id),
                price = VALUES(price),
                price_b2c = VALUES(price_b2c),
                description = VALUES(description),
                images = VALUES(images),
                parameters = VALUES(parameters),
                updated_at = VALUES(updated_at)
        """
        
        db.execute(query, (
            product_code,
            p.get('nazov'),
            brand_id,
            p.get('cena_bez_dph'),
            p.get('cena_b2c'),
            p.get('description'),
            images_json,
            params_json,
            "xml_file",
            now,
            now
        ))

        # 4. Prepojenie s kategóriou (product_categories)
        # Najskôr zistíme ID práve vloženého/upraveného produktu
        res_p = db.fetchone("SELECT id FROM products WHERE product_code = %s", (product_code,))
        if res_p and category_id:
            p_id = res_p[0]
            # Vložíme väzbu do prepojovacej tabuľky
            db.execute(
                "INSERT IGNORE INTO product_categories (product_id, category_id) VALUES (%s, %s)",
                (p_id, category_id)
            )

    print("Hotovo.")
    db.close()









if __name__ == "__main__":
    main()


