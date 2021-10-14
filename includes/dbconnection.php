<?php
    $con = mysqli_connect("sql211.epizy.com", "epiz_30040196", "vpx3dk2r", "epiz_30040196_supu");
    if(mysqli_connect_errno()){
        echo "Spoj na bazu neuspješan!".mysqli_connect_errno();
    }
?>