<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./script/main.js"></script>
    <title>Сугалаа</title>

  <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<link rel="stylesheet" href="./style/index.css">
<script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>

<script>

    
           


</script>
<body>
<? 
$con =  new mysqli('localhost','root','',"lottery");
if(!$con) trigger_error(mysqli_connect_error());
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
        global $typeIdddd, $con;

        $type = 1;   

      
        $type=$_GET['select1'];
        $typeIdddd=$type;
  

                    
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
    <div class="container-fluid text-right"> 
       <div class="row menu">
                        <div class="col-md-6 text-left">
                                <img style="height:100;width:100px;"src="./photos/tdb.png" class="img-fluid" alt="Desc" />
                    
                        </div>

                            <br class="my-4">
                    <div class="col-md-6">
                            <a class="btn" href="http://localhost/test/admin.php">АДМИН</a>
                    </div>
        </div>

        <div class="col-md-12 text-center" id="ylagch">
             
              <h1 class="text-center text-primary">Сугалааны дугаар:<? echo $randomToo?></h1>

          
              <? 
            
                $ylagch="update customer set winner = 1 ,status = 0 where lottery_num =$randomToo  ";
                $urdun = $con->query($ylagch);

                $nameSql = "select f.customer_name from customer_form f left join customer c on f.customer_id = c.cust_id where c.winner = 1 and c.lottery_num = " . $randomToo;
             
                if($resultName = $con->query($nameSql)) {
                    if($row = $resultName->fetch_assoc()) {
                        echo "<h1 class='text-primary'><strong>Эрхэм хүндэт хэрэглэгч&nbsp" .$row['customer_name']. "&nbspта азтан боллоо.</strong></h1>";
                    }
                    else {
                        echo "<h1 class='text-primary'><strong>Алдаа ялагч үлдсэнгүй</strong></h1>";
                    }
                }

            
                   
              ?>

        </div>

  
              
    </div>
    <br class="my-4">

    <div id="container" class="container"  >

    <form action="index.php?a=save">
            <div class="d-flex justify-content-center flex-column pic">
          
                             <select
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

                <div class="img-fluid text-center">
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
                 <input class="btn "  type="submit" value="Хайх" name="search" />
        
            </div>
 </form>



    </div>
   
                    <div id="contain" class="contain"> 
                        <?

                                for($i=count($list)-1; $i>=0 ;$i--) {
                                 
                                    echo "<div  id='dom$i' class='dorwoljin'><p>".$list[$i]."</p></div>";
                                }
                                
                         ?>
                    </div>
    
</body>
</html>