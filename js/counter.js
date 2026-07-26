const counters = document.querySelectorAll(".counter");

const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry =>{
        if(!entry.isIntersecting) return;

        const counter = entry.target;
        const target = Number(counter.dataset.target);
        const suffix = counter.dataset.suffix || "";

        let current = 0;
        const increment = Math.max(1, Math.ceil(target/100));

        const timer = setInterval(() =>{
            current += increment;

            if(current >= target){
                current = target;
                clearInterval(timer);
            }

            counter.textContent = 
                current.toLocaleString("sk-SK") + suffix;
        }, 50);

        obs.unobserve(counter);
    });

}, {
    threshold: 0.9
});

counters.forEach(counter => obs.observe(counter));