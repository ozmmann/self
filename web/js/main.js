$(document).ready(function () {
    $('select.chosen').chosen({
        allow_single_deselect: true,
        width: "100%",
        no_results_text: "Ничего не найдено"
    });

    $('[type=url]').blur(function () {
        checkURL(this);
    });
});

function checkURL(abc) {
    var string = abc.value;
    if (string) {
        if (!~string.indexOf("http")) {
            string = "http://" + string;
        }
        abc.value = string;
        return abc;
    }
}

$(document).ready(function () {

    var allPanels = $('.accordion').find('.faq-content').hide();

    $('.accordion').find('.faq-header').children('a').click(function() {
        var faqBlock = $(this).parents('.faq-question');
        if(faqBlock.hasClass('active')){
            faqBlock.removeClass('active');
            faqBlock.find('.faq-content').slideUp();
        } else {
            faqBlock.find('.faq-content').slideDown();
            faqBlock.addClass('active');
        }
        return false;
    });

    jQuery(".phone").mask("+38 (000) 000-00-00", {
        placeholder: "+380 (ХХ) ХХХ-ХХ-ХХ"
    });

    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',
        mainClass: 'login-popup',
        closeMarkup: '<button title="Закрыть" type="button" class="mfp-close close"></button>',
        callbacks: {
            beforeOpen: function () {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }

                $('.show-password').click(function () {
                    var password_input = $(this).parent().siblings('#password'),
                        type = password_input.attr('type');
                    if (type == 'text') {
                        password_input.attr('type', 'password');
                    } else if (type == 'password') {
                        password_input.attr('type', 'text');
                    }
                });
            }
        }
    });
});

$(document).ready(function () {
        $('#login_form').on('beforeSubmit', function (event, jqXHR, settings) {
            var form = $(this);
            if (form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (data) {
                    $("#login_popup").find("#modalContent")
                        .html(data);
                    $(".show-password").click(function () {
                        var password_input = $(this).parent().siblings("#password"),
                            type = password_input.attr("type");
                        if (type == "text") {
                            password_input.attr("type", "password");
                        } else if (type == "password") {
                            password_input.attr("type", "text");
                        }
                    });
                }
            });

            return false;
        });
    }
);