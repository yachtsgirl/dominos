<?
  session_start();
  unset($_SESSION['s_username']);
  unset($_SESSION['s_fname']);
  unset($_SESSION['s_lname']);
  unset($_SESSION['s_level']);

  echo("<script>
    location.href = '/domino/index.html';
    </script>"
  );
?>
