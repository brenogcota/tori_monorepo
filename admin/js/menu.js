var menu = document.getElementsByClassName("menu")[0];
var hamburguer = document.getElementsByClassName("menu-hamburger")[0];
hamburguer.onclick = function() {
    menu.style.display === "block" ? menu.style.display = "none" : menu.style.display = "block"
}
