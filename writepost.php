<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/checksignsession.php';
?>
<!DOCTYPE html>
<html lang="kor" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>글작성</title>
  </head>
  <body>
    <form name="writeboard" method="post" action="savepost.php">
      작성자 <input type="hidden" value="<?=$_SESSION['userID']?>"><?=$_SESSION['userID']?>
      <br>
      <br>
      제목
      <br>
      <br>
      <input type="text" name="title">
      <br>
      <br>
      내용
      <br>
      <br>
      <textarea name="content" cols="80" rows="20"></textarea>
      <br>
      <br>
      <input type="submit" value="저장">
    </form>
  </body>
</html>
