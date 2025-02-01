document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".carousel-wrapper");
    const images = document.querySelectorAll(".carousel-image");
    let currentIndex = 1;
    wrapper.style.transform = `translateX(-${images[0].clientWidth + 20}px)`;
    
    function nextImage() {
        images[currentIndex].classList.remove("carousel-active");
        
        currentIndex = currentIndex + 1;

        if (currentIndex == images.length) {
            currentIndex = 0;
            const offset = -currentIndex * (images[currentIndex].clientWidth + 20);

            wrapper.style.transform = `translateX(${offset}px)`;
            wrapper.style.transition = `none`;
            images[currentIndex].style.transition = 'none';
            images[currentIndex].classList.toggle("carousel-active");
        }
        else {
            const offset = -currentIndex * (images[currentIndex].clientWidth + 20);
    
            wrapper.style.transform = `translateX(${offset}px)`;
            images[currentIndex].classList.toggle("carousel-active");
        }
    }
    setInterval(nextImage, 4000)
});