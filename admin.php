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
   <div class="container text-center "> 
   <div class="col-12">
        <img src="./photos/123.jpg" class="img-fluid" alt="Desc" />
      </div>


        <div class="col-12 d-flex justify-content-between mt-4 ">
            <button class="btn btn-secondary dropdown-item " onclick="$('#test').load('data.php');">DATA BURTGEH</button>
            <button class="btn btn-secondary dropdown-item" onclick="$('#test').load('config.php');">TOHIRGOO</button>
            <button class="btn btn-secondary dropdown-item"  onclick="$('#test').load('lottery.php');">SUGALAANII NER</button>
            <button class="btn btn-secondary dropdown-item"  onclick="$('#test').load('qr.php');">QR BURTGEH</button>
            <button class="btn btn-secondary dropdown-item"  onclick="$('#test').load('register.php');">Register</button>
        </div>
    </div>


    <div class="container w-100 h-100" id="test">
        <br class="my-4">
        <? include_once("./data.php"); ?>
    </div>




     <script src="./bootstrap-4.5.0/js/bootstrap.js"></script>
     <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>

   
 
</body>
</html>
