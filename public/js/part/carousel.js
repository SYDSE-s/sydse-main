document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".carousel-wrapper");
    const images = document.querySelectorAll(".carousel-image");
    let currentIndex = 1;
    wrapper.style.transform = `translateX(-${images[0].clientWidth + 20}px)`;
    
    function addStyle() {
        images[1].style.transition = 'all 1s ease';
    }

    function nextImage() {
        images[currentIndex].classList.remove("carousel-active");
        
        currentIndex = (currentIndex + 1) % images.length;
        console.log(currentIndex)
        console.log(images.length)


        if (currentIndex == images.length -1) {
            currentIndex = 1;
            const offset = -currentIndex * (images[currentIndex].clientWidth + 20);

            wrapper.style.transform = `translateX(${offset}px)`;
            wrapper.style.transition = 'none';
            images[currentIndex].style.transition = 'none';
            setInterval(addStyle, 10);

            images[currentIndex].classList.toggle("carousel-active");
            // console.log('sini mas')
        }
        else {
            const offset = -currentIndex * (images[currentIndex].clientWidth + 20);
            // console.log(offset)
            
            wrapper.style.transform = `translateX(${offset}px)`;
            wrapper.style.transition = 'all 1s ease';
            images[currentIndex].style.transition = 'all 1s ease';
            images[currentIndex].classList.toggle("carousel-active");
        }
    }
    setInterval(nextImage, 4000)
});