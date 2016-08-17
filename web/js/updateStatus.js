/**
 * Created by Sova on 10.06.2016.
 */
$(document).ready(function () {
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
});