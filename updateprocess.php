<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $boardID = $_GET['boardID'];
  $title = $_GET['title'];
  $content = $_GET['content'];
  $regTime = time();

  $sql = "UPDATE board SET title='{$title}', content='{$content}', regTime='{$regTime}' ";
  $sql .= "WHERE boardID='{$boardID}'";

  $result = $dbConnect->query($sql);

  if($result){
?>
  <script>
    alert("수정되었습니다.");
    location.replace("./viewpost.php?boardID=<?=$boardID?>");
  </script>;
<?php
  } else{
    echo '<script>alert("수정 실패."); history.back(-2);</script>';
    exit;
  }
?>
