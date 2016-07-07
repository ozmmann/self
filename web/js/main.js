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

function checkURL (abc) {
    var string = abc.value;
    if(string) {
        if (!~string.indexOf("http")) {
            string = "http://" + string;
        }
        abc.value = string;
        return abc;
    }
}