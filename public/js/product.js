document.addEventListener("DOMContentLoaded", function () {
    const filterBtns = document.querySelectorAll(".filter-btn");
    const productItem = document.querySelectorAll(".product-item");

    filterBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const category = btn.getAttribute("data-value");
            const active = document.querySelector(".btn-active");
            console.log(category)
            if (active) {
                active.classList.remove("btn-active");
            }
            btn.classList.add("btn-active");

            productItem.forEach((item) => {
                if (item.getAttribute("data-category") === category) {
                    item.classList.remove("hide");
                }
                else if (category === "semua" ) {
                    window.location.href = "/product";
                } else {
                    item.classList.add("hide");
                    console.log(item.getAttribute("data-category"))
                }
            });
        });
    });

    const items = document.querySelectorAll(".item");
    const Dphoto = document.querySelector(".img-product");
    const Dname = document.querySelector(".name");
    const Ddescription = document.querySelector(".description");
    const Downer_name = document.querySelector(".owner_name");
    const Dlocation = document.querySelector(".location");
    const Dphone_number = document.querySelector(".phone_number");
    const Dprice = document.querySelector(".price");
    const Dnib = document.querySelector(".nib");
    const Dhalal = document.querySelector(".halal");
    const Dpirt = document.querySelector(".pirt");
    const Dbpom = document.querySelector(".bpom");
    const Dhki = document.querySelector(".hki");
    const Dnutrition = document.querySelector(".nutrition");
    const Dhaccp = document.querySelector(".haccp");

    const photo = items[0].getAttribute("data-photo");
    const name = items[0].getAttribute("data-name");
    const desc = items[0].getAttribute("data-desc");
    const owner_name = items[0].getAttribute("data-owner_name");
    const province = items[0].getAttribute("data-province");
    const city = items[0].getAttribute("data-city");
    const sub_district = items[0].getAttribute("data-sub_district");
    const village = items[0].getAttribute("data-village");
    const phone_number = items[0].getAttribute("data-phone_number");
    const price = items[0].getAttribute("data-price");
    const nib = items[0].getAttribute("data-nib");
    const halal = items[0].getAttribute("data-halal");
    const pirt = items[0].getAttribute("data-pirt");
    const bpom = items[0].getAttribute("data-bpom");
    const hki = items[0].getAttribute("data-hki");
    const nutrition = items[0].getAttribute("data-nutrition");
    const haccp = items[0].getAttribute("data-haccp");

    Dphoto.style.backgroundImage = "url(/product_photo/" + photo + ")";
    Dname.textContent = name;
    Ddescription.textContent = desc;
    Downer_name.textContent = owner_name;
    Dlocation.textContent =
        province + ", " + city + ", " + sub_district + ", " + village;
    Dphone_number.textContent = phone_number;
    Dprice.textContent = price;
    Dnib.textContent = nib;
    Dhalal.textContent = halal;
    Dpirt.textContent = pirt;
    Dbpom.textContent = bpom;
    Dhki.textContent = hki;
    Dnutrition.textContent = nutrition;
    Dhaccp.textContent = haccp;
    console.log;

    items.forEach((product, index) => {
        const photo = product.getAttribute("data-photo");
        const name = product.getAttribute("data-name");
        const desc = product.getAttribute("data-desc");
        const owner_name = product.getAttribute("data-owner_name");
        const province = product.getAttribute("data-province");
        const city = product.getAttribute("data-city");
        const sub_district = product.getAttribute("data-sub_district");
        const village = product.getAttribute("data-village");
        const phone_number = product.getAttribute("data-phone_number");
        const price = product.getAttribute("data-price");
        const nib = product.getAttribute("data-nib");
        const halal = product.getAttribute("data-halal");
        const pirt = product.getAttribute("data-pirt");
        const bpom = product.getAttribute("data-bpom");
        const hki = product.getAttribute("data-hki");
        const nutrition = product.getAttribute("data-nutrition");
        const haccp = product.getAttribute("data-haccp");

        product.addEventListener("click", () => {
            Dphoto.style.backgroundImage = "url(/product_photo/" + photo + ")";
            Dname.textContent = name;
            Ddescription.textContent = desc;
            Downer_name.textContent = owner_name;
            Dlocation.textContent =
                province + ", " + city + ", " + sub_district + ", " + village;
            Dphone_number.textContent = phone_number;
            Dprice.textContent = price;
            Dnib.textContent = nib;
            Dhalal.textContent = halal;
            Dpirt.textContent = pirt;
            Dbpom.textContent = bpom;
            Dhki.textContent = hki;
            Dnutrition.textContent = nutrition;
            Dhaccp.textContent = haccp;
        });
    });
});
