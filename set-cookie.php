<?php
  //time() là thời gian hiện khi gọi lệnh -> unix time
setcookie("user", "Alex Porter", time()+3600);// expires in 1 hour
?>
