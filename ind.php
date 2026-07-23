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
        <section class="bg-[var(--bg-color)] lg:px-32">
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] min-h-screen mx-auto items-center">
                <div class="col-span-6 flex flex-col justify-center gap-[var(--medium-gap)]">
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
                    <div class="flex flex-row gap-[var(--large-gap)]">
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
                <div class="col-span-6 relative flex items-center justify-end">

                    <!-- Accent box -->
                    <div class="absolute
                                left-0
                                bottom-10
                                translate-y-1/2
                                w-[19rem]
                                h-[12.25rem]
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
         <section class="bg-[var(--decent-color)] lg:px-32">
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] mx-auto py-10  items-center">
                <div class="flex flex-col col-span-12">
                    <p class="bodyText text-[var(--accent-primary-color)] font-[700]">ODPORÚČAME</p>
                    <div class="flex justify-between items-end">
                        <h2 class="h2Text">Produkty z nášho katalógu</h2>
                        <a href="#" class="pText text-[var(--accent-primary-color)]">CELÝ KATALÓG -></a>
                    </div>
                </div>
                <div class="col-span-12 flex justify-between">
                    <div class="product p-4 flex flex-col relative w-fit gap-[var(--medium-gap)] rounded-[var(--rounded-medium)]">
                        <img src="./assets/product.png" alt="product"  class="w-[12.0625rem] h-[12.0625rem] rounded-[var(--rounded-medium)]" />
                        <div class="flex flex-row justify-between">
                            <p class="pText">STIHL FSA 110 R</p>
                            <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                        </div>
                    </div>
                    <div class="product p-4 flex flex-col relative w-fit gap-[var(--medium-gap)] rounded-[var(--rounded-medium)]">
                        <img src="./assets/product.png" alt="product"  class="w-[12.0625rem] h-[12.0625rem] rounded-[var(--rounded-medium)]" />
                        <div class="flex flex-row justify-between">
                            <p class="pText">STIHL FSA 110 R</p>
                            <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                        </div>
                    </div>
                    <div class="product p-4 flex flex-col relative w-fit gap-[var(--medium-gap)] rounded-[var(--rounded-medium)]">
                        <img src="./assets/product.png" alt="product"  class="w-[12.0625rem] h-[12.0625rem] rounded-[var(--rounded-medium)]" />
                        <div class="flex flex-row justify-between">
                            <p class="pText">STIHL FSA 110 R</p>
                            <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                        </div>
                    </div>
                    <div class="product p-4 flex flex-col relative w-fit gap-[var(--medium-gap)] rounded-[var(--rounded-medium)]">
                        <img src="./assets/product.png" alt="product"  class="w-[12.0625rem] h-[12.0625rem] rounded-[var(--rounded-medium)]" />
                        <div class="flex flex-row justify-between">
                            <p class="pText">STIHL FSA 110 R</p>
                            <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                        </div>
                    </div>
                    <div class="product p-4 flex flex-col relative w-fit gap-[var(--medium-gap)] rounded-[var(--rounded-medium)]">
                        <img src="./assets/product.png" alt="product"  class="w-[12.0625rem] h-[12.0625rem] rounded-[var(--rounded-medium)]" />
                        <div class="flex flex-row justify-between">
                            <p class="pText">STIHL FSA 110 R</p>
                            <p class="pText text-[var(--accent-primary-color)]">499.99€</p>
                        </div>
                    </div>
                </div>
            </div>
         </section>
        <!-- SERVICES -->
        <section class="bg-[var(--secondary-color)] lg:px-32">
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
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
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
                <div class="col-span-12">
                    <h2 class="h2Text">Spolupracujeme s overenými značkami</h2>
                </div>
                <div class="col-span-12">
                    <div class="flex items-center justify-between pt-5 pb-20">
                        <img src="./assets/partners/Fiskars_logo.png" alt="Fiskars" class="partnerLogo">
                        <img src="./assets/partners/stiga_logo.png" alt="Stiga" class="partnerLogo">
                        <img src="./assets/partners/stihl_logo.png" alt="Stihl" class="partnerLogo">
                        <img src="./assets/partners/vari_logo.jpg" alt="Vari" class="partnerLogo">
                        <img src="./assets/partners/wolfgarten_logo.png" alt="Wolfgarten" class="partnerLogo">
                        <img src="./assets/partners/honda_logo.png" alt="Honda" class="partnerLogo">
                    </div>
                </div>
            </div>   
        </section>
        <!-- QUESTIONS -->
        <section class="bg-[var(--decent-color)] lg:px-32">
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20  items-center">
                <div class="col-span-12 flex flex-col items-center justify-center text-center gap-[var(--medium-gap)]">
                    <p class="pText text-[var(--accent-primary-color)] font-[800]">NAVŠTÍVTE NAŠU PREDAJŇU</p>
                    <h1 class="h1Text">Prídte si vybrať techniku, na ktorú sa môžete spoľahnúť</h1>
                    <p class="bodyText mx-auto w-[80%] mt-3">V našej predajni nájdete široký výber záhradnej a lesnej techniky spolu s odborným poradenstvom. Pomôžeme vám vybrať stroj, ktorý bude spoľahlivo slúžiť a dokonale vyhovovať vašim potrebám.</p>
                    <button class="qaButton bg-[var(--secondary-color)] text-white">Máte otázky?</button>
                </div>
            </div>
        </section>
        <!-- CONTACT -->
        <!-- FOOTER -->
        <section class="bg-[var(--secondary-color)] lg:px-32">
            <div class="grid grid-cols-12 gap-8 max-w-[80rem] mx-auto py-10 ">
                <div class="col-span-4">
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <h2 class="h2Text text-white">RMTechnik</h2>
                        <p class="pText text-white">
                            Či už sa staráte o záhradu, pracujete so stromami alebo v lese, radi vám pomôžeme nájsť správne náradie. 
                            Vyberáme značky, ktorým sami dôverujeme, a poradíme vám tak, aby vám technika vydržala čo najdlhšie.
                        </p>
                        <div class="flex gap-[var(--small-gap)]">
                            <a href="#" class="w-auto h-auto">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-facebook-f text-white"></i>
                                </div>
                            </a>
                            <a href="#" class="w-auto h-auto">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-instagram text-white"></i>
                                </div>
                            </a>
                            <a href="#" class="w-auto h-auto">
                                <div class="flex rounded-full w-[40px] h-[40px] bg-[var(--accent-primary-color)] text-center items-center justify-center">
                                    <i class="fa-brands fa-youtube text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-start-11 col-span-2 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="bodyText text-white font-[400] textr">NAVŠTÍVTE NÁS</h2>
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <p class="pText text-white">ADRESA</p>
                        <p class="pText text-white">Moravská 619, 907 01 Myjava</p>
                    </div>
                    <div class="flex flex-col gap-[var(--small-gap)]">
                        <p class="pText text-white">KONTAKT</p>
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
                    <p class="pText text-white py-3">🤎bucak.dev</p>
                    <p class="pText text-white py-3">RMTechnik all rights reserved 2026</p>
                </div>
        </section> 
    </body>
</html>