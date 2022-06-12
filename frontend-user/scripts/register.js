let signup = document.getElementById("register");
signup.addEventListener("submit", function (event) {
  event.preventDefault();
  let email = document.getElementById("email");
  let password = document.getElementById("password");
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let data = new FormData();
  data.append("email", email.value);
  data.append("password", password.value);
  data.append("fname", fname.value);
  data.append("lname", lname.value);
  axios({
    method: "post",
    url: "http://127.0.0.1:8000/api/v1/user/register",
    data: data,
  }).then(function (response) {
    if (response.data.message == "User successfully registered") {
        window.location.href = "./login.html";
    //   alert(response.data.message);
    } 
    
    });
})