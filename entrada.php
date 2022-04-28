<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

//HEAD
$title = "Entrada de Veículos - ".TITULO;
$menumarcado = 4;   
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
                        <h1>Entrada de Veículos</h1>
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

                            <div class="col-lg-1" id="dados"></div>
                        </div>

                        
                    </div>
                </div>

                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <h1>Estadias Abertas</h1>
                    </div>
                </div>

                

            </div>
        </div>
    </body>

    <script>
        $.ajax({   
            url: '<?=API_URL?>Estadia/buscar',  
            method: "GET", 
            headers: {          
                "Content-Type": "application/json"   
            }, 
            "data": JSON.stringify({
                "CNPJEstacionamento": '<?=CNPJ?>',
                "PlacaVeiculo": '',
                "ApenasEmAberto": true
            }), 
            success: function(result) { 
                console.log(result.data);
            }
        });

        $('#add').click(function(){
            if($('#placa').val().length<7) {
                alert('Placa inválida');
            } else {  
                $("#dados").html("<br><img src='<?=SITE_URL?>imgs/carregando.gif' class='carregando' />");
                $.ajax({   
                  url: '<?=API_URL?>Estadia/entrada',  
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