<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $searchKeyword = $dbConnect->real_escape_string($_POST['searchKeyword']);
  $searchOption = $dbConnect->real_escape_string($_POST['option']);

  if($searchKeyword == '' || $searchKeyword == null){
    echo '<script>alert("검색어가 없습니다."); history.back(-2);</script>';
    exit;
  }

  switch($searchOption){
    case 'title':
    case 'content':
    case 'tandc':
    case 'torc':
      break;
    default:
      echo "검색 옵션이 없습니다.";
      exit;
      break;
  }

  $sql = "SELECT b.boardID, b.title, m.userID, b.regTime FROM board b ";
  $sql .= "JOIN mymember m ON (b.memberID = m.memberID)";

  switch($searchOption){
    case 'title':
      $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
      break;
    case 'content':
      $sql .= "WHERE b.content LIKE '%{$searchKeyword}%'";
      break;
    case 'tandc':
      $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
      $sql .= " AND ";
      $sql .= "b.content LIKE '%{$searchKeyword}%'";
      break;
    case 'torc':
      $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
      $sql .= " OR ";
      $sql .= "b.content LIKE '%{$searchKeyword}%'";
      break;
  }

  $result = $dbConnect->query($sql);

  if($result){
    $dataCount = $result->num_rows;
  } else{
    echo '<script>alert("오류 발생 - 관리자 문의"); history.back(-2);</script>';
  }

?>

<!DOCTYPE html>
<html lang="kor" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>검색 결과</title>
  </head>
  <body>
    <h1><a href="mainboard.php">자유 게시판</a></h1>
    <br>
    <br>
    <input type="button" value="글 작성" onclick="location.href='writepost.php'">
    <input type="button" value="로그아웃" onclick="location.href='logout.php'">
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
              echo "<tr><td colspan='4'>{$searchKeyword}를 포함하는 게시글이 없습니다..</td></tr>";
            }
        ?>
      </tbody>
      <tfoot>
        <form method="post" action="mainboard.php">
          <input type="submit" value="이전">
        </form>
      </tfoot>
    </table>
  </body>
</html>
