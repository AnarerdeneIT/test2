<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Config</title>
    <link rel="stylesheet" href="./style/config.css">
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/config.css">
</head>
<body>

<? 
    switch(@$_GET['a']) {
    
        case "save" : addStatus(); break;
        default : break;
      
    }   

    function  addStatus() {
        //date
        $date = date("Y/m/d");
        $aztan = $_POST['aztan'];
        $oron = $_POST['oron'];
        $type = $_POST['select1'];
        // type    
      

         if($aztan == 0 || $oron == 0 || strcmp($type,'') ==0) 
             {
                    echo "<p style='color:red;text-align:center;'><strong>Shaardlagatai talbariig nohno uu </strong></p>";
            }
        else {
            $con =  new  mysqli('localhost','root','',"lottery");
            if(!$con) trigger_error(mysqli_connect_error());
            $selectType = " SELECT lottery_id FROM lottery_name WHERE lottery_name = '$type'";
            $result = $con->query($selectType);
            if($row = $result->fetch_assoc()) 
            $typeId = $row['lottery_id'];

            echo $typeId;
                 //zurag

            if(isset($_POST['save'])) {
                $name = $_FILES['file']['name'];
                echo $name;

                $target_dir="photos/";
                $target_file = $target_dir . basename($_FILES['file']['name']);
                // orgotgol
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                }

                $extensions_arr =array ("jpg","jpeg","png");

                $con =  new  mysqli('localhost','root','',"lottery");
                if(!$con) trigger_error(mysqli_connect_error());
                
                $insertSql = "
                            INSERT INTO lottery_config ( type, oron, winner,insert_date, status, photoUrl) VALUES ($typeId,$oron,$aztan,'$date',1,'$name');
                             ";


                    if($con->query($insertSql) === true) {
                         header("Location : index.php");  
                    }
                    else {
                        echo "<br>aldaa";   
                    }
                    $con->close();
                    exit;
            }
      
    }
?>

    <div class="container">
                    <div class="content">
                        <form method="POST" action="config.php?a=save" enctype="multipart/form-data" >

                            <select style="width:10%;"class="float-left" name="select1" id="aztan">
                                    <? 

                                        $con =  new mysqli('localhost','root','',"lottery");
                                            if(!$con) trigger_error(mysqli_connect_error());
                                                        $selectSql = "
                                                                    SELECT *
                                                                    from lottery_name
                                                                    WHERE status = 1;
                                                                    ";
                                        $result = $con->query($selectSql);
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value=" .$row['lottery_name']. ">" .$row['lottery_name']. "</option>";
                                        }
                                        ?>
                             </select> 

                             

                             <input  type="text" name="oron" placeholder="oron"/>
                             <input  type="text" name="aztan" placeholder="aztan"/>

                           
                           <input type="hidden" name="a" value="insert">
                            <input type="file" class="file" name="file" /> 

                            
                                    <input type="hidden" name="a" value="save">
                                    <input class="btn btn-primary text-center" style="width:15%;height:10%;" type="submit" value="SAVE" name="save" />
                            
                        </form>
                        </div>

        </div>


        <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
  
</body>
</html>