<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR CODE </title>
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
</head>
<body>
      
 

        <div class="row">
                
              

                <div style="background-color:#8c9ba5"class="col-md-12 col-lg-12 text-center  p-5 ">

                                <h2 class="text-center" style="color:#f5f7fa;">QR code</h2>

                                
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

                                        <input class="text-center w-50 m-5 btn btn-primary border-5px"type="submit" name="save" value="hadgalah"> 
                                                    
                                </form>

                              <img src="./photos/123.jpg" alt="">
                         
                 </div>
                    <? 
                        // hereglegchdiig tooldog
                        $con =  new mysqli('localhost','root','',"lottery");
                        if(!$con) trigger_error(mysqli_connect_error());
                      
                     
                        //type
                        if(isset($_POST['save'])) {
                            $type = $_POST['select1'];
                            
                            $query = "select * from customer_form";
                            $result = $con->query($query);

                            
                            while($row = $result->fetch_assoc()){


                             

                                 $hashcode = md5(date("Y/m/d H:i:s"));
                                 $id =  $row['customer_rd'];
                                 $register =  $row['customer_id'];  
                                

                                 
                        
                                 $query = "insert into qr_table (cust_id,type,hashcode) VALUES ($id ,'$type','$hashcode')";
                              
                                
                                 
                                  if($con->query($query) === true);
                                  


                                 $url = "https://chart.googleapis.com";
                                 $result2 = $url . "?id=" .$hashcode;
                               
                                 @$rawImage = file_get_contents($result2);
                                 if($rawImage) {
                                     file_put_contents("qr/$register.jpg",$rawImage);
                                     echo "<script>alert('amjilttai');</script>";
                                 }

                            }
                        }
                      


                            

                            
                                 
                       
      

                                //  $url = "http://192.168.43.248/test/qr.php?a=success&";
                                 


                                //  if(isset($_REQUEST['id'])) echo "<h2>Thank you</h2>";
                                //  else {
                                   //   ?> 
                                       <!-- <div class="container" >    
                                          <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&ch1= <?echo $result ?> " alt="QR CODE">   
                                      </div>  -->
                                      
                       
                


        </div>

      
                
    
        
        <footer>
                    <div class="container fluid">
                        <div class="row text-center" >

                            <div class="col-md-6"> 

                                        <hr class="light">
                                        <h3 style="color:#8c9ba5;" >Contact</h3>
                                        <p>99394044</p>
                                        <p>Email: Anarerdene.otgoo@gmail.com</p>
                                        <p>Muis</p>
                            </div>


                            <div class="col-md-6"> 

                                        <hr class="light">
                                        <h3 style="color:#8c9ba5">Contact</h3>
                                        <p>99394044</p>
                                        <p>Email: Anarerdene.otgoo@gmail.com</p>
                                        <p>Muis</p>
                            </div>

                        </div>
                    </div>


                    <div class="container-fluid">
                        <div class="row text-center  ">
                            <div class="col-md-12">
                                <hr class="light">
                            <h5>Mongol ulsiin ih surguuli Medeellin tehnologin gazar</h5>
                                <hr class="light">
                            </div>
                        
                        </div>
                    </div>
        </footer>
    
    

</body>
</html>