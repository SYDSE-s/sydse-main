const texts = document.querySelectorAll(".text-item");
const container = document.querySelector(".wrapper");
const nextBtn = document.querySelectorAll(".next");
let currentIndex = 0;

texts[currentIndex].classList.add("animation-start");
function showNextText() {
    texts.forEach((item) => {
        item.classList.remove("animation-start");
    });

    currentIndex = currentIndex + 1;
    texts[currentIndex].classList.add("animation-start");
    console.log(currentIndex);
}


nextBtn.forEach((item) => {
    item.addEventListener('click', ()=> {
        showNextText()
    })
})