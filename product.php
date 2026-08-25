<?php 
    require_once __DIR__ . '/php/config/database.php';
    require_once __DIR__ . '/php/products_data.php';
?>

<?php 
    $pdo = getPDO();

    $productId = isset($_GET['product_id'])
        ? (int) $_GET['product_id']
        : 0;
    $product = ProductDetails($pdo, $productId);

    if(!$product){
        http_response_code(404);
        exit('Produkt sa nenašiel');
    }
?>

<?php
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $brandSlug = isset($_GET['brands']) && $_GET['brands'] !== ''
    ? array_filter(explode(',', $_GET['brands']))
    : null;

    $categorySlug = isset($_GET['categories']) && $_GET['categories'] !== ''
    ? array_filter(explode(',', $_GET['categories']))
    : null;
    
    $min = isset($_GET['min']) && $_GET['min'] !== ''
    ? (float) $_GET['min']
    : null;

    $max = isset($_GET['max']) && $_GET['max'] !== ''
        ? (float) $_GET['max']
        : null;



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script defer src="https://cloud.umami.is/script.js" data-website-id="716f70e9-d65b-49ec-b2aa-451c3221d137"></script>
        
        <!-- SCRIPTS -->
        <script src="./js/product-images.js" defer></script>

        <script src="./js/mailSender.js" defer></script>
        <script src="./js/contactForm.js" defer></script>
        <!-- <script src="./js/counter.js" defer></script> -->
        <script src="./js/navigation.js" defer></script>
        <script src="./js/product-tabs.js" defer></script>
        <script src="./js/share.js" defer></script>
        
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
        
        
        <main class="w-full px-4 lg:px-8 pt-[7rem] pb-8 min-h-screen">
            <div class="max-w-[90rem] flex flex-col mx-auto bg-white rounded-xl border-1 border-[var(--catalog-border-color)]">
                <div class="header px-4 py-5 flex flex-col gap-3">
                    <button onclick="history.back()" class="w-auto flex justify-start items-center gap-2"><i class="fa-solid fa-angle-left"></i> Späť</button>
                    <div class="border-b border-[var(--catalog-border-color)]"></div>
                </div>

                <!-- PRODUCT SECTION -->
                <div class="productSection flex flex-col lg:flex-row gap-5 px-4 py-5">
                    <div class="imageSection flex flex-col-reverse lg:flex-row gap-4 min-w-0 flex-1">
                        <!-- THUMBNAILS -->
                        <div class="flex flex-row lg:flex-col gap-3 pb-5 lg:py-0 md:w-auto shrink-0">
                            <?php foreach ($product['images'] as $index => $image): ?>
                                <button 
                                    type="button"
                                    class="productThumbnail w-24 h-24 rounded-lg border-2 <?= $index === 0 
                                        ? 'border-[var(--accent-primary-color)]' 
                                        : 'border-[var(--catalog-border-color)]' ?> bg-white p-2L"
                                    data-image="<?= htmlspecialchars($image) ?>"
                                >
                                    <img 
                                        src="<?= htmlspecialchars($image) ?>" 
                                        alt="<?= htmlspecialchars($product['name']) ?>"
                                        class="w-full h-full object-contain"
                                    >
                                </button>
                            <?php endforeach; ?>
                            <button
                                type="button"
                                id="nextImage"
                                class="w-auto h-24 md:h-auto md:w-24 md:h-12 rounded-lg border-2 border-[var(--catalog-border-color)] bg-white p-2">
                                <i class="fa-solid fa-chevron-down -rotate-90 lg:rotate-0"></i>
                            </button>

                        </div>


                        <!-- MAIN IMAGE -->
                        <div class="flex-1 min-w-0 aspect-square flex items-start justify-start p-2 border-1 border-[var(--catalog-border-color)] rounded-xl">
                            <img
                                id="mainProductImage"
                                src="<?= htmlspecialchars($product['images'][0] ?? '/assets/products/Image-not-found.jpg') ?>" 
                                alt="<?= htmlspecialchars($product['name']) ?>"
                                class="w-full h-full object-contain"
                            >
                        </div>
                    </div>
                        <div class="productBox flex-1 flex flex-col gap-5">
                            <div class="header flex flex-col justify-start items-start md:flex-row md:justify-between md:items-center gap-2">
                                
                                <div class="bg-[var(--catalog-stock-color)] self-start flex items-center gap-[var(--small-gap)] px-2 py-1 rounded-md">
                                    <i class="fa-solid fa-tag text-[1.2rem] md:text-[1.4rem]"></i>
                                    <p class="h5Text text-[var(--accent-secondary-color)] md:h4Text"><?= htmlspecialchars($product['brand_name']) ?></p>
                                </div>
                                
                                <div class="flex gap-2">
                                    <p class="font-medium">KÓD PRODUKTU: </p> <span><?= htmlspecialchars($product['product_code']) ?></span>

                                </div>
                            </div>
                            <div class="productContent flex flex-col gap-5">
                                <h1 class="h4Text md:h2Text"><?= htmlspecialchars($product['name']) ?></h1>
                                <div class="border-b border-[var(--catalog-border-color)]"></div>
                                <div class="priceBox flex flex-col px-3 gap-5 ">
                                    <div class="px-2 py-3">
                                        <h3 class="h3Text text-[var(--product-price-color)]"><?= htmlspecialchars($product['price_b2c']) ?>€</h3>
                                    </div>
                                    <div class="flex gap-3 justify-end items-stretch">
                                        <div class="productButton flex items-center justify-center bg-[var(--product-price-color)] text-white transition-opacity duration-300 hover:opacity-70">
                                            <button
                                                id="displayContactForm"
                                                type="button" 
                                                class="w-full h-full text-center content-center">
                                                Kontaktujte nás
                                            </button>
                                        </div>
                                        <button
                                            type="button"
                                            id="shareButton" 
                                            class="border-2 border-[var(--catalog-border-color)] rounded-md aspect-square h-auto w-14 md:h-full">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </button>
                                    </div>
                                    <div class="border-b border-[var(--catalog-border-color)] pt-5"></div>
                                </div>

                                <div class="services grid grid-cols-1 gap-5 md:grid-cols-3 md:gap-2 items-start">
                                    <div class="col-span-1 flex gap-3 items-center">
                                        <div class="w-12 h-12 aspect-square">
                                            <img src="/assets/icons/mechanic.png" alt="" class="w-full h-full object-contain">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <h5 class="h5Text">Odborný servis</h5>
                                            <p class="pText">Komplexná starostlivosť o vašu techniku</p>
                                        </div>
                                    </div>
                                    <div class="col-span-1 flex gap-3 items-center">
                                        <div class="w-12 h-12 aspect-square">
                                            <img src="/assets/icons/group.png" alt="" class="w-full h-full object-contain">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <h5 class="h5Text">Vyškolený personál</h5>
                                            <p class="pText">Odborné poradenstvo a pomoc s výberom</p>
                                        </div>
                                    </div>
                                    <div class="col-span-1 flex gap-3 items-center">
                                        <div class="w-12 h-12 aspect-square">
                                            <img src="/assets/icons/verify.png" alt="" class="w-full h-full object-contain">
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <h5 class="h5Text">Overené značky</h5>
                                            <p class="pText">Kvalitná technika, na ktorú sa môžete spoľahnúť</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- PRODUCT DETAILS -->
                <div class="flex flex-col px-4 py-5">
                    <div class="border-b border-[var(--catalog-border-color)]"></div>
                    <div class="flex gap-5 pb-6 pt-10">
                        <button
                            type="button"
                            data-tab="description" 
                            class="tabButton h5Text text-[var(--product-price-color)]">Popis produktu</button>
                        <button
                            type="button"
                            data-tab="parameters"
                            class="tabButton h5Text">Parametre</button>
                    </div>
                    <div id="description" class="tabContent flex flex-col lg:flex-row gap-5">
                        <div class="descriptionContent flex-2">
                            <?php
                                $description = $product['description'];

                                if ($description !== strip_tags($description)) {
                                    // Obsahuje HTML
                                    $description = preg_replace('/<br\s*\/?>/i', ' ', $description);
                                } else {
                                    // Čistý text
                                    $description = nl2br(htmlspecialchars($description));
                                }
                                ?>

                                <div class="text-black/70 leading-relaxed">
                                    <?= $description ?>
                                </div>
                        </div>
                        <div class="table flex-1">
                            <div class="border border-black/10 rounded-xl overflow-hidden">

                                <div class="flex justify-between gap-6 px-5 py-4 border-b border-black/10">
                                    <span class="font-medium">Značka</span>
                                    <span class="text-black/60"><?= $product['brand_name'] ?></span>
                                </div>

                                <div class="flex justify-between gap-6 px-5 py-4 border-b border-black/10">
                                    <span class="font-medium">Produktový kód</span>
                                    <span class="text-black/60"><?= $product['product_code'] ?></span>
                                </div>

                                <div class="flex justify-between gap-6 px-5 py-4 border-b border-black/10">
                                    <span class="font-medium">Kategória</span>
                                    <span class="text-black/60"><?= $product['category_name'] ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="parameters" class="tabContent hidden flex">
                        <div class="table w-full">
                            <div class="border border-black/10 rounded-xl overflow-hidden">

                                <?php foreach ($product['parameters'] as $name => $value): ?>
                                    <div class="flex justify-between gap-6 px-5 py-4 border-b border-black/10">
                                        <span class="font-medium"><?= htmlspecialchars($name) ?></span>
                                        <span class="text-black/60"><?= htmlspecialchars($value) ?></span>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php require __DIR__ . '/components/contact_form.php'; ?>
        
        
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