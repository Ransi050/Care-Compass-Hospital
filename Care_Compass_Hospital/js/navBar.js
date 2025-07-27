function nav(){
    var nav = document.getElementById('navBarMobile');
    var list = document.getElementById('min');

    nav.classList.toggle('active');
    list.classList.toggle("anim");
}

function openFilter(){
    var filter = document.getElementById('filters');
    var burgerMenu = document.getElementById('menubar');

    filter.classList.toggle('active');
    burgerMenu.classList.toggle('close');
}

