<?php
// logout.php
session_start();
session_destroy();
?>
<script>
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('funcionarios');
    window.location.href = 'index.php';
</script>