<?php
    $url = "";
    if(isset($_GET['view']) && isset($_GET['page'])){
        $diretorio = $_GET['view'];
        $pagina = $_GET['page'];
        $url = "view/$diretorio/$pagina";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Área Administrativa</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/jquery.toastmessage.css">
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.toastmessage.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
    
    
</head>
<body>
  
    <div id="a">
        <header>
                <a href="index.php" title="Go to Homepage">Área <strong> Administrativa</strong></a>
                <p>Sr. Administrador,  <br /> 
                  <b style="text-align: center; width: 100%; display: block;">utilize o menu abaixo
                  </b><br /><b style="text-align: right; width: 100%; display: block;">para o gerenciamento do sitema </b> </p>
        </header>
        <div id="b">            
            <aside>
                <nav>    
                    <h4>Gerenciamento</h4>
                <ul>
                    <li class="active"><a href="#">Cadastro</a>
                        <ul>
                                <li><a href="index.php?view=cadastro&page=cadcliente">Clientes</a></li>
                                <li><a href="index.php?view=cadastro&page=cadfunc">Funcionários</a></li>
                                <li><a href="index.php?view=cadastro&page=cadprod">Produtos</a></li>
                                <li><a href="index.php?view=cadastro&page=cadpromo">Promoções</a></li>

                        </ul>
                    </li>
                     <li><a href="#">Sair</a></li>
                </lu>
                </nav>
            </aside>
            
            <article>
                <?php 
                    if($url != ""){
                        try{
                            include_once  $url.".php";
                        }  catch (ErrorException $e){
                            echo "<script type=\"text/javascript\" > showErrorToast('".$e->getMessage()."'); </script>";
                        }
                    }
                ?>    

            </article>
        </div>
        <footer>
            <ul class="icons">
                <li><a href="#"><img src="img/icon1.jpg" alt="">Facebook</a></li>
                <li><a href="#"><img src="img/icon2.jpg" alt="">Twitter</a></li>
                <li><a href="#"><img src="img/icon3.jpg" alt="">LinkedIn</a></li>
            </ul>
        </footer>
    </div>


</html>
