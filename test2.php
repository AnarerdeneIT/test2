<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?

       

        $con =  new mysqli('127.0.0.1','root','root',"lottery");
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $query = "select * from customer";


   $result =  $con->query($query);

   while($row = $result->fetch_assoc()) 
      echo $row['status'];


    ?>
</body>

</html>