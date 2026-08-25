const shareButton = document.getElementById("shareButton");

shareButton.addEventListener("click", async () => {

    const shareData = {
        title: "Produkt",
        text: "Pozri si tento produkt v katalógu RMTechnik.",
        url: window.location.href
    };

    if (!navigator.share) {
        alert(
            "navigator.share nie je dostupné\n" +
            "Secure context: " + window.isSecureContext
        );
        return;
    }

    try {
        await navigator.share(shareData);
        //console.log("Zdieľanie úspešné");
    } catch (err) {
        console.error(err);

        if (err.name !== "AbortError") {
            alert("Chyba: " + err.name + "\n" + err.message);
        }
    }
});