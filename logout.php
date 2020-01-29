<script>
    function confirmLogout() {
        if( confirm("정말 로그아웃 하시겠습니까?") ) {
            location.href = "./index.php";
        }
    }
    confirmLogout();
</script>
<?php
  include $_SERVER['DOCUMENT_ROOT'].'/MyBoard/session.php';
  unset($_SESSION['memberID']);
  unset($_SESSION['userID']);
?>
