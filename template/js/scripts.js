// ============= PRELOADER SCRIPT ===================
        $(window).load(function() { 
        	setTimeout(function() {
                $('#preloader').addClass('hid');
            }, 200); 
            setTimeout(function() {
                $('#preloader').hide();
            }, 800);
        });
// ============= END PRELOADER SCRIPT ===================
/*closestchild*/
 
        ;(function($){
          $.fn.closestChild = function(selector) {
            var $children, $results;
            
            $children = this.children();
            
            if ($children.length === 0)
              return $();
          
            $results = $children.filter(selector);
            
            if ($results.length > 0)
              return $results;
            else
              return $children.closestChild(selector);
          };
        })(window.jQuery);

/* /. closestchild*/


$(function(){
        var hPanelHide = 75; // В каком положении полосы прокрутки прятать верхнюю панель
        var top_show = 280; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
        var speed = 500; // Скорость прокрутки
    	var $backButton = $('#up');
        
        var tempScrollTop, currentScrollTop = 0;

    	$(window).scroll(function () { // При прокрутке попадаем в эту функцию
    		/* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
    		if ($(this).scrollTop() > top_show) {
    			$backButton.fadeIn();
    		}
    		else {
    			$backButton.fadeOut();
    		}
            

            currentScrollTop = jQuery(window).scrollTop();
        
            if (tempScrollTop < currentScrollTop ){
                if ($(this).scrollTop() > hPanelHide) {
    			$('.header-wrapper').addClass('hPanelHide');
        		}
        		else {
        			$('.header-wrapper').removeClass('hPanelHide');
        		}
            }
            
            else if (tempScrollTop > currentScrollTop ){
                $('.header-wrapper').removeClass('hPanelHide');
            }
            else if (tempScrollTop > currentScrollTop ){
                $('.header-wrapper').removeClass('hPanelHide');
            }
            tempScrollTop = currentScrollTop;

            
    	});
        
        
    	$backButton.click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
    		/* Плавная прокрутка наверх */
    		scrollto(0, speed);
    	});
        
        
        

// scrollto
    	window.scrollto = function(destination, speed) {
    		if (typeof speed == 'undefined') {
    			speed = 800;
    		}
    		jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination-60}, speed);
    	};
    	$("a.scrollto").click(function () {
    		var elementClick = $(this).attr("href")
    		var destination = $(elementClick).offset().top;
    		scrollto(destination);
    		return false;
    	});
// end scrollto 


//Chrome Smooth Scroll
        
        var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
        
        if(!iOS){
            try {
                $.browserSelector();
                if($("html").hasClass("chrome")) {
                    $.smoothScroll();
                }
            } catch(err) {
        
            };
        }
        
        
//Chrome Smooth Scroll end
        
        
        


// fancybox
        $('.fancybox').fancybox({
            padding: 0,
            openEffect  : 'fade',
            closeEffect : 'fade',
            nextEffect  : 'none',
            prevEffect  : 'none',
            helpers: {
            overlay: {
              locked: false
            }
            }
        });
        
        $('.fancyboxModal').fancybox({
            autoResize:true,            
            padding: 0,
            openEffect  : 'fade',
            closeEffect : 'fade',
            nextEffect  : 'none',
            prevEffect  : 'none',
            fitToView : false, 
            maxWidth: '100%',
            scrolling : "no",
            helpers: {
            overlay: {
              locked: false
            }
            }
        });
        

// end fancybox


// инициализация плагина jquery.maskedinput.js
        if(typeof $.mask !== "undefined"){
            $.mask.definitions['~']='[+-]';
            $('.tel').mask('+38(999)999-9999');
        }

