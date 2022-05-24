<?
if($_SERVER['HTTP_HOST']=='localhost')
{
    DEFINE('SITE_URL','http://www.localhost/automac/estacionamento/');
}
else
{
    DEFINE('SITE_URL','');
}

DEFINE('TITULO', utf8_encode('Automac - Estacionamento'));
DEFINE('NOME_SESSAO','automac_estacionamento');
DEFINE('API_URL','https://localhost:44352/api/');
DEFINE('CNPJ','123456');
?>