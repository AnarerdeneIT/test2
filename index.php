<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./script/main.js"></script>
    <title>Lottery</title>

  <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<link rel="stylesheet" href="./style/index.css">
<script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>


<script>


           


</script>
<body>
<? 
    $orontest='';
    $typeIdddd='';
    $list=[];
    $randomToo =0;
    

 switch(@$_GET['a']) {
    case "search" : save(); break;
    default : break;
  
    }
    function save() { 
        global $list;
        global $id;
        global $randomToo;
        global $typeIdddd;

        $type = 1;   

      
        $type=$_GET['select1'];
        $typeIdddd=$type;
  

                    $con =  new mysqli('localhost','root','',"lottery");
                    if(!$con) trigger_error(mysqli_connect_error());
                                $selectSql = "
                                select lottery_id
                                from lottery_name
                                where lottery_name= '$type';
                                                ";      
                        $result = $con->query($selectSql);
                        while($row = $result->fetch_assoc()) {
                           $id = $row['lottery_id'];
                         }



                $query = "
                        select lottery_num
                        from customer
                        where cust_type = $id and winner = 0
                        order by RAND()
                        limit 1
                ";

           

            $result2 = $con->query($query);


            if($row = $result2->fetch_assoc()) {
                $randomToo = $row['lottery_num'];
           
                 }

                $list = str_split((string)$randomToo);
    
    } 

   

?>
    <div class="container text-right"> 
       <div class="row">

            
                        <div class="col-md-6 text-left">
                                <img style="height:100;width:100px;"src="./photos/123.jpg" class="img-fluid" alt="Desc" />
                    
                        </div>

                            <br class="my-4">
                    <div class="col-md-12">
                            <a class="btn btn-primary"href="http://localhost/test/admin.php">ADMIN</a>
                    </div>
        </div>

        <div class="col-md-12 text-center"  class="ygagch" id="ylagch">
             
              <h1 class="text-center text-primary">Lottery:<? echo $randomToo?></h1>

          
              <? 
                $con =  new mysqli('localhost','root','',"lottery");
                if(!$con) trigger_error(mysqli_connect_error());
                $nameSql = "select customer_name from customer_form where customer_id in (select cust_id from customer where  winner=1 and lottery_num = $randomToo)";
                    $resultName = $con->query($nameSql);
                      if($row = $resultName->fetch_assoc()) {
                echo "<h1 class='text-primary'><strong> You winner " .$row['customer_name']."</strong></h1>";
            }
              ?>

        </div>

  
              
    </div>
    <br class="my-4">

    <div id="container" class="container"  >

    <form action="index.php?a=save">
            <div class="d-flex justify-content-center flex-column">
          
                             <select style="width:15%;"
                              name="select1" id="aztan">
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
                             <hr class="my-3">

                <div class="img-fluid text-center shadow p-3 mb-5  rounded-sm">
                <? 
            
                    $typeId=1;
                global $typeIdddd;
                    $con =  new mysqli('localhost','root','','lottery');
                    if(!$con) trigger_error(mysqli_connect_error());
                  
                          
                     $typeawahsql="select lottery_id from lottery_name where lottery_name ='$typeIdddd'";
                    $urdun = $con->query($typeawahsql);
                     if($row = $urdun->fetch_assoc()) {
                      $typeId=$row['lottery_id'];
                    }
            
                 
                                    
                     $sql ="select photoUrl from lottery_config WHERE type= $typeId";
                    $result = $con->query($sql);
                    if($row = $result->fetch_assoc()) {
                     $image = $row['photoUrl'];
                                
                     $image_src = "photos/" .$image;
        
                      
                    }
                                       ?> 
                <img style="width:400;height:400px;margin-top:50px;" src="<? echo $image_src ?>" alt="zurag">
                    
                </div>
                <main>
                </main>
                <input type="hidden" name="a" value="search">
                 <input class="btn btn-primary"style="width:20%;font-size:18px;margin:20px auto;"  type="submit" value="Search" name="search" />
                

        



        
            </div>
 </form>



    </div>
   
                    <div id="contain" class="contain"> 
                        <?

                                for($i=count($list)-1; $i>=0 ;$i--) {
                                 
                                    echo "<div  id='dom$i' class='dorwoljin'><p>".$list[$i]."</p></div>";
                                }

                                $con =  new mysqli('localhost','root','','lottery');
                                if(!$con) trigger_error(mysqli_connect_error());
                              
                                      
                                 $ylagch="update customer set winner = 1,status = 0 where lottery_num =$randomToo  ";
                                $urdun = $con->query($ylagch);
                                
                                    
                         ?>
                    </div>

   


  
    
</body>
</html>