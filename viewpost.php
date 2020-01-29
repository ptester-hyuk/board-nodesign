<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/checksignsession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
    $boardID = $_GET['boardID'];
    $sql = "SELECT b.title, b.content, m.userID, b.regTime, b.boardID FROM board b ";
    $sql .= "JOIN mymember m ON (b.memberID = m.memberID) ";
    $sql .= "WHERE b.boardID = {$boardID}";
    $result = $dbConnect->query($sql);


    if($result){
      $contentInfo = $result->fetch_array(MYSQLI_ASSOC);
      echo "제목 : ". $contentInfo['title']. "<br>";
      echo "작성자 : " . $contentInfo['userID'] . "<br>";
      $regDate = date("Y-m-d h:i");
      echo "게시일 : {$regDate}<br><br><hr>";
      echo "내용 <br>";
      echo $contentInfo['content'].'<br>';
  ?>
    <input type="button" value="목록" onclick="location.href='mainboard.php'">
    <form method="get" action="updatepost.php">
      <input type="hidden" name="userID" value="<?=$contentInfo['userID']?>">
      <input type="hidden" name="boardID" value="<?=$contentInfo['boardID']?>">
      <input type="submit" value="수정">
    </form>
    <form method="get" action="deletepost.php">
      <input type="hidden" name="userID" value="<?=$contentInfo['userID']?>">
      <input type="hidden" name="boardID" value="<?=$contentInfo['boardID']?>">
      <input type="submit" value="삭제">
  <?php
    } else{
      echo '<script>alert("잘못된 접근입니다."); history.back(-2);</script>';
      exit;
    }
  }else {
    echo '<script>alert("잘못된 접근입니다."); history.back(-2);</script>';
    exit;
  }
?>
