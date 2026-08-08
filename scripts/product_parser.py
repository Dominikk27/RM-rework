import xml.etree.ElementTree as ET
from abc import ABC, abstractmethod
from pathlib import Path
from typing import List
import re


class ProductParser(ABC):
    @abstractmethod
    def parse(self, raw) -> list[dict]:
        pass

    def parse_file(self, path) -> list[dict]:
        raw = Path(path).read_text(encoding="utf-8", errors="replace")
        return self.parse(raw)


class XmlReader:
    def __init__(self, namespace = None):
        self.ns = namespace


    def text(self, el, tag, default=""):
        child = el.find(tag, self.ns) if self.ns else el.find(tag)
        return child.text.strip() if child is not None and child.text else default


    def html_text(self, el, tag, default=""):
        child = el.find(tag, self.ns) if self.ns else el.find(tag)
        if child is None:
            return default
        inner = child.text or ""
        for sub in child:
            inner += ET.tostring(sub, encoding="unicode")
        return inner.strip()


    def _float(self, el, tag):
        val = self.text(el, tag)
        val = re.sub(r"[^\d.,]", "", val)

        try:
            return float(val.replace(",","."))
        except ValueError:
            return None


    def _int(self, el, tag):
        val = self.text(el, tag)
        try:
            return int(val)
        except ValueError:
            return None


    def images(self, el, main_tag, container_tag = None):
        images = []

        firstImg = el.find(main_tag, self.ns) if self.ns else el.find(main_tag)

        if firstImg is not None and firstImg.text:
            images.append(firstImg.text.strip())

        if container_tag:
            containerImgs = el.find(container_tag, self.ns) if self.ns else el.find(container_tag)

            if containerImgs is not None:
                for child in containerImgs:
                    if child.text and child.text.strip():
                        images.append(child.text.strip())

        seen = set()
        unique = []

        for url in images:
            if url not in seen:
                seen.add(url)
                unique.append(url)

        return unique

class SupaXMLParser(ProductParser):
    def __init__(self):
        self.reader = XmlReader()

    def parse(self, raw) -> list[dict]:
        try:
            root = ET.fromstring(raw)
        except ET.ParseError:
            root = ET.fromstring(f"<root>{raw}</root>")

        return [self._parse_product(el) for el in root.iter("PRODUCT")]

    def json_format(self, el, container_tag):
        container = el.find(container_tag) if container_tag else None
        result = {}
        if container is not None:
            for child in container:
                if child.text and child.text.strip():
                    result[child.tag] = child.text.strip()
        return result

    def _parse_product(self, el) -> dict:
        reader = self.reader
        return {
            "kod_produktu": reader.text(el, "KOD_PRODUKTU"),
            "nazov": reader.text(el, "NAZOV_TOVARU"),
            "brand": reader.text(el, "VYROBCA"),
            "cena_b2c": reader._float(el, "CENA_B2C"),
            "cena_bez_dph": reader._float(el, "CENA_BEZ_DPH"),
            "technical_description": self.json_format(el, "TECHNICKE_UDAJE"),
            #"in_stock": reader._int(el, "SKLADOM"),
            "description": reader.html_text(el, "POPIS"),
            "images": reader.images(el, "LINK_NA_OBRAZOK", "MEDIA"),
            "zaradenie_v_strome": reader._int(el, "ZARADENIE_V_STROME")
        }


class StihlXMLParser(ProductParser):
    ns = {"g": "http://base.google.com/ns/1.0"}
    def __init__(self):
        self.reader = XmlReader(namespace=self.ns)

    def parse(self, raw) -> list[dict]:
            try:
                root = ET.fromstring(raw)
            except ET.ParseError:
                root = ET.fromstring(f"<root>{raw}</root>")
    
            return [self._parse_product(el) for el in root.iter("item")]

    def json_format(self, el, container_tag) -> dict:
        raw = self.reader.text(el, container_tag)
        result = {}

        if not raw:
            return result

        # Odstráni HTML tagy (<sup>, <i>, ...)
        raw = re.sub(r"<[^>]+>", "", raw)

        # Normalizuje medzery
        raw = re.sub(r"\s+", " ", raw).strip()

        LOWER = "a-záäčďéíĺľňóôŕšťúýž"
        UPPER = "A-ZÁÄČĎÉÍĹĽŇÓÔŔŠŤÚÝŽ"

        # Nájde začiatok ďalšieho názvu parametra
        label_start_re = re.compile(
            rf"\s([{UPPER}][{LOWER}][^{UPPER}]*)"
        )

        parts = [p.strip() for p in raw.split("|") if p.strip()]

        labels = []
        values = []

        i = 0
        while i < len(parts):
            label = parts[i]
            value = parts[i + 1] if i + 1 < len(parts) else ""

            i += 2

            if i < len(parts):
                next_field = parts[i]

                m = label_start_re.search(next_field)

                if m:
                    unit = next_field[:m.start()].strip()
                    next_label = next_field[m.start():].strip()

                    if unit:
                        value = f"{value} {unit}".strip()

                    parts[i] = next_label

            labels.append(label)
            values.append(value)

        for label, value in zip(labels, values):
            result[label] = value

        return result

    def _parse_product(self, el) -> dict:
        reader = self.reader
        return {
            "kod_produktu": reader.text(el, "g:sku"),
            "nazov": reader.text(el, "g:title"),
            "brand": reader.text(el, "g:brand"),
            "cena_b2c": reader._float(el, "g:price"),
            "cena_bez_dph": reader._float(el, "g:sale_price"),
            "technical_description": self.json_format(el, "g:parametre_tab"),
            #"in_stock": reader._int(el, "g:availability"),
            "description": reader.html_text(el, "g:description"),
            "images": reader.images(el, "g:image_link", None),
            "zaradenie_v_strome": reader._int(el, "g:google_product_category")
        }

    