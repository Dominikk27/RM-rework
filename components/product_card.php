<?php

function renderProductCard(array $product): void {
    $name = htmlspecialchars($product['name'] ?? '');
    $image =!empty($product['images'][0]) ? $product['images'][0] : '../assets/products/Image-not-found.png';
    $price = !empty($product['price_b2c']) && (float)$product['price_b2c'] > 0
        ? number_format((float)$product['price_b2c'], 2, ',', ' ') . ' €'
        : '';
    ?>
    <article class="productCard flex flex-col bg-gray-100 rounded-b-xl overflow-hidden">

        <!-- Obrázok -->
        <div class="max-h-38 bg-white">
            <img
                src="<?= htmlspecialchars($image) ?>"
                alt="<?= $name ?>"
                class="w-full h-full object-contain object-top"
            >
        </div>

        <!-- Obsah -->
        <div class="content flex items-center justify-between gap-2 px-3 pb-5 pt-2">
            <!-- Name -->
            <h3 class="font-bold">
                <?= $name ?>
            </h3>
            <!-- Price -->
            <span class="font-medium whitespace-nowrap">
                <?= $price ?>
            </span>

        </div>

    </article>
    <?php
}