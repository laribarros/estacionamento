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
                    <div id="pagamento"></div>
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
                    console.log(result);

                    if(result.status==200) {
                        if(result.data==null) {
                            alert(result.message);
                            location.reload();
                        } else {
                            if(result.data.valor==0) {
                                $("#pagamento").html("<div class='fundocinza espaco'><center><b>Data de entrada:</b> "+result.data.dataEntradaVeiculo+"<br><b>Data de saída: </b>"+result.data.dataSaidaVeiculo+"<br><b>Tempo de permanência: </b>"+result.data.tempoConsumo+"<br><b>MENSALISTA: </b>"+result.data.proprietario+"<br><button class='add' style='float: none; margin-top: 10px;'' onclick='pago(\""+result.data.codigoCobranca+"\")'>OK</button></center></div>");
                            } else {
                                $("#pagamento").html("<div class='fundocinza espaco'><center><b>Data de entrada:</b> "+result.data.dataEntradaVeiculo+"<br><b>Data de saída: </b>"+result.data.dataSaidaVeiculo+"<br><b>Tempo de permanência: </b>"+result.data.tempoConsumo+"<br><b>Valor: </b>R$ "+result.data.valor.toFixed(2)+"<br><button class='add' style='float: none; margin-top: 10px;'' onclick='pago(\""+result.data.codigoCobranca+"\")'>PAGO</button></center></div>");
                            }
                        }
                    } else {
                        alert(result.message);
                        location.reload();
                    }
                    
                    /*result.message=saida de mensalista

                    ABRE REGISTRO DE PAGAMENTO
                    data:
                    codigoCobranca: "91 7A 41 91 F7"
                    dataEmissao: "2022-04-25T20:56:06.3454664-03:00"
                    dataEntradaVeiculo: "2022-04-25T20:43:36.3432684-03:00"
                    dataPagamento: ""
                    dataSaidaVeiculo: "2022-04-25T20:56:06.3432715-03:00"
                    estacionamento: "teste - 123456"
                    pago: "NÃO"
                    placa: "lbe5e18"
                    proprietario: "SEM PROPRIETÁRIO VINCULADO"
                    tempoConsumo: "0 horas e 12 minutos"
                    valor: 3
                    veiculo: ""
                    */ 
                    //location.reload();
                  }
                });
            }
        });

        function pago(codigoCobranca) {
            $.ajax({   
              url: '<?=API_URL?>Cobranca/pagamentoCobranca',  
              method: "PUT",
              headers: {          
                "Content-Type": "application/json"   
              }, 
              "data": JSON.stringify({
                "codigoCobranca": codigoCobranca.replace(/\s/g, '')
              }), 
              success : function(result) { 
                alert(result.message);
                if(result.status==200) {
                    location.reload();
                }
              }
            });
        }
    </script>
</html>