var timerId;

function changeDiscount() {
    getAllocationTypes();
}

function getAllocationTypes() {
    if (timerId) {
        clearInterval(timerId);
    }
    timerId = setTimeout(function () {
        var categoryId = $('#stockform-categoryid').val();
        var discount = $('#discount').val();
        if (categoryId && discount)
            $.ajax({
                url: location.href,
                type: "post",
                data: {"categoryId": categoryId, "discount": discount, 'get': 'allocationTypes'},
                beforeSend: function () {
                    $('#loading').removeClass('hidden');
                },
                success: function (result) {
                    $('#loading').addClass('hidden');
                    if (result) {
                        var select = $('#stockform-commissiontype');
                        var selected = select.attr('data-selected');
                        var isEdit = false;
                        select.empty();
                        for (var key in result) {
                            if (key == selected) {
                                select.append('<option selected value="' + key + '" data-value="' + result[key]['value'] + '">' + result[key]['name'] + '</option>');
                                isEdit = true;
                            } else {
                                if(Object.keys(result).length > 1) {
                                    select.append('<option value="' + key + '" data-value="' + result[key]['value'] + '">' + result[key]['name'] + '</option>');
                                } else {
                                    select.append('<option selected value="' + key + '" data-value="' + result[key]['value'] + '">' + result[key]['name'] + '</option>');
                                    isEdit = true;
                                }
                            }
                        }
                        select.parents('#commissionTypeWrap').removeClass('hidden');
                        if(!isEdit) {
                            select.val('');
                        }
                        select.trigger("chosen:updated");
                        select.trigger("change");
                    } else {
                        var select = $('#stockform-commissiontype');
                        select.parents('#commissionTypeWrap').addClass('hidden');

                    }

                },
                error: function () {
                    $('#loading').addClass('hidden');
                }
            });
    }, 100)
}

function getCategoryCover(categoryId) {
    $.ajax({
        url: location.href,
        type: "post",
        data: {"categoryId": categoryId, 'get': 'categoryCovers'},
        success: function (result) {
            if(result && result.length > 0) {
                var wrap = $('#covers-wrap');
                wrap.children('img').each(function () {
                    $(this).remove();
                });
                // wrap.empty();
                for (var key in result) {
                    if (result[key].slice(4) == $('#stockform-picture').val()) {
                        wrap.prepend('<img src="' + result[key].slice(4) + '" class="img-thumbnail active" onclick="selectCover(this)">');
                    } else {
                        wrap.prepend('<img src="' + result[key].slice(4) + '" class="img-thumbnail" onclick="selectCover(this)">');
                    }
                }
                $('.default-images').removeClass('hidden');
            } else {
                $('.default-images').addClass('hidden');
            }

        }
    });
}

function selectCover(img) {
    $('.img-thumbnail').not(img).removeClass('active');
    $(img).addClass('active');
    $('#stockform-picture').val($(img).attr('src').replace('thumb_', ''));
    $('#stockform-picture').trigger('change');
    $('#stock-cover').attr('src', $(img).attr('src').replace('thumb_', ''));
}

function checkGroup(button) {
    var fields = button.parent().parent().find('.required .form-control');
    for (var i = 0; i < fields.length; i++) {
        if ($(fields[i]).val() == '') {
            return false;
        }
    }

    return true;
}

function isEmpty(el) {
    return !$.trim(el.html())
}

function whichDay(dateString) {
    var daysOfWeek = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
    return daysOfWeek[dateString.getDay()];
}

function whichMonth(dateString) {
    var months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    return months[dateString.getMonth()];
}

function unValid(el) {
    $(el).closest($('.valid')).removeClass('valid');
}

function countPrice() {
    var discount = $('#discount').val();
    var price = $('#stockform-price').val();
    var save = price * discount / 100;
    var new_price = price - save;

    new_price = cutPrice(new_price);
    $('#new_price').text(new_price);
    $('.price').text(new_price);
    $('#new_price').parent('#price').removeClass('no-data');

    save = cutPrice(save);
    $('#save').text(save);
}

