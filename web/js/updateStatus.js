/**
 * Created by Sova on 10.06.2016.
 */
$(document).ready(function () {
    $('.changeStatus').change(function (e) {
        var id = $(this).data('id');
        var status = $(this).val();
        $.ajax({
            url: '/moderator/edit-stock?id=' + id,
            method: 'post',
            data: {"status": status, "updateStatus": 1},
            success: function (result) {
                // console.log(result);
                location.reload();
            }
        });

    });
});