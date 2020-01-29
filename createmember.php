<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/connection.php';

  $sql = "CREATE TABLE MyMember (";
  $sql .= "memberID int(10) unsigned NOT NULL AUTO_INCREMENT,";
  $sql .= "email varchar(40) UNIQUE NOT NULL,";
  $sql .= "userID varchar(10) NOT NULL,";
  $sql .= "name varchar(10) NOT NULL,";
  $sql .= "pw varchar(40) DEFAULT NULL,";
  $sql .= "regTime int(11) NOT NULL,";
  $sql .= "PRIMARY KEY (memberID)";
  $sql .= ") CHARSET=utf8";

  $res = $dbConnect->query($sql);

  if($res){
    echo "테이블 생성 완료<br>";
  } else{
    echo "테이블 생성 실패";
  }
?>
