<?php
    require_once __DIR__ . '/config/database.php';


    function getProducts(
                    PDO $pdo,
                    ?array $brandSlug = null,
                    ?array $categorySlug = null,
                    ?float $min = null,
                    ?float $max = null, 
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

        if (!empty($categorySlug)) {
            $placeholders = [];

            foreach($categorySlug as $index => $category){
                $key = "category_$index";
                $placeholders[] = ":$key";
                $params[$key] = $category;
            }

            $joins .= " AND c.slug IN (" . implode(',', $placeholders) . ")";
        }

        if($min !== null){
            $joins .= " AND p.price_b2c >= :min";
            $params['min'] = $min;
        }


        if($max !== null){
            $joins .= " AND p.price_b2c <= :max";
            $params['max'] = $max;
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
                    ORDER BY 
                    CASE 
                        WHEN 
                            c.slug = 'ostatne' OR 
                            c.slug = 'oleje-a-maziva' OR 
                            c.slug = 'ochranne-pomocky' OR
                            c.slug = 'snehova-technika' OR
                            c.slug = 'pluhy' OR
                            c.slug = 'rotavatory' THEN 1
                        ELSE 0
                    END,
                    p.name DESC
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



    function ProductDetails(
        PDO $pdo,
        int $productId
    ): ?array {

        $query = "
            SELECT
                p.id,
                p.product_code,
                p.name,
                p.price_b2c,
                p.price,
                p.description,
                p.images,
                p.parameters,

                b.id AS brand_id,
                b.name AS brand_name,
                b.slug AS brand_slug,

                c.id AS category_id,
                c.name AS category_name,
                c.slug AS category_slug

            FROM products p

            LEFT JOIN brands_new b
                ON b.id = p.brand_id

            LEFT JOIN product_categories pc
                ON pc.product_id = p.id

            LEFT JOIN categories c
                ON c.id = pc.category_id

            WHERE p.id = :product_id

            LIMIT 1
        ";

        $stmt = $pdo -> prepare($query);
        $stmt->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$product){
            return null;
        }


        $decodedImages = json_decode($product['images'] ?? '[]', true);
        $product['images'] = is_array($decodedImages)
            ? $decodedImages
            : [];
        

        $decodedParameters = json_decode($product['parameters'] ?? '[]', true);
        $product['parameters'] = is_array($decodedParameters)
            ? $decodedParameters
            : [];
        

        return $product;

    }


?>