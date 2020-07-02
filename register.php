<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
<body>
 
<script>

 

</script>
 <? 
     
  
    
     if(isset($_POST['save'])) {
        $name='';
        $register='';
        $phone='';
        $hayg='';
         register();
     }
 function register () {
  
    $name = $_POST['name'];
    $register = $_POST['register'];
    $phone = $_POST['phone'];
    $hayg = $_POST['hayg'];


    $con =  new mysqli('localhost','root','',"lottery");
                            if(!$con) trigger_error(mysqli_connect_error());
                            $query = "insert into customer_form ( customer_lottery_num , customer_name , customer_rd , phone , hayg )
                             VALUES (0, '$name' , '$register' , $phone , '$hayg' )";
                           
                       
                                if($result = $con->query($query)) {
                                  
                                    header("Location:admin.php");
                                }
   
 }

 
 ?>


        <div class="container padding">



                     <div class="text-center">

                                                  <h2>Бүртгэл</h2>
                            <form method="POST" class="d-flex flex-column  align-items-center " action="register.php">
                               
                                <input class="mt-4 w-50" type="text" name="name" placeholder="Нэр">
                               
                                <input class="mt-4 w-50" type="text" name="register" placeholder="Регистерийн дугаар">
                              
                                <input class="mt-4 w-50" type="text" name= "phone" placeholder="Утасны дугаар">
                                
                                <textarea  class="mt-4 w-50" name="hayg" placeholder="Хаяг"> </textarea>

                                <input class="text-center w-50 m-5 btn btn-primary border-5px"type="submit" onclick="abc()" name="save" value="Хадгалах"> 
                            </form>
           
                    </div>
           
        </div>
    
</body>
</html>