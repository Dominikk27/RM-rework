import re
from collections import defaultdict


class AttributeExtractor:
    COLOR_STEMS = {
        "CERVEN": "CERVENY",
        "ORANZOV": "ORANZOVY",
        "CIERN": "CIERNY",
        "MODR": "MODRY",
        "ZELEN": "ZELENY",
        "ZLT": "ZLTY",
        "BIEL": "BIELY",
        "RUZOV": "RUZOVE",
        "FIALOV": "FIALOVY",
        "HNED": "HNEDY",
        "SIV": "SIVY",
        "TYRKISOV": "TYRKISOVY",
        "STRIEBORN": "STRIEBORNY",
        "ZLAT": "ZLATY",
    }

    RE_PREVEDENIE = re.compile(r"\b(SPIRALOVY|HR\.)(?=\s|$)", re.IGNORECASE)
    RE_ROZMER = re.compile(r"(?P<priemer>\d+[.,]\d+)\s*[-x×X]\s*(?P<dlzka>\d+)\s*M\b\.?", re.IGNORECASE)
    RE_VELKOST = re.compile(r"\b[Cč]\.?\s?(\d{1,2})\b", re.IGNORECASE)

    def __init__(self):
        stems = sorted(self.COLOR_STEMS.keys(), key=len, reverse=True)
        self.re_color = re.compile(r"\b(" + "|".join(stems) + r")\w*\b", re.IGNORECASE)

    def extract(self, name):
        working = name
        attrs = {}

        working, prevedenie = self._extract_one(working, self.RE_PREVEDENIE)
        if prevedenie:
            attrs["prevedenie"] = prevedenie.upper()

        m = self.re_color.search(working)
        if m:
            stem = m.group(1).upper()
            attrs["farba"] = self.COLOR_STEMS[stem]
            working = self.re_color.sub("", working)

        m = self.RE_ROZMER.search(working)
        if m:
            attrs["priemer"] = m.group("priemer").replace(",", ".")
            attrs["dlzka"] = m.group("dlzka") + "M"
            working = self.RE_ROZMER.sub("", working)
        else:
            working, velkost = self._extract_one(working, self.RE_VELKOST)
            if velkost:
                attrs["velkost"] = velkost

        base_name = self._clean(working)
        return base_name, attrs

    @staticmethod
    def _extract_one(text, pattern):
        m = pattern.search(text)
        if not m:
            return text, None
        return pattern.sub("", text), m.group(1)

    @staticmethod
    def _clean(text):
        text = re.sub(r"(?<=\s)-(?=[A-Za-zÀ-ž])", "", text)
        text = re.sub(r"[\s\-–]+$", "", text)
        text = re.sub(r"\s{2,}", " ", text).strip()
        return text


class GroupingRule:
    def __init__(self, match, group_by, variant_by):
        self.match = match
        self.group_by = group_by
        self.variant_by = variant_by

    def matches(self, base_name):
        return self.match.upper() in base_name.upper()


class GroupItems:
    def __init__(self, items):
        self.items = items
        self.master_name = ""
        self.base_name = ""
        self.group_attrs = {}

    def add(self, item):
        self.items.append(item)

    def __len__(self):
        return len(self.items)

    def __repr__(self):
        return f"GroupItems('{self.master_name}', {len(self.items)} items)"

    def to_dict(self):
        return {
            "master_name": self.master_name,
            "base_name": self.base_name,
            "group_attrs": self.group_attrs,
        }


class ProductGrouper:
    DEFAULT_GROUP_BY = []
    DEFAULT_VARIANT_BY = None

    def __init__(self, group_rules=None, extractor=None):
        self.rules = group_rules or []
        self.extractor = extractor or AttributeExtractor()

    def _find_rule(self, base_name):
        for rule in self.rules:
            if rule.matches(base_name):
                return rule
        return None

    def group(self, items):
        buckets = defaultdict(lambda: GroupItems([]))

        for item in items:
            base_name, attrs = self.extractor.extract(item["nazov"])
            rule = self._find_rule(base_name)
            group_by = rule.group_by if rule else self.DEFAULT_GROUP_BY
            variant_by = rule.variant_by if rule else self.DEFAULT_VARIANT_BY

            key = (base_name,) + tuple((k, attrs.get(k, "")) for k in group_by)

            if variant_by is None:
                variant = {k: v for k, v in attrs.items() if k not in group_by}
            else:
                variant = {k: attrs[k] for k in variant_by if k in attrs}

            group = buckets[key]
            group.base_name = base_name
            group.group_attrs = {k: v for k, v in attrs.items() if k not in variant}
            group.add({**item, "variant": variant})

        for group in buckets.values():
            extra = " ".join(str(v) for v in group.group_attrs.values() if v)
            group.master_name = f"{group.base_name} {extra}".strip()

        return list(buckets.values())