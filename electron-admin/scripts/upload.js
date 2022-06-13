let token = localStorage.getItem("token");
if (!token) window.location.href = "./pages/login.html";

let add_product = document.getElementById("add-product");
let add_category = document.getElementById("add-category");
let upload_product = document.getElementById("upload-product");
let upload_category = document.getElementById("upload-category");
let product_category = document.getElementById("product-category");
let profile_logo = document.getElementById("profile-logo");


profile_logo.addEventListener("click", function(){
  localStorage.clear();
  window.location.href = "./pages/login.html";
})

add_product.addEventListener("click", function(){
    upload_product.classList.remove("hide");
    upload_category.classList.add("hide");
})

add_category.addEventListener("click", function(){
    upload_product.classList.add("hide");
    upload_category.classList.remove("hide");
})

axios({
  method: "get",
  url: "http://127.0.0.1:8000/api/v1/admin/categories",
  headers: {"Authorization" : `Bearer ${token}`}
}).then(function (response) {
  let categories =  response.data.categories;
  for (let i=0; i< categories.length; i++){
    const category_option = document.createElement("option");
    category_option.setAttribute("value", categories[i].id);
    category_option.innerText = categories[i].category_name;
    product_category.appendChild(category_option);
  }
})

upload_product.addEventListener("submit", function (event) {
  event.preventDefault();
  let product_name = document.getElementById("product-name");
  let product_image = document.getElementById("product-image");
  let product_category = document.getElementById("product-category");
  let product_price = document.getElementById("product-price");

  let reader = new FileReader();
  reader.readAsDataURL(product_image.files[0]);
  reader.addEventListener('loadend', function(){
    let data = new FormData();
    data.append("name", product_name.value);
    data.append("image", reader.result);
    data.append("category_id", product_category.value);
    data.append("price", product_price.value);
    axios({
      method: "post",
      url: "http://127.0.0.1:8000/api/v1/admin/upload_product",
      headers: {"Authorization" : `Bearer ${token}`},
      data: data
    }).then(function (response) {
        window.location.reload();
      });
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
      window.location.reload();
    });
})




