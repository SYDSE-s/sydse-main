const texts = document.querySelectorAll(".text-item");
const container = document.querySelector(".wrapper");
// const nextBtn = document.querySelectorAll(".next");
const prevBtn = document.querySelectorAll(".back");
const steps = document.getElementById("step");
let step = parseInt(steps.getAttribute("value"));
console.log(step);

// const requiredInput = document.querySelectorAll("[required]");

let currentIndex = 0;

texts[currentIndex].classList.add("animation-start");

function showNextForm() {
    texts.forEach((item) => {
        item.classList.remove("animation-start");
    });

    currentIndex = currentIndex + 1;
    texts[step].classList.add("animation-start");
    console.log(currentIndex);
}

// function showPrevForm(test) {
//     console.log('ini ', test)
// }
function showPrevForm(current) {
    texts.forEach((item) => {
        item.classList.remove("animation-start");
        console.log(item)
    });

    // currentIndex = currentIndex - 1;
    // texts[step].classList.add("animation-start");
    // console.log("ini step", texts);
    console.log("ini index", currentIndex);
    console.log("ini current", current);
}

// nextBtn.forEach((item) => {
//     item.addEventListener("click", () => {
//         showNextForm();
//     });
// });
// prevBtn.forEach((item) => {
//     item.addEventListener("click", () => {
//         showPrevForm();
//     });
// });

function showPassword() {
    let x = document.getElementById("input-password");
    const eyesOpen = document.querySelector(".eyes-on")
    const eyesClosed = document.querySelector(".eyes-off")
    if (x.type === "password") {
        x.type = "text";
        eyesOpen.style.display = 'block'
        eyesClosed.style.display = 'none'
    } else {
        x.type = "password";
        eyesOpen.style.display = 'none'
        eyesClosed.style.display = 'block'
    }
}
