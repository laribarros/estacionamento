<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

//HEAD
$title = "Formas de Pagamento - ".TITULO;
$menumarcado = 7;   
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
                        <h1>Formas de Pagamento</h1>
                    </div>
                </div>
                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <div class="row">
                            <div class="col-lg-3 col-10">
                                <input type="text" id="forma" class="form-control" placeholder="nova" />
                            </div>

                            <div class="col-lg-1 col-3">
                                <button id="add" class="add">Salvar</button>
                            </div>

                            <div class="col-lg-1" id="dados"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 detalhe">
                    <div id="formas"></div>
                </div>
            </div>
        </div>
    </body>

    <script>
        $("#formas").html("<br><img src='<?=SITE_URL?>imgs/carregando.gif' class='carregando' />");

        $.ajax({   
            url: '<?=API_URL?>FormaPagamento/listar',  
            method: "GET",  
            success: function(result) {
                var html="<br><div class='row'>";
                var dados = result.data; //console.log(dados);

                for(var e in dados) {
                    //console.log(dados[e]);
                    html += "<div class='col-lg-3 col-12'><div class='fundocinza'>"+
                        "<b><center><big>"+dados[e].nome+"</big></center></b>"+
                    "</div></div>";
                }

                html+="</div>";

                $("#formas").html(html);
            }
        });

        $('#add').click(function(){
            if($('#forma').val() == '') {
                alert('Prencha uma forma de pagamento');
            } else {  
                $("#dados").html("<br><img src='<?=SITE_URL?>imgs/carregando.gif' class='carregando' />");
                $.ajax({   
                  url: '<?=API_URL?>FormaPagamento/criar',  
                  method: "POST",
                  headers: {          
                    "Content-Type": "application/json"   
                  }, 
                  "data": JSON.stringify({
                    "nome": $("#forma").val()
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