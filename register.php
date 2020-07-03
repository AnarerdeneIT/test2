<? 
     $con =  new mysqli('localhost','root','',"lottery");
     if(!$con) trigger_error(mysqli_connect_error());
?>

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

 function saveReg() {
    var name = $("#reg_name").val();
    var register = $("#reg_register").val();
    var phone =$("#reg_phone").val();
    var hayg = $("#reg_hayg").val();



    $.ajax({
        url:"register.php",
        type:"GET",
        data : {
            "name" : name,
            "register" :register,
            "phone" :phone,
            "hayg" :hayg
         },
         success:() => {
             alert("Хэрэглэгчийг амжилттай бүртгэлээ.")
         }

    })


 }

</script>
 <? 
     
  
    
     if(isset($_REQUEST['name'])) {
        $name = $_REQUEST['name'];
        $register = $_REQUEST['register'];
        $phone = $_REQUEST['phone'];
        $hayg = $_REQUEST['hayg'];

         register($name,$register,$phone,$hayg);
         
         exit(json_encode(["success" => "success"]));
     }

 function register ($name,$register,$phone,$hayg) {

            global $con;
            $query = "insert into customer_form ( customer_lottery_num , customer_name , customer_rd , phone , hayg )
                        VALUES (0, '$name' , '$register' , $phone , '$hayg' )";        
            $result = $con->query($query); 
 }
 ?>


        <div class="container padding">



                     <div class="text-center">

                                                  <h2>Бүртгэл</h2>
                            <form method="POST" class="d-flex flex-column  align-items-center ">
                               
                                <input id="reg_name" class="mt-4 w-50" type="text" name="name" placeholder="Нэр">
                               
                                <input id="reg_register" class="mt-4 w-50" type="text" name="register" placeholder="Регистерийн дугаар">
                              
                                <input id="reg_phone" class="mt-4 w-50" type="text" name= "phone" placeholder="Утасны дугаар">
                                
                                <textarea id="reg_hayg"  class="mt-4 w-50" name="hayg" placeholder="Хаяг"> </textarea>

                                <input class="text-center w-50 m-5 btn btn-primary border-5px" type="button" onclick="saveReg()" name="save" value="Хадгалах"> 
                            </form>
           
                    </div>
           
        </div>
    
</body>
</html>