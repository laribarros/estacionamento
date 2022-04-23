<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

if($usu!='admin') {
    echo "<script>alert('Você não tem permissão para essa ação!'); history.back();</script>";
    exit();
}

//HEAD
$title = "Criar Usuário - ".TITULO;
$menumarcado = 6;   
?>

<html class="no-js" lang="pt_BR" xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <? include('_head.php'); ?> 
    </head>
    <body>
        <nav class="menu">
            <? include('_menu.php'); ?> 
        </nav>
        <div class="cont">
            <div class="row">
                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <h1>Criar Usuário</h1>
                    </div>
                </div>
                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <div class="row">
                            <div class="col-lg-3 col-12">
                                <input type="text" id="nome" class="form-control" placeholder="nome" />
                            </div>

                            <div class="col-lg-3 col-12">
                                <input type="text" id="login" class="form-control" placeholder="login" />
                            </div>

                            <div class="col-lg-3 col-10">
                                <input type="password" id="senha" class="form-control" placeholder="senha" />
                            </div>

                            <div class="col-lg-1 col-2">
                                <button id="add" class="add">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detalhe">
                    <div id="dados"></div>
                </div>

            </div>
        </div>
    </body>

    <script>
        $('#add').click(function(){  
            $("#dados").html("<div class='fundocinza espaco'><center><img src='<?=SITE_URL?>imgs/carregando.gif' class='carregando' /></center></div>");

            $.ajax({   
              url: '<?=API_URL?>Usuario/criar',  
              method: "POST",
              headers: {          
                "Content-Type": "application/json"   
              }, 
              "data": JSON.stringify({
                "nome": $("#nome").val(),
                "login": $("#login").val(),
                "senha": $("#senha").val()
              }), 
              success : function(result) { 
                alert(result.message); 
                location.reload();
              }
            });
        });
    </script>
</html>