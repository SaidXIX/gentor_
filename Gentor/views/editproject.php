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

    $query="SELECT * FROM user WHERE email = '$email'";
    $queryexe=mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($queryexe)){
        $username=$row['username'];
        $idU=$row['id'];
    }

    if(isset($_GET['e'])){
        $idP=$_GET['idP'];
        echo $idP;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/editproject style.css">
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
            <div class="container">


<div id="getBack" style="text-align: center;">
    <button id="cancelBtn"><ion-icon name="return-down-back-outline"></ion-icon> Return</button>
    <img src="../assets/edit tasks.svg" alt="pic" style="width: 100%; height: 70%; margin-top:0%;">
</div>

<div id="addtask">
    <form action="" method="post">
        <div>
            <label for="projectname"><b>Project name</b></label>
            <br>
            <input required type="text" name="projectname" id="projectname"> <button class="add-button" id="addBtn" title="add task"><ion-icon name="add-outline"></ion-icon></button>
        </div>
        <div id="task" class="form-wrapper">
            <div>
            <label for="task"><b>Task</b></label>
            <br>
            <input required type="number" name="taskId[]" placeholder="Task Id "/>
            <input required type="text" name="taskName[]" id="taskName" placeholder="Name of the task" min="1">
            <input required type="number" name="taskDuration[]" id="taskDuration" placeholder="Duration">
            <input type="text" name="predecessor[]" id="predecessor" placeholder="Predecessor">
            <br>
            </div>
        </div>
        <hr>
        <div id="buttons">
                <button name="createGraph" id="createBtn"><ion-icon name="git-network-outline"></ion-icon> Create</button>
            <div>
    </form>
</div>
</div>









<script>
// list of str
// l = [appendhtml, ]
    var cancelBtn=document.getElementById("cancelBtn");
    cancelBtn.onclick = function(){
        window.location = "../views/dashboard.php";
    }

    jQuery(document).ready(function() {
        var maxLimit = 50;
        var appendHTML=
        '<div id="taskAdded"><label for="task"><b>Task</b></label><br><input required type="number" name="taskId[]" /><input required type="text" name="taskName[]" id="taskName" placeholder="Name of the task" min="1"><input required type="number" name="taskDuration[]" id="taskDuration" placeholder="Duration"><input type="text" name="predecessor[]" id="predecessor" placeholder="Predecessor"><button class="remove-button" title="delete task"><ion-icon name="trash-outline"></ion-icon></button><br></div>';

        var x=1;
    //add input field
        jQuery('.add-button').click(function(e){
            e.preventDefault();
            if(x < maxLimit){ 
            jQuery('.form-wrapper').append(appendHTML);
            x++;
            }
        });
        
    //delete input field    
    jQuery('.form-wrapper').on('click', '.remove-button', function(e){
        e.preventDefault();
        jQuery(this).parent('div').remove();
        x--;
    });

});
</script>


<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>