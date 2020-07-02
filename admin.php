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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenLite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TimelineLite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    
</head>
<body>

        <script>
           

            

                $(document).ready(function() {
                $("#btn1").on("click",function() {
             
                    TweenMax.to("nav",1,{
                       scaleY:1,
                       height:'100vh'
                   });
                
                });
              });

   
        </script>

       



    

   <div id="nav"   class="container-fluid"> 

        <div class="row col-12">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
            <img src="./photos/tdb.png" class="img-fluid" alt="logo" />
        </div>


            <nav class="navbar navbar-expand-md  navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    
                <div class="collapse navbar-collapse ml-5" id="navbarNavDropdown" >
                        <button id="btn1" class="btn btn-secondary dropdown-item " onclick="$('#test').load('data.php');">Дата бүртгэх</button>
                        <button id="btn" class="btn btn-secondary dropdown-item " onclick="$('#test').load('config.php');">Тохиргоо</button>
                        <button id="btn" class="btn btn-secondary dropdown-item"  onclick="$('#test').load('lottery.php');">Сугалааны нэр</button>
                        <button id="btn" class="btn btn-secondary dropdown-item"  onclick="$('#test').load('qr.php');">QR код бүртгэх</button>
                        <button id="btn-burtgel" class="btn btn-secondary dropdown-item "  onclick="$('#test').load('register.php');">Бүртгэл</button>
                </div>
            </nav>
                                             
     

      

        </div>
    </div>

    


    



    <div class="container w-100 h-100" id="test">
        <br class="my-4">
        <? include_once("./data.php"); ?>
    </div>



    <footer>
            <div class="text-center footer-title">  <h3>Холбоо барих</h3> </div>

        <div class="row text-center" style="display:flex;flex-decoration:column;justify-content: space-around;">


                            <div id="texts"  class="col-lg-6 col-md-6 col-sm-12 mt-5"> 
                                    
                                    
                                        <br class="my-4">
                                    
                                        <p>Утас:80247030</p>
                                        <p>И-мэйл хаяг: Narmandakhboldbaatar34@gmail.com</p>
                                        <p>Сургууль:МУИС</p>
                                    
                            </div>
                
                            <div id="texts" class="col-lg-6 col-md-6 col-sm-12 mt-5"> 
                                    
                                        <br class="my-4">
                                    
                                        <p>Утас:99394044</p>
                                        <p>И-мэйл хаяг: Anarerdene.otgoo@gmail.com</p>
                                        <p>Сургууль:МУИС</p>
                                                
                            </div>

        </div>
    
            <div class="container">
                 <div class="footer-copoyright text-dark py-3"> 
                    <strong><p style="font-size:20px;">&copy; Худалдаа хөгжлийн банк, Суурь системийн хэлтэс</p></strong>
                </div>
            
            </div> 

</footer>
     <script src="./bootstrap-4.5.0/js/bootstrap.js"></script>
     <script src="./bootstrap-4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
