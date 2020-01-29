<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $email = $_POST['yourEmail'];
  $YID = $_POST['yourID'];
  $pw = $_POST['yourPW'];
  $name = $_POST['yourName'];

  //이메일 검사 및 중복검사
  if(!filter_Var($email, FILTER_VALIDATE_EMAIL)){
    echo '<script>alert("올바른 이메일 주소가 아닙니다."); history.back(-2);</script>';
    exit;
  }

  $isEmailCheck = false;

  $sql = "SELECT email FROM mymember WHERE email = '$email'";
  $result = $dbConnect->query($sql);

  if($result){
    $count = $result->num_rows;
    if($count == 0){
      $isEmailCheck = true;
    } else{
      echo '<script>alert("이미 존재하는 이메일입니다."); history.back(-2);</script>';
      exit;
    }
  }

  //아이디 정규식 검사 및 중복 검사
  $userIDpattern = '/^[^0-9]{1}[a-z0-9]+$/';

  if(!preg_match($userIDpattern, $YID, $matches)){
    echo '<script>alert("아이디는 영어와 숫자만 입력 가능하고 숫자가 맨 앞에 올 수 없습니다."); history.back(-2);</script>';
    exit;
  }

  $isIDCheck = false;

  $sql = "SELECT userID FROM mymember WHERE userID = '$YID'";
  $result = $dbConnect->query($sql);

  if($result){
    $count = $result->num_rows;
    if($count == 0){
      $isIDCheck = true;
    } else{
      echo '<script>alert("이미 존재하는 아이디입니다."); history.back(-2);</script>';
      exit;
    }
  }

  //비밀번호 검사
  if($pw == null || $pw == ''){
    echo '<script>alert("비밀번호를 입력해주세요."); history.back(-2);</script>';
    exit;
  }
  //영문자, 숫자, 특수문자 혼합해서 6자리 이상 비밀번호
  $userPWpattern = '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/';

  if(!preg_match($userPWpattern, $pw, $matches)){
    echo '<script>alert("영문자, 숫자, 특수문자 혼합해서 6자리 이상 비밀번호를 입력하세요."); history.back(-2);</script>';
    exit;
  }

  $pw = sha1('H4C'.$pw);

  //아이디와 이메일 중복이 없으면 회원가입 완료 그렇지 않으면 실패
  if ($isEmailCheck == true && $isIDCheck == true){
    $regTime = time();
    $sql = "INSERT INTO mymember (email, userID, pw, name, regTime)";
    $sql .= "VALUES('$email', '$YID', '$pw', '$name', '$regTime')";
    $result = $dbConnect->query($sql);

    if($result){
      $_SESSION['memberID'] = $dbConnect->insert_id;
      $_SESSION['userID'] = $YID;

      echo '<script>alert("회원가입이 완료되었습니다."); location.href = "index.php";</script>';
    } else{
      echo '<script>alert("회원가입 실패 : 관리자 문의 요망"); history.back(-2);</script>';
      exit;
    }
  } else{
    echo '<script>alert("이메일 또는 아이디가 중복입니다."); history.back(-2);</script>';
    exit;
  }
?>
