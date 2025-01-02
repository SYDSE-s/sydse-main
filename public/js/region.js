$(document).ready(function () {
    // Ketika kota dipilih
    $("#citySelect").on("change", function () {
        const cityCode = $(this).find(":selected").data("code"); // Ambil data-code

        // Hapus data dropdown yang lebih rendah
        $("#subDistrictSelect").html('<option value="">Loading...</option>');
        $("#villageSelect").html('<option value="">Pilih Desa</option>');

        // AJAX untuk kecamatan
        $.ajax({
            url: "/get-regions",
            type: "GET",
            data: {
                parent_code: cityCode,
                level: "sub-district",
            }, // Kirim kode kota
            success: function (response) {
                $("#subDistrictSelect").html(
                    '<option value="">Pilih Kecamatan</option>'
                );
                response.forEach((region) => {
                    $("#subDistrictSelect").append(`
                    <option value="${region.nama}" data-code="${region.kode}">${region.nama}</option>
                `); // bagian yang saya rubah
                });
            },
            error: function () {
                alert("Gagal mengambil data kecamatan.");
            },
        });
    });

    // Ketika kecamatan dipilih
    $("#subDistrictSelect").on("change", function () {
        const subDistrictCode = $(this).find(":selected").data("code"); // Ambil data-code

        // Hapus data desa
        $("#villageSelect").html('<option value="">Loading...</option>');

        // AJAX untuk desa
        $.ajax({
            url: "/get-regions",
            type: "GET",
            data: {
                parent_code: subDistrictCode,
                level: "village",
            }, // Kirim kode kecamatan
            success: function (response) {
                $("#villageSelect").html(
                    '<option value="">Pilih Desa</option>'
                );
                response.forEach((region) => {
                    $("#villageSelect").append(`
                    <option value="${region.nama}" data-code="${region.kode}">${region.nama}</option>
                `); // bagian yang saya rubah
                });
            },
            error: function () {
                alert("Gagal mengambil data desa.");
            },
        });
    });
});
