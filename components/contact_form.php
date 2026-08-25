<?php
$productName = $product['name'] ?? '';
$productId = $product['id'] ?? '';
$productCode = $product['product_code'] ?? '';
?>

<div id="productContactForm"
     class="hidden fixed inset-0 z-[100] bg-black/50 flex items-center justify-center p-4">

    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        
        <!-- FORMULÁR -->
        <div class="bg-white rounded-[var(--rounded-medium)] border border-[var(--secondary-color)] shadow-lg px-[1.6rem] py-[2rem]">
            
            <!-- ZATVORIŤ -->
            <button
                type="button"
                id="closeContactForm"
                class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black/5 hover:bg-black/10 transition-colors"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

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
                        <option value="dostupnost">Dostupnosť tovaru</option>
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
</div>