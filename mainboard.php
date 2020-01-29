<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/checksignsession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';
?>
<!DOCTYPE html>
<html lang="kor" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>게시판</title>
  </head>
  <body>
    <h1><a href="mainboard.php">자유 게시판</a></h1>
    <br>
    <br>
    <?php echo "반갑습니다. '{$_SESSION['userID']}님'<br><br>"; ?>
    <input type="button" value="글 작성" onclick="location.href='writepost.php'">
    <input type="button" value="로그아웃" onclick="location.href='logout.php'">
    <?php
      if($_SESSION['userID'] == 'admin'){
    ?>
    <input type="button" value="관리자 페이지" onclick="location.href='admin.php'">
    <?php }?>
    <br>
    <br>
    <table>
      <thead>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>게시일</th>
      </thead>
      <tbody>
        <?php
          if(isset($_GET['page'])){
            $page = (int) $_GET['page'];
          } else {
            $page = 1;
          }

          $numview = 20;

          $firstLimitValue = ($numview * $page) - $numview;

          $sql = "SELECT b.boardID, b.title, m.userID, b.regTime FROM board b ";
          $sql .= "JOIN mymember m ON (b.memberID = m.memberID) ORDER BY boardID ";
          $sql .= "DESC LIMIT $firstLimitValue, $numview";
          $result = $dbConnect->query($sql);

          if($result){
            $dataCount = $result->num_rows;

            if($dataCount > 0){
              for($i = 0; $i < $dataCount; $i++){
                $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                echo "<tr>";
                echo "<td>".$memberInfo['boardID']."</td>";
                echo "<td><a href='/MyBoard/viewpost.php?boardID=";
                echo "{$memberInfo['boardID']}'>";
                echo $memberInfo['title'];
                echo "</a></td>";
                echo "<td>{$memberInfo['userID']}</td>";
                echo "<td>".date('Y-m-d H:i', $memberInfo['regTime'])."</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
            }
          }
        ?>
      </tbody>
    </table>
    <?php
    include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/nextPageLink.php';
    include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/searchPost.php';
    ?>
  </body>
</html>
