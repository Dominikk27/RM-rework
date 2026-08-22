<?php
    require_once __DIR__ . '/config/database.php';


    function getProducts(
                    PDO $pdo,
                    ?array $brandSlug = null,
                    ?float $min = null,
                    ?float $max = null, 
                    ?string $categorySlug = null,
                    int $page = 1,
                    int $productsPerPage = 24
    ): array{
        // $pdo = getPDO();
        $page = max(1, $page);
        $offset = ($page - 1) * $productsPerPage;
        

        $joins = "
            FROM products p
            LEFT JOIN brands_new b ON b.id = p.brand_id
            LEFT JOIN product_categories pc ON pc.product_id = p.id
            LEFT JOIN categories c ON c.id = pc.category_id
            WHERE 1=1
        ";

        $params = [];

        if(!empty($brandSlug)) {
            $placeholders = [];

            foreach ($brandSlug as $index => $slug){
                $key = "brand_$index";
                $placeholders[] = ":$key";
                $params[$key] = $slug;
            }

            $joins .= " AND b.slug IN (" . implode(',', $placeholders) . ")";
        }

        if($min !== null){
            $joins .= " AND p.price_b2c >= :min";
            $params['min'] = $min;
        }


        if($max !== null){
            $joins .= " AND p.price_b2c <= :max";
            $params['max'] = $max;
        }

        if ($categorySlug !== null){
            $joins .= " AND c.slug = :category_slug";
            $params['category_slug'] = $categorySlug;
        }

        $countRows = "SELECT COUNT(DISTINCT p.name) AS total $joins";
        $countStmt = $pdo->prepare($countRows);
        $countStmt->execute($params);
        $total = (int)$countStmt->fetchColumn();

        $query = "
                    SELECT
                        DISTINCT p.name,
                        p.id,
                        p.product_code,
                        p.price_b2c,
                        p.images,
                        b.name AS brand_name,
                        b.slug AS brand_slug
                    $joins
                    AND p.price_b2c > 0
                    GROUP BY p.id
                    ORDER BY p.name ASC
                    LIMIT :limit OFFSET :offset
        ";


        $stmt = $pdo->prepare($query);
        foreach ($params as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':limit', $productsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $rows = $stmt->fetchAll();
        
        foreach ($rows as &$row){
            $decoded = json_decode($row['images'] ?? '[]', true);
            $row['images'] = is_array($decoded) ? $decoded : [];
        }
        unset($row);

        return [
            'items' => $rows,
            'total' => $total,
            'page' => $page,
            'perPage' => $productsPerPage,
            'totalPages' => (int)ceil($total / $productsPerPage),
        ];
    }


    function getBrandsFilter(): array {
        $pdo = getPDO();
        $query = "
                SELECT DISTINCT
                    b.id,
                    b.name,
                    b.slug,
                FROM brands_new b
                INNER JOIN products p ON p.brand_id = b.id
                ORDER BY b.name ASC
        ";

        return $pdo->query($query)->fetchAll();
    }

?>