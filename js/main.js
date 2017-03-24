
$(document).ready(function(){
  $('.mainSlider').bxSlider({
    auto:true,
    controls: false,
    speed : 1000,
    mode:'fade'
  })

  /*nav 주문********************************************************/
  $('.nav .box p span').each(function(index){
    $(this).after($(this).clone());
    $(this).parent('p').parent('.box').on({
      'mouseenter':function(){
        $(this).children('p').children('span.kor-n').animate({top:-40,color:'#fff'});
        $(this).children('p').children('span.eng-n').animate({top:-29,color:'#fff'});
        $(this).children('.line').animate({width:0, backgroundColor:'#fff'},200,function(){$(this).animate({width:200},200)});
        if($(this).children('.line').hasClass('colored')){
          $(this).animate({backgroundColor:'#e21836'})
        }else{
          $(this).animate({backgroundColor:'#006391'});
        }
      },
      'mouseleave':function(){
        $(this).children('p').children('span.kor-n').animate({top:0,color:'#000'});
        $(this).children('p').children('span.eng-n').animate({top:0,color:'#000'});
        if($(this).children('.line').hasClass('colored')){
          $(this).children('.line').animate({backgroundColor:'#e21836'});
        }else{
          $(this).children('.line').animate({backgroundColor:'#006391'});
        }
        $(this).animate({backgroundColor:'#fff'})
      }
    })
  })

  /*베스트메뉴********************************************************/
  var timer;//setInteral 저장 변수
  var norepeatInterval = false;
  function play(){
    if(!norepeatInterval){
      norepeatInterval = true;
      timer=setInterval(function(){
        $('.menu .quad .imgSliderWrap .imgslider').animate({left:-320},'swing',function(){
          $(this).append($(this).children('dl').eq(0));
          $(this).css({left:0});
        })
      },3000)
    }
  }
  function stop(){
    norepeatInterval = false;
    clearInterval(timer);
  }
  // $('.imgSliderWrap').on({
  //   'mouseenter':stop
  // })
  // $('.quad').on({
  //   'mouseenter':play
  // })
  play();
  $('.menu .quad .imgslider').css({width:320*$('.menu .quad .imgslider dl').length});
  $('.menu .quad .arrow .left').click(function(){
    $('.menu .quad .imgSliderWrap .imgslider').animate({left:-320},'swing',function(){
      $(this).append($(this).children('dl').eq(0));
      $(this).css({left:0});
      stop();
      setTimeout(function(){play(),3000});
    })
  })
  var dlLength =$('.menu .quad .imgSliderWrap .imgslider dl').length-1;
  $('.menu .quad .arrow .right').click(function(){
    var lastDl=$('.menu .quad .imgSliderWrap .imgslider dl').eq(dlLength);
    $('.menu .quad .imgSliderWrap .imgslider').prepend(lastDl);
    $('.menu .quad .imgSliderWrap .imgslider').css({left:-320});
    $('.menu .quad .imgSliderWrap .imgslider').animate({left:0},'swing');
    stop();
    setTimeout(function(){play(),3000});
  })

  $('.menu .quad .imgSliderWrap .imgslider dl').on('click',modal);
  $('.modalPage').on('click',modalOut);
  function modal(){
    stop();
    var modalIndex = $(this).index();
    var modalImg = $(this).children('dt').children('img').clone();
    var modalText = $(this).children('dd').children().clone();
    $('.modalPage').append(modalImg);
    $('.modalPage').append(modalText);
    $('.modalPage p').removeClass();
    $('.modalPage').fadeIn();
  }
  function modalOut(){
    $('.modalPage').fadeOut();
    $('.modalPage').empty();
    play();
  }

  /*신메뉴********************************************************/
  $('.menu .tres a dl dd').on({
    'mouseenter':function(){
      $(this).children('p').css({fontSize: 25, marginTop:60});
      $(this).children('p.discription').css({fontSize: 15});
      $(this).animate({top:0});
    },
    'mouseleave':function(){
      $(this).children('p').css({fontSize:16, marginTop:20});
      $(this).children('p.discription').css({marginTop:40});
      $(this).animate({top:300});
    }
  })

  /*menu 클릭시 화면 구성********************************************************/
  	$('.menu_nav ul li').on('click',pizzaMenu);
  	$('.header .top_nav ul li').on('click',pizzaMenu);
  	function pizzaMenu(e){
      if($(this).parents('ul').parents('div').hasClass('menu_nav')){
        e.preventDefault();
      }
  		var className = $(this).children('a').attr('class');
      var currentIndex = $(this).index();
      $('.menu_nav ul li').removeClass('on');
      $('.menu_nav ul li').children('.'+className).parents('li').addClass('on');
  		$('.menuList ul li').removeClass('on');
  		$('.menuList ul').children('.'+className).addClass('on');
  		var mHeight = $('.menuList ul li.on').height();
  		$('.menuList').css({height:mHeight});
      var dumT = $('.menuList ul li.on').attr('class');
      var dumT2 = dumT.split(" ");
      var menuText = dumT2[0].toUpperCase();
      $('.menu .menu_top .menuText h2').text(menuText);
      $('.menu .menu_top .img_wrapper li').removeClass('on');
      $('.menu .menu_top .img_wrapper li').eq(currentIndex).addClass('on');
  	}


})
