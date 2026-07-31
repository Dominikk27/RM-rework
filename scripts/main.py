from product_parser import SupaXMLParser
from save import SaveSystem


def main():
    parser = SupaXMLParser()
    products = parser.parse_file("./data/productsSupa.xml")
    print(f"{len(products)}")

    SaveSystem.save(products, "supa.json")






if __name__ == "__main__":
    main()


