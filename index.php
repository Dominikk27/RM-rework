<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- SCRIPTS -->
        <script src="./js/mailSender.js" defer></script>
        <script src="./js/counter.js" defer></script>
        <script src="./js/navigation.js" defer></script>
        
        <!-- STYLES SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://kit.fontawesome.com/aeaa451863.js" crossorigin="anonymous"></script>

        <!-- STYLES -->
        <link rel="stylesheet" href="./css/global.css">
        
        <title>R.M. Technik | Predaj záhradnej a lesnej techniky</title>

    </head>
    <body>
        <!-- NAVIGATION -->
        <header id="navigationHeader" class="fixed top-0 left-0 w-full bg-[var(--decent-color)] z-50 transition-all duration-300">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-12 max-w-[80rem] mx-auto">
                <div class="col-span-2 md:col-span-2 lg:col-span-2 z-50">
                    <a href="#" class="inline-block">
                        <img src="./assets/logo/logo.png" class="w-[6.5rem] h-[6rem]" alt="">
                    </a>
                </div>
                <nav class="hidden lg:flex lg:col-span-6 flex  items-center justify-center gap-10">
                    <a href="#services" class="
                                    bodyText relative hover:text-[var(--accent-primary-color)] transition-colors
                                    after:absolute after:left-0 after:bottom-[-4px] after:h-[2px] after:w-full 
                                    after:bg-[var(--accent-primary-color)] after:origin-left after:scale-x-0 
                                    hover:after:scale-x-100 after:transition-transform">
                                    Služby
                    </a>
                    <a href="#recommended" class="
                                    bodyText relative hover:text-[var(--accent-primary-color)] transition-colors
                                    after:absolute after:left-0 after:bottom-[-4px] after:h-[2px] after:w-full 
                                    after:bg-[var(--accent-primary-color)] after:origin-left after:scale-x-0 
                                    hover:after:scale-x-100 after:transition-transform">
                                    Produkty
                    </a>
                    <a href="#contact" class="
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
                    class="bodyText bg-[var(--accent-primary-color)] text-white rounded-[var(--rounded-small)] px-8 py-2 hover:opacity-90 transition-opacity">
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
                    class="bodyText text-center bg-[var(--accent-primary-color)] text-white rounded-[var(--rounded-small)] px-8 py-3 hover:opacity-90 transition-opacity">
                        Katalóg
                    </a>
                </div>
            </div>
        </header>
        <!-- HERO -->
        <section class="bg-[var(--bg-color)] px-4 md:px-16  lg:px-32 scroll-mt-28">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 lg:max-w-[80rem] gap-8 min-h-screen mx-auto items-start lg:items-center py-20 lg:pt-0">
                <div class="col-span-4 lg:col-span-6 flex flex-col justify-center gap-[var(--medium-gap)]">
                    <h1 class="h1Text">Všetko pre starostlivosť o vašu záhradu</h1>
                    <p class="bodyText text-[var(--text-color)]">
                        Objavte široký výber záhradnej a lesnej techniky od overených značiek. 
                        Ponúkame kosačky, píly, krovinorezy aj originálne náhradné diely, 
                        ktoré vám pomôžu zvládnuť každú prácu.
                    </p>
                    <div class="flex gap-[var(--small-gap)]">
                        <button class="heroButton bg-[var(--secondary-color)] text-white transition-opacity duration-300 hover:opacity-70">Prezerať katalóg</button>
                        <button class="heroButton relative overflow-hidden border-2 border-[var(--line-color)] text-black
                                       before:absolute before:top-0 before:left-0 before:h-full before:w-0
                                       before:bg-[var(--secondary-color)] before:transition-all before:duration-300
                                       hover:before:w-full hover:text-white">
                            <span class="relative z-10">
                                Kontaktujte nás
                            </span>

                        </button>
                    </div>
                    <!-- NUMBERS  -->
                    <div class="mt-10
                                w-full 
                                h-[0.0625rem] 
                                bg-[var(--line-color)]">
                    </div>
                    <div class="flex flex-row md:gap-[var(--extra-large-gap)] lg:justify-start justify-center">
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center counter" data-target="10" data-suffix="+">10+</h3>
                            <p class="bodyText text-center">ROKOV PRAXE</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center counter " data-target="6">6</h3>
                            <p class="bodyText text-center">OVERENÝCH ZNAČIEK</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="h2Text text-center counter" data-target="3500" data-suffix="+">3500+</h3>
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
        <section id="recommended" class="bg-[var(--decent-color)] px-4 md:px-16  lg:px-32 relative scroll-mt-28">
            <div class="max-w-[80rem] mx-auto grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 py-10 blur-sm">
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
                <div class="col-span-4 md:col-span-8 lg:col-span-12 scroll-mt-28">
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
            <!-- Overlay s textom -->
            <div class="absolute inset-0 flex items-center justify-center">
                <p class="h2Text text-center bg-[var(--decent-color)]/70 px-8 py-4 rounded-[var(--rounded-medium)]">
                    Na katalógu pracujeme
                </p>
            </div>
        </section>
        
        <!-- SERVICES -->
        <section id="services" class="bg-[var(--secondary-color)] px-4 md:px-16  lg:px-32 scroll-mt-28">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-white text-left">Servis a brúsenie</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        Stroje zakúpene u nás v predajni vybavíme do 7 dní.
                        Postaráme sa o brúsenie nožov a reťazí, pravidelný servis aj kompletnú údržbu vašej techniky.
                    </p>
                </div>

                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-white text-left">Odborné poradenstvo</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        Poradíme s výberom techniky, príslušenstva aj náhradných dielov podľa vašej práce a požiadaviek.
                    </p>
                </div>

                <div class="col-span-4 flex flex-col gap-[var(--small-gap)]">
                    <h2 class="h4Text text-white text-left">Autorizovaný predajca</h2>
                    <p class="pText text-left text-white max-w-[20.6rem]">
                        V našej ponuke nájdete kvalitnú techniku overených značiek. 
                        Zabezpečujeme aj autorizovaný servis a odbornú starostlivosť o vaše stroje. 
                    </p>
                </div>
            </div>
        </section>

        <!-- PARTNERS -->
        <section class="bg-[var(--bg-color)] lg:px-32 scroll-mt-28">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20 ">
                <div class="col-span-4 md:col-span-8 lg:col-span-12">
                    <h2 class="h2Text">Naši overený partneri</h2>
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

        <!-- QUESTIONS -->
        <section class="bg-[var(--decent-color)] px-4 md:px-16  lg:px-32 scroll-mt-28">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-20  items-center">
                <div class="col-span-4 md:col-span-8 lg:col-span-12 flex flex-col items-center justify-center text-center gap-[var(--medium-gap)]">
                    <p class="pText text-[var(--accent-primary-color)] font-[800]">NAVŠTÍVTE NAŠU PREDAJŇU</p>
                    <h1 class="h1Text">Prídte si vybrať techniku, na ktorú sa môžete spoľahnúť</h1>
                    <p class="bodyText mx-auto w-[80%] mt-3">V našej predajni nájdete široký výber záhradnej a lesnej techniky spolu s odborným poradenstvom. Pomôžeme vám vybrať stroj, ktorý bude spoľahlivo slúžiť a dokonale vyhovovať vašim potrebám.</p>
                    <button class="qaButton bg-[var(--secondary-color)] text-white">Máte otázky?</button>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section id="contact" class="bg-[var(--bg-color)] px-4 md:px-16  lg:px-32 scroll-mt-28">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-10 ">
                <div class="col-span-4 lg:col-span-5">
                    <div class="flex flex-col gap-[var(--extra-small-gap)]">
                        <p class="bodyText text-[var(--accent-primary-color)] font-bold">KONTAKT</p>
                        <h2 class="h2Text">Navštívte nás</h2>
                        <p class="pText mt-2">Príďte sa pozrieť, porozprávať a vybrať si správnu techniku. 
                           Radi vám poradíme na základe skúseností z praxe a pomôžeme nájsť stroj, ktorý bude presne vyhovovať vašim potrebám. Kanvica je vždy pripravená.</p>
                        <div class="mt-10
                            w-full 
                            h-[0.0625rem] 
                            bg-[var(--line-color)]">
                        </div>
                        <div class="flex flex-col gap-[var(--large-gap)]">
                            <div class="flex flex-col gap-[var(--small-gap)]">
                                <p class="bodyText">ADRESA</p>
                                <p class="pText">Moravská 619, 907 01 Myjava</p>
                            </div>

                            <div class="flex flex-col gap-[var(--small-gap)]">
                                <p class="bodyText">OTVÁRACIE HODINY</p>
                                <div class="flex flex-col gap-[var(--extra-small-gap)]">
                                    <p class="pText"><strong>PO-PIA</strong>: 8:00 - 16:00</p>
                                    <p class="pText"><strong>SO</strong>: 8:00 - 11:30</p>
                                    <p class="pText"><strong>NE</strong>: ZATVORENÉ</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-[var(--small-gap)]">
                                <p class="bodyText">KONTAKT</p>
                                <div class="flex flex-col gap-[var(--extra-small-gap)]">
                                    <p class="pText">0918 523 756</p>
                                    <p class="pText">034/621 44 00</p>
                                    <p class="pText">rmtechnikmyjava@gmail.com</p>
                                    <p class="pText">IČO: 53498615</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FORM -->
                <div class="col-span-4 lg:col-start-7 lg:col-span-6">
                    <div class="bg-white rounded-[var(--rounded-medium)] border-1 border-[var(--secondary-color)] shadow-lg px-[1.6rem] py-[2rem]">
                        <h2 class="h2Text">Napíšte nám</h2>
                        <form id="contactForm" class="flex flex-col gap-[var(--large-gap)] mt-6">
                            <div class="grid grid-cols-2 gap-[var(--medium-gap)]">
                                <div class="col-span-2 md:col-span-1 flex flex-col gap-[var(--extra-small-gap)]">
                                    <label for="name" class="bodyText">MENO</label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name" 
                                        class="pText w-full bg-[var(--bg-color)] rounded-[var(--rounded-small)] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--accent-primary-color)]"
                                    >
                                </div>

                                <div class="col-span-2 md:col-span-1 flex flex-col gap-[var(--extra-small-gap)]">
                                    <label for="email" class="bodyText">E-MAIL</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        name="email" 
                                        class="pText w-full bg-[var(--bg-color)] rounded-[var(--rounded-small)] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--accent-primary-color)]"
                                    >
                                </div>
                            </div>

                            <div class="flex flex-col gap-[var(--extra-small-gap)]">
                                <label for="subject" class="bodyText">PREDMET</label>
                                <select 
                                    id="subject" 
                                    name="subject" 
                                    class="pText w-full bg-[var(--bg-color)] rounded-[var(--rounded-small)] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--accent-primary-color)] appearance-none bg-[url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23555%22 stroke-width=%222%22><polyline points=%226 9 12 15 18 9%22></polyline></svg>')] bg-no-repeat bg-[right_1rem_center] bg-[length:1rem]"
                                >
                                    <option value="" disabled selected>Vyberte možnosť</option>
                                    <option value="servis">Servis a brúsenie</option>
                                    <option value="poradenstvo">Odborné poradenstvo</option>
                                    <option value="predaj">Predaj techniky</option>
                                    <option value="reklamacia">Reklamácia</option>
                                    <option value="ine">Iné</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-[var(--extra-small-gap)]">
                                <label for="message" class="bodyText">SPRÁVA</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    rows="10"
                                    class="pText w-full bg-[var(--bg-color)] rounded-[var(--rounded-small)] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--accent-primary-color)] resize-y"
                                ></textarea>
                            </div>
                            <input type="checkbox" name="botcheck" class="hidden" style="display: none;">

                            <div>
                                <button 
                                    type="submit" 
                                    class="pText bg-[var(--secondary-color)] text-white rounded-[var(--rounded-small)] px-6 py-3 hover:opacity-90 transition-opacity"
                                >
                                    Odoslať správu
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="formStatus" class="my-5 p-2 w-full h-[40px] bg-[var(--decent-color)] rounded-[var(--rounded-medium)] border-1 border-[var(--secondary-color)] hidden">
                        <p class="textContent"></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <section id="footer" class="bg-[var(--secondary-color)] px-4 md:px-16  lg:px-32">
            <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-12 gap-8 max-w-[80rem] mx-auto py-10 ">
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