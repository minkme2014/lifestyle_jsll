<?php
if($_GET['user'] == 'Admin'){
    setcookie("dbuser", 'inventor_hospitl', 0, '/');
    setcookie("dbpass", 'inventor_hospital@321', 0, '/');
    setcookie("dbname", 'inventor_hospital', 0, '/');
    setcookie("dbmail", 'admin@demo.com', 0, '/');
}else{
    setcookie("dbuser", 'inventor_hospitl', 0, '/');
    setcookie("dbpass", 'inventor_hospital@321', 0, '/');
    setcookie("dbname", 'inventor_hospital', 0, '/');
    setcookie("dbmail", 'store@demo.com', 0, '/');
}
header("Location: https://inventory.meshink.xyz/primehealthcarechd/admin_dashboard");
?>