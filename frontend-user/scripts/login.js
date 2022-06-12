localStorage.clear();

let login = document.getElementById("login");
login.addEventListener("submit", function (event) {
  event.preventDefault();
  let user_email = document.getElementById("email");
  let user_password = document.getElementById("password");
  let data = new FormData();
  data.append("email", email.value);
  data.append("password", password.value);
  axios({
    method: "post",
    url: "http://127.0.0.1:8000/api/v1/user/login",
    data: data,
  }).then(function (response) {
    if (response.data.user.role.role_name == "user") {
      window.location.href = "../index.html";
    }
    localStorage.setItem("token", response.data.access_token);
  });
});