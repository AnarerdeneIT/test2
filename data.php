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
            }
        });
    }


    $(()=>{
        $("#showdata").click(function () {
        var count=2;
        $.ajax({
            url:"table.php",
            type:"GET",
            data : {
                count:count+2
            },
            success:(data)=> {
                $("#table-items").html(data);
            }
        });
    });
    })
        
    
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


    <div class="container jumbotron bg-success">
                <div class="row">
                            <div class="col-12">
                            
                                <div id="table-items">
                                
                                
                                
                                </div>
                                <button id="showdata" class="btn btn-primary"> Дата харах</button>
                            </div>
                                                                
                </div>
    
    </div>

    <div class="page">
    <?php
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn =  new mysqli('localhost','root','','lottery');
if(!$con) trigger_error(mysqli_connect_error());



$total_pages = ceil(100 /10);

$sql = "SELECT * FROM customer_form LIMIT $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($res_data)){
    print_r($row);
}
mysqli_close($conn);
?>
<ul class="pagination">
<li><a href="?pageno=1">First</a></li>
<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
</li>
<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
</li>
<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
    </div>




    
<script src="chosen.jquery.js" type="text/javascript"></script>

    <script src="docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
    <script src="docsupport/init.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>     