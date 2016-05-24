// $('#login-form').on('submit', function(e) {
//     var username = $("#username").val();
//     var password = $("#password").val();
//     $.ajax({
//         url: "user/login",
//         type: "post",
//         data: {
//             ajax: 1,
//             username: username,
//             password: password
//         },
//         cache: false,
//         success: function(json) {
//             var error_message = json.error;
//             var success = json.logged_in;
//             if (typeof error_message !== "undefined") {
//                 $("#text-login-msg").html(error_message);
//             } else if (typeof success !== "undefined" && success == "1") {
//                 $("#text-login-msg").html("You've been successfully logged in!");
//                 $("#login-form").hide();
//             }
//         }
//     });
//     e.preventDefault();
// });
