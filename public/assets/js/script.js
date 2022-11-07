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

//----------Barre de recherche patient------------//
function search_patient() {
    let input = document.getElementById('searchbar').value
    input=input.toLowerCase();
    let x = document.getElementsByClassName('patient');
      
    for (i = 0; i < x.length; i++) { 
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            x[i].style.display="none";
        }
        else {
            x[i].style.display="list-item";                 
        }
    }
}