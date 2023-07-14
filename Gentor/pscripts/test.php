<?php 
if(isset($_POST['submit'])){
    for($i = 0; $i <= count($_POST['name']) && $i<count($_POST['age']); $i++) {
        echo $_POST['name'][$i]." ".$_POST['age'][$i];
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../pscripts/test.php" method="post">
        <input type="text" name="name[]" id="">
        <input type="text" name="age[]" id="">
        <input type="text" name="name[]" id="">
        <input type="text" name="age[]" id="">
        <button name="submit">submit</button>
    </form>
</body>
</html>