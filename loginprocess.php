<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $UID = $_POST['loginID'];
  $passwd = $_POST['loginPW'];

  if($UID == null || $UID == ''){
    echo '<script>alert("아이디를 입력하세요."); history.back(-2);</script>';
    exit;
  }

  if($passwd == null || $passwd == ''){
    echo '<script>alert("비밀번호를 입력하세요."); history.back(-2);</script>';
    exit;
  }

  $passwd = sha1('H4C'.$passwd);

  $sql = "SELECT memberID, userID FROM mymember WHERE userID = '$UID' AND pw = '$passwd'";
  $result = $dbConnect->query($sql);

  if($result){
    if($result->num_rows == 0){
      echo '<script>alert("로그인 정보가 일치하지 않습니다."); history.back(-2);</script>';
      exit;
    } else{
      $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
      $_SESSION['memberID'] = $memberInfo['memberID'];
      $_SESSION['userID'] = $memberInfo['userID'];
      echo '<script>alert("로그인이 완료되었습니다."); location.href="./mainboard.php";</script>';
    }
  }
  ?>
