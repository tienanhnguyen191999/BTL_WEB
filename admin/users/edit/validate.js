// Validate Store new User
$(document).ready(function () {
  function validateInput() {
    let email = $('[name="email"').val();
    let password = $('[name="password"').val();
    let repassword = $('[name="re_password"').val();

    // Validate Email
    let isValidEmail = true;
    $.ajax({
      url: "/api/getUserByEmail.php",
      type: "GET",
      dataType: "json",
      data: { email },
      async: false,
      success: function (data) {
        let { user } = data;
        if (user != null) {
          isValidEmail = false;
          toastr.error("Email đã được đăng kí");
        }
      },
    });

    if (!isValidEmail) return false;
    // Validate Password
    if (password != repassword) {
      toastr.error("Mật khẩu nhập lại không trùng");
      return false;
    }
    return true;
  }

  $("#main-form").submit(function (e) {
    let isPrevent = validateInput();
    console.log(isPrevent);
    if (!isPrevent) {
      e.preventDefault();
    }
  });
});
