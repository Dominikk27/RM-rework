import xml.etree.ElementTree as ET
from abc import ABC, abstractmethod
from pathlib import Path
from typing import List


class ProductParser(ABC):
    @abstractmethod
    def parse(self, raw) -> list[dict]:
        pass

    def parse_file(self, path) -> list[dict]:
        raw = Path(path).read_text(encoding="utf-8", errors="replace")
        return self.parse(raw)

    @staticmethod
    def _text(el, tag, default=""):
        child = el.find(tag)
        return child.text.strip() if child is not None and child.text else default

    @staticmethod
    def _html_text(el, tag, default=""):
        child = el.find(tag)
        if child is None:
            return default
        inner = child.text or ""
        for sub in child:
            inner += ET.tostring(sub, encoding="unicode")
        return inner.strip()

    @staticmethod
    def _float(el, tag):
        val = SupaXMLParser._text(el, tag)
        try:
            return float(val.replace(",","."))
        except ValueError:
            return None

    @staticmethod
    def _int(el, tag):
        val = SupaXMLParser._text(el, tag)
        try:
            return int(val)
        except ValueError:
            return None

    @staticmethod
    def _images(el, main_tag, container_tag):
        images = []

        firstImg = el.find(main_tag)

        if firstImg is not None and firstImg.text:
            images.append(firstImg.text.strip())

        containerImgs = el.find(container_tag)
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

    @staticmethod
    def _json_format(el, container_tag):
        container = el.find(container_tag)
        result = {}
        if container is not None:
            for child in container:
                if child.text and child.text.strip():
                    result[child.tag] = child.text.strip()
        return result
                

class SupaXMLParser(ProductParser):
    def parse(self, raw) -> list[dict]:
        try:
            root = ET.fromstring(raw)
        except ET.ParseError:
            root = ET.fromstring(f"<root>{raw}</root>")

        return [self._parse_product(el) for el in root.iter("PRODUCT")]

    def _parse_product(self, el) -> dict:
        return {
            "kod_produktu": self._text(el, "KOD_PRODUKTU"),
            "nazov": self._text(el, "NAZOV_TOVARU"),
            "brand": self._text(el, "VYROBCA"),
            "cena_b2c": self._float(el, "CENA_B2C"),
            "cena_bez_dph": self._float(el, "CENA_BEZ_DPH"),
            "technical_description": self._json_format(el, "TECHNICKE_UDAJE"),
            "in_stock": self._int(el, "SKLADOM"),
            "description": self._html_text(el, "POPIS"),
            "images": self._images(el, "LINK_NA_OBRAZOK", "MEDIA"),
            "zaradenie_v_strome": self._int(el, "ZARADENIE_V_STROME")
        }


class StihlXMLParser(ProductParser):
    def parse(self, raw) -> list[dict]:
            try:
                root = ET.fromstring(raw)
            except ET.ParseError:
                root = ET.fromstring(f"<root>{raw}</root>")
    
            return [self._parse_product(el) for el in root.iter("item")]

    