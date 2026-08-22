<?php 
    require_once __DIR__ . '/php/config/database.php';
    require_once __DIR__ . '/php/filter/filterSetup.php';
    require_once __DIR__ . '/php/products_data.php';
    require_once __DIR__ . '/components/product_card.php';
    require_once __DIR__ . '/php/pagination.php';
?>

<?php 
    $pdo = getPDO();

    $filters = getFilterOptions($pdo);
?>

<?php
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $brandSlug = isset($_GET['brands']) && $_GET['brands'] !== ''
    ? array_filter(explode(',', $_GET['brands']))
    : null;
    
    $min = isset($_GET['min']) && $_GET['min'] !== ''
    ? (float) $_GET['min']
    : null;

    $max = isset($_GET['max']) && $_GET['max'] !== ''
        ? (float) $_GET['max']
        : null;

    $categorySlug = $_GET['category'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script defer src="https://cloud.umami.is/script.js" data-website-id="716f70e9-d65b-49ec-b2aa-451c3221d137"></script>
        
        <!-- SCRIPTS -->
        <!-- <script src="./js/mailSender.js" defer></script> -->
        <!-- <script src="./js/counter.js" defer></script> -->
        <script src="./js/navigation.js" defer></script>
        <script src="./js/filter.js" defer></script>
        <script src="./js/filterLogic.js" defer></script>
        
        <!-- STYLES SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://kit.fontawesome.com/aeaa451863.js" crossorigin="anonymous"></script>

        <!-- STYLES -->
        <link rel="stylesheet" href="./css/global.css">
        <link rel="icon" type="image/x-icon" href="./assets/logo/logo.png">
        
        <title>R.M. Technik | Predaj záhradnej a lesnej techniky</title>

    </head>
    <body class="bg-[var(--catalog-background)] overflow-y-auto flex flex-col">
        <!-- NAVIGATION -->
        <header id="navigationHeader" class="fixed top-0 left-0 w-full bg-[var(--decent-color)] z-50 transition-all duration-300">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-12 max-w-[80rem] mx-auto">
                <div class="col-span-2 md:col-span-2 lg:col-span-2 z-50">
                    <a href="/" class="inline-block">
                        <img src="./assets/logo/logo.png" class="w-[6.5rem] h-[6rem]" alt="">
                    </a>
                </div>
                <nav class="hidden lg:flex lg:col-span-6 flex  items-center justify-center gap-10">
                    <a href="/#services" class="
                                    bodyText relative hover:text-[var(--accent-primary-color)] transition-colors
                                    after:absolute after:left-0 after:bottom-[-4px] after:h-[2px] after:w-full 
                                    after:bg-[var(--accent-primary-color)] after:origin-left after:scale-x-0 
                                    hover:after:scale-x-100 after:transition-transform">
                                    Služby
                    </a>
                    <a href="/#recommended" class="
                                    bodyText relative hover:text-[var(--accent-primary-color)] transition-colors
                                    after:absolute after:left-0 after:bottom-[-4px] after:h-[2px] after:w-full 
                                    after:bg-[var(--accent-primary-color)] after:origin-left after:scale-x-0 
                                    hover:after:scale-x-100 after:transition-transform">
                                    Produkty
                    </a>
                    <a href="/#contact" class="
                                    bodyText relative hover:text-[var(--accent-primary-color)] transition-colors
                                    after:absolute after:left-0 after:bottom-[-4px] after:h-[2px] after:w-full 
                                    after:bg-[var(--accent-primary-color)] after:origin-left after:scale-x-0 
                                    hover:after:scale-x-100 after:transition-transform">
                                    Kontakt
                    </a>
                </nav>

                <!-- BUTTONS -->
                <div class="hidden lg:flex lg:col-span-4 flex items-center justify-end gap-4">
                    <a href="https://profitrend.elnot.com/" target="_blank"
                    class="bodyText bg-[var(--secondary-color)] text-white rounded-[var(--rounded-small)] px-8 py-2 hover:opacity-90 transition-opacity">
                        Servis
                    </a>
                    <a href="#katalog"
                    class="hidden bodyText bg-[var(--accent-primary-color)] text-white rounded-[var(--rounded-small)] px-8 py-2 hover:opacity-90 transition-opacity">
                        Katalóg
                    </a>
                </div>

                <!-- MOBILE MENU BUTTON -->
                <button class="lg:hidden col-span-2 md:col-span-6 flex items-center justify-end p-2" aria-label="Otvoriť menu" id="menuToggle">
                    <div class="px-2 flex flex-col gap-1.5 z-50">
                        <span id="bar1" class="w-6 h-1 bg-[var(--accent-primary-color)] transition-all duration-300 origin-center"></span>
                        <span id="bar2" class="w-6 h-1 bg-[var(--accent-primary-color)] transition-all duration-300 "></span>
                        <span id="bar3" class="w-6 h-1 bg-[var(--accent-primary-color)] transition-all duration-300 origin-center"></span>
                    </div>
                </button>
            </div>
            
            <!-- MOBILE MENU OVERLAY -->
            <div id="mobileMenu" 
                class="lg:hidden fixed top-0 left-0 w-full h-screen bg-[var(--decent-color)] z-40 
                        flex flex-col items-center justify-center gap-8 
                        opacity-0 scale-95 pointer-events-none transition-all duration-300">
                
                <nav class="flex flex-col items-center gap-8">
                    <a href="#services" class="h4Text text-black hover:text-[var(--accent-primary-color)] transition-colors">Služby</a>
                    <a href="#recommended" class="h4Text text-black hover:text-[var(--accent-primary-color)] transition-colors">Produkty</a>
                    <a href="#contact" class="h4Text text-black hover:text-[var(--accent-primary-color)] transition-colors">Kontakt</a>
                </nav>

                <div class="flex flex-col gap-4 mt-4 w-[16rem]">
                    <a href="https://profitrend.elnot.com/" target="_blank"
                    class="bodyText text-center bg-[var(--secondary-color)] text-white rounded-[var(--rounded-small)] px-8 py-3 hover:opacity-90 transition-opacity">
                        Servis
                    </a>
                    <a href="#katalog"
                    class="hidden bodyText text-center bg-[var(--accent-primary-color)] text-white rounded-[var(--rounded-small)] px-8 py-3 hover:opacity-90 transition-opacity">
                        Katalóg
                    </a>
                </div>
            </div>
        </header>

        <!-- MAIN -->
        <main class="relative flex justify-center items-center max-w-[90rem] mx-auto bg-white border-1 border-[var(--catalog-border-color)]">
            <div class="flex flex-col flex-1 min-h-0 pt-[6rem] mt-5 max-w-[80rem] px-4 sm:px-8 lg:px-12">
                
                <!-- PRODUCTS FILTER -->
                <div id="filterBlock" class="shrink-0 border-b border-[var(--catalog-border-color)] transition-all duration-300">
                    <button
                        id="filterToggle"
                        type="button"
                        class="w-full h-16 flex items-center justify-between focus:outline-0">

                        <div>
                            <span class="block text-[24px] leading-8 font-semibold text-start">
                                Filter
                            </span>

                            <span class="hidden sm:block text-sm text-gray-500 mt-0.5">
                                Nájdite presne to, čo potrebujete
                            </span>
                        </div>

                        <span
                            class="w-9 h-9 rounded-full
                                flex items-center justify-center
                                bg-[var(--accent-primary-color)]
                                text-black">

                            <i
                                id="filterIcon"
                                class="fa-solid fa-chevron-down text-sm
                                    transition-transform duration-300">
                            </i>

                        </span>

                    </button>
                    <div id="filterPanel" class="overflow-hidden max-h-0 transition-[max-height] duration-300 ease-in-out">

                        <div class="pb-6 pt-5">

                            <!-- FILTER CONTROLS -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 pb-6">

                                <!-- CATEGORY -->
                                <div class="filterGroup relative">
                                    <button
                                        type="button"
                                        class="filterGroupToggle w-full h-12 flex items-center justify-between
                                            px-4 rounded-[var(--rounded-small)]
                                            border border-[var(--catalog-border-color)]
                                            bg-white hover:border-[var(--accent-primary-color)]
                                            transition-colors duration-200"
                                        data-target="categoryGroup"
                                        aria-expanded="false">

                                        <span class="flex items-center gap-3">
                                            <i class="fa-solid fa-border-all text-sm text-gray-500"></i>
                                            <span class="pText font-medium">Kategória</span>
                                        </span>

                                        <i class="fa-solid fa-chevron-down text-xs text-gray-500
                                                transition-transform duration-300"></i>
                                    </button>

                                    <div id="categoryGroup"
                                        class="filterGroupBody overflow-hidden max-h-0
                                            transition-[max-height] duration-300 ease-in-out
                                            absolute left-0 right-0 top-full z-30 mt-2
                                            bg-white border-[var(--catalog-border-color)]
                                            rounded-[var(--rounded-small)]
                                            shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                                        <div class="p-4">
                                            <div id="categoryFilterList"
                                                class="flex flex-col gap-2 max-h-[220px] overflow-y-auto pr-2">
                                                <!-- LABELS -->
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- BRAND -->
                                <div class="filterGroup relative">
                                    <button
                                        type="button"
                                        class="filterGroupToggle w-full h-12 flex items-center justify-between
                                            px-4 rounded-[var(--rounded-small)]
                                            border border-[var(--catalog-border-color)]
                                            bg-white hover:border-[var(--accent-primary-color)]
                                            transition-colors duration-200"
                                        data-target="brandGroup"
                                        aria-expanded="false">

                                        <span class="flex items-center gap-3">
                                            <i class="fa-solid fa-tag text-sm text-gray-500"></i>
                                            <span class="pText font-medium">Značka</span>
                                        </span>

                                        <i class="fa-solid fa-chevron-down text-xs text-gray-500
                                                transition-transform duration-300"></i>
                                    </button>

                                    <div id="brandGroup"
                                        class="filterGroupBody overflow-hidden max-h-0
                                            transition-[max-height] duration-300 ease-in-out
                                            absolute left-0 right-0 top-full z-30 mt-2
                                            bg-white border-[var(--catalog-border-color)]
                                            rounded-[var(--rounded-small)]
                                            shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                                        <div class="p-4">

                                            <div id="brandFilterList"
                                                class="flex flex-col gap-2 max-h-[220px] overflow-y-auto z-20 overflow pr-2">
                                                <!-- LABELS -->
                                                <?php foreach ($filters['brands'] as $brand): ?>

                                                    <label class="flex items-center gap-3 cursor-pointer group">

                                                        <input
                                                            type="checkbox"
                                                            name="brands[]"
                                                            data-filter="brands"
                                                            value="<?= htmlspecialchars($brand['slug']) ?>"
                                                            class="filterInput w-4 h-4 accent-[var(--accent-primary-color)] cursor-pointer"
                                                            <?= !empty($brandSlug) && in_array($brand['slug'], $brandSlug) ? 'checked' : '' ?>
                                                        >

                                                        <span class="pText group-hover:text-[var(--accent-primary-color)] transition-colors">
                                                            <?= htmlspecialchars($brand['name']) ?>
                                                        </span>

                                                    </label>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- PRODUCT TYPE -->
                                <div class="filterGroup relative">
                                    <button
                                        type="button"
                                        class="filterGroupToggle w-full h-12 flex items-center justify-between
                                            px-4 rounded-[var(--rounded-small)]
                                            border border-[var(--catalog-border-color)]
                                            bg-white hover:border-[var(--accent-primary-color)]
                                            transition-colors duration-200"
                                        data-target="productTypeGroup"
                                        aria-expanded="false">

                                        <span class="flex items-center gap-3">
                                            <i class="fa-solid fa-cube text-sm text-gray-500"></i>
                                            <span class="pText font-medium">Typ produktu</span>
                                        </span>

                                        <i class="fa-solid fa-chevron-down text-xs text-gray-500
                                                transition-transform duration-300"></i>
                                    </button>

                                    <div id="productTypeGroup"
                                        class="filterGroupBody overflow-hidden max-h-0
                                            transition-[max-height] duration-300 ease-in-out
                                            absolute left-0 right-0 top-full z-30 mt-2
                                            bg-white border-[var(--catalog-border-color)]
                                            rounded-[var(--rounded-small)]
                                            shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                                        <div class="p-4">

                                            <div id="productTypeFilterList"
                                                class="flex flex-col gap-2 max-h-[220px] overflow-y-auto pr-2">
                                                <!-- LABELS -->
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <!-- PRICE -->
                                <div class="filterGroup relative">
                                    <button
                                        type="button"
                                        class="filterGroupToggle w-full h-12 flex items-center justify-between
                                            px-4 rounded-[var(--rounded-small)]
                                            border border-[var(--catalog-border-color)]
                                            bg-white hover:border-[var(--accent-primary-color)]
                                            transition-colors duration-200"
                                        data-target="priceGroup"
                                        aria-expanded="false">

                                        <span class="flex items-center gap-3">
                                            <i class="fa-solid fa-euro-sign text-sm text-gray-500"></i>
                                            <span class="pText font-medium">Cena</span>
                                        </span>

                                        <i class="fa-solid fa-chevron-down text-xs text-gray-500
                                                transition-transform duration-300"></i>
                                    </button>

                                    <div id="priceGroup"
                                        class="filterGroupBody overflow-hidden max-h-0
                                            transition-[max-height] duration-300 ease-in-out
                                            absolute left-0 right-0 top-full z-30 mt-2
                                            bg-white border-[var(--catalog-border-color)]
                                            rounded-[var(--rounded-small)]
                                            shadow-[0_10px_30px_rgba(0,0,0,0.08)]">

                                        <div class="p-4">

                                            <div class="flex gap-3">

                                                <div class="flex-1">
                                                    <label class="block text-xs text-gray-500 mb-1">
                                                        Od
                                                    </label>

                                                    <input
                                                        type="number"
                                                        id="priceMin"
                                                        data-filter="min"
                                                        placeholder="0 €"
                                                        class="filterInput w-full h-10 px-3 rounded-lg
                                                            border border-[var(--catalor-border-color)]
                                                            outline-none
                                                            focus:border-[var(--accent-primary-color)]"
                                                        value="<?= htmlspecialchars($_GET['min'] ?? '') ?>">
                                                </div>

                                                <div class="flex-1">
                                                    <label class="block text-xs text-gray-500 mb-1">
                                                        Do
                                                    </label>

                                                    <input
                                                        type="number"
                                                        id="priceMax"
                                                        data-filter="max"
                                                        placeholder="1000 €"
                                                        class="filterInput w-full h-10 px-3 rounded-lg
                                                            border border-[var(--catalor-border-color)]
                                                            outline-none
                                                            focus:border-[var(--accent-primary-color)]"
                                                        value="<?= htmlspecialchars($_GET['max'] ?? '') ?>">
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- FILTER FOOTER -->
                            <div class="flex items-center justify-end mt-3 gap-5">

                                <button
                                    id="applyFilter"
                                    type="button"
                                    class="h-10 px-4 flex items-center gap-2
                                        rounded-lg
                                        text-sm font-semibold
                                        text-[var(--accent-primary-color)]
                                        bg-[var(--accent-primary-color)]/10
                                        hover:bg-[var(--accent-primary-color)]/20
                                        transition-colors duration-200">

                                    <span>Aplikovať filter</span>
                                    <i class="fa-solid fa-check text-xs"></i>

                                </button>

                                <button
                                    id="resetFilter"
                                    type="button"
                                    class="h-10 px-4 flex items-center gap-2
                                        rounded-lg
                                        text-sm font-semibold
                                        text-[var(--accent-primary-color)]
                                        bg-[var(--accent-primary-color)]/10
                                        hover:bg-[var(--accent-primary-color)]/20
                                        transition-colors duration-200">

                                    <span>Vymazať filtre</span>
                                    <i class="fa-solid fa-rotate-right text-xs"></i>

                                </button>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- PRODUCTS -->
                <?php 
                $result = getProducts($pdo, $brandSlug, $min, $max, $categorySlug, $page, 24);
                $products = $result['items'];
                ?>
                <section id="productsArea" class="flex-1 min-h-0 max-w-[100rem] px-4">
                    <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 py-10">
    <!-- -->            <?php if (empty($products)) : ?>
                            <p>Vyskytla sa chyba pri načítaní produktov!</p>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <?php renderProductCard($product); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                        <!-- PAGES -->
                        <?php 
                            renderPagination(
                                $result['page'], 
                                $result['totalPages'], 
                                array_filter([
                                    'brands' => !empty($brandSlug) ? implode(',', $brandSlug) : null,
                                    'min' => $min,
                                    'max' => $max,
                                    'category' => $categorySlug,
                            ])); 
                        ?>
                </section>
            </div>
        </main>

        <!-- FOOTER -->
        <section id="footer" class="bg-[var(--secondary-color)] px-4 md:px-16  lg:px-32">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 py-10 ">
                <div class="col-span-4">
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <h2 class="h2Text text-white">RMTechnik</h2>
                        <p class="pText text-white">
                            Či už sa staráte o záhradu, pracujete so stromami alebo v lese, radi vám pomôžeme nájsť správne náradie. 
                            Vyberáme značky, ktorým sami dôverujeme, a poradíme vám tak, aby vám technika vydržala čo najdlhšie.
                        </p>
                        <div class="flex gap-[var(--small-gap)]">
                            <a href="https://www.instagram.com/r.m.technik/" target="_blank" class="w-auto h-auto transition-opacity duration-300 hover:opacity-70">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-facebook-f text-white"></i>
                                </div>
                            </a>
                            <a href="https://www.instagram.com/r.m.technik/" target="_blank" class="w-auto h-auto transition-opacity duration-300 hover:opacity-70">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-instagram text-white"></i>
                                </div>
                            </a>
                            <a href="#" class="w-auto h-auto transition-opacity duration-300 hover:opacity-70">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-youtube text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 lg:col-start-11 lg:col-span-2 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="bodyText text-white font-[400] textr">NAVŠTÍVTE NÁS</h2>
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <p class="pText text-[var(--accent-primary-color)] font-bold">ADRESA</p>
                        <p class="pText text-white">Moravská 619, 907 01 Myjava</p>
                    </div>
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <p class="pText text-[var(--accent-primary-color)] font-bold">KONTAKT</p>
                        <div class="flex flex-col gap-[var(--extra-small-gap)]">
                            <p class="pText text-white">0918 523 756</p>
                            <p class="pText text-white">034/621 44 00</p>
                            <p class="pText text-white">rmtechnikmyjava@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-4
                            mt-10
                            w-full 
                            h-[0.0625rem] 
                            bg-[var(--line-color)]">
                </div>
                <div class="flex justify-between col-start-1">
                    <a href="https://bucak.dev" target="_blank" class="pText text-white py-3">bucak.dev</a>
                    <p class="pText text-white py-3">RMTechnik all rights reserved 2026</p>
                </div>
        </section> 
    </body>
</html>