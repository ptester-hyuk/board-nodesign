<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/checksignsession.php';
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';
?>
<!DOCTYPE html>
<html lang="kor" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>관리자 페이지</title>
  </head>
  <body>
    <table>
      <br><br><br><br><h2>사용자 목록</h2><br>
      <thead>
        <th>번호</th>
        <th>사용자</th>
        <th>가입 시기</th>
        <th></th>
      </thead>
      <tbody>
        <tr>
            <?php
              $sql = "SELECT memberID, userID, regTime FROM mymember ";
              $result = $dbConnect->query($sql);

              if($result){
                $dataCount = $result->num_rows;

                if($dataCount > 0){
                  for($i = 0; $i < $dataCount; $i++){
                    $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
                    echo "<tr>";
                    echo "<td>".$memberInfo['memberID']."</td>";
                    echo "<td>{$memberInfo['userID']}</td>";
                    echo "<td>".date('Y-m-d H:i', $memberInfo['regTime'])."</td>";
                    echo "<td>";
                    if($memberInfo['userID'] != 'admin'){
                    ?>
                      <form method="post" name="delIDprocess" action="deleteID.php">
                        <input type="hidden" name="userID" value="$memberInfo['memberID']">
                        <input type="hidden" name="memberID" value="$memberInfo['userID']">
                      </form>
                    <?php
                  }
                    echo "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                }
              }
              ?>
            </tr>
          </tbody>
        </table>
  </body>
</html>
