document.addEventListener('DOMContentLoaded', () =>{

    const applyFilter = document.getElementById('applyFilter');
    const resetFilter = document.getElementById('resetFilter');

    const minInput = document.getElementById('priceMin');
    const maxInput = document.getElementById('priceMax');

    console.log('MIN:', minInput.value);
    console.log('MAX:', maxInput.value);

    resetFilter.addEventListener('click', () =>{
        const url = new URL(window.location.href);

        url.searchParams.delete('page');
        url.searchParams.delete('brands');
        url.searchParams.delete('min');
        url.searchParams.delete('max');

        window.location.href = url.toString();
    })



    applyFilter.addEventListener('click', () =>{

        const url = new URL(window.location.href);

        url.searchParams.delete('page');
        url.searchParams.delete('brands');
        url.searchParams.delete('categories');
        url.searchParams.delete('min');
        url.searchParams.delete('max');

        const filters = {};
        
        document.querySelectorAll('.filterInput:checked').forEach(input => {
            const filterName = input.dataset.filter;

            if(!filters[filterName]){
                filters[filterName] = [];
            }

            filters[filterName].push(input.value);
        });

        if (minInput !== ''){
            url.searchParams.set('min', minInput.value);
        }

        if (maxInput !== ''){
            url.searchParams.set('max', maxInput.value);
        }



        Object.entries(filters).forEach(([filterName, values]) => {
            if (values.length > 0){
                url.searchParams.set(
                    filterName,
                    values.join(',')
                );
            }
        });

        window.location.href = url.toString();
    });

});