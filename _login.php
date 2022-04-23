<? 
	session_start();
    include("lib/dados.php");

    $_SESSION[NOME_SESSAO]['usuario'] = $_GET['usuario']; 

    print "<script>window.location='".SITE_URL."entrada.php';</script>";

?>