function countProfit() {
    var commissiontype = $('#stockform-commissiontype');
    var discount = $('#discount').val();
    var price = $('#stockform-price').val();
    var commissionvalue = 0;
    var new_price = price - price * discount / 100;
    var profit = 0;

    if (commissiontype.val() && commissiontype.val().toLowerCase() == 'percent') {
        commissionvalue = commissiontype.find(':selected').data('value');
        var commissionUAH = new_price * commissionvalue / 100;
        profit = new_price - commissionUAH;

        commissionvalue = cutPrice(commissionvalue);

        $('#commission_percent').find('.percent-amount').text(commissionvalue);

        commissionUAH = cutPrice(commissionUAH);

        $('#commission_percent').find('.price-amount').text(commissionUAH);
        $('#commission_percent').removeClass('hidden');
        $('#commission_fixed').addClass('hidden');
    } else if (commissiontype.val() && commissiontype.val().toLowerCase() == 'fixed') {
        commissionvalue = commissiontype.find(':selected').data('value');
        profit = new_price;

        commissionvalue = cutPrice(commissionvalue);
        $('#commission_fixed').find('.price-amount').text(commissionvalue);

        $('#commission_fixed').removeClass('hidden');
        $('#commission_percent').addClass('hidden');

    } else {
        profit = new_price;
        $('#commission_percent').addClass('hidden');
        $('#commission_fixed').addClass('hidden');

    }

    profit = cutPrice(profit);
    $('#webmaster_reward').text(profit);
}

function validateEmpty(section) {
    var errors = 0;
    section.find($('.field-error')).each(function () {
        $(this).removeClass('field-error');
    });
    section.find($('.form-error-msg')).each(function () {
        $(this).text('');
    });

    section.find($('.required-field')).each(function () {
        var $this = $(this),
            input = $this.find($("[name^='StockForm']"));
        if (!input.val() && input.parent().is(':visible')) {
            errors++;
            $this.addClass('field-error');
            $this.find('.form-error-msg').text('Поле является обязательным');
        }

        input = $this.find($("[name^='OrganizerForm']"));
        if (!input.val() && input.parent().is(':visible')) {
            errors++;
            $this.addClass('field-error');
            $this.find('.form-error-msg').text('Поле является обязательным');
        }

        input = $this.find($("[name^='LocationForm']"));
        if (!input.val() && input.parent().is(':visible')) {
            errors++;
            $this.addClass('field-error');
            $this.find('.form-error-msg').text('Поле является обязательным');
        }
    });
    section.find($('.phone')).each(function () {
        var val = $(this).val();
        var tel = new RegExp(/^(\+?38\s?|)(|\()[0-9]{3}(|\))\s?(|\-)[0-9]{3}\s?(|\-)[0-9]{2}\s?(|\-)[0-9]{2}$/);
        // var tel = new RegExp('\s?(|\-)[0-9]{3}$');
        if (val && !tel.test(val)) {
            $(this).css("border-color", "#f00");
            errors++;
        } else {
            $(this).css("border-color", "#eaeff4");
        }
    });
    if (errors > 0) {
        section.removeClass('valid');
        return false;
    }

    section.addClass('valid');
    return true;
}

function phonePreview() {
    $('.phone').keyup(function () {
        var id = $(this).attr('id');
        $('#preview_' + id).text($(this).val());
    }).change(function () {
        var id = $(this).attr('id');
        $('#preview_' + id).text($(this).val());
    });
}

function cutPrice(price){
    // if (price.toString().indexOf('.') != -1) {
    //     if (price.toString().split(".")[1].length > 2) {
    //         if (!isNaN(parseFloat(price))) {
    //             price = parseFloat(price).toFixed(2);
    //         }
    //     }
    // }
    if (!isNaN(price)) {
        return Math.ceil(price);
    }
}