// end

        
        

        
// validation
        
        $('.rf').each(function(){
            var item = $(this),
            
            btn = item.find('.btn');
            
            
            function checkInput(){
                item.find('select.required').each(function(){
                    if($(this).val() == '0'){
                        
                        // Если поле пустое добавляем класс-указание
                        $(this).parents('.form-group').addClass('error');
                        $(this).parents('.form-group').find('.error-message').show();

                    } else {
                        // Если поле не пустое удаляем класс-указание
                        $(this).parents('.form-group').removeClass('error');
                    }
                });
                
                
                
                
                
                item.find('input[type=text].required').each(function(){
                    if($(this).val() != ''){
                        // Если поле не пустое удаляем класс-указание
                        $(this).removeClass('error');
                    } else {
                        // Если поле пустое добавляем класс-указание
                        $(this).addClass('error');
                        $(this).parent('.form-group').find('.error-message').show();
                        
                    }
                });
                
                
                item.find('input[type=password].required').each(function(){
                    if($(this).val() != ''){
                        // Если поле не пустое удаляем класс-указание
                        $(this).removeClass('error');
                    } else {
                        // Если поле пустое добавляем класс-указание
                        $(this).addClass('error');
                        $(this).parent('.form-group').find('.error-message').show();
                        
                    }
                });
                
                
                if($('.pass1',item).length != 0){
                    var pass01 = item.find('.pass1').val();
                    var pass02 = item.find('.pass2').val();
                    if(pass01 != pass02){
                        $('.pass1, .pass2',item).addClass('error');
                        
                        
                        $('.pass1').parent('.form-group').find('.error-message').show();
                        $('.pass2').parent('.form-group').find('.error-message').show();
                    }
                }
                
                
                
                item.find('textarea.required').each(function(){
                    if($(this).val() != ''){
                        // Если поле не пустое удаляем класс-указание
                        $(this).removeClass('error');
                    } else {
                        // Если поле пустое добавляем класс-указание
                        $(this).addClass('error');
                        $(this).parent('.form-group').find('.error-message').show();
                        
                    }
                });
                
                item.find('input[type=email]').each(function(){
                    var regexp = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i;
                    var $this = $(this);
                    if($this.hasClass('required')){
                        
                        if (regexp.test($this.val())) {
                            $this.removeClass('error');
                        }else {
                            // Если поле пустое добавляем класс-указание
                            $this.addClass('error');
                            $(this).parent('.form-group').find('.error-message').show();
                        }
                    }else{
                        
                        if($this.val() != ''){
                            if (regexp.test($this.val())) {
                                $this.removeClass('error');
                            }else {
                            
                            $this.addClass('error');
                            $(this).parent('.form-group').find('.error-message').show();
                            }
                        }else{
                            $this.removeClass('error');
                        }
                    }
                    
                    
                });
                
                
                item.find('input[type=checkbox].required').each(function(){
                    if($(this).is(':checked')){
                        // Если поле не пустое удаляем класс-указание
                        $(this).removeClass('error');
                    } else {
                        // Если поле пустое добавляем класс-указание
                        $(this).addClass('error');
                        $(this).parent('.form-group').find('.error-message').show();
                    }
                });
                
            
            }

            btn.click(function(){
                checkInput();
                var sizeEmpty = item.find('.error:visible').size();
                if(sizeEmpty > 0){
                    return false;
                } else {
                    // Все хорошо, все заполнено, отправляем форму
                    
                    item.submit();
                    $.fancybox.close();
                }
            });

        });
        
        
        $('.required:not(.pass1, .pass2)').change(function(){
            if($(this).val() != ''){
                $(this).removeClass('error');
                $(this).parents('.form-group').find('.error-message').hide();
                $(this).parents('.form-group').find('.t-tip').tooltip('hide');
            }
            
        });
        
        $('.pass1').change(function(){
            if($(this).val() != ''){
                
                var pass1Val = $('.pass1').val();
                var pass2Val = $(this).parents('.rf').find('.pass2').val();
                
                if(pass1Val == pass2Val){
                    $('.pass1, .pass2').removeClass('error');
                    $('.pass1, .pass2').parents('.form-group').find('.error-message').hide();
                    $('.pass1, .pass2').parents('.form-group').find('.t-tip').tooltip('hide');
                }

            }
            
        });
        
        $('.pass2').change(function(){
            if($(this).val() != ''){
                
                var pass2Val = $('.pass2').val();
                var pass1Val = $(this).parents('.rf').find('.pass1').val();
                
                if(pass1Val == pass2Val){
                    $('.pass1, .pass2').removeClass('error');
                    $('.pass1, .pass2').parents('.form-group').find('.error-message').hide();
                    $('.pass1, .pass2').parents('.form-group').find('.t-tip').tooltip('hide');
                }

            }
            
        });
        
        
        $('select').change(function(){
            if($(this).val() == ''){     
                // Если значение empty
                $(this).parents('.form-group').removeClass('selected');

            } else {
                // Если значение не empty
                $(this).parents('.form-group').addClass('selected');
                $(this).parents('.form-group').removeClass('error');
            }
        });
        
