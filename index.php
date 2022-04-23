<?
session_start();
include('lib/dados.php');
include("lib/verificaSessao.php");

//HEAD
$title = 'Painel | '.TITULO;
$menumarcado = 1;   
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
                        <h1>Painel</h1>
                    </div>
                </div>
                <div class="col-12 detalhe">
                    <div class="fundocinza">
                        <div class="row">
                            <div class="col-12">
                                Em breve
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>