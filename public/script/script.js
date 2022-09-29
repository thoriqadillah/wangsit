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

// function filterModul() {
//     let value = getValueinput();
//     console.log(value);
//     console.log(modul);
// for (let i = 0; i < modul.length; i++) {
//     if (
//         modul[i].children[1].children[0].innerText.toUpperCase() ===
//         value.toUpperCase()
//     ) {
//         console.log(true);
//     }
// }
// }
