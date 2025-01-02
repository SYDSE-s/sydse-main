const texts = document.querySelectorAll(".text-item");
const container = document.querySelector(".wrapper");
const nextBtn = document.querySelectorAll(".next");
const prevBtn = document.querySelectorAll(".back");

// const requiredInput = document.querySelectorAll("[required]");

let currentIndex = 0;

texts[currentIndex].classList.add("animation-start");

function showNextForm() {
    texts.forEach((item) => {
        item.classList.remove("animation-start");
    });

    currentIndex = currentIndex + 1;
    texts[currentIndex].classList.add("animation-start");
    console.log(currentIndex);
}

function showPrevForm() {
    texts.forEach((item) => {
        item.classList.remove("animation-start");
    });

    currentIndex = currentIndex - 1;
    texts[currentIndex].classList.add("animation-start");
    console.log(currentIndex);
}

nextBtn.forEach((item) => {
    item.addEventListener("click", () => {
        showNextForm();
    });
});
prevBtn.forEach((item) => {
    item.addEventListener("click", () => {
        showPrevForm();
    });
});



const businessProfile = document.querySelectorAll(".business-profile");
const liBP = document.querySelector(".li-BP");
const ulBP = document.querySelector(".ul-business-profile");
const lastBtn = document.querySelector('.last-btn')
lastBtn.addEventListener('click', ()=> {
    businessProfile.forEach((item) => {
        const inputName = item.getAttribute('name')
        const bPValue = item.value
        
        if (lastBtn) {
            const li = document.createElement('li')
            li.setAttribute('class', 'li-BP')
            const liText = document.createTextNode(inputName + ' : ' + bPValue)
            li.appendChild(liText)
            ulBP.appendChild(li)
        }
    })
})
console.log(liBP)