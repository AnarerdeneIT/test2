<?
$con =  new mysqli('localhost','root','','lottery');
if(!$con) trigger_error(mysqli_connect_error());

function addStatus($rd,$typename) {
    global $con;
    $array = array();
    $name = '';
    $date = date("Y/m/d");  

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
    
        $min = "1";
        $max = "";
        
        for($i=0;$i<$oron;$i++) {
            if($i !=0)
            $min.= "0";
            $max .= "9";
        }
        $utga = rand(intval($min),intval($max));
       


     
                $insertSql = "
                INSERT INTO customer ( Cust_type,lottery_num,status,insert_date,winner,cust_id)
                VALUES ($typeId,'$utga',1,'$date',0,$custid)";
               
            
                if($result = $con->query($insertSql)) {
                
                }
                else {
                    echo "aldaa garchla";   
                }


    
        $con->close();
    }



    // huselt
if(isset($_REQUEST['regid'])){
    $rd = $_REQUEST['regid'];
    $typename = $_REQUEST['type'];
    echo $rd . $typename;
    addStatus($rd,$typename);

   exit(json_encode(["success" => "success"]));

}
if(isset($_REQUEST['id'])) {
    $id=$_POST['id'];
   

    $selectQuery = "
    select f.customer_id,f.customer_lottery_num
    from customer c
    left join customer_form f
    on  c.cust_id = f.customer_id
    where c.dataid = $id
    ";
    $result =  $con->query($selectQuery);
    print_r($result);
    if($row = $result->fetch_assoc()) {
        $hereglegchId = $row['customer_id'];

        $too = $row['customer_lottery_num'];
        $too=$too-1;
        $con->query("update customer_form set customer_lottery_num = $too where customer_id =$hereglegchId ");
    }

    $deleteQuery = "delete from customer where dataid = $id";
    $con->query($deleteQuery);

 
 
}
?>

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
    <script>

    function hadgalah() {
        
            $.ajax({
            url:"data.php",
            type:"GET",
            data: { "regid": $("#regid").val(), "type": $("#lottery_type").val()
            },
            success:(data)=>{
               alert("Суглааг амжилттай бүртгэлээ");
               $("#table-items").load("table.php");
            }
        });
    }


    $(()=>{
        $("#table-items").load("table.php");
    });
    function deleteData(id) {
         
    if(confirm("Та энэхүү дата-г устгахдаа итгэлтэй байна уу?")) {
        $.ajax({
            url:"data.php",
            type:"POST",
            data : {id : id},
            success:(data)=> {
          
                alert("Амжилттай устгалаа");
                $("#table-items").load("table.php");
              
            }
        });
    }
        
    }



  
    
    </script>
</head>
<body>

    <div id="container-mid" class="container text-center shadow-lg p-3  bg-white rounded" > 
                         <form class=" col-12"  id="forms" >
                             <br>
                                <h3>Сугалааны нэрийг оруулна уу!</h3>
                                <br>
                                
                                <div class="side-by-side clearfix">

                        <div  id="dug" class="text-left">
                               <p><strong>Регистерийн дугаар</strong></p>
                               <p id="p"></p>
                        
                        <select data-placeholder="Choose a Country..." id="regid" name="select" class="chosen-select" tabindex="2">
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
                                    <select class="float-left" id="lottery_type" name="select1" id="aztan">
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
                                            <input  type="button" onclick="hadgalah()" value ="Бүртгэх"/> 
                                    </div>
                                    <br>
                        </form>
    </div>


    <div class="container jumbotron  shadow-lg p-3 mb-5 rounded">
                <div class="row">
                            <div class="col-12">
                            
                                <div id="table-items">

                                </div>
                                
                            </div>                                        
                </div>

    </div>

   



    
<script src="chosen.jquery.js" type="text/javascript"></script>

    <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>     