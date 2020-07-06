<? 
    $con =  new  mysqli('localhost','root','',"lottery");
    if(!$con) trigger_error(mysqli_connect_error());

    if(isset($_FILES['file'])){

        $id = $_REQUEST['id'];
        $aztan = $_REQUEST['aztan'];
        $oron = $_REQUEST['oron'];
        $lottery_name = $_REQUEST['lottery_name'];
        $file = $_FILES['file'];
        
    
        if($aztan > 0 && $oron > 0 && strcmp($lottery_name,"") !=0  ) {
       
            update($id,$aztan,$oron,$lottery_name,$file);
            exit(json_encode([ "success" => "success"]));
        }
        else {
            exit(json_encode(["error" => "<p style='color:red;text-align:center;'><strong>Шаардлагатай талбарыг нөхнө үү!!! </strong></p>" ]));
        }
    }


    function  update($id,$aztan,$oron,$lottery_name,$file) {

        global $con;
       
        // sugalaanii ner oruulj baina
    
        $updateNameQuery = "update lottery_name set lottery_name = '$lottery_name' where lottery_id = $id";
        $con->query($updateNameQuery);

        $updateConfig = "update lottery_config set oron=$oron,winner=$aztan,photoUrl ='".$file['name']."' where id =$id";
        $con->query($updateConfig);
         
      
    }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
                    <body>
                    <form method="POST"  enctype="multipart/form-data" >

                                                                                


                                    <input  id="new_name" type="text" name="name" placeholder="Нэр"/> 




                                    <input id="new_oron" type="text" name="oron" placeholder="орон"/>
                                    <input  id="new_aztan" type="text" name="aztan" placeholder="азтан"/>


                                    <input type="hidden" name="a" value="insert">
                                    <input id="new_img-file" type="file" class="file" name="file" /> 


                              
                                   

                                    <div id="error"> </div>
                    </form>
</body>
</html>