from product_parser import SupaXMLParser, StihlXMLParser
from save import SaveSystem


def main():
    parserSupa = SupaXMLParser()
    products = parserSupa.parse_file("./data/productsSupa.xml")
    print(f"{len(products)}")

    SaveSystem.save(products, "supa.json")

    parserStihl = StihlXMLParser()
    products = parserStihl.parse_file("./data/productsStihl.xml")
    print(f"{len(products)}")

    SaveSystem.save(products, "stihl.json")




if __name__ == "__main__":
    main()


