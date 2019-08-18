<!DOCTYPE html>
<html>
<body>

<?php

session_start();
session_destroy();
// Redirect to the login page:
header('Location: login.php');
?>

</body>
</html>