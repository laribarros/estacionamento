<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

$cpfCnpj = isset($_REQUEST['cpfCnpj'])?$_REQUEST['cpfCnpj']:0;

//HEAD
$title = "Clientes | ".TITULO;
$menumarcado = 2;	
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
                    <div class="col-12 fundocinza">
                        <h1>Cliente</h1>

                        <a class="button" href="<?=SITE_URL?>clientes.php"><< Voltar</a>
                    </div>

                    <div class="col-12 fundocinza espaco">
                        <form id="form">
                            <input type="hidden" name="id" id="id" value="0" />
                            <div class="row">
                                <div class="col-lg-4">
                                    Tipo
                                    <select name="tipo" id="tipo" class="form-control" required >
                                        <option value=""></option>
                                        <option value="PF">pessoa física</option>
                                        <option value="PJ">pessoa jurídica</option>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    Nome / Razão Social
                                    <input type="text" name="nome" id="nome" value="" class="form-control" required />
                                </div>

                                <div class="col-lg-2">
                                    Vagas
                                    <input type="number" name="vagas" id="vagas" value="" class="form-control" maxlength="2" oninput="maxLengthNumber(this)" required />
                                </div>
                            

                                <div class="col-lg-4">
                                    Apelido / Título da empresa
                                    <input type="text" name="apelido" id="apelido" value="" class="form-control" required />
                                </div>

                                <div class="col-lg-4">
                                    CPF / CNPJ
                                    <input type="number" name="cpf" id="cpf" value="" class="form-control" maxlength="14" oninput="maxLengthNumber(this)" />
                                </div>

                                <div class="col-lg-4">
                                    RG / Inscrição Estadual
                                    <input type="number" name="rg" id="rg" value="" class="form-control" maxlength="15" oninput="maxLengthNumber(this)" />
                                </div>
                                

                                <div class="col-lg-3">
                                    CEP
                                    <input type="number" name="cep" id="cep" value="" class="form-control" maxlength="8" oninput="maxLengthNumber(this)" />
                                </div>

                                <div class="col-lg-7">
                                    Logradouro
                                    <input type="text" name="logradouro" id="logradouro" value="" class="form-control" />
                                </div>

                                <div class="col-lg-2">
                                    Número
                                    <input type="number" name="numero" id="numero" value="" class="form-control" maxlength="10" oninput="maxLengthNumber(this)" />
                                </div>


                                <div class="col-lg-3">
                                    Complemento
                                    <input type="text" name="complemento" id="complemento" value="" class="form-control" />
                                </div>

                                <div class="col-lg-4">
                                    Bairro / Distrito
                                    <input type="text" name="bairro" id="bairro" value="" class="form-control" maxlength="50" />
                                </div>

                                <div class="col-lg-4">
                                    Município
                                    <input type="text" name="municipio" id="municipio" value="" class="form-control" maxlength="50" />
                                </div>

                                <div class="col-lg-1">
                                    UF
                                    <input type="text" name="uf" id="uf" value="" class="form-control" maxlength="2" />
                                </div>


                                <div class="col-lg-6">
                                    Email
                                    <input type="email" name="email" id="email" value="" class="form-control" />
                                </div>

                                <div class="col-lg-3">
                                    Telefone
                                    <input type="number" name="telefone" id="telefone" value="" class="form-control" maxlength="10" oninput="maxLengthNumber(this)" />
                                </div>

                                <div class="col-lg-3">
                                    Celular
                                    <input type="number" name="celular" id="celular" value="" class="form-control" maxlength="11" oninput="maxLengthNumber(this)" />
                                </div>

                                <div class="col-12">
                                    <a class="button left" href="<?=SITE_URL?>clientes.php"><< Voltar</a>

                                    <button id="salvar">Salvar</button>
                                </div>

                            </div>
                        </form>

                        <div id="placas"></div>
                    </div>

                </div>
            </div>
        </div>
    </body>

    <script>
        function buscaCliente(cpfCnpj) {
            $.ajax({   
              url: '<?=API_URL?>Proprietario/buscarPorDocumento/'+cpfCnpj,  
              method: "GET", 
              success: function(result) { 
                var dados = result.data;

                $("#id").val(dados.cpfCnpj);
                $("#nome").val(dados.nome);
                $("#tipo").val(dados.tipoPessoaProprietario);
                $("#vagas").val(dados.vagasContratadas);
                $("#apelido").val(dados.apelido);
                $("#cpf").val(dados.cpfCnpj);
                $("#rg").val(dados.rg);
                $("#cep").val(dados.cep);
                $("#logradouro").val(dados.logradouro);
                $("#numero").val(dados.numero);
                $("#complemento").val(dados.complemento);
                $("#bairro").val(dados.bairro);
                $("#municipio").val(dados.municipio);
                $("#uf").val(dados.uf);
                $("#email").val(dados.email);
                $("#telefone").val(dados.telefone);
                $("#celular").val(dados.celular);

                $("#form input").attr("readonly", true); 
                $("#form select").attr("disabled", true); 
                $('#salvar').html("Editar");
                $('#salvar').removeClass("desabilitado");

                var html="";

                if(dados.vagasContratadas>0) {
                    html += "<h2>Placas</h2>"+
                    "<div class='row'>"+
                        "<div class='col-lg-4 col-5'>"+
                            "<input type='hidden' id='alterarplaca' value='' />"+
                            "<input type='text' name='placa' id='placa' class='form-control' maxlength='7' placeholder='placa' />"+
                        "</div>"+
                        "<div class='col-lg-3 col-4'>"+
                            "<select name='padrao' id='padrao' class='form-control'>"+
                                "<option value='true'>padrão</option>"+
                                "<option value='false'>adicional</option>"+
                            "</select>"+
                        "</div>"+

                        "<div class='col-lg-2 col-3'>"+
                            "<button onclick='salvarPlaca()' class='add'>Adicionar</button>"+
                        "</div>"+
                    "</div><br>";
                }

                for(var p in dados.placas) {
                    padrao="ADICIONAL";

                    if(dados.placas[p].prioritaria==true) {
                        padrao="PADRÃO";
                    }

                    html += "<div class='row'>"+
                        "<div class='col-lg-4 col-4'><div class='placa'>"+dados.placas[p].placa+"</div></div>"+
                        "<div class='col-lg-3 col-4'><div class='placa'>"+padrao+"</div></div>"+

                        "<div class='input-group-append excluir col-lg-1 col-2' onclick=\"alteraPlaca(\'"+dados.placas[p].placa+"\', '"+dados.placas[p].prioritaria+"\')\" title='Editar'>"+
                            "<span class='input-group-text' id='basic-addon2'><i class='bi bi-pencil-square'></i></span>"+
                        "</div>"+
                        "<div class='input-group-append excluir col-lg-1 col-2' onclick=\"excluiPlaca(\'"+dados.placas[p].placa+"\')\" title='Excluir'>"+
                            "<span class='input-group-text' id='basic-addon2'><i class='bi bi-trash'></i></span>"+
                        "</div>"+
                    "</div>";
                }
                $("#placas").html(html);
              }

            });
        }

        <? if($cpfCnpj!=0) { ?>
            buscaCliente(<?=$cpfCnpj?>);
        <? } ?>

        //ao clicar no botão salvar
        $('#salvar').click(function(){
            if($('#salvar').html()=="Editar") {
                if($("#id").val()!=0) {
                    $("#form input").attr("readonly", false); 
                    $("#form select").attr("disabled", false); 
                    $('#salvar').html("Salvar");
                    $('#salvar').removeClass("desabilitado");

                    $("#tipo").attr("disabled", true); 
                    $("#cpf").attr("disabled", true); 
                }
            } else if($('#salvar').html()=="Salvar") {
                //valida dados
                if($('#form')[0].checkValidity()) {
                    acao = "criar";
                    meth="POST";
                    if($("#id").val()!=0) {
                        acao = "atualizar";
                        meth="PUT";
                    }

                    $.ajax({   
                      url: '<?=API_URL?>Proprietario/'+acao,  
                      method: meth,
                      headers: {          
                        "Content-Type": "application/json"   
                      }, 
                      "data": JSON.stringify({
                        "nome": $("#nome").val(),
                        "apelido": $("#apelido").val(),
                        "tipoPessoaProprietario": $("#tipo").val(),
                        "cpfCnpj": $("#cpf").val(),
                        "rg": $("#rg").val(),
                        "cep": $("#cep").val(),
                        "numero": $("#numero").val(),
                        "complemento": $("#complemento").val(),
                        "logradouro":$("#logradouro").val(),
                        "bairro": $("#bairro").val(),
                        "municipio": $("#municipio").val(),
                        "uf": $("#uf").val(),
                        "email": $("#email").val(),
                        "telefone": $("#telefone").val(),
                        "celular": $("#celular").val(),
                        "vagasContratadas": $("#vagas").val()
                      }), 
                      success: function(result) { 
                        alert(result.message);
                        if(result.status==200) {
                          buscaCliente($("#cpf").val());
                        }
                      }
                    });
                } else 
                    $("#form")[0].reportValidity();
            }

            return false;
        });

        function salvarPlaca() {
            if($('#placa').val().length<7) {
                alert('Placa inválida');
            } else {
                if($("#alterarplaca").val()=="sim") {
                    if($("#padrao").val()=='true') {
                        var data = JSON.stringify({
                        "placaVeiculo": $("#placa").val(),
                        "placaPrioritaria": true
                      });
                    } else {
                        var data = JSON.stringify({
                        "placaVeiculo": $("#placa").val(),
                        "placaPrioritaria": false
                      });
                    }

                    $.ajax({   
                      url: '<?=API_URL?>Placa/atualizar',  
                      method: "PUT",
                      headers: {          
                        "Content-Type": "application/json"   
                      }, 
                      "data": data, 
                      success: function(result) { 
                        alert(result.message);
                        if(result.status==200) {
                          buscaCliente($("#cpf").val());
                        }
                      }
                    });
                } else {
                    $.ajax({   
                      url: '<?=API_URL?>Proprietario/criarPlacaProprietario',  
                      method: "POST",
                      headers: {          
                        "Content-Type": "application/json"   
                      }, 
                      "data": JSON.stringify({
                        "CpfCnpj": $("#cpf").val(),
                        "placa": $("#placa").val()
                      }), 
                      success: function(result) { 
                        if(result.status==200) {
                          if($("#padrao").val()=='true') {
                                //tem que mandar padrão no alterar pq na inserção não funciona
                                $.ajax({   
                                  url: '<?=API_URL?>Placa/atualizar',  
                                  method: "PUT",
                                  headers: {          
                                    "Content-Type": "application/json"   
                                  }, 
                                  "data": JSON.stringify({
                                    "placaVeiculo": $("#placa").val(),
                                    "descricaoVeiculo": "",
                                    "placaPrioritaria": true
                                  }), 
                                  success: function(result) { 
                                    alert("Placa adicionada");
                                    if(result.status==200) {
                                      buscaCliente($("#cpf").val());
                                    }
                                  }
                                });
                            } else {
                                alert(result.message);
                                buscaCliente($("#cpf").val());
                            }
                        }
                      }
                    });
                }
            }
        }

        function alteraPlaca(placa, padrao){
            $("#placa").val(placa);
            $("#padrao").val(padrao);
            $("#alterarplaca").val("sim");

            $("#placa").attr("readonly", true); 
        }

        function excluiPlaca(id){
            if(confirm("Deseja realmente excluir essa placa?")) {
                $.ajax({   
                  url: '<?=API_URL?>Placa/excluir/'+id,  
                  method: 'DELETE', 
                  success: function(result) { 
                    alert(result.message);
                    if(result.status==200) {
                      buscaCliente($("#cpf").val());
                      busca();
                    }
                  }
                });
            }
        }
    </script>
</html>