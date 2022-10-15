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

const modalConfirm = document.getElementById("modalConfirm");
let isConfirm = false;

function confirmDelete() {
    isConfirm = !isConfirm;
    if (isConfirm) {
        modalConfirm.style.display = "block";
    } else if (!isConfirm) {
        modalConfirm.style.display = "none";
    }
}
