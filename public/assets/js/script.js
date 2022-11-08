let toggle = document.querySelector('.toggle');
let naviguation = document.querySelector('.naviguation');
let main = document.querySelector('.main');

toggle.onclick = function(){
    naviguation.classList.toggle('active');
    main.classList.toggle('active');
}


let list = document.querySelectorAll('.naviguation li');
function activeLink(){
    list.forEach((item)=>
    item.classList.remove('hovered'));
    this.classList.add('hovered');
}
list.forEach((item)=>
item.addEventListener('mouseover', activeLink));

