<? 
    include("lib/dados.php");

    $title = 'Login | '.TITULO;
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta name="author" content="Automac" />
    <meta name="resource-type" content="document"/>
    <meta name="content-language" content="pt-br"/>
    <meta name="theme-color" content="#1d3557">

    <title><?=$title?></title>

    <link rel="icon" href="favicon.png">

    <script src="<?=SITE_URL?>lib/jquery.js"></script>
    <script src="<?=SITE_URL?>lib/bootstrap.js"></script>
    <script src="<?=SITE_URL?>lib/util.js"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>lib/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE_URL?>estilo.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if IE]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="login">
    <div class="container">
	  	<div class="row">
		  	<div class="col-md-6 offset-md-3 col-sm-12">
                <div class="col-12">
                    <h1><?=TITULO?></h1>
                </div><br>

			    <form id="form">
			        <div class="col-12">
                        Login
			          <input type="text" name="login" id="login" class="form-control" required />
			        </div>
			        <div class="col-12">
                        Senha
			          <input type="password" name="senha" id="senha" class="form-control" required />
			        </div>
                    
			        <div class="col-12">
                    <br>
                    <a class="button" id="entrar">ENTRAR</a>
                </div>
                </form>
		      </div>
	      </div>
	</div>
  </body>

  <script type="text/javascript">
    $('#entrar').click(function(){
        //valida dados cadastro
        if($('#form')[0].checkValidity()) {
            $.ajax({   
              url: '<?=API_URL?>Usuario/login',  
              method: "POST",
              headers: {          
                "Content-Type": "application/json"   
              }, 
              "data": JSON.stringify({
                "login": $("#login").val(),
                "senha": $("#senha").val()
              }), 
              success : function(result) {  
                if(result.status!=200) {
                  alert(result.message);
                } else {
                  //redireciona para criar sessão
                  location.href='<?=SITE_URL?>_login.php?usuario='+result.data.usuario;
                }
              }
            });
        } else 
            $("#form")[0].reportValidity();

        return false;
    });
  </script>
</html>
