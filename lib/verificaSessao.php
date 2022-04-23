<? 
	if(!isset($_SESSION[NOME_SESSAO]))
    {
        print "<script>window.location='".SITE_URL."login.php';</script>";
    }

    $usu = $_SESSION[NOME_SESSAO]['usuario'];
?>