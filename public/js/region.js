const selectCity = document.querySelector(".select-city");
const optionCity = document.querySelectorAll('.select-city option');


let cityValue = selectCity.value;

const selectSubDIstrict = document.querySelector(".select-sub-district");

selectCity.addEventListener("change", () => {
    if (selectCity.value) {
        const selectedValue = selectCity.value
        console.log(`Value yang dipilih: ${selectedValue}`)
    } else {
        output.textContent = "Belum memilih opsi.";
    }
});