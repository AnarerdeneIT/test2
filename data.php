<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/data.css">
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap-4.5.0/css/bootstrap.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="docsupport/style.css">
  <link rel="stylesheet" href="docsupport/prism.css">
  <link rel="stylesheet" href="chosen.css">

    <title>Data</title>
</head>
<body>
<? 
 
 switch(@$_GET['a']) {
    case "addStatus" : addStatus(); break;
    default :break;
  
    } 

function addStatus() {
    $array = array();
    $name = '';
    $date = date("Y/m/d");
    $typename =  $_GET['select1'];
    $rd = $_GET['select'];

    
   
        $con =  new mysqli('localhost','root','','lottery');
        if(!$con) trigger_error(mysqli_connect_error());

   


        $selectType = " SELECT lottery_id FROM lottery_name WHERE lottery_name = '$typename'";
        $result = $con->query($selectType);
        if($row = $result->fetch_assoc()) 
        $typeId = $row['lottery_id'];
    
        
        // oron 
        $selectOron = "select oron
                        from lottery_config
                        where  type=$typeId
                        limit 1                
        ";
        $result2 = $con->query($selectOron);
    
        if($row = $result2->fetch_assoc())
         $oron=$row['oron'];

        $dataChange = "update customer_form SET customer_lottery_num=customer_lottery_num+1  where customer_rd = '$rd'";
        if($con->query($dataChange)===true) {
            echo "";
        }
        else {
            echo "Error";
        }

        $custidQuery = "select customer_id from customer_form where customer_rd = '$rd'";
                

        $resutcust = $con->query($custidQuery);
        if($row = $resutcust->fetch_assoc()) 
        $custid = $row['customer_id'];
    
        
            
        switch($oron){
            case 7:$utga = rand(1000000,9999999) . "<br>"; break;
            case 8:$utga  = rand(10000000,99999999) . "<br>"; break;
            case 10:$utga = rand(1000000000,9999999999) . "<br>"; break;
            default:$utga = rand(0,10);
        }


     


                $insertSql = "
                INSERT INTO customer ( Cust_type,lottery_num,status,insert_date,winner,cust_id)
                VALUES ($typeId,'$utga',1,'$date',0,$custid)";
               
            
                if($result = $con->query($insertSql)) {
                    header("Location:index.php");
                }
                else {
                    echo "aldaa garchla";   
                }


    
        $con->close();
    }






 
    


?>
    <div id="container-mid" class="container text-center shadow-lg p-3  bg-white rounded" > 
                         <form class=" col-12 b-color"  id="forms" action="data.php?a=addStatus">
                             <br>
                                <h3>Сугалааны нэрийг оруулна уу!</h3>
                                <br>
                                
                                <div class="side-by-side clearfix">

                        <div class="text-left">
                               <p><strong>Регистерийн дугаар</strong></p>
                        
                        <select data-placeholder="Choose a Country..."  name="select" class="chosen-select" tabindex="2">
                                            <? 

                                                    $con =  new mysqli('localhost','root','',"lottery");
                                                    if(!$con) trigger_error(mysqli_connect_error());
                                                    $query = "SELECT customer_rd from customer_form ";
                                                        $result = $con->query($query);
                                                        while($row = $result->fetch_assoc()) {
                                                        echo "<option value=" .$row['customer_rd']. ">" .$row['customer_rd']. "</option>";
                                                        }
                                            ?>   
                        </select>
                    
                        </div>
                    </div>  

    <br>

                                
                                    <div class="input">
                                    <select style="width:10%;"class="float-left" name="select1" id="aztan">
                                                      <? 

                                                            $con =  new mysqli('localhost','root','',"lottery");
                                                            if(!$con) trigger_error(mysqli_connect_error());
                                                                        $selectSql = "SELECT * from lottery_name WHERE status = 1";
                                                                $result = $con->query($selectSql);
                                                                    while($row = $result->fetch_assoc()) {
                                                                echo "<option value=" .$row['lottery_name']. ">" .$row['lottery_name']. "</option>";
                                                                }
                                                    ?>      
                                    </select> 



                                            <input type="hidden" name="a" value="addStatus"/>
                                            <input type="submit" value ="Бүртгэх"/> 
                                    </div>
                                    <br>
                        </form>
    </div>




    
<script src="chosen.jquery.js" type="text/javascript"></script>

    <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>     