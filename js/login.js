$(document).ready(function() {

  $(".login_button").click(function(){
    if(!document.join.username.value){
      alert("Please insert username");
      document.join.username.focus();
      return;
    }

    if(!document.join.password.value){
      alert("Please insert password");
      document.join.password.focus();
      return;
    }

    if (!document.join.confirm_password.value){
      alert("Please insert confirm password");
      document.join.confirm_password.focus();
      return;
    }

    if (!document.join.fname.value)
    {
        alert("Please insert first name");
        document.join.fname.focus();
        return;
    }

    if (!document.join.lname.value)
    {
        alert("Please insert last name");
        document.join.lname.focus();
        return;
    }


    if (!document.join.email.value)
    {
        alert("Please insert email");
        document.join.email.focus();
        return;
    }

    document.join.submit();
  });

  $("#username").keyup(function(){
    var id = $('#username').val();
    $.ajax({
        type: "POST",
        url: "../member/check_id.php",
        data: "id="+ id,
        cache: false,
        success: function(data){
             $(".join p span.id_check").html(data);
        }
    });
  });

  $("#password").keyup(function(){
    var pw = $('#password').val();
    if(pw.length<8 ||pw.length>15){
      $(".pw_check").html("please insert 8~15 letters");
    }else{
      $(".pw_check").html("");
    }
  });

  $("#confirm_password").blur(function(){
    var pw= $('#password').val();
    var re_pw = $('#confirm_password').val();
    if(re_pw!=pw){
      $(".pw_check_dup").html("password doesn't match!");
    }else{
      $(".pw_check_dup").html("maching password");
    }
  });

  $("#email").keyup(function(){
    var email= $('#email').val();
    var exptext = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;

    if(exptext.test(email)==false){
      $(".email_check").html("Please enter correct email");
    }else{
      $(".email_check").html("");
      $(".email_check_js").attr('value','ok');
    }
  });




});
