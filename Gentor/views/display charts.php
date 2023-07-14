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
    
    $projectId = $_GET['projectId'];
    $SelectTasksQuery="SELECT * FROM task WHERE projectId = '$projectId'";
    $SelectTasksQueryExe=mysqli_query($conn,$SelectTasksQuery);

    $taskarray=array();

    while($row=mysqli_fetch_assoc($SelectTasksQueryExe)){
        $taskId=$row['taskNbr'];
        $taskName=$row['taskName'];
        $taskDuration=$row['taskDuration'];
        $predecessor = $row['predecessor'];

 
        if(empty($predecessor)){
            $task=array();
            array_push($task, $taskId,$taskDuration, $taskName);

        }
        else{
            $dependsOn=explode(";", $predecessor);
            $task=array();
            array_push($task, $taskId, $taskDuration, $taskName, $dependsOn);
   
        }

       
  
        array_push($taskarray, $task);
        
    }
   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/display charts.css">
    <link rel="icon" href="../assets/octagon.svg" type="favicon" sizes="32 * 32"/>
    <title>Gentor</title>
    <script src="../scripts/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js" type="text/javascript"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pert.min.js" type="text/javascript"></script>
</head>
<body>


    <div id="pertChart">
       
    </div>


    <script>
	   anychart.onDocumentReady(function () {


       var array=<?php echo json_encode($taskarray); ?>;

       var objarray=[];
       for(var i=0; i<array.length; i++){

        const obj = Object.assign({}, array[i]);
        objarray.push(obj);
        
        obj['id']=obj['0'];
        delete obj['0'];

        obj['duration']=obj['1'];
        delete obj['1'];

        obj['name']=obj['2'];
        delete obj['2'];

        obj['dependsOn']=obj['3'];
        delete obj['3'];

       }
       console.log("-----------------------");
       console.log(objarray);

            // create a PERT chart
            chart = anychart.pert();


            // set chart data
            chart.data(objarray, "asTable");

            // set the title of the chart
            chart.title("PERT Chart");

            // set the container id for the chart
            chart.container("pertChart");

            // return slack on top of each arrow
            chart.tasks().lowerLabels().format(function(e){
                return "Slack: " + e.slack;
            });
 

            chart.draw();


       });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
    <?php  } 
?>