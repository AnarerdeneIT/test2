<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <link href="./bootstrap-4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap-4.5.0/css/bootstrap.css" rel="stylesheet">
    <script src="./bootstrap-4.5.0/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="./style/admin.css">
 

    
</head>
<body>

     

       



    

   <div id="nav"   class="container-fluid"> 

        <div class="row col-12">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
            <img src="./photos/tdb.png" class="img-fluid" alt="logo" />
        </div>

        <div id="buttons" class="col-lg-9  col-md-12 col-sm-12 d-flex justify-content-between mt-4  text-center">
            <button id="btn" class="btn btn-secondary dropdown-item " onclick="$('#test').load('data.php');">Дата бүртгэх</button>
            <button id="btn" class="btn btn-secondary dropdown-item " onclick="$('#test').load('config.php');">Тохиргоо</button>
            <button id="btn" class="btn btn-secondary dropdown-item"  onclick="$('#test').load('lottery.php');">Сугалааны нэр</button>
            <button id="btn" class="btn btn-secondary dropdown-item"  onclick="$('#test').load('qr.php');">QR код бүртгэх</button>
            <button id="btn" class="btn btn-secondary dropdown-item active"  onclick="$('#test').load('register.php');">Бүртгэл</button>
        </div>

      

        </div>
    </div>


    



    <div class="container w-100 h-100" id="test">
        <br class="my-4">
        <? include_once("./data.php"); ?>
    </div>



    <footer>
 
        <div class="row text-center" style="display:flex;flex-decoration:column;justify-content: space-around;">

            <div id="texts"  class="col-lg-6 col-md-6"> 
                        <h2>Холбоо барих:</h2>
                        <div style="margin-left:100px;">
                        <p>Утас:80247030</p>
                        <p>И-мэйл хаяг: Narmandakhboldbaatar3
                            4@gmail.com</p>
                        <p>Сургууль:МУИС</p>
                        </div>
            </div>

            <div id="texts" class="col-lg-6 col-md-6"> 


                        <h2 class="text-center">Холбоо барих:</h2>
                                <div style="margin-left:100px;">
                                    <p>Утас:99394044</p>
                                    <p>И-мэйл хаяг: Anarerdene.otgoo@gmail.com</p>
                                    <p>Сургууль:МУИС</p>
                                </div>
            </div>

        </div>
    
            <div class="container">
                 <div class="footer-copoyright text-dark text-center py-3" style="margin-left:150px;"> 
                    <strong><p style="font-size:20px;">&copy; Худалдаа хөгжлийн банк, Суурь системийн хэлтэс</p></strong>
                </div>
            </div>

</footer>
     <script src="./bootstrap-4.5.0/js/bootstrap.js"></script>
     <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
