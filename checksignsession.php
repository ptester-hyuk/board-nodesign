<?php
  //로그인 안한 경우
  if(!isset($_SESSION['userID'])){
    echo '<script>alert("회원가입 또는 로그인 필요."); location.href="./index.php";</script>';
  }
?>
