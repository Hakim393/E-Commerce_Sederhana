function togglePasswordVisibility() {
  const passwordInputSignup = document.getElementById("password");
  const eyeIconSignup = document.querySelector(".password-signup .eye-off");
  const eyeOffIconSignup = document.querySelector(".password-signup .eye");

  const passwordInputLogin = document.getElementById("passwordlog");
  const eyeIconLogin = document.querySelector(".password-login .eye-off");
  const eyeOffIconLogin = document.querySelector(".password-login .eye");

  if (passwordInputSignup.type === "password") {
    passwordInputSignup.type = "text";
    eyeIconSignup.style.display = "none";
    eyeOffIconSignup.style.display = "block";
  } else {
    passwordInputSignup.type = "password";
    eyeIconSignup.style.display = "block";
    eyeOffIconSignup.style.display = "none";
  }

  if (passwordInputLogin.type === "password") {
    passwordInputLogin.type = "text";
    eyeIconLogin.style.display = "none";
    eyeOffIconLogin.style.display = "block";
  } else {
    passwordInputLogin.type = "password";
    eyeIconLogin.style.display = "block";
    eyeOffIconLogin.style.display = "none";
  }
}

const checkbox = document.getElementById("chk");
const signupForm = document.querySelector(".signup");
const loginForm = document.querySelector(".login");

checkbox.addEventListener("change", function () {
  if (checkbox.checked) {
    signupForm.classList.add("active");
    loginForm.classList.add("active");
  } else {
    signupForm.classList.remove("active");
    loginForm.classList.remove("active");
  }
});
