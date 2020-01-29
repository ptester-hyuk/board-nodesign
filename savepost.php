<?php
include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/checksignsession.php';
include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

$title = $_POST['title'];
$content = $_POST['content'];

if($title != null && $title != ''){
  $title = $dbConnect->real_escape_string($title);
} else {
  echo '<script>alert("제목을 입력해주세요."); history.back(-2);</script>';
  exit;
}

if($content != null && $content != ''){
  $content = $dbConnect->real_escape_string($content);
} else {
  echo '<script>alert("내용을 입력해주세요."); history.back(-2);</script>';
  exit;
}

$memberID = $_SESSION['memberID'];

$regTime = time();

$sql = "INSERT INTO board (memberID, title, content, regTime) ";
$sql .= "VALUES ('$memberID', '$title', '$content', '$regTime')";
$result = $dbConnect->query($sql);

if($result){
  echo '<script>alert("저장 완료."); location.href="./mainboard.php";</script>';
} else {
  echo '<script>alert("저장 실패."); location.href="./mainboard.php";</script>';
}

?>
