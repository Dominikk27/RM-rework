<?php 

    function getFilterOptions(PDO $pdo): array {
        

        $filters = [];


        $brands_query = "
            SELECT DISTINCT b.name, b.slug 
            FROM brands_new b
            INNER JOIN products p ON p.brand_id = b.id
            WHERE b.name IS NOT NULL
            ORDER BY b.name
        ";

        $stmt = $pdo->prepare($brands_query);

        $stmt->execute();

        $filters['brands'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $filters;
    }
?>