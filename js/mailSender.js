const form = document.getElementById('contactForm');
const submitBTN = form.querySelector('button[type="submit"]');

const status = document.getElementById('formStatus');
const statusText = document.querySelector("#formStatus p");

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    formData.append("access_key", "54d8c941-bdcc-49de-b1b2-6f2cf6c7dc16");

    const orgText = submitBTN.textContent;

    submitBTN.textContent = "Sending...";
    submitBTN.disabled = true;

    try{
        const response = await fetch("https://api.web3forms.com/submit", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (response.ok) {
            status.classList.remove("hidden")
            status.textContent = "Vaša správa bola úspešne odoslaná.";
            status.classList.add("text-green-500");

            form.reset();

            setTimeout(() => {
                status.classList.add("hidden");
            }, 3000);
        }else{
            status.classList.remove("hidden")
            status.textContent = data.message;
            status.classList.add("text-red-500");

            setTimeout(() => {
                status.classList.add("hidden");
            }, 3000);
        }
    }catch (err) {
        console.error(err);
        alert(err.message);
    }finally{
        submitBTN.textContent = orgText;
        submitBTN.disabled = false;
    }
})