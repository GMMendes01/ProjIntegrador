function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Fechar o dropdown se clicar fora dele
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.closest('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// Adiciona o evento de clique ao botão
document.querySelector('.dropbtn').addEventListener('click', toggleDropdown);