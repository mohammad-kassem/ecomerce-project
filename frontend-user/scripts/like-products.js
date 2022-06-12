let token = localStorage.getItem("token");
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
    }
    for (let i = 0; i < products.length; i++) {
        if (products[i].users.length){
            let like_button = document.getElementById(`liked${products[i].id}`);
            like_button.innerHTML = `<i class="fa-solid fa-heart"></i>`
        }
    }
    
      // like a product //
      let like_buttons = document.getElementsByClassName(`like`);
      let product_id = 0;
      for (let i = 0; i< like_buttons.length; i++){
        like_buttons[i].addEventListener('click', function(){
          product_id = like_buttons[i].id;
          product_id = product_id[product_id.length - 1];
          console.log(product_id);
          data = new FormData();
          data.append('id', product_id);
          axios({
            method: "post",
            url: "http://127.0.0.1:8000/api/v1/product/like_product",
            headers: {"Authorization" : `Bearer ${token}`},
            data: data,
          }).then(function (response) {
            if (like_buttons[i].innerHTML == `<i class="fa-solid fa-heart"></i>`) like_buttons[i].innerHTML = `<i class="fa-regular fa-heart"></i>`;
            else  like_buttons[i].innerHTML = `<i class="fa-solid fa-heart"></i>`;
        });

      });
      }
  });





