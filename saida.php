<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

//HEAD
$title = "Saída de Veículos - ".TITULO;
$menumarcado = 5;   
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
                        <h1>Saída de Veículos</h1>
                    </div>
                </div>
                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <div class="row">
                            <div class="col-lg-3 col-10">
                                <input type="text" id="placa" class="form-control" maxlength="7" placeholder="placa" />
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
            if($('#placa').val().length<7) {
                alert('Placa inválida');
            } else {  
                $("#dados").html("<div class='fundocinza espaco'><center><img src='<?=SITE_URL?>imgs/carregando.gif' class='carregando' /></center></div>");

                $.ajax({   
                  url: '<?=API_URL?>Estadia/saida',  
                  method: "POST",
                  headers: {          
                    "Content-Type": "application/json"   
                  }, 
                  "data": JSON.stringify({
                    "cnpjEstabelecimento": "<?=CNPJ?>",
                    "placaVeiculo": $("#placa").val()
                  }), 
                  success : function(result) { 
                    alert(result.message); 
                    location.reload();
                  }
                });
            }
        });
    </script>
</html>