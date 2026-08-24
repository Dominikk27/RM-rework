<?php 

    function getBrands(PDO $pdo): array {
        $brands_query = "
            SELECT DISTINCT b.name, b.slug 
            FROM brands_new b
            INNER JOIN products p ON p.brand_id = b.id
            WHERE b.name IS NOT NULL
            ORDER BY b.name
        ";

        $stmt = $pdo->prepare($brands_query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCategories(PDO $pdo): array {
         $query = "
            SELECT DISTINCT c.id, c.name, c.slug
            FROM categories c
            INNER JOIN product_categories pc ON pc.category_id = c.id
            INNER JOIN products p ON p.id = pc.product_id
            ORDER BY c.name DESC
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getFilterOptions(PDO $pdo): array {
        

        $filters = [];


        $filters['brands'] = getBrands($pdo);
        $filters['categories'] = getCategories($pdo);

        return $filters;
    }
?>