<?php
  $sql = "SELECT count(boardID) FROM board";
  $result = $dbConnect->query($sql);

  $boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
  $boardTotalCount = $boardTotalCount['count(boardID)'];

  $totalPage = ceil($boardTotalCount / $numview);
  
  echo "<a href='./mainboard.php?page=1'>처음</a>&nbsp;";

  if($page != 1){
    $previousPage = $page - 1;
    echo "<a href='./mainboard.php?page={$previousPage}'>이전</a>";
  }

  $pageTerm = 5;
  $startPage = $page - $pageTerm;

  if($startPage < 1){
    $startPage = 1;
  }

  $lastPage = $page + $pageTerm;

  if($lastPage >= $totalPage){
    $lastPage = $totalPage;
  }

  for($i = $startPage; $i <= $lastPage; $i++){
    $nowPageColor = 'unset';
    if($i == $page){
      $nowPageColor = 'hotpink';
    }
    echo "&nbsp<a href='./mainboard.php?page={$i}'";
    echo "style='color:{$nowPageColor}'>{$i}</a>&nbsp";
  }

  if($page != $totalPage){
    $nextPage = $page + 1;
    echo "<a href='./mainboard.php?page={$nextPage}'>다음</a>";
  }

  echo "&nbsp;<a href='./mainboard.php?page={$totalPage}'>끝</a>";
?>