// end validation
        
        
        
        

// tabs
    
      $('ul.tabs').on('click', 'li:not(.current)', function() {
        
        
        $(this)
          .addClass('current').siblings().removeClass('current')
          .closest('div.section').closestChild('div.box').removeClass('visible').eq($(this).index()).addClass('visible');
      });
      
      
      
        $('ul.tabs.mobile li').click(function(){
            $(this).parent().hide().siblings('.mobile-tab-header').html($(this).html());
            $('.mobile-tab-header').removeClass('active');
        });
      
        $('.mobile-tab-header').click(function(e){
            $(this).toggleClass('active');
            $(this).siblings('.tabs.mobile').toggle();
            e.stopPropagation();
        });
    
        
        $('body').click(function(){
            if($('.mobile-tab-header').is(':visible')){
                $('.tabs.mobile').hide();
                $('.mobile-tab-header').removeClass('active');
            }
        });
    
// end tabs   
        


     
// Mobile menu

        $('.mob-menu-btn').click(function(){
            $('.mobile-menu').addClass('open');
        });
        
        $('.mobile-menu-close').click(function(){
            $('.mobile-menu').removeClass('open');
        });
        
        $('.mobile-menu ul a').click(function(){
            $('.mobile-menu').removeClass('open');
        });
        
        
        $('.mobile-menu, .mob-menu-btn').click(function(e){
            e.stopPropagation();
        });
        $('body').click(function(){
            $('.mobile-menu').removeClass('open');
        });
    
// End mobile menu
                 
    
    
    
    
        
// Animation        
        
        if ( !$("html").hasClass("touch") ){
            
            if ( !$("body").hasClass("no-animate") ){

                $('.accordeon-section .img-wrapper, .services-section .element, .guarantee-section .row > div, .action-section .row > div, .application-inner .element').addClass("hidden");
                
                
                
                $('.accordeon-section .img-wrapper').viewportChecker({
                    classToAdd: 'visible animated fadeInUp',
                    offset: 400
                });
                
                $('.guarantee-section .row > div:first-of-type, .action-section .row > div:first-of-type').viewportChecker({
                    classToAdd: 'visible animated fadeInLeft',
                    offset: 200
                });
                
                $('.guarantee-section .row > div:last-of-type, .action-section .row > div:last-of-type').viewportChecker({
                    classToAdd: 'visible animated fadeInRight',
                    offset: 200
                });
                
                $('.services-section .element').viewportChecker({
                    classToAdd: 'visible animated fadeInUp',
                    offset: 200
                });
                
                $('.application-inner .element').viewportChecker({
                    classToAdd: 'visible animated fadeIn',
                    offset: 200
                });
            }
        }         
                 
                 
            
        $('.num1').viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100,
            callbackFunction: function(){
                $('#num1').animateNumber({ number: 1228 },2500);
            }
        });
        
        $('.num2').viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100,
            callbackFunction: function(){
                $('#num2').animateNumber({ number: 960 },2500);
            }
        });
        
        $('.num3').viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100,
            callbackFunction: function(){
                $('#num3').animateNumber({ number: 10 },1200);
            }
        });  
        
        $('.num4').viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100,
            callbackFunction: function(){
                $('#num4').animateNumber({ number: 38 },2000);
            }
        });        
                 
         
        
// End animation        
        


// Carousels
        
        $('.reviews-carousel').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            //autoplay: true,
            autoplaySpeed: 5000,
            speed: 700,
            fade: false,
            arrows: false,
            adaptiveHeight: true,
            asNavFor: '.rev-prev-carousel',     
        });
        
        
        $('.rev-prev-carousel').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            //autoplay: true,
            autoplaySpeed: 5000,
            speed: 700,
            fade: false,
            arrows: false,  
            asNavFor: '.reviews-carousel',  
            centerMode: true,
            focusOnSelect: true,
            centerPadding: 0 
        });
        
        
        
        
        $('.top-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            speed: 800,
            arrows: true,
            prevArrow: '<a href="#" class="slick-prev"></a>',
            nextArrow: '<a href="#" class="slick-next"></a>',
            dots: true,
            responsive: [
                {
                  breakpoint: 1365,
                  settings: {
                    arrows: false,
                  }
                }
              ]     
        });
        
