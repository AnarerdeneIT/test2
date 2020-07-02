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
<body>

<? 
   switch(@$_GET['a']) {
    case "addStatus" : addStatus(); break;
    default : break;
  
    }   

function addStatus() {
   
    $con =  new mysqli('localhost','root','','lottery');

    if(!$con) trigger_error(mysqli_connect_error());

    $insertSql = "
    INSERT INTO lottery_name ( lottery_name,status)
     VALUES ('".@$_GET['name']."','1')";

    if($con->query($insertSql) === true) {
        header("Location:index.php");
    }
    else {
        echo "aldaa";   
    }
    $con->close();


    exit;
}



?>
    

    <div class="container text-center">
                         <form class="" id="forms" action="lottery.php?a=addStatus">
                                    <div class="col-12">
                                    <h3 class="page-header" style="color:#0095DA">Сугалааны нэр</h3>
                                    </div>
                                
                                    <div class="col-12 mt-3">
                                            <input type="hidden" name="a" value="addStatus"/>
                                            <input style="width:20%;height:35px;" type="text" name="name" placeholder=""/> 
                                            <input class="btn"  value="Хадгалах"type="submit"/> 
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