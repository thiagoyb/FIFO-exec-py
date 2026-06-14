<?php
if(basename($_SERVER['PHP_SELF'])=='certidoes.php'){
	header('Location: index.php?page=certidoes');
	exit;
}
	$page = isset($_GET['page']) && $_GET['page']!='' ? $_GET['page'].'.php' : 'emitir.php';
?>
<!DOCTYPE html>
<HTML lang="pt-br">
<HEAD><title>Sistema de Emissão de Certidões em FIFO</title>
	<META http-equiv="X-UA-Compatible" content="IE=edge" />
    <META http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<META name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, maximum-scale=1, user-scalable=0" />

	<META name="description" content="Emissão de CND, Simples e FGTS, etc em fila!" />
	<META name="author" content="ThiagoDev" />
	<link rel="icon" href="./assets/img/logo_certidoes.png"></link>
<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css"></link>
	<link rel="stylesheet" type="text/css" href="./assets/css/view.class.css"></link>
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.custom.css"></link>
	<LINK rel="stylesheet" type="text/css" href="./assets/css/FontAwesomePro.css"></link>
	<LINK rel="stylesheet" type="text/css" href="./assets/css/fonts.min.css"></LINK>
	<LINK rel="stylesheet" type="text/css" href="./assets/css/neon-core.css"></link>
	<LINK rel="stylesheet" type="text/css" href="./assets/css/neon-theme.css"></link>
	<LINK rel="stylesheet" type="text/css" href="./assets/css/neon-forms.css"></link>
	<script type="application/javascript" src="./assets/js/jquery-1.11.3.min.js"></script>
	<style>
	body.os, .wrapper.container-fluid{
		text-align: center;
		background-color: #EEE !important;
		-webkit-background-size: inherit !important;
		moz-background-size: inherit !important;
		-o-background-size: inherit !important;
		background-size: inherit !important;
	}
	.card-profile .user-stats [class^="col"]{
		border-right: 1px solid #ebebeb;
	}
	input[type="date"].form-control, input[type="time"].form-control, input[type="datetime-local"].form-control, input[type="month"].form-control{line-height: 1.9;}
	.page-container .sidebar-menu{
		background: #304136 !important;
	}
	footer.footer, .theme-cert header.row{
		background: #304136 !important;
		color: snow !important;
	}
	/* DEFAULT THEME COLOR */
	.theme-cert .bg-default{
		background-color: #304136 !important;
	}
	.theme-cert .btn-default:hover{
		/*color: #BDE5F8 !important;*/
		background-color: #107e1e !important;
		border-color: #107e1e !important;
	}
	.theme-cert .btn-default{
		color: #fff;
		background-color: #304136 !important;
		border-color: #00529B !important;
	}
	.theme-cert header.row{
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li.active > a{
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu{
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li#search{
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li ul > li > a{
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li ul > li ul > li > a {
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li ul > li ul > li ul > li > a {
		background-color: #304136;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li ul > li ul > li ul > li ul > li > a {
		background-color: #304136;
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li#search.focused .search-input{
		background-color: #304136;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-inner > ul > li#search,
	.theme-cert .page-container.horizontal-menu header.navbar > ul > li#search{
		background-color: #304136;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search{
		background-color: #304136;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search:hover{
		background-color: #304136;
	}
	.theme-cert .dataTables_wrapper .dataTables_paginate span .paginate_button.current{
		background-color: #304136;
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li > a > span:not(.badge){
		background-color: #304136;
	}
	.theme-cert .profile-info.dropdown .dropdown-menu{
		background-color: #304136;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li, .notifications.dropdown .dropdown-menu > li > ul > li{
		background: inherit !important;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li > ul{
		background-color: #304136;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li.top > p, .theme-cert .notifications.dropdown .dropdown-menu > li.external a{
		background-color: #1F497D;
	}
	.theme-cert .notifications.dropdown .dropdown-menu{
		background-color: #304136;
		border: 1px solid #304136;
	}
	.theme-cert .profile-info.dropdown .dropdown-menu li a:hover{
		background-color: #107e1e !important;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li ul > li > a:hover{
		background-color: #107e1e !important;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li.external a:hover, .notifications.dropdown .dropdown-menu > li.top p:hover{
		background-color: transparent;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li > ul > li > a:hover, .notifications.dropdown .dropdown-menu > li > ul > li > p:hover{
		background-color: #107e1e !important;
	}
/* END DEFAULT THEME COLOR */
/* DEFAULT BORDER COLOR */
	[dark] .notifications.dropdown .dropdown-menu > li > ul > li strong{
		color: #373e4a;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li > ul > li strong{
		color: white;
	}
	[dark] .page-container .sidebar-menu #main-menu li{
		border-bottom: 1px solid rgba(69, 74, 84, 0.7) !important;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li{
		border-bottom: 1px solid rgba(200, 200, 200, 0.5);
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li > a > span:not(.badge){
		border-top: 1px solid rgba(200, 200, 200, 0.5);
		border-bottom: 1px solid rgba(200, 200, 200, 0.5);
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li ul{
		border-color: rgba(200, 200, 200, 0.5);
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li > ul li{
		border-bottom: 1px solid rgb(112 112 112 / 70%);
		/*border-bottom: 1px solid #107e1e !important;*/
	}
	.theme-cert .profile-info.dropdown .dropdown-menu > li{
		border-bottom: 1px solid #107e1e !important;
	}
	.theme-cert .page-container .sidebar-menu .logo-env > div.sidebar-collapse a, .page-container .sidebar-menu .logo-env > div.sidebar-mobile-menu a{
		border-color: transparent !important;
	}
	
	.theme-cert .notifications.dropdown .dropdown-menu > li{
		border-bottom: 1px solid #107e1e;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li > ul > li{
		border-bottom: 1px solid #107e1e !important;
	}
	[dark] .notifications.dropdown.open > a{
		background-color: #107e1e;
	}
	.theme-cert .notifications.dropdown.open > a{
		background-color: #1F497D;
	}
/* DEFAULT BORDER COLOR */
/* MY TEXT COLORS */
	.theme-cert .notifications.dropdown .dropdown-menu li, .notifications.dropdown .dropdown-menu a, .notifications.dropdown .dropdown-menu p{
		color: #e6f9ff !important;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li.external a{
		color: #ec5956 !important;
		font-weight: bold;
	}
	.theme-cert .notifications.dropdown .dropdown-menu > li > p a.pull-right{
		color: #107e1e !important;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li a, .profile-info.dropdown .dropdown-menu li a{
		color: #e6f9ff !important;
	}
	.theme-cert .page-container .sidebar-menu .logo-env > div > a{
		color: #e6f9ff !important;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li#search .search-input{
		color: #dfdfdf;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li#search .search-input{
		color: #dfdfdf;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li#search button{
		color: #dfdfdf;
	}
	.theme-cert .page-container .sidebar-menu #main-menu li a{
		color: #dfdfdf;
	}
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li.has-sub:hover.has-sub > a:hover,
	.theme-cert .page-container.sidebar-collapsed .sidebar-menu #main-menu > li:hover.has-sub > a:hover{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-nav > li > a{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-nav > li ul li a{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-nav > li ul li.has-sub > a:before{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-inner > ul > li#search .search-input,
	.theme-cert .page-container.horizontal-menu header.navbar > ul > li#search .search-input{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar .navbar-inner > ul > li#search button,
	.theme-cert .page-container.horizontal-menu header.navbar > ul > li#search button{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar ul.nav{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar ul.nav > li > a,
	.theme-cert .page-container.horizontal-menu header.navbar ul.nav > li > span{
		color: #dfdfdf;
	}
	.theme-cert .page-container.horizontal-menu header.navbar ul.nav > li .horizontal-mobile-menu a{
		color: #dfdfdf;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search ::-webkit-input-placeholder {
		color: #dfdfdf;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search :-moz-placeholder {
		color: #dfdfdf;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search ::-moz-placeholder {
		color: #dfdfdf;
	}
	.theme-cert .page-body .page-container.horizontal-menu header.navbar .navbar-nav > li#search :-ms-input-placeholder {
		color: #dfdfdf;
	}
	.theme-cert .profile-info.dropdown .dropdown-menu li{
		color: #dfdfdf;
	}
	.theme-cert .profile-info.dropdown .dropdown-menu li a {
		color: #dfdfdf;
	}
	.theme-cert .badge{    color: #373e4a !important;}	
	.theme-cert header.row UL.user-info LI a, header.row UL.links-list LI a, header.row UL.notifications UL * {
	    color: #DFDFDF;
	}
	.theme-cert UL.notifications UL.dropdown-menu LI, UL.notifications UL.dropdown-menu LI UL LI{
		color: #373e4a !important;
	}
	
	.theme-cert table.rs THEAD, .theme-cert table.rs TFOOT{
		background-color: #1F497D;
		background-color: #3f7daf !important;
		color: snow;
	}
	</style>
</head>
<BODY bgcolor="ddd" class="page-body os theme-cert" data-bjdark="true" onmouseup onmousedown onoffline onresize onload>
  <DIV class="page-container">
	<!--<NAV HIDDEN id="sidebar" class="sidebar-menu fixed">
		<div class="sidebar-menu-inner">
			<header class="logo-env">
				<div class="logo">
					<a href="index.php" class="logo">
						<img class="navbar-brand1 rounded-circle" src="./assets/img/logo_certidoes.png" valign="middle" padding="0" width="45" alt="navbar brand" />
						<span class="noselect text-white font-weight-bold hidden-xs ml-1">Certidões</span>
					</a>
				</div>
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon">
						<i class="icon-menu"></i>
					</a>
				</div>
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation">
						<i class="icon-menu"></i>
					</a>
				</div>
			</header>
		</div>
	</NAV>-->
	<MAIN class="main-content container-fluid border-0">
		<header class="row noprint">
			<section id="barraEsquerda" class="col-md-6 col-sm-4 clearfix">
				<div class="logo d-inline-block pull-left m-2">
					<a href="index.php" class="logo">
						<img class="navbar-brand1 rounded-circle" src="./assets/img/logo_certidoes.png" valign="middle" padding="0" width="45" alt="navbar brand" />
						<span class="noselect text-white font-weight-bold hidden-xs ml-1">Certidões</span>
					</a>
				</div>
				<ul class="list-inline links-list pull-left hidden-xs">				
					<li class="sep"></li>
					<li>
						<a target="_self" href="./../" title="" data-collapse-sidebar="1">
							<i class="fa-solid fa-arrow-left mr-1"></i> <span class="hidden-xs">Voltar / Sair</span>
						</a>
					</li>
					<li class="sep"></li>
				</ul>
				<ul class="user-info pull-left pull-left-xs pull-none-xsm">
					<li class="profile-info dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="line-height: 3;">
							<i class="fa-regular fa-user"></i>
							<?= $VAR_NOME_SERVIDOR; ?>
						</a>
						<ul class="dropdown-menu">
							<li class="caret"></li>
							<!--<li>
								<a href="./../index.php?">
									<i class="fa-solid fa-house-user mr-1"></i>
									Meus Sistemas
								</a>
							</li>-->
							<li>
								<a href="./../index.php?p=CONTA#profile">
									<i class="fa-solid fa-user-pen"></i>
									Editar Perfil
								</a>
							</li>
							<li>
								<a href="./../index.php?p=SENHA#password">
									<i class="fa-solid fa-key"></i>
									Senha
								</a>
							</li>							
							<li>
								<a target="_self" href="./../sair.php">
									<i class="fa-solid fa-arrow-right-from-bracket"></i>
									Sair
								</a>
							</li>
						</ul>
					</li>		
				</ul>				
			</section>
			<section id="barraDireita" class="col-md-6 col-sm-8 clearfix">
				<ul class="user-info pull-left pull-right-xs pull-none-xsm">
					<li>
						<a href="#" class="btn text-center">
							<font class="d-block messageSimple w-100">
								<b id="processing_now" class="badge badge-roundless text-white badge-status" style="font-size: 11px;">
									carregando...<script>
									setTimeout(()=>{current_process(); },999);
									</script>
								</b> sendo processado...
							</font>
						</a>
					</li>
				</ul>
			</section>
		</header>
		<section id="mainPage" class="page mainPage text-left">
		<?php
			if(file_exists($page)){ ?>
			  <div class="row">
		  <?php
				require_once $page; ?>
			  </div><?php

			}else{
			  echo "Bem-vindo, <b class='highlighted'>".$VAR_NOME_SERVIDOR.'</b> !';
			} ?>			
		</section>
		<footer class="footer bg-dark text-light">
		  <div class="container">
			<div class="row">
			<div class="col-lg-12 text-center">
			  <h5 class="text-light">Processador de Certidões em FIFO</h5>
			  <h6 class="text-light"><a target="_blank" class="text-link" href="https://github.com/thiagoyb/FIFO-exec-py">://github.com/thiagoyb/FIFO-exec-py</a></h6>
			</div>
			</div>
			<div class="footer d-block text-light" style="padding-top:2px;border-top:1px solid #CCCCCC11;">
			&copy; <?= date('Y'); ?> - <a target="_blank" class="text-link" href='http://byt.dev.br'>Thiago.Dev</a>
			</div>
		  </div>
		</footer>
		<a href="#top" title="Voltar ao Topo">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 7.58l5.995 5.988-1.416 1.414-4.579-4.574-4.59 4.574-1.416-1.414 6.006-5.988z"/></svg>
		</a>
	</MAIN>
  </DIV>
<!-- Bottom Scripts (common) -->
	<script type="application/javascript" src="./assets/js/Utils.js"></script>
    <script type="application/javascript" src="./assets/js/Masks.js"></script>
    <script type="application/javascript" src="./assets/js/Listener.js"></script>

	<script type="application/javascript" src="./assets/js/TweenMax.min.js"></script>
	<script type="application/javascript" src="./assets/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script type="application/javascript" src="./assets/js/bootstrap.js"></script>
	<!--<script type="application/javascript" src="./assets/js/joinable.js"></script>-->
	<script type="application/javascript" src="./assets/js/resizeable.js"></script>
	<!-- JS initializations and stuff -->
	<script type="application/javascript" src="./assets/js/neon-api.js"></script>
	<script type="application/javascript" src="./assets/js/neon-custom.js"></script>
	<SCRIPT type="application/javascript" language="javascript">
	const mostrarErro = msg => {
		document.querySelectorAll('.toast-erro').forEach(t => t.remove());
		const toast = document.createElement('div');
		toast.className = 'toast-erro';
		toast.style.cssText = `
		  position: fixed;
		  bottom: 25px;
		  left: 50%;
		  transform: translateX(-50%);
		  background: #c0392b;
		  color: #fff;
		  padding: 14px 20px;
		  border-radius: 10px;
		  font-size: 13px;
		  z-index: 9999;
		  box-shadow: 0 5px 20px rgba(0,0,0,0.2);
		  max-width: 90%;
		  word-break: break-word;
		`;
		toast.textContent = msg;
		document.body.appendChild(toast);
		setTimeout(() => { toast.remove(); }, 5000);
	}
	const current_process = ()=> {
		if(event) event.preventDefault();
		let cur_container = document.querySelector('b#processing_now');
		if(cur_container){
			return fetch(`ajax.php?a=current_process&token=<?= strtotime('+6 hour'); ?>`,{
				method: 'POST', headers: {
				  'Accept': 'application/json'
				},
				body: Utils.Obj2FD({code:null})
			})
			.then(response => {
				if(!response.ok){
				   throw new Error('Error: '+response.statusText);
				}
				return response.json();
			})
			.then(rs => {
				if(rs.id && rs.id!=''){
					cur_container.classList.add('ongoing');
					cur_container.classList.add('blink');
					cur_container.innerHTML =  rs.id;
				} else{
					cur_container.classList.remove('ongoing');
					cur_container.classList.remove('blink');
					cur_container.innerHTML =  'carregando...';
				}
				setTimeout(()=>{ current_process(); }, 3000);
			});
		}
	}
	const sendQueue = e =>{
		if(event) event.preventDefault();
		let form = e.closest('form') ? e.closest('form') : document, cnpj = form.querySelector('[name=cnpj]');
		if(Utils.isCNPJ(cnpj.value)){
			e.innerHTML='Carregando...';
			e.value=e.innerHTML;
			e.disabled = true;
			return fetch(`ajax.php?a=sendQueue&token=<?= strtotime('+6 hour'); ?>`,{
				method: 'POST', headers: {
				  'Accept': 'application/json'
				},
				body: Utils.Obj2FD({cnpj:cnpj.value})
			})
			.then(response => {
				e.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles mr-2"></i>Gerar Certidões';
				e.disabled = true;	e.value=e.innerHTML;
				if(!response.ok){
				   throw new Error('Error: '+response.statusText);
				}
				return response.json();
			})
			.then(rs => {
				if(rs.msg && rs.msg!='') mostrarErro(rs.msg);
				if(rs.rs){
					renderPanel(form, rs.data);
					checkStatus(rs.data.code);
				}
			});
		} else{ mostrarErro('Não é CNPJ valido!'); }
	}
	const checkStatus = code=>{
		let statusContainer = document.querySelector('.recibo-header .badge-status');
		return fetch(`ajax.php?a=checkStatus&token=<?= strtotime('+6 hour'); ?>`,{
				method: 'POST', headers: {
				  'Accept': 'application/json'
				},
				body: Utils.Obj2FD({code:code})
			})
			.then(response => {
				if(!response.ok){
				   throw new Error('Error: '+response.statusText);
				}
				return response.json();
			})
			.then(rs => {console.log(rs);
				switch(rs.status){
					case 'ongoing':
						statusContainer.innerHTML = 'Na Fila';
						statusContainer.classList.add('pending');
						statusContainer.classList.remove('ongoing');
						statusContainer.classList.remove('success');
						setTimeout(() => { checkStatus(code); }, 3000);
						break;
					case 'processing':
						statusContainer.innerHTML = 'Processando';
						statusContainer.classList.add('ongoing');
						statusContainer.classList.remove('pending');
						statusContainer.classList.remove('success');
						setTimeout(() => { checkStatus(code); }, 3000);
						break;
					case 'finished':
						statusContainer.innerHTML = 'Finalizado';
						statusContainer.classList.add('success');
						statusContainer.classList.remove('pending');
						statusContainer.classList.remove('ongoing');
						setTimeout(()=>{ setResult(rs);},500);
						break;
					default:
						setTimeout(() => { checkStatus(code); }, 3000);
						break;
				}
			});
	}
	const setResult = rs=>{
		if(rs.result && rs.files){
			Object.entries(rs.result).forEach(([key, result])=>{
				let container = document.querySelector('.certidoes-progress #cert-'+key), a = document.createElement('a');
				if(container){
					const cert = result[0], cor = result[1], url = rs.files[key];

					container.style.backgroundColor = cor;
					container.innerHTML = `<i class="fa-solid fa-check"></i><strong>${key.toUpperCase()}:</strong>${cert}`;
					a.setAttribute('class','btn btn-success rounded small position-absolute p-1');
					a.innerHTML = 'Acessar';
					a.target='_blank';
					a.style = url!=undefined ? 'right:5px' : 'display:none !important';
					a.href = url!=undefined ? url : '#';
					container.append(a);
				}
			});
		} else{ console.log('Error getting files'); } 
	}
	const renderPanel = (container, data)=>{
		if(container && data){
			container.innerHTML = `
			<div class="card-recibo animate__animated animate__fadeIn">
				<div class="recibo-header">
					<h3><i class="bi bi-receipt"></i> Andamento da Requisição</h3>
					<span class="badge-status highlight pending">${data.status.toUpperCase()}</span>
				</div>
				<div class="recibo-body">
					<p><strong>ID da Requisição:</strong> ${data.idRequest}</p>
					<p><strong>CNPJ:</strong> ${data.cnpj}</p>
					<p><strong>Data/Hora:</strong> ${data.data}</p>
					<p><strong>Solicitante:</strong> ${data.user}</p>
				</div>
				<hr>
				<div class="certidoes-progress">
					<div class="item-certidao font-weight-bold" id="cert-simples"><i class="spinner-border spinner-border-sm circLoader"></i> Simples Nacional</div>
					<div class="item-certidao font-weight-bold" id="cert-cnd"><i class="spinner-border spinner-border-sm circLoader"></i> CND</div>
					<div class="item-certidao font-weight-bold" id="cert-fgts"><i class="spinner-border spinner-border-sm circLoader"></i> FGTS</div>
				</div>
			</div>
			`;
		}
	}
	$(document).ready(function(){
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$('a[href="#top"]').fadeIn();
			} else {
				$('a[href="#top"]').fadeOut();
			}
		});
		$('a[href="#top"]').click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
	</SCRIPT>
  </BODY>
</HTML>