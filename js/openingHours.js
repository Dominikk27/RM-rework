const month = new Date().getMonth() + 1;

const summerHours = document.getElementById('summerHours');
const winterHours = document.getElementById('winterHours');


if(month >=3 && month <=11){
    summerHours.classList.remove('hidden');
    winterHours.classList.add('hidden');
} else {
    summerHours.classList.add('hidden');
    winterHours.classList.remove('hidden');
}