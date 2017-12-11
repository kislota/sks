$(document).ready(function () {
        $('#id_tehnika').change(function () {
    var id_tehnika = $(this).val();
    if (id_tehnika == '0') {
            $('#id_brend').html('<option>- выберите технику -</option>');
            $('#id_brend').attr('disabled', true);
            return(false);
}
$('#id_brend').attr('disabled', true);
$('#id_brend').html('<option>загрузка...</option>');

var url = 'get_brend.php';

$.get(
url,
"id_tehnika=" + id_tehnika,
function (result) {
            if (result.type == 'error') {
                    alert('error');
                    return(false);
}
else {
                            var options = '';
                    $(result.regions).each(function () {
                        options += '<option value="' + $(this).attr('id') + '">' + $(this).attr('name') + '</option>';
});
$('#id_brend').html(options);
$('#id_brend').attr('disabled', false);
}
},
"json"
);
});
});