$(document).ready(function () {
    // $('.discount-but').click(changeDiscount);
    if ($('#stockform-picture').val()) {
        $('#stock-cover').attr('src', $('#stockform-picture').val());
    }

    phonePreview();

    var number = document.getElementById('conditionform-countperson');

// Listen for input event on numInput.
    number.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106)
            || (e.keyCode > 47 && e.keyCode < 58)
            || e.keyCode == 8
            || e.keyCode == 46)) {
            return false;
        }
    }

    $('.address-row').each(function () {
        var id = $(this).find('.address').attr('id');
        if (isEmpty($('#preview_' + id))) {
            var preview = '<div id="preview_' + id + '" class="f-14 lh-1-4 mtop-15">';
            preview += '<div class="preview_address"></div>';
            preview += '<div id="preview_phone_' + id + '"></div>';
            preview += '</div>';

            if ($('#place').append(preview)) {
                phonePreview();
            }

        }
    });

    $('.phone').each(function () {
        if ($(this).val()) {
            var id = $(this).attr('id');
            $('#preview_' + id).text($(this).val());
        }
    });

    getCategoryCover($('#stockform-categoryid').val());

    getAllocationTypes();

    $('.cancel').click(function (e) {
        e.preventDefault();
        var locationsCount = $(this).parents('#locations').data('locations-count');
        var newLocCount = locationsCount - 1;
        $(this).parents('.address-row').remove();
        $(this).parents('#locations').data('locations-count', newLocCount);
        var markerId = $(this).parents('.address-row').find('.address').attr('id');
        var marker = markers[markerId];
        marker.setMap(null);
        delete markers[markerId];
        $('#preview_' + markerId).remove();
    });

    $(document).on("keypress", ":input:not(textarea)", function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    var discountInp = $('#discount');
    var categorySelect = $('#stockform-categoryid');
    categorySelect.change(function () {
        if ($(this).val() != '') {
            // discountInp.removeAttr('disabled');
            // discountInp.parent().removeClass('disabled');
            getCategoryCover($(this).val());
        } else {
            // discountInp.parent().addClass('disabled');
            // discountInp.attr('disabled', 'disabled');
            // discountInp.val('');
            $('#commissionTypeWrap').addClass('hidden');
            $('#stockform-commissiontype').val('');
            $('#stockform-commissiontype').data('selected', '');
        }
    });

    if (discountInp.val() == '') {
        // discountInp.parent().addClass('disabled');
    } else {
        // discountInp.removeAttr('disabled');
    }

    discountInp.keydown(function () {
        if (event.keyCode < 48 || event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105) {
            if (event.keyCode == 8) {

            } else {
                event.preventDefault();
            }
        }
    });
    discountInp.change(function () {
        if ($(this).val() == '') {
            $('#commissionTypeWrap').addClass('hidden');
            $('#stockform-commissiontype').val('');
        } else {
            getAllocationTypes();
        }
    });

    $('.step-button').click(function () {
        if ($(this).data('action') == 'next') {
            if (checkGroup($(this))) {
                $('.step-content').slideUp(500);
                $($(this).data('target')).addClass('open').slideDown(500);
                $('.panel').each(function () {
                    $(this).removeClass('active');
                });
                $($(this).data('target')).parent('.panel').addClass('active');

            }
        } else {
            $('.step-content').slideUp(500);
            $($(this).data('target')).addClass('open').slideDown(500);
            $('.panel').each(function () {
                $(this).removeClass('active');
            });
            $($(this).data('target')).parent('.panel').addClass('active');
        }
    });

    $('#add-image').change(function () {
        var form = $('#w0');
        var el = $(this).parents('#covers-wrap').find('.img-item').last();
        var self = this;
        var formData = new FormData(form.get(0));
        formData.append('upload', 1);
        $.ajax({
            url: location.href,
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (result) {
                $('#stockform-picture').val(result);
                $('.img-thumbnail').removeClass('active');
                var img = '<img src="' + result.slice(4) + '" class="active img-thumbnail" onclick="selectCover(this)">';
                if (isEmpty(el)) {
                    el = $(self).parents('#covers-wrap');
                    el.prepend(img);
                } else {
                    el.after(img);
                }

                $('#stockform-picture').val(result.slice(4).replace('thumb_', ''));
                $('#stock-cover').attr('src', result.slice(4).replace('thumb_', ''));
            }
        });
    });

    $('#add-logo').change(function () {
        var form = $('#w0');
        var formData = new FormData(form.get(0));
        formData.append('uploadLogo', 1);
        $.ajax({
            url: location.href,
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (result) {
                $('#logo-wrap').html('<img src="' + result.slice(4) + '" class="img-thumbnail">');
                $('#organizerform-logo').val(result.slice(4));
            }
        });
    });

    if ($('#conditionform-iscount').is(':checked')) {
        $('#countPersonWrap').removeClass('hidden');
    }

    $('#conditionform-iscount').change(function () {
        if ($(this).is(':checked')) {
            $('#countPersonWrap').removeClass('hidden');
        } else {
            $('#countPersonWrap').addClass('hidden');
        }
    });

    // $('.form-control').keyup(function (event) {
    $("[name^='StockForm']").keyup(function (event) {
        var target = '#stock' + $(this).attr('id').substr($(this).attr('id').indexOf('-'));
        $(target).removeClass('no-data');

        if (event.keyCode == 8) {
            var str = $(target).text();
            $(target).text(str.substr(0, -1));
        }
        $(target).text($(this).val());
    }).change(function (event) {
        var target = '#stock' + $(this).attr('id').substr($(this).attr('id').indexOf('-'));
        $(target).removeClass('no-data');

        if (event.keyCode == 8) {
            var str = $(target).text();
            $(target).text(str.substr(0, -1));
        }
        $(target).text($(this).val());
    });

    $("[name^='StockForm']").each(function (event) {
        var target = '#stock' + $(this).attr('id').substr($(this).attr('id').indexOf('-'));
        if ($(this).val()) {
            $(target).removeClass('no-data');
            $(target).text($(this).val());
        }
    });

    $('#stockform-categoryid').chosen().change(function () {
        getAllocationTypes();
        unValid(this);
    });

    $('#addlocation').click(function () {
        var locationsCount = $(this).parents('#locations').data('locations-count');
        var id = locationsCount;
        var addressId = 'address_' + id;

        var newLocation = '<div id="location_' + id + '" class="address-row">';
        newLocation += '<div class="db mtop-50">';
        newLocation += '<h4>Добавить локацию</h4>';
        newLocation += '</div>';
        newLocation += '<textarea id="address_' + id + '" name="LocationForm[address][]" class="w-100 address" placeholder="ул. Парашютная 12/14 1"></textarea>';
        newLocation += '<div class="f-0 mtop-20">';
        newLocation += '<div class="dib w-50 f-14">';
        newLocation += '<input id="city_' + addressId + '" class="city_' + addressId + ' w-85 city" name="LocationForm[city][]" placeholder="Киев" disabled="true">';
        newLocation += '<input type="hidden" class="city_' + addressId + '" name="LocationForm[city][]" >';
        newLocation += '</div>';
        newLocation += '<div class="dib w-50 f-14 text-right">';
        newLocation += '<input id="phone_' + addressId + '" class="w-100 phone" name="LocationForm[phone][]" placeholder="+380 (ХХ) ХХХ-ХХ-ХХ">';
        newLocation += '</div>';
        newLocation += '<div class="text-right">';
        newLocation += '<button type="button" class="cancel btn btn-blue">Отменить</button>';
        newLocation += '</div>';
        newLocation += '</div>';
        // newLocation += '<div class="text-right">';
        // newLocation += '<button class="btn btn-blue">Отменить</button> ';
        // newLocation += '<button class="btn btn-blue">Сохранить</button>';
        // newLocation += '</div>';
        newLocation += '</div>';

        if ($(this).parent().before(newLocation)) {
            var newLocationCount = locationsCount + 1;
            $(this).parents('#locations').data('locations-count', newLocationCount);
            var autocomplete_ = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById(addressId)),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete_.addListener('place_changed', function () {
                codeAddress(addressId);
                fillInAddress(addressId, this.getPlace());
            });

            $('.cancel').click(function (e) {
                e.preventDefault();
                var locationsCount = $(this).parents('#locations').data('locations-count');
                var newLocCount = locationsCount - 1;
                $(this).parents('.address-row').remove();
                $(this).parents('#locations').data('locations-count', newLocCount);
                var markerId = $(this).parents('.address-row').find('.address').attr('id');
                var marker = markers[markerId];
                marker.setMap(null);
                delete markers[markerId];
                $('#preview_' + markerId).remove();
            });
        }

        var preview = '<div id="preview_' + addressId + '" class="f-14 lh-1-4 mtop-15">';
        preview += '<div class="preview_address"></div>';
        preview += '<div id="preview_phone_' + addressId + '"></div>';
        preview += '</div>';

        if ($('#place').append(preview)) {
            phonePreview();
        }
    });

    var start = $('#stockform-startdate').pickadate({
        min: true,
        today: '',
        clear: '',
        close: '',
        select: $(this).val(),
        monthsFull: ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"],
        monthsShort: ["янв", "фев", "мар", "апр", "май", "июн", "июл", "авг", "сен", "окт", "ноя", "дек"],
        weekdaysFull: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
        weekdaysShort: ["вс", "пн", "вт", "ср", "чт", "пт", "сб"],
        firstDay: 1,
        format: "d mmmm yyyy г.",
        formatSubmit: "yyyy-mm-dd",
        onStart: function () {
            $('.picker__day').each(function () {
                var timestamp = $(this).data('pick');
                var date = new Date(timestamp);
                var day = whichDay(date);
                var month = whichMonth(date);
                $(this).attr('data-month', day);
                $(this).attr('data-day', month);
            });
        },
        onRender: function () {
            $('.picker__day').each(function () {
                var timestamp = $(this).data('pick');
                var date = new Date(timestamp);
                var day = whichDay(date);
                var month = whichMonth(date);
                $(this).attr('data-day', day);
                $(this).attr('data-month', month);
            });
        }
    });

    var end = $('#stockform-enddate').pickadate({
        min: true,
        today: '',
        clear: '',
        close: '',
        select: $(this).val(),
        monthsFull: ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"],
        monthsShort: ["янв", "фев", "мар", "апр", "май", "июн", "июл", "авг", "сен", "окт", "ноя", "дек"],
        weekdaysFull: ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"],
        weekdaysShort: ["вс", "пн", "вт", "ср", "чт", "пт", "сб"],
        firstDay: 1,
        format: "d mmmm yyyy г.",
        formatSubmit: "yyyy-mm-dd",
        onStart: function () {
            $('.picker__day').each(function () {
                var timestamp = $(this).data('pick');
                var date = new Date(timestamp);
                var day = whichDay(date);
                var month = whichMonth(date);
                $(this).attr('data-month', day);
                $(this).attr('data-day', month);
            });
        },
        onRender: function () {
            $('.picker__day').each(function () {
                var timestamp = $(this).data('pick');
                var date = new Date(timestamp);
                var day = whichDay(date);
                var month = whichMonth(date);
                $(this).attr('data-day', day);
                $(this).attr('data-month', month);
            });
        }
    });
    var pickerstart = start.pickadate('picker');
    var pickerend = end.pickadate('picker');
    pickerstart.set('select', new Date($('#stockform-startdate').val()));
    pickerend.set('select', new Date($('#stockform-enddate').val()));

    pickerstart.on('set', function(e) {
        if (e.select) {
            pickerend.set('min', new Date(e.select));
        }
    });

});

