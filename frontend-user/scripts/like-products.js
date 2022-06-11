let token = localStorage.getItem("token");
if (!token) window.location.href = "./pages/login.html";
// display the products //
  axios({
    method: "get",
    url: "http://127.0.0.1:8000/api/v1/product/products",
    headers: {"Authorization" : `Bearer ${token}`}
  }).then(function (response) {
    let products_directory = document.getElementById("products-directory");
    // every row contains 3 retsaurant boxes so at i=0,3,6..... we create a new row
    let products = response.data.products;
    for (let i = 0; i < products.length; i++) {
      if (i % 3 === 0) {
        row = document.createElement("div");
        row.classList.add("products-row");
        products_directory.appendChild(row);
      }
      
      const product_box = document.createElement("div");
      product_box.classList.add("product-box");
      product_box.id = products[i].id;
      product_box.innerHTML = 
      `<div class="product-image-box">
        <img src=${products[i].image} alt="">
        </div>
    <div class="product-box-content">
      <h1> ${products[i].product_name} </h1>
      <p class="category"> ${products[i].category_id} </p>
      <div class="product-footer">
          <p class="price"> ${products[i].price}$ </p>
          <div id="liked${products[i].id}" class="like"><i class="fa-regular fa-heart"></i></div>
      </div>
    </div>`;

      //and always append the product boxes to the most recent row
      row.appendChild(product_box);

      // this takes you to the product you clicked on with the product id in the url
      product_box.addEventListener("click", function () {
        window.location.href =
          "./pages/product-reviews.html?user_id=" + user_id + "&product_id=" + product_box.id;
      });
    }
    for (let i = 0; i < products.length; i++) {
        if (products[i].length){
            let like_button = document.getElementById(`liked${products[i].id}`);
            console.log(like_button.id);
            like_button.innerHTML = `<i class="fa-solid fa-heart"></i>`
        }
    }
  });
