<?php
if(basename($_SERVER['PHP_SELF'])=='emitir.php'){
	header('Location: index.php?page=emitir');
	exit;
}
$servidor = isset($servidor) ?  $servidor : array();

?>
<style>
fieldset .page-body{
	height: 100%;
    padding: 15px;
    position: relative;
    width: 350px;
    max-width: 100%;
    margin: auto;
}
figure img:not([src]):after{
	content: 'Selecionar Imagem';
	font-size: 12px;
}
label.checkbox.required:after{
	content: '(Obrigatório)';
	font-size: 9px !important;
	margin-left: 5px;
}
</style>
<article class="page-inner container-fluid">
	<div class="page-header bg-white border-bottom inteiro text-left">
		<h4 class="page-title noselect font-weight-bold">Emitir Certidão</h4>
	</div>
	<div class="tela_central text-center mt-3">
	<?php
	if(!empty($servidor)){ ?>
		<form name="form_emitir" id="form_emitir" action="" enctype="multipart/form-data" method="post">
			<fieldset class="d-block border1 p-2">
				<legend class="section-title text-left small border-0">Bem-vindo, <b class='highlighted'><?=$VAR_NOME_SERVIDOR;?></b> !</legend>
				<div class="page-body d-inline-block">
					<div class="form-group col-lg-12 col-12 col-sm-12">
						<label class="font-weight-bold d-block text-left required" for="cnpj">CNPJ:</label>
						<input type="text" class="form-control input-sm typeCnpj" id="cnpj" name="cnpj" maxlength="18" size="14" placeholder="00.000.000/0000-00" />
					</div>
					<div class="form-group col-lg-12 col-12 col-sm-12">
						<UL class="d-block nav text-left"><?php
						$k=0;
						foreach(CERTS as $key => $val){
							$k++;
							$checado = $k<=2 ? ' checked disabled' : ''; ?>
							<LI class="nav-item">
								<label class="checkbox font-weight-bold <?=$k<=2?'required':'';?>"><?=$val;?>
									<input type="checkbox" name="keys" value="<?=$key;?>" <?=$checado;?> /><span class="mark"></span>
								</label>
							</LI>
						<?php
						}
						?></UL>
					<hr>
						<button class="btn btn-default btn-small" name="submit" onclick="sendQueue(this)" id="btn-submit"><i class="fa-solid fa-wand-magic-sparkles mr-2"></i>Gerar Certidões</button>
					</div>
				</div>
			</fieldset>
		</form>
	<?php

	} else {?>
		<div class="card-header bg-white mb-4">
			<font class="messageSimpleError text-center d-block"><b class="negrito mr-1">Mensagem:</b>Usuário não autenticado. Faça seu Login.</font>
		</div>
	<?php
		} ?>
	</div>
</article>