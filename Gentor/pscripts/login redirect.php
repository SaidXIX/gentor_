<?php 
 
 if(isset($_POST['login'])){
    session_start();
    $server="localhost";
    $username="root";
    $password="Workzone";
    $dbname="gentor";

    $conn=mysqli_connect($server,$username,$password,$dbname) or die ("Error occured connecting to the database");

    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pwd=mysqli_real_escape_string($conn, $_POST['password']);
    $mdp=md5($pwd);

    $selectquery="SELECT * FROM user WHERE email = '$email' AND password = '$mdp'";
    $selectqueryExe=mysqli_query($conn,$selectquery) or die('Error Occured, Can not login');

    $rows=mysqli_num_rows($selectqueryExe);

    if($rows==1){
        $_SESSION['email']=$email;
      ?> <script>
        window.location='../views/dashboard.php';
      </script>
      <?php
    }
    else{
        ?> <script>
            alert('wrong password');
            window.location='../views/dashboard.php';
         </script>
        <?php
    }
 }
 

?>