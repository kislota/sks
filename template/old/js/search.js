$(function(){
    
    //Живой поиск
    $('#form-control-firstname').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "search_clients.php", //Путь к обработчику
                data: {'referal':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
    })
  
  $(".search_result").hover(function(){
    $("#form-control-firstname").blur(); //Убираем фокус с input
})
$('html').click(function(){
		$('.search_result').hide();
	});
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
	var myString = $(this).text();
    var s_user = myString.split(" ");
        $("#form-control-firstname").val(s_user[0]); //деактивируем input, если нужно
		$("#form-control-lastname").val(s_user[1]); //деактивируем input, если нужно
		$("#phone").val(s_user[2]); //деактивируем input, если нужно
        $(".search_result").fadeOut();
    })

})