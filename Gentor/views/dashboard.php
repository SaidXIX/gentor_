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

    $SelectQuery = "SELECt * FROM user WHERE email = '$email'";
    $SelectQueryExe=mysqli_query($conn,$SelectQuery);

    while($row=mysqli_fetch_assoc($SelectQueryExe)){
        $id=$row['id'];
        $username=$row['username'];
    }

    $SelectProjectsQuery = "SELECT * FROM project WHERE userId = '$id'";
    $SelectProjectsQueryEXE=mysqli_query($conn,$SelectProjectsQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard style.css">
    <link rel="icon" href="../assets/octagon.svg" type="favicon" sizes="32 * 32"/>
    <title>Gentor</title>
    <script src="../scripts/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav>
        <div id="navcontainer">
            <div id="logocontainer">
                <a href="index.html"><img src="../assets/gentor main.svg" id="GentorLogo"></a>
            </div>

            <div id="actionscontainer">
                    <div class="dropdown">
                        <button class="dropbtn"><?php echo $username; ?>   <ion-icon name="chevron-down-outline"></ion-icon></button>
                            <div class="dropdown-content">
                                <a href="#"><ion-icon name="settings-outline"></ion-icon>   Edit personal info</a>
                                <a href="../pscripts/logout redirect.php"><ion-icon name="log-out-outline"></ion-icon>    Log out</a>
                            </div>
                    </div>
            </div>
        </div>
    </nav>
   
    <div id="container">
        <div id="title">
           <h1>Projects</h1> 
        </div>
        <div id="action">
            <button id="addProject"><ion-icon name="add-outline"></ion-icon> Add a new project</button>
        </div>
    </div>

    <div id="displayprojects">
        <table>
            <tr>
                <th>PROJECTS</th>
                <th>ACTIONS</th>
            </tr>
            <?php 
                while($row=mysqli_fetch_assoc($SelectProjectsQueryEXE)){
                ?>
                <tr>
                    <td><?php echo $row['projectName']; ?></td>
                    <td>
                        <!--View GRAPH-->
                        <a class="operations" href="../views/display charts.php?projectId=<?php echo $row['projectId'] ;?>">
                            <ion-icon name="eye-outline"></ion-icon>
                        </a>

                        <!--Edit project tasks-->
                        <a  class="operations" href="../views/editproject.php?idP=<?php echo $row['projectId']; ?>&e=true">
                            <ion-icon name="create-outline"></ion-icon>
                        </a> 

                        <!--delete project-->
                        <a  class="operations" href="../pscripts/redirect.php?idP=<?php echo $row['projectId']; ?>&d=true">
                            <ion-icon name="trash-outline"></ion-icon>
                        </a>
                      
                    </td>
                </tr>

                <?php
                }
            ?>
    </div>



    <script>
        var addProject = document.getElementById("addProject");

        addProject.onclick = function(){
            window.location ="../views/addproject.php";
        }

    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>


<?php 

}

?>