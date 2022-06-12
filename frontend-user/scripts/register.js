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
        alert(response.data.message);
    } 

    let fname = response.data.message['fname'] ? response.data.message['fname'] + '\n' :"";
    let lname = response.data.message['lname'] ? response.data.message['lname'] + '\n' :"";
    let email = response.data.message['email'] ? response.data.message['email'] + '\n' :"";
    let password = response.data.message['password'] ? response.data.message['password'] + '\n' :"";
    alert(fname + lname + email + password);
    window.location.reload();
    });
})