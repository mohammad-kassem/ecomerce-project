let token = localStorage.getItem("token");
if (!token) window.location.href = "./pages/login.html";

let add_product = document.getElementById("add-product");
let add_category = document.getElementById("add-category");
let upload_product = document.getElementById("upload-product");
let upload_category = document.getElementById("upload-category");
add_product.addEventListener("click", function(){
    upload_product.classList.remove("hide");
    upload_category.classList.add("hide");
})

add_category.addEventListener("click", function(){
    upload_product.classList.add("hide");
    upload_category.classList.remove("hide");
})

upload_product.addEventListener("submit", function (event) {
  event.preventDefault();
  let product_name = document.getElementById("product-name");
  let product_image = document.getElementById("product-image");
  let product_category = document.getElementById("product-category");
  let product_price = document.getElementById("product-price");
  let data = new FormData();
  data.append("name", product_name.value);
  data.append("image", product_image.files[0]);
  data.append("category_id", product_category.value);
  data.append("price", product_price.value);
  axios({
    method: "post",
    url: "http://127.0.0.1:8000/api/v1/admin/upload_product",
    headers: {"Authorization" : `Bearer ${token}`},
    data: data
  }).then(function (response) {
    if (response.data.message == "Product added successfully") {
        window.location.reload();
        alert(response.data.message);
        } 
    });
})

upload_category.addEventListener("submit", function (event) {
  event.preventDefault();
  let data = new FormData();
  let category_name = document.getElementById("category-name");
  data.append("name", category_name.value);
  axios({
    method: "post",
    url: "http://127.0.0.1:8000/api/v1/admin/upload_category",
    headers: {"Authorization" : `Bearer ${token}`},
    data: data
  }).then(function (response) {
    if (response.data.message == "Category added successfully") {
        window.location.reload();
        alert(response.data.message);
        } 
    });
})




