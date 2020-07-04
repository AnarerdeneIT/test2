<? 
$con =  new  mysqli('localhost','root','',"lottery");
if(!$con) trigger_error(mysqli_connect_error());
function  addStatus($aztan,$oron,$lottery_name,$file) {
    global $con;
   
    // sugalaanii ner oruulj baina

    $checkQuery = "select lottery_id from lottery_name  where lottery_name = '".$lottery_name."'";
    $result=$con->query($checkQuery);
    // print_r($result);exit;
    if($result->num_rows == 0) {
        $con->query("INSERT INTO lottery_name ( lottery_name,status) VALUES ('$lottery_name','1')");
    }

    $checkQuery = "select l.lottery_id, c.type from lottery_name l left join lottery_config c on c.type = l.lottery_id where lottery_name = '".$lottery_name."'";
    $result=$con->query($checkQuery);
            if($row = $result->fetch_assoc()) {
   
                    $date = date("Y/m/d");                 
                    $typeId = $row['lottery_id'];
                    $typeCheck = $row['type'];
            
                            //zurag
                 


            
                   
                if($typeCheck == null) {

                    $target_dir="C:\\xampp\\htdocs\\test\\photos\\";
                    $target_file = $target_dir . basename($file['name']);
                    // orgotgol
                 //    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
             
                    move_uploaded_file($file['tmp_name'],$target_file);
                    $extensions_arr =array ("jpg","jpeg","png");
 
                    $insertSql = "
                    INSERT INTO lottery_config ( type, oron, winner,insert_date, status, photoUrl) VALUES ($typeId,$oron,$aztan,'$date',1,'".$file['name']."');
                     ";
                        if($con->query($insertSql)){
                            exit(json_encode(["success" => "success","error"=>"error"] ));
                        }else{
                            exit(json_encode(["success" => "fail","error"=>$insertSql] ));
                        }
                }
                else {
                    exit(json_encode(["success" => "fail", "error" => "dawhtsaj baina"]));
                }
                       
                      
                   
            }
            
       
        

            $con->close();
    
            exit(json_encode(["success" => "success","error"=>""]));

           
  

     
  
}

if(isset($_FILES['file'])){

    
    $aztan = $_REQUEST['aztan'];
    $oron = $_REQUEST['oron'];
    $lottery_name = $_REQUEST['lottery_name'];
    $file = $_FILES['file'];
    
  

    if($aztan > 0 && $oron > 0 && strcmp($lottery_name,"") !=0  ) {
        addStatus($aztan,$oron,$lottery_name,$file);
        exit(json_encode(["aztan" => $aztan]));
    }
    else {
        exit(json_encode(["error" => "<p style='color:red;text-align:center;'><strong>Шаардлагатай талбарыг нөхнө үү!!! </strong></p>" ]));
    }
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

<script>

   function saveConfig() {
    var file_data = $('#img-file').prop('files')[0];


    var formData = new FormData();
  formData.append('file', file_data);
  formData.append('aztan', $("#aztan").val());
  formData.append('oron', $("#oron").val());
  formData.append('lottery_name', $("#lottery_name").val());
        $.ajax({
            url: "config.php",
            type:"POST",
            dataType: 'json',
            cache : false,
            processData: false,
            contentType: false,
            data: formData,
            success:(data)=>{
              
             alert("Амжилттай тохиргоог өөрчиллөө");
             
            }
        })
    }




    
    $(()=>{
        $("#showdata").click(function () {
            $("#table-items").toggle();
        $.ajax({
            url:"table.config.php",
            type:"GET",
            success:(data)=> {
                $("#table-items").html(data);
            }
        });
    });
    })


    function editData(id) {

        $("#dialog").dialog({
            autoOpen:false,
            modal:true
        
        })

        // alert(id);
                    // $("#editInformation").dialog({
                    //     autoOpen:false,
                    //     modal:true,
                    //     button :{
                    //         Ok:function() {
                    //             alert("okey");

                    //         },
                    //         Cancel:function () {
                    //             $(this).dialog('close');
                    //         }
                    //     }


    // })
    // $("#editInformation").data("id",id).dialog("open");
   
    }

    function deleteData() {
       if(confirm("Та энэхүү дата-г устгахдаа итгэлтэй байна уу?"));
    }

</script>
    <div class="container shadow-lg p-4 mb-5 bg-white rounded">
                    <div class="content">
                        <form method="POST"  enctype="multipart/form-data" >

                                              
                                        <h2 class=" text-primary text-center">Суглааны нэр</h2>   
                        
                            <input  id="lottery_name" type="text" name="name" placeholder="Нэр"/> 
            

                        

                             <input id="oron" type="text" name="oron" placeholder="орон"/>
                             <input  id="aztan" type="text" name="aztan" placeholder="азтан"/>

                           
                           <input type="hidden" name="a" value="insert">
                           <input id="img-file" type="file" class="file" name="file" /> 

                            
                                    <input type="hidden" name="a" value="save">
                                    <input class="btn btn-primary text-center" type="button" onclick="saveConfig()" value="Хадгалах" name="save" />
                            
                            <div id="error"> </div>
                        </form>
                        </div>

     </div>



     <div class="container jumbotron bg-success">
                <div class="row">
                            <div class="col-12">
                            
                                <div id="table-items">

                                </div>
                                <button id="showdata" class="btn btn-warning"> Дата харах</button>
                            </div>                                        
                </div>

    </div>

    <div id="dialog" title="burtgeh"> 
    <p>Anar</p>

    </div>
    


        <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
  
</body>
</html>