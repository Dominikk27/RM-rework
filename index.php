<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://kit.fontawesome.com/aeaa451863.js" crossorigin="anonymous"></script>

        <!-- STYLES -->
        <link rel="stylesheet" href="./css/global.css">
        
        <title>R.M. Technik | Predaj záhradnej a lesnej techniky</title>

    </head>
    <body>
        <!-- NAVIGATION -->
        <!-- HERO -->
        <section class="bg-[var(--bg-color)] px-4 md:px-16  lg:px-32">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 lg:max-w-[80rem] gap-8 min-h-screen mx-auto items-start lg:items-center py-20 lg:pt-0">
                <div class="col-span-4 lg:col-span-6 flex flex-col justify-center gap-[var(--medium-gap)]">
                    <h1 class="h1Text">Všetko pre starostlivosť o vašu záhradu</h1>
                    <p class="bodyText text-[var(--text-color)]">
                        Objavte široký výber záhradnej a lesnej techniky od overených značiek. 
                        Ponúkame kosačky, píly, krovinorezy aj originálne náhradné diely, 
                        ktoré vám pomôžu zvládnuť každú prácu.
                    </p>
                    <div class="flex gap-[var(--small-gap)]">
                        <button class="heroButton bg-[var(--secondary-color)] text-white">Prezerať katalóg</button>
                        <button class="heroButton border-2 border-[var(--line-color)]  text-black">Prezerať katalóg</button>
                    </div>
                    <!-- NUMBERS  -->
                    <div class="mt-10
                                w-full 
                                h-[0.0625rem] 
                                bg-[var(--line-color)]">
                    </div>
                    <div class="flex flex-row md:gap-[var(--large-gap)] lg:justify-start justify-center">
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center">10+</h3>
                            <p class="bodyText text-center">ROKOV PRAXE</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center">6</h3>
                            <p class="bodyText text-center">OVERENÝCH ZNAČIEK</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center">3500+</h3>
                            <p class="bodyText text-center">PREDANÝCH STROJOV</p>
                        </div>
                    </div>

                </div>
                <div class="col-span-4 lg:col-span-6 relative flex items-center justify-center lg:justify-end">

                    <!-- Accent box -->
                    <div class="absolute
                                left-0
                                bottom-10
                                translate-y-1/2
                                w-[19rem]
                                h-[12.25rem]
                                lg:w-[19rem]
                                lg:h-[12.25rem]
                                bg-[var(--accent-primary-color)]
                                z-10">
                    </div>

                    <!-- Obrázok -->
                    <div class="relative z-1">
                        <div class="bg-white rounded-[var(--rounded-medium)] p-4 shadow-lg">
                            <img
                                src="./assets/hero.png"
                                class="w-[26.8125rem] h-[26.8125rem] object-cover rounded-[var(--rounded-medium)]">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RECOMMENDED PRODUCTS -->
        <section class="bg-[var(--decent-color)] px-4 md:px-16  lg:px-32">
            <div class="max-w-[80rem] mx-auto grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8">
                <!-- Header -->
                <div class="col-span-4 md:col-span-8 lg:col-span-12">
                    <p class="bodyText text-[var(--accent-primary-color)] font-bold">
                        ODPORÚČAME
                    </p>
                    <div class="flex justify-between items-end">
                        <h2 class="h2Text">
                            Produkty z nášho katalógu
                        </h2>
                        <a href="#" class="pText text-[var(--accent-primary-color)]">
                            CELÝ KATALÓG →
                        </a>
                    </div>
                </div>
                <!-- Products -->
                <div class="col-span-4 md:col-span-8 lg:col-span-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="product p-4 rounded-[var(--rounded-medium)]">
                            <img src="./assets/product.png"
                                class="w-full aspect-square object-cover rounded-[var(--rounded-medium)]">

                            <div class="flex flex-col xl:flex-row justify-between mt-4">
                                <p class="pText">STIHL FSA 110 R</p>
                                <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                            </div>
                        </div>

                        <div class="product p-4 rounded-[var(--rounded-medium)]">
                            <img src="./assets/product.png"
                                class="w-full aspect-square object-cover rounded-[var(--rounded-medium)]">

                            <div class="flex justify-between mt-4">
                                <p class="pText">STIHL FSA 110 R</p>
                                <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                            </div>
                        </div>

                        <div class="product p-4 rounded-[var(--rounded-medium)]">
                            <img src="./assets/product.png"
                                class="w-full aspect-square object-cover rounded-[var(--rounded-medium)]">

                            <div class="flex justify-between mt-4">
                                <p class="pText">STIHL FSA 110 R</p>
                                <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                            </div>
                        </div>

                        <div class="product p-4 rounded-[var(--rounded-medium)]">
                            <img src="./assets/product.png"
                                class="w-full aspect-square object-cover rounded-[var(--rounded-medium)]">

                            <div class="flex justify-between mt-4">
                                <p class="pText">STIHL FSA 110 R</p>
                                <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SERVICES -->
        <section class="bg-[var(--secondary-color)] px-4 md:px-16  lg:px-32">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-left">Servis a brúsenie</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        Stroje zakúpene u nás v predajni vybavíme do 7 dní.
                        Postaráme sa o brúsenie nožov a reťazí, pravidelný servis aj kompletnú údržbu vašej techniky.
                    </p>
                </div>

                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-left">Odborné poradenstvo</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        Poradíme s výberom techniky, príslušenstva aj náhradných dielov podľa vašej práce a požiadaviek.
                    </p>
                </div>

                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-left">Autorizovaný predajca</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        V našej ponuke nájdete kvalitnú techniku overených značiek. 
                        Zabezpečujeme aj autorizovaný servis a odbornú starostlivosť o vaše stroje. 
                    </p>
                </div>
            </div>
        </section>
        <!-- PARTNERS -->
        <section class="bg-[var(--bg-color)] lg:px-32">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
                <div class="col-span-4 md:col-span-8 lg:col-span-12">
                    <h2 class="h2Text">Spolupracujeme s overenými značkami</h2>
                </div>
                <div class="col-span-4 md:col-span-8 lg:col-span-12">
                    <div class="col-span-4 md:col-span-8 lg:col-span-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-8 pt-5 pb-20">
                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/Fiskars_logo.png" alt="Fiskars" class="partnerLogo">
                            </div>

                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/stiga_logo.png" alt="Stiga" class="partnerLogo">
                            </div>

                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/stihl_logo.png" alt="Stihl" class="partnerLogo">
                            </div>

                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/vari_logo.jpg" alt="Vari" class="partnerLogo">
                            </div>

                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/wolfgarten_logo.png" alt="Wolfgarten" class="partnerLogo">
                            </div>

                            <div class="flex justify-center items-center">
                                <img src="./assets/partners/honda_logo.png" alt="Honda" class="partnerLogo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </section>
    </body>
</html>