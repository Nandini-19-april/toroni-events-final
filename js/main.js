document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const email = document.querySelector("input[name='username']").value;
      const password = document.querySelector("input[name='password']").value;
      fetch("includes/login.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
      })
      .then(response => response.text())
      .then(data => {
        if (data === "success") {
          window.location.href = "events.php";
        } else {
          alert("Login failed. Redirecting to Sign Up.");
          window.location.href = "signup.html";
        }
      });
    });
  }
});
