
<? 
 $con =  new mysqli('localhost','root','','lottery');
 if(!$con) trigger_error(mysqli_connect_error());



if(isset($_REQUEST['name'])) {
    $name =$_REQUEST['name'];
    addStatus($name);
    exit(json_encode(["success" => "success"]));
}



function addStatus($name) {
  global $con;

    $insertSql = "
    INSERT INTO lottery_name ( lottery_name,status)
     VALUES ('$name','1')";

    if($con->query($insertSql) === true) {
       
    }
    else {
        echo "Алдаа гарлаа";   
    }
    $con->close();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LotteryName</title>
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
</head>
<style>

    body {

    }
    input[type = text] {
        border: 1px solid #007bff;
    }
</style>


<script>
function saveLottery() {

    $.ajax({
        url:"lottery.php",
        type:"GET",
        data : { 
            "name" : $("#lottery_name").val()
        },
        success:(data)=>{
               alert("amjilttai");
    }
        
    })


}

    
</script>


<body>


    

    <div class="container text-center">
                         <form>
                                    <div class="col-12">
                                    <h3 class="page-header" style="color:#0095DA">Сугалааны нэр</h3>
                                    </div>
                                
                                    <div class="col-12 mt-3">
                                            <input type="hidden" name="a" value="addStatus"/>
                                            <input  id="lottery_name" type="text" name="name" placeholder=""/> 
                                            <input style="margin-bottom:3px;height:30px;padding:2px;" class="btn btn-primary" onclick="saveLottery()" value="Хадгалах" type="button"/> 
                                    </div>
                        </form>
    </div>




    <!-- zurag -->

    <? 
            $array = array();
      
            $typeId=1;
            $con =  new mysqli('localhost','root','','lottery');
            if(!$con) trigger_error(mysqli_connect_error());
          
            $typeidsql = "select lottery_id from lottery_name where status = 1";

            $typeidurdun = $con->query($typeidsql);
         

            while($row=$typeidurdun->fetch_assoc()) {
               
               array_push($array,$row['lottery_id']);
            }

  
            
           $array_map =  array_map(function ($element){
    
            $con =  new mysqli('localhost','root','','lottery');
            $photos = "select photoUrl from lottery_config where type = $element and status = 1" ;
            $photosurdun = $con->query($photos);

            while($row = $photosurdun->fetch_assoc()) {
               
              return $row['photoUrl'];
            }
            },$array);

  
    ?> 



                    <div class="parent_carousel" style="min-height: 620px;">

                    <div id="carouselExampleIndicators" class="carousel slide" date-ride="carousel">

                        <ol class="carousel-indicators " style="margin-bottom:-50px;background-color:#0095DA;opacity:0.8;">
                                <? 
                                    for($i=0 ; $i<count($array_map) ; $i++) {
                                            if($i == 0) {
                                                echo  "<li data-target='#carouselExampleIndicators' class='active' data-slide-to='$i' ></li>" ;
                                            }
                                            else  echo  "<li data-target='#carouselExampleIndicators' data-slide-to='$i' ></li>" ;
                                    
                            
                                    }
                                
                            
                                    ?>
                                

                        </ol>

                        <div class="container ">
                        
                        <div class="carousel-inner "  >
                                    <? 
                                    
                                    

                                    for( $i=0 ; $i <  count($array_map);$i++) {
                                        if($i == 0 ) {
                                            echo "<div class='carousel-item active mt-3 '>
                                            <img class='d-block ' style='margin-left:250px;width:60%;height:500px;' src='./photos/$array_map[$i]' alt=$i>  </div>";
                                        }
                                        else {
                                            echo "<div class='carousel-item mt-3'>
                                            <img class='d-block ' style='margin-left:250px;width:60%;height:500px;' src='./photos/$array_map[$i]' alt=$i> </div>";
                                        }
                                    }
                                
                                    
                                    ?>
                        </div>

                        </div>
                        </div>
                    </div>
            


   
  
    <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
  
</body>
</html>