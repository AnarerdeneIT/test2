<? 
$con =  new  mysqli('localhost','root','',"lottery");
if(!$con) trigger_error(mysqli_connect_error());
function  addStatus($aztan,$oron,$type,$name) {
    global $con;

    $date = date("Y/m/d");
    
  

     if($aztan == 0 || $oron == 0 || strcmp($type,'') ==0) 
         {
                echo "<p style='color:red;text-align:center;'><strong>Shaardlagatai talbariig nohno uu </strong></p>";
        }
    else {
        
        $selectType = " SELECT lottery_id FROM lottery_name WHERE lottery_name = '$type'";
        $result = $con->query($selectType);
        if($row = $result->fetch_assoc()) 
        $typeId = $row['lottery_id'];


             //zurag

    
            


            $target_dir="photos/";
            $target_file = $target_dir . basename($_FILES['file']['name']);
            // orgotgol
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            }

            $extensions_arr =array ("jpg","jpeg","png");

            
            $insertSql = "
                        INSERT INTO lottery_config ( type, oron, winner,insert_date, status, photoUrl) VALUES ($typeId,$oron,$aztan,'$date',1,'$name');
                         ";


                if($con->query($insertSql) === true) {
                     
                }
                else {
                    echo "<br>Алдаа гарлаа!";   
                }
                $con->close();
                exit;
  
}

if(isset($_REQUEST['aztan'])){

    $aztan = $_REQUEST['aztan'];
    $oron = $_REQUEST['oron'];
    $type = $_REQUEST['type'];
    $name = $_REQUEST['img-file'];
    addStatus($aztan,$oron,$type,$name);

   exit(json_encode(["success" => "success"]));

}


  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Config</title>
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/config.css">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
</head>

<body>

<script>
   function saveConfig() {
    var file_data = $('#img-file').prop('files')[0].name;
    console.log(file_data);
    var formData = new FormData();
  formData.append('file', file_data);
        $.ajax({
            url: "config.php",
            type:"GET",
            data: { 
                "aztan": $("#aztan").val(),
                "oron" : $("#oron").val(),
                 "type": $("#type").val(),
                 "img-file" : file_data
            },
            success:(data)=>{
             alert("Амжилттай тохиргоог өөрчиллөө");
            }
        })
    }

</script>
    <div class="container shadow-lg p-4 mb-5 bg-white rounded">
                    <div class="content">
                        <form method="POST" action="config.php?a=save" enctype="multipart/form-data" >

                            <select class="float-left" name="select1" id="type">
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

                             

                             <input id="oron" type="text" name="oron" placeholder="орон"/>
                             <input  id="aztan" type="text" name="aztan" placeholder="азтан"/>

                           
                           <input type="hidden" name="a" value="insert">
                            <input id="img-file" type="file" class="file" name="file" /> 

                            
                                    <input type="hidden" name="a" value="save">
                                    <input class="btn btn-primary text-center" type="button" onclick="saveConfig()" value="Хадгалах" name="save" />
                            
                        </form>
                        </div>

     </div>





    


        <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
  
</body>
</html>