// End Carousels
        
        
        
        
        
        $('#applicationsection .element .button').click(function(){
           var theme = $(this).data('theme'); 
           $('#themeInput').val(theme);
        });
        
        
        
       

// проверка на Internet Explorer 6-11
        var isIE = /*@cc_on!@*/false || !!document.documentMode;
            
        
        if(isIE){
            $('body').addClass('ie');
        }
// end
        
        
        
        
          
        
// countdown (счетчик для акций)
        
        
        var now = new Date();
        var actionYear = now.getFullYear();
        var actionMonth = now.getMonth()+1;
        var actionDay = now.getDate();
        
        /*
        инструкция: 
            счетчик по умолчанию обновляется каждые сутки, то есть акция идёт непрерывно.
            чтобы выставить реальную дату окончания акции необходимо раскомментировать переменные ниже (убрать в начале строки двойной слэш)
            и выставить им необходимые значения:
            - actionYear - это год наступления события
            - actionMonth - это месяц наступления события
            - actionDay - это день наступления события
            отсчет идет от начала суток, то есть от 00ч 00минут и до конца суток выставленной даты
            
            если поставить actionYear = 2015 (прошлая дата),  то счетчик прекратит отсчет и будет показывать нули
        */
        
        //actionYear = 2017; 
        //actionMonth = 12;
        //actionDay = 31;
        
        
        
        
    	var actionDate = new Date(actionYear, actionMonth -1, actionDay + 1),
        nowDate = new Date();
    	
    	if( actionDate > nowDate){
    		
    		ts = (new Date()).getTime() + 10*24*60*60*1000;
    	}
    		
    	$('#countdown').countdown({
    		timestamp	: actionDate
    	});
        
        
        
        
// countdown (счетчик для акций)
        
        
        
        
        
// accordeon
        var $thisElement, 
            $thisElementContent,
            $elements,
            $elementsContent;
            
        $('.accordeon .title').click(function(){
            $thisElement = $(this).parent();
            $thisElementContent = $thisElement.find('.element-content');
            $elements = $thisElement.siblings();
            $elementsContent = $elements.find('.element-content');
            
            $elements.removeClass('active');
            $elementsContent.slideUp();
            if(!$thisElement.hasClass('active')){
                $thisElement.addClass('active');
                $thisElementContent.slideDown();
            }else{
                $thisElement.removeClass('active');
                $thisElementContent.slideUp();
            }
            
        });
        
// end accordeon        
        
        



// Anchor menu       
                
        
        // Cache selectors
        var lastId,
            topMenu = $(".top-menu, .mobile-menu"),
            topMenuHeight = $(".top-menu").outerHeight()+15,
            // All list items
            menuItems = topMenu.find("a"),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function(){
              var item = $($(this).attr("href"));
              if (item.length) { return item; }
            });
        
        // Bind click handler to menu items
        // so we can get a fancy scroll animation
        menuItems.click(function(e){
          var href = $(this).attr("href"),
              offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
          $('html, body').stop().animate({ 
              scrollTop: offsetTop 
          }, 500);
          e.preventDefault();
        });
        
        // Bind to scroll
        $(window).scroll(function(){
           // Get container scroll position
           var fromTop = $(this).scrollTop()+topMenuHeight+50;
           
           // Get id of current scroll item
           var cur = scrollItems.map(function(){
             if ($(this).offset().top < fromTop)
               return this;
           });
           // Get the id of the current element
           cur = cur[cur.length-1];
           var id = cur && cur.length ? cur[0].id : "";
           
           if (lastId !== id) {
               lastId = id;
               // Set/remove active class
               menuItems
                 .parent().removeClass("active")
                 .end().filter("[href=#"+id+"]").parent().addClass("active");
           }                   
        });
        
// End anchor menu   


        var slWidth, totalWidth, screenPadding, windWidth;

        $("#slider").slider({
            min: 0,
        	max: 100,
        	value: 50,
            step: 1,
            slide: function( event, ui ) {
                windWidth = $(window).width();
                if( windWidth > 1230){
                    screenPadding = 45;
                }else{
                    screenPadding = 80;
                }
                slWidth = $("#slider").width();
                totalWidth = slWidth*ui.value/100 + screenPadding;
                $( ".it-was" ).css({"width":totalWidth});
            }
        });      
                
                
});// end ready



















