$(document).ready(function () {
    $('select.chosen').chosen({
        allow_single_deselect: true,
        width: "100%",
        no_results_text: "Ничего не найдено",
        search_contains: true
    });

    $('[type=url]').blur(function () {
        checkURL(this);
    });

    $('[disabled]').click(function (e) {
        e.preventDefault();
        return false;
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

    $('.accordion').find('.faq-header').children('a').click(function () {
        var faqBlock = $(this).parents('.faq-question');
        if (faqBlock.hasClass('active')) {
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
                        $(this).removeClass('active');
                    } else if (type == 'password') {
                        password_input.attr('type', 'text');
                        $(this).addClass('active');
                    }
                });
            }
        }
    });

    $('.stockpopup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',
        mainClass: 'login-popup',
        closeMarkup: '<button title="Закрыть" type="button" class="mfp-close close"></button>',
        callbacks: {
            open: function () {
                var mp = $.magnificPopup.instance,
                    t = $(mp.currItem.el[0]);

                $('#link_form').find('#stock_data_id').val(t.data('stock-id'));
            },

            beforeOpen: function () {
                if ($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }

                var stock_id = this.st.el.data('stock-id');

                $('#link_popup').find('.content')
                    .load('/moderator/modal-add-stock-link', {"id": stock_id}, function () {
                        $('#link_form').on('beforeSubmit', function (event, jqXHR, settings) {
                            var form = $(this);
                            var stock_data_id = form.find('#stock_data_id');

                            if (form.find('.has-error').length) {
                                return false;
                            }

                            $.ajax({
                                url: form.attr('action'),
                                type: 'post',
                                data: form.serialize(),
                                success: function (data) {
                                    $("#link_popup").find(".content")
                                        .html(data);
                                }
                            });

                            return false;
                        });

                        $('[type=url]').blur(function () {
                            checkURL(this);
                        });
                    });
            },
            close: function () {
                $("#link_popup").find(".content")
                    .html('<div class="f-15 fw-semi-bold">Загрузка...</div>');
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

        $('#link_form').on('beforeSubmit', function (event, jqXHR, settings) {
            var form = $(this);
            var stock_data_id = form.find('#stock_data_id');

            if (form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (data) {
                    $("#link_popup").find(".content")
                        .html(data);
                }
            });

            return false;
        });

        $('.changeStatus').change(function (e) {
            var id = $(this).data('id');
            var status = $(this).val();
            var el = $('#loader');
            var loader = $.magnificPopup;
            if ($.trim(el.html())) {
                loader.open({
                    items: {
                        src: el
                    },
                    mainClass: 'mfp-light',
                    closeOnContentClick: false,
                    closeOnBgClick: false,
                    closeBtnInside: false,
                    showCloseBtn: false,
                    type: 'inline'
                });
            }
            $.ajax({
                url: '/moderator/edit-stock?id=' + id,
                method: 'post',
                data: {"status": status, "updateStatus": 1},
                success: function (result) {
                    location.reload();
                },
                complete: function () {
                    loader.close();
                }
            });

        });

        $('#addSecondPhone').click(function () {
            $('#secondPhoneWrapper').removeClass('hidden');
            $(this).remove();
        });

        $("#slider").slick({
            dots: true,
            arrows: false
        });
    }
);