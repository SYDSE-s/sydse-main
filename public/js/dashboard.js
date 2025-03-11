// const exportBtn = document.querySelector(".export-btn");

// exportBtn.addEventListener("click", () => {
//     var table = document.getElementById("data-table");

//     //convert table
//     var workbook = XLSX.utils.table_to_book(table);

//     //generate xlsx file
//     var excelData = XLSX.write(workbook, { bookType: "xlsx", type: "array" });

//     //save file
//     saveAs(
//         new Blob([excelData], { type: "application/octet-stream" }),
//         "users.xlsx"
//     );
// });

// const sidebarToggle = document.querySelector(".msbo");
// sidebarToggle.addEventListener("click", function () {
//     // document.body.classList.toggle("msb-x");
//     console.log("test");
// });
