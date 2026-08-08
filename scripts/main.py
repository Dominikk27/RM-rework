from product_parser import SupaXMLParser, StihlXMLParser
from group import ProductGrouper, GroupingRule
from save import SaveSystem
from extractor import Extractor
from database import MYSQLDatabase as Database

RULES = [
    GroupingRule("SILON", group_by=["farba", "prevedenie"], variant_by=["priemer", "dlzka"]),
    GroupingRule("RUKAVIC", group_by=[], variant_by=["velkost"]),
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

    #grouper = ProductGrouper(RULES)
    #groups = grouper.group(combine)

    #print(f"po zgrupneni: {len(groups)}")

    #SaveSystem.save([g.to_dict() for g in groups], "grouped.json")

    brands = Extractor.brands(combine)
    print(f"Brands: {len(brands)}")

    db = Database()
    db.connect()


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

        if success:
            print(f"Inserted brand: {brand}")


    db.close()









if __name__ == "__main__":
    main()


