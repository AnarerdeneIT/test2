<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Код </title>
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
</head>
<body>
        <script>
        </script>

     <? 
                        
                        $con =  new mysqli('localhost','root','',"lottery");
                        if(!$con) trigger_error(mysqli_connect_error());
                      
                     
                        //type
                        if(isset($_POST['save'])) {
                      
                            $type = $_POST['select1'];
                            $query = "select * from customer_form";
                            $result = $con->query($query);

                            
                            while($row = $result->fetch_assoc()){
                                $register =   $row['customer_rd'];

                   
                                 $hashcode = md5(date("Y/m/d H:i:s").$register);
                      
                                 $id =  $row['customer_id'];  
                               
                        
                                 $query = "insert into qr_table (cust_id,type,hashcode,status) VALUES ($id ,'$type','$hashcode',0)";
                              
                            
                                 if($con->query($query) === true){
                                 }
                             

                                 $link = "http://192.168.43.248/test/qr.php?a=success&id=$hashcode";
                                 $urlen = urlencode($link);
                                

                                $urlencode = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$urlen";
                               
                              
                                 @$rawImage = file_get_contents($urlencode);
                                 if($rawImage) {
                                     file_put_contents("qr/$register.jpg",$rawImage);
                                 }

                            }


                            if(isset($_REQUEST['id'])) {
                                echo "connected";
                            }

                        }

                ?> 
        

        <div class="row">
                
              

                <div style="background-color:#white"class="col-md-12 col-lg-12 text-center  p-5 ">

                                <h2 class="text-center" style="color:#0095DA;">QR code</h2>

                                    <br my="4">
                                <form method="POST" class="d-flex flex-column  align-items-center " action="qr.php">
                                            <select style="width:10%;"class="text-center" name="select1" id="aztan">

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

                                        <input class="text-center w-10 m-5 btn btn-primary border-5px" type="submit"  name="save" value="Хадгалах">            
                                </form>

                             
                         
                 </div>
                    

        </div>

      
                
    
        
       
    
    

</body>
</html>