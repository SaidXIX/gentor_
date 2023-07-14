<?php 
session_start();
if(!isset($_SESSION['email'])){
    ?> <script>
        window.location="../views/index.html";
    </script>
    <?php
}

else{
    $email=$_SESSION['email'];

    $server="localhost";
    $username="root";
    $password="Workzone";
    $dbname="gentor";
    
    $conn=mysqli_connect($server,$username,$password,$dbname) or die ("Error occured connecting to the database");

    if(isset($_GET['d'])){
        $idProject=$_GET['idP'];

        //select the user
        $query = "SELECT * FROM user WHERE email = '$email'";
        $queryexe=mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($queryexe)){
            $userId=$row['id'];
        }

        $deleteproject="DELETE FROM project WHERE projectId= '$idProject' AND userId = '$userId'";
        $deleteprojectexe = mysqli_query($conn, $deleteproject);
        ?>  <script>
                window.location="../views/dashboard.php";
            </script> 
        <?php

    }
}

?>