$(function() {

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $("form").submit(function() {
        switch (this.id) {
            case "login-form":
                var lg_username = $('#login_username').val();
                var lg_password = $('#login_password').val();
                $.ajax({
                    url: "user/login",
                    type: "post",
                    data: {
                        username: lg_username,
                        password: lg_password
                    },
                    cache: false,
                    success: function(json) {
                        var error_message = json.error;
                        var success = json.success;
                        if (typeof error_message !== "undefined") {
                            msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", error_message);
                        } else if (typeof success !== "undefined" && success == "1") {
                            msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
                            $("#login-modal").modal("hide");
                        }
                    }
                });
                return false;
                break;
            case "lost-form":
                var $ls_email = $('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var rg_username = $('#register_username').val();
                var rg_email = $('#register_email').val();
                var rg_password = $('#register_password').val();
                $.ajax({
                    url: "user/register",
                    type: "post",
                    data: {
                        username: rg_username,
                        email: rg_email,
                        password: rg_password
                    },
                    cache: false,
                    success: function(json) {
                        var error_message = json.error;
                        var success = json.success;
                        if (typeof error_message !== "undefined") {
                            msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", error_message);
                        } else if (typeof success !== "undefined" && success == "1") {
                            msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Success! Please login");
                            $("#login-modal").modal("hide");
                        }
                    }
                });
                return false;
                break;
            default:
                return false;
        }
        return false;
    });

    $('#login_register_btn').click(function() {
        modalAnimate($formLogin, $formRegister)
    });
    $('#register_login_btn').click(function() {
        modalAnimate($formRegister, $formLogin);
    });
    $('#login_lost_btn').click(function() {
        modalAnimate($formLogin, $formLost);
    });
    $('#lost_login_btn').click(function() {
        modalAnimate($formLost, $formLogin);
    });
    $('#lost_register_btn').click(function() {
        modalAnimate($formLost, $formRegister);
    });
    $('#register_lost_btn').click(function() {
        modalAnimate($formRegister, $formLost);
    });

    function modalAnimate($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height", $oldH);
        $oldForm.fadeToggle($modalAnimateTime, function() {
            $divForms.animate({
                height: $newH
            }, $modalAnimateTime, function() {
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

    function msgFade($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }

    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }
});
