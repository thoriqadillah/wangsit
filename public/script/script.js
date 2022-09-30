function filterModul() {
    const searchAcademy = document.getElementById("searchAcademy");
    const modul = document.getElementsByClassName("modul");
    console.log(searchAcademy.value.toUpperCase());
    console.log(modul[0].children[1].children[0].innerText.toUpperCase());

    for (let i = 0; i < modul.length; i++) {
        if (
            modul[i].children[1].children[0].innerText
                .toUpperCase()
                .indexOf(searchAcademy.value.toUpperCase()) > -1
        ) {
            modul[i].style.display = "";
        } else {
            modul[i].style.display = "none";
        }
    }
}

let isOpen = false;
const sidebar = document.getElementById("sidebar");
const modal = document.getElementById("modal");

function mySidebar() {
    isOpen = !isOpen;
    if (isOpen) {
        sidebar.style.left = "0px";
        modal.style.display = "block";
    } else if (!isOpen) {
        sidebar.style.left = "-240px";
        modal.style.display = "none";
    }
}

modal.addEventListener("click", (e) => {
    isOpen = false;
    if (!isOpen) {
        sidebar.style.left = "-240px";
        modal.style.display = "none";
    }
});
