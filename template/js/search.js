$(function(){
    
    //Живой поиск
    $('#firstname').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'post',
                url: "/client/search", //Путь к обработчику
                data: {'client':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
        }
    })
  
  $(".search_result").hover(function(){
    $("#firstname").blur(); //Убираем фокус с input
})
$('html').click(function(){
		$('.search_result').hide();
	});
    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
	var myString = $(this).text();
    var s_user = myString.split(" ");
        $("#firstname").val(s_user[0]); //деактивируем input, если нужно
		$("#lastname").val(s_user[1]); //деактивируем input, если нужно
		$("#phone").val(s_user[2]); //деактивируем input, если нужно
        $(".search_result").fadeOut();
    })

})