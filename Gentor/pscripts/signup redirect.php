<?php 

if(isset($_POST['signup'])){
    session_start();
    $server="localhost";
    $username="root";
    $password="Workzone";
    $dbname="gentor";
    
    
    $conn=mysqli_connect($server,$username,$password,$dbname) 
    or die("you have problems connecting to the database");

    $user=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pwd=mysqli_real_escape_string($conn,$_POST['password']);
    $mdpass=md5($pwd);


//VERIFICATION EMAIL
$verifyquery="SELECT * FROM employe WHERE email = '$email'";
$verifyqueryexe=mysqli_query($conn,$verifyquery);
$present=mysqli_num_rows($verifyqueryexe);

if($present >0){
    
?> <script> alert('ce mail existe déja vous devez choisir un autre'); 
</script>
 <?php
    
    
}
else{
$insertquery="INSERT INTO user (username, email, password ) VALUES ('$user','$email','$mdpass')";

$insertqueryExe=mysqli_query($conn,$insertquery);
$_SESSION=$email;
echo "Registration Completed";
}


}



?>