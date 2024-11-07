function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("togglePasswordIcon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text"; // Show password
      toggleIcon.classList.remove("bi-eye-slash");
      toggleIcon.classList.add("bi-eye"); // Change icon to eye open
    } else {
      passwordInput.type = "password"; // Hide password
      toggleIcon.classList.remove("bi-eye");
      toggleIcon.classList.add("bi-eye-slash"); // Change icon to eye closed
    }
  }