<?
    session_start();
    include("lib/dados.php");
    session_destroy();
    print "<script>window.location='".SITE_URL."login.php';</script>";
?>