<div class="row">

    <div class="col-md-12 col-3 item <?=$menumarcado==4?'marcado':''?>" title="Entrada">
        <a href="<?=SITE_URL?>entrada.php">
            <i class="bi bi-box-arrow-in-up"></i>
        </a>
    </div>

    <div class="col-md-12 col-3 item <?=$menumarcado==5?'marcado':''?>" title="Saída">
        <a href="<?=SITE_URL?>saida.php">
            <i class="bi bi-box-arrow-down"></i>
        </a>
    </div>

    <? if($usu=='admin') { ?>
        <div class="col-md-12 col-3 item <?=$menumarcado==2?'marcado':''?>" title="Clientes">
            <a href="<?=SITE_URL?>clientes.php">
                <i class="bi bi-card-heading"></i>
            </a>
        </div>

        <div class="col-md-12 col-3 item <?=$menumarcado==6?'marcado':''?>" title="Criar Usuário">
            <a href="<?=SITE_URL?>usuario.php">
                <i class="bi bi-person-plus-fill"></i>
            </a>
        </div>
    <? } ?>

    <div class="col-md-12 col-3 item" title="Sair">
        <a href="<?=SITE_URL?>sair.php">
            <i class="bi bi-x-octagon-fill"></i>
        </a>
    </div>
</div>

<script>
    $(window).resize(function() {
        //para o menu e a lista ficarem no mínimo do tamanho da tela
        if($(window).width()>750) {
            $(".menu").css("min-height", $(window).height()+"px");
            $(".lista").css("min-height", $(window).height()+"px");
        } else {
            $(".menu").css("min-height", "auto");
            $(".lista").css("min-height", "auto");
        }
    });

    $(document).ready(function(){
        //para o menu e a lista ficarem no mínimo do tamanho da tela
        if($(window).width()>750) {
            $(".menu").css("min-height", $(window).height()+"px");
            $(".lista").css("min-height", $(window).height()+"px");
        }
    });
</script>