$(document).ready(function () {
    var keypressSlider = document.getElementById('precentslider'),
        input = document.getElementById('discount'),
        resultElement = document.getElementsByClassName('current'),
        isFirstUpdate = true;

    noUiSlider.create(keypressSlider, {
        start: input.value ? input.value : 50,
        step: 1,
        range: {
            'min': 0,
            'max': 100
        },
        format: wNumb({
            decimals: 0
        })
    });

    keypressSlider.noUiSlider.on('update', function (values, handle) {
        input.value = values[handle];
        $(resultElement).text(values[handle]);
        $('.discount').text(values[handle]);
        countPrice();
        if (!isFirstUpdate) {
            changeDiscount();
        }

        countProfit();
        unValid(resultElement);
        isFirstUpdate = false;
    });

    input.addEventListener('change', function () {
        keypressSlider.noUiSlider.set(this.value);
    });

    input.addEventListener('keyup', function () {
        if (this.value)
            keypressSlider.noUiSlider.set(this.value);
    });

    // Listen to keydown events on the input field.
    input.addEventListener('keydown', function (e) {

        // Convert the string to a number.
        var value = Number(keypressSlider.noUiSlider.get()),
            sliderStep = keypressSlider.noUiSlider.steps();

        // keypressSlider.noUiSlider.set([null, this.value])

        // Select the stepping for the first handle.
        sliderStep = sliderStep[0];

        // 13 is enter,
        // 38 is key up,
        // 40 is key down.
        switch (e.which) {
            case 13:
                keypressSlider.noUiSlider.set(this.value);
                break;
            case 38:
                keypressSlider.noUiSlider.set(value + sliderStep[1]);
                break;
            case 40:
                keypressSlider.noUiSlider.set(value - sliderStep[0]);
                break;
        }
    });


    $("#stockform-price").keyup(function (event) {
        $('.full-price').text($(this).val());
        countPrice();
        countProfit();
    }).change(function (event) {
        $('.full-price').text($(this).val());
        countPrice();
        countProfit();
    });

    $('#stockform-commissiontype').chosen().change(function () {
        countProfit();
        unValid(this);
    });

    $(document).on("click", ".js-toggle", function (e) {
        e.preventDefault();
        $($(this).data("toggle")).toggle();
    });

    $(".row .row-title").click(function (e) {
        if ($(this).parents('.row').hasClass('valid') || $(this).parents('.row').hasClass('open')) {
            e.preventDefault();
            $(".row.active").removeClass("active");
            $(this).parent().toggleClass("active");
        }
    });

    $(".row .btn-next-step").click(function (e) {
        if ($(this).attr('type') != 'submit') {
            e.preventDefault();
            if (validateEmpty($(this).parents('.row'))) {
                $(this).parents('.row').addClass('valid');
                $(this).parents('.row').addClass('open');
                $(".row.active").removeClass("active");
                $(".row.active").removeClass("open");
                $("html, body").animate({
                    scrollTop: $(this).closest(".row").next().addClass("active").addClass("open").offset().top
                }, 450);
                $("#sidebar").animate({
                    scrollTop: $(this).closest(".row").next().find(".row-title").position().top
                }, 450);
            } else {
                $("#sidebar").animate({
                    scrollTop: $(this).closest(".row").find(".field-error").first().position().top
                }, 450);
            }
        } else {
            if (validateEmpty($(this).parents('.row'))) {
                return true;
            }
            e.preventDefault();
        }
    });

    $('input, textarea').on('keyup change', function () {
        unValid(this);
    });

    $('textarea').each(function () {
        var self = $(this);
        var text_max = self.attr('maxlength') ? self.attr('maxlength') : 255;
        var input = self.siblings('.text');
        input.html(text_max + ' символов осталось');
        self.keyup(function () {
            var x = self.val();
            var newLines = x.match(/(\r\n|\n|\r)/g);
            var addition = 0;
            if (newLines != null) {
                addition = newLines.length;
            }

            var text_length = x.length + addition;

            var text_remaining = text_max - text_length;

            input.html(text_remaining + ' символов осталось');
        });
    })

});
