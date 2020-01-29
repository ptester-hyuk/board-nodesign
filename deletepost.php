<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $id = $_GET['userID'];
  $boardID = $_GET['boardID'];

  $sql = "SELECT b.title, b.content, m.userID, b.regTime, b.boardID FROM board b ";
  $sql .= "JOIN mymember m ON (b.memberID = m.memberID) ";
  $sql .= "WHERE b.boardID = '{$boardID}'";

  $result = $dbConnect->query($sql);
  $rows = $result->fetch_array(MYSQLI_ASSOC);

  if(!isset($_SESSION['userID'])){
    echo '<script>alert("권한이 없습니다."); history.back(-2);</script>';
    exit;
  }else if($_SESSION['userID'] == $rows['userID'] || $_SESSION['userID'] == 'admin'){
      $sql = "DELETE FROM board WHERE boardID = '{$boardID}'";
      $delete = $dbConnect->query($sql);
      if($delete){
        echo '<script>alert("삭제 완료."); location.href="./mainboard.php";</script>';
      } else{
        echo '<script>alert("삭제 실패."); history.back(-2);</script>';
      }
  }else {
    echo '<script>alert("권한이 없습니다."); history.back(-2);</script>';
    exit;
  }
?>
