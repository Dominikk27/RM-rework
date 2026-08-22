<?php

function renderProductCard(array $product): void {
    $name = htmlspecialchars($product['name'] ?? '');
    $image =!empty($product['images'][0]) ? $product['images'][0] : '../assets/products/Image-not-found.jpg';
    $price = !empty($product['price_b2c']) && (float)$product['price_b2c'] > 0
        ? number_format((float)$product['price_b2c'], 2, ',', ' ') . ' €'
        : '';
    ?>
    <article class="productCard h-full flex flex-col bg-gray-100 rounded-xl overflow-hidden border border-[var(--catalog-border-color)]">

        <!-- Obrázok -->
        <div class="max-h-38 bg-white rounded-t-xl">
            <img
                src="<?= htmlspecialchars($image) ?>"
                alt="<?= $name ?>"
                onerror="this.onerror=null; this.src='/assets/products/Image-not-found.jpg';"
                class="w-full h-full object-contain object-top rounded-t-xl"
            >
        </div>

        <!-- Obsah -->
        <div class="content flex flex-col flex-1 gap-5 px-3 pb-5 pt-2">
            <!-- Name -->
            <div class="flex-1">
                <h3 class="font-bold">
                    <?= $name ?>
                </h3>
            </div>
            <div class="flex justify-between items-center px-2">
                <!-- Price -->
                <span class="font-bold text-[var(--accent-primary-color)] whitespace-nowrap">
                    <?= $price ?>
                </span>

                <a href="#" class="w-10 h-10 flex justify-center items-center rounded-full border-1 border-[var(--accent-primary-color)]">
                    <i class="fa-solid fa-cart-shopping text-[var(--accent-primary-color)]"></i>
                </a>
            </div>

        </div>

    </article>
    <?php
}