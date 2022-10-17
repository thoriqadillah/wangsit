let isOpen = false;
const sidebar = document.getElementById("sidebar");
const modal = document.getElementById("modal");

function mySidebar() {
    isOpen = !isOpen;
    if (isOpen) {
        sidebar.className =
            "h-screen fixed z-10 w-60 top-0 bg-white transition translate-x-0 duration-700 px-5 py-20";
        modal.className =
            "fixed w-full h-full scale-100 transition duration-100 bg-[#000000e1] z-50";
    } else if (!isOpen) {
        sidebar.className =
            "h-screen fixed z-10 w-60 top-0 bg-white transition -translate-x-60 duration-700 px-5 py-20";
        modal.className =
            "fixed w-full h-full scale-0 transition duration-100 bg-[#000000e1] z-50";
    }
}

modal.addEventListener("click", (e) => {
    isOpen = false;
    if (!isOpen) {
        sidebar.className =
            "h-screen fixed z-10 w-60 top-0 bg-white transition -translate-x-60 duration-700 px-5 py-20";
        modal.className =
            "fixed w-full h-full scale-0 transition duration-100 bg-[#000000e1] z-50";
    }
});

const modalConfirm = document.getElementById("modalConfirm");
let isConfirm = false;

function confirmDelete() {
    isConfirm = !isConfirm;
    if (isConfirm) {
        modalConfirm.className =
            "fixed w-full top-0 bottom-0 right-0 left-0 bg-[#000000e1] z-50 transition duration-100 scale-100";
    } else if (!isConfirm) {
        modalConfirm.classList =
            "fixed w-full top-0 bottom-0 right-0 left-0 bg-[#000000e1] z-50 transition duration-100 scale-0";
    }
}
