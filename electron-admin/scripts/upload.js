let add_product = document.getElementById("add-product");
let add_category = document.getElementById("add-category");
let upload_product = document.getElementById("upload-product");
let upload_category = document.getElementById("upload-category");
add_product.addEventListener("click", function(){
    upload_product.classList.remove("hide");
    upload_category.classList.add("hide");
})
add_category.addEventListener("click", function(){
    console.log("hi");
    upload_product.classList.add("hide");
    upload_category.classList.remove("hide");
})