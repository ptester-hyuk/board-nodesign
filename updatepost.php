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

  $title = $rows['title'];
  $content = $rows['content'];

  if(!isset($_SESSION['userID'])){
    echo '<script>alert("권한이 없습니다."); history.back(-2);</script>';
    exit;
  }else if($_SESSION['userID'] == $rows['userID']){
  ?>
      <form method="get" action="updateprocess.php">
        작성자 <input type="hidden" name="id" value="<?=$_SESSION['userID']?>"><?=$_SESSION['userID']?>
        <br>
        <br>
        제목
        <br>
        <br>
        <input type="text" name="title" value="<?=$title?>">
        <br>
        <br>
        내용
        <br>
        <br>
        <textarea name="content" cols="80" rows="20"><?=$content?></textarea>
        <br>
        <br>
        <input type="hidden" name="boardID" value="<?=$boardID?>">
        <input type="submit" value="수정">
      </form>
      <input type="button" value="이전" onclick="location.href='mainboard.php'">
    </body>
<?php
  } else {
    echo '<script>alert("권한이 없습니다."); history.back(-2);</script>';
    exit;
    }
?>
