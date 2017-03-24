$(document).ready(function(){
  /*header top_nav********************************************************/
  $('.top_nav li').on('mouseenter',function(){$(this).siblings().children('ul').slideUp();$(this).children('ul').stop().slideDown()})
  $('.top_nav').on('mouseleave',function(){$('.top_nav li ul').stop().slideUp();})

  $('.top_nav li a').on('focusin',function(){
    $(this).parents('li').siblings().children('ul').slideUp();
    $(this).siblings('ul').slideDown();
  })
})
