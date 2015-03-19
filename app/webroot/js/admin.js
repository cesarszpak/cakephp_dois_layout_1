// JavaScript Document
$(document).ready(function(){
	
	// ***********************ADMINISTRAÇÃO - PRINCIPAL******************************//
	
	//Mostra mensagem de carregando
	carregadorMostra('Carregando a administração do seu site, aguarde...');
	
	$(window).load(function(){
	
		//oculta mensagem de carregando
		carregadorOculta('Carregando a administração do seu site, aguarde...');
		
		$("#cms-site").contents().find('body').on('click','a',function(e){
			e.preventDefault();
		});
		
		//injeta o css
		injectionCss();
		
		$('body').on('click','#painel a, #edicao a,#ajax-admin a',function(){
			if($(this).data('toggle')!='dropdown'){
				if($(this).attr('href')=='#')return false;
				ajaxLink($(this).attr('href'),$(this).attr('title'));
				return false;
			}
		});
		$('body').on('submit','#ajax-admin form',function(){
			ajaxForm($(this).attr('action'),$(this));
			return false;
		});
		
		base(true);
		
		CkEditorReload();
		
	});
	
	// ***********************ADMINISTRAÇÃO - EDIÇÃO******************************//
	
	$('body').on('click','#edicao a',function(){
		if(!$(this).hasClass('.edicao-widget')) var retorno = eval($(this).data('edicao')+'()');
		if($(this).data('edicao')!='salvar') $('#Salvar i').addClass('red');
	});
	
	//Ações dos botões
	
	
	function salvar(){
		carregadorMostra('Aguarde enquanto salvo sua página!');
		$("#cms-site").contents().find('.cms-conteudo div').each(function(){
			$(this).removeClass('coluna-ativo');
			$(this).removeClass('row-ativo');
			$(this).removeClass('admin-field sort');
			$(this).removeClass('sort');
			$(this).removeClass('ui-sortable');
			$(this).removeAttr('contenteditable');
			
			if($(this).hasClass('campo-edita')){
				$(this).each(function() {

					var attributes = $.map(this.attributes, function(item) {
						return item.name;
					});
					
					var este = $(this);
					$.each(attributes, function(i, item) {
						este.removeAttr(item);
						este.addClass('campo-edita');
					});
				});
			}else{
				$(this).children('.campo-edita').each(function() {

					var attributes = $.map(this.attributes, function(item) {
						return item.name;
					});
					
					var este = $(this);
					$.each(attributes, function(i, item) {
						este.removeAttr(item);
						este.addClass('campo-edita');
					});
				});
			}
		});
		
		$('#PaginaCorpo').val($("#cms-site").contents().find('.cms-conteudo').html());
		
		$.ajax({
			url:base_url+'ajax/Paginas/edita/'+base_id,
			dataType: "html",
			type:'post',
			data:$('#PaginaCmsEditaForm').serialize(),
			success:function(e){
				CkEditorReload();
				carregadorMostra(e,false,false);
				$('#Salvar i').removeClass('red');
				return 'Salvo';
			},error:function(){
				CkEditorReload();
				carregadorMostra('Verifique a conexão com a internet!');
			}
		});
	}
	function linha(){
		$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').each(function(i){
			$(this).removeClass('row-ativo');
		});
		$("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').each(function(i){
			$(this).removeClass('coluna-ativo');
		});
		$("#cms-site").contents().find('.cms-conteudo').append('<div class="row row-ativo sort"><div class="text-center">Nova linha criada com sucesso</div></div>');
	}
	
	function coluna(){
		var i = 0;
		$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').each(function(){
			i++;
		});
		$("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').each(function(i){
			$(this).removeClass('coluna-ativo');
		});
		if(i==0){
			$('#ajax-admin .modal-header h3').html('Nenhuma linha selecionada');
			$('#ajax-admin .modal-body').html('Atenção: você precisa escolher uma linha para poder adicionar uma coluna!');
			$('#ajax-admin').modal();
		}else if(i==1){
			addHtml();
			var i=0;
			function addHtml(){
				elemento=$("#cms-site").contents().find('.row-ativo');
				var n='1';
				$('#ajax-admin .modal-header h3').html('Escolha o tamanho da coluna');
				$('#ajax-admin .modal-body').html('<h4>Escolha o formato das colunas:</h4><p><div class="coluna-formato"><a href="#" data-coluna="1" class="btn"><img src="'+base_url+'img/editor/coluna_1.png"/></a> <a href="#" data-coluna="2" class="btn"><img src="'+base_url+'img/editor/coluna_2.png"/></a> <a href="#" data-coluna="5" class="btn"><img src="'+base_url+'img/editor/coluna_3.png"/></a> <a href="#" data-coluna="3" class="btn"><img src="'+base_url+'img/editor/coluna_4.png"/></a> <a href="#" data-coluna="4" class="btn"><img src="'+base_url+'img/editor/coluna_5.png"/></a> <a href="#" data-coluna="8" class="btn"><img src="'+base_url+'img/editor/coluna_6.png"/></a> <a href="#" data-coluna="6" class="btn"><img src="'+base_url+'img/editor/coluna_7.png"/></a> <a href="#" data-coluna="7" class="btn"><img src="'+base_url+'img/editor/coluna_8.png"/></a> <a href="#" data-coluna="9" class="btn"><img src="'+base_url+'img/editor/coluna_9.png"/></a></div></p>');
				
				$('#ajax-admin').modal();
				
				$('#ajax-admin').on('click','.modal-body .coluna-formato a',function(e){
					e.stopPropagation();
					n = $(this).data('coluna');
					if(n==1) var html='<div class="span12 coluna-ativo">Coluna 1</div>';
					if(n==2) var html='<div class="span6 coluna-ativo">Coluna 1</div><div class="span6">Coluna 2</div>';
					if(n==3) var html='<div class="span4 coluna-ativo">Coluna 1</div><div class="span8">Coluna 2</div>';
					if(n==4) var html='<div class="span8 coluna-ativo">Coluna 1</div><div class="span4">Coluna 2</div>';
					if(n==5) var html='<div class="span4 coluna-ativo">Coluna 1</div><div class="span4">Coluna 2</div><div class="span4">Coluna 3</div>';
					if(n==6) var html='<div class="span2 coluna-ativo">Coluna 1</div><div class="span5">Coluna 2</div><div class="span5">Coluna 3</div>';
					if(n==7) var html='<div class="span5 coluna-ativo">Coluna 1</div><div class="span5">Coluna 2</div><div class="span2">Coluna 3</div>';
					if(n==8) var html='<div class="span5 coluna-ativo">Coluna 1</div><div class="span2">Coluna 2</div><div class="span5">Coluna 3</div>';
					if(n==9) var html='<div class="span3 coluna-ativo">Coluna 1</div><div class="span6">Coluna 2</div><div class="span3">Coluna 3</div>';
					
					elemento.html(html);
					html_insert();
					$('#ajax-admin').modal('hide');
					return false;
				});
			}
		}else{
			$('#ajax-admin .modal-header h3').html('Escolha apenas uma linha');
			$('#ajax-admin .modal-body').html('Atenção: Existe mais de uma linha ativa no momento, clique apenas em uma!');
			$('#ajax-admin').modal();
		}
	}
	function apagar(){
		if($("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').length){
			if(confirm('Tem certeza que quer remover a coluna?'))
			$("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').remove();
			if(!$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo [class*="span"]').length) $("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').html('<div class="text-center">Nova linha criada com sucesso</div>');
		}else if($("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').length){
			if(confirm('Tem certeza que quer remover a linha?'))
			$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').remove();
		}
	}
	
	function html_insert(){
		var i = 0;
		var seletor = $("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').children('div');
		
		seletor.each(function(){
			i++;
		});
		
		//if((seletor.text()=='Coluna 1')||(seletor.text()=='Coluna 2')||(seletor.text()=='Coluna 3')){
			seletor.html('<div class="campo-edita"><p>Clique aqui para alterar este texto!</p></div>');
		/*}else{
			if(confirm('Tem certeza que quer sobrescrever o conteúdo atual?')){
				seletor.html('<div class="campo-edita"><p>Clique aqui para alterar este texto!</p></div>');
			}
		}*/
		CkEditorReload();
		
		return false;
	}
	
	// ***********************NAVEGAÇÃO ENTRE LINHAS E COLUNAS*******************//
	
	//Seleciona coluna
	$("#cms-site").load(function(){
		$(this).contents().find('.cms-conteudo').on('click','[class*="span"]',function(e){
			$("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').each(function(i){
				$(this).removeClass('coluna-ativo');
			});
			$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').each(function(i){
				$(this).removeClass('row-ativo');
			});
			if($(this).parents('.cms-conteudo')) $(this).addClass('coluna-ativo');
			if($(this).parents('.cms-conteudo')) $(this).parent().addClass('row-ativo');
		});
		$(this).contents().find('.cms-conteudo').on('click','.row',function(e){
			$("#cms-site").contents().find('.cms-conteudo').find('.row-ativo').each(function(i){
				$(this).removeClass('row-ativo');
			});
			$(this).addClass('row-ativo');
			
			$("#cms-site").contents().find('.cms-conteudo').find('.coluna-ativo').each(function(i){
				if(!$(this).parents('.row-ativo').length) $(this).removeClass('coluna-ativo');
			});
			
		});
		$(this).contents().find('body').on('click','*',function(e){
			e.stopPropagation();
			if(!$(this).parents('.cms-conteudo').length){
				$("#cms-site").contents().find('.cms-conteudo [class*="span"]').each(function(i){
					$(this).removeClass('coluna-ativo');
					$(this).parent().removeClass('row-ativo');
				});
			}
		});
	});
	
	//seleção
	
	// ***********************CORE DA ADMINISTRAÇÃO******************************//
	
	//adiciona o css da coluna e linha ativa
	function injectionCss(){
		$('<style>.coluna-ativo{outline:1px dashed #F90}.cms-conteudo [class*="span"],.cms-conteudo .row{cursor:pointer}.cms-conteudo [class*="span"]:hover{outline:1px dashed #FC0}.row-ativo{outline:1px dashed #FC9}</style>').appendTo($("#cms-site").contents().find('head'));

	}	
	
	//carrega páginas em ajax
	
	function ajaxLink(url,titulo){
		titulo = typeof titulo !== 'undefined' ? titulo : 'CMS Inline';
		carregadorMostra();
		$.ajax({
			url:url,
			dataType: "html",
			type:'get',
			success:function(data){
				
				carregadorOculta();
				
				$('#ajax-admin .modal-header h3').text(titulo);
				$('#ajax-admin .modal-body').html(data);
				$('#ajax-admin').modal('show');
				
				base();
				
			}
		});
	}
	
	//carrega formulários em ajax
	
	function ajaxForm(url,elemento){
		carregadorMostra('Carregando, aguarde...');
		$.ajax({
			url:url,
			dataType:'html',
			data:elemento.serialize(),
			type:'post',
			success: function(e){
				$('#ajax-admin .modal-body').html(e);
				$('#ajax-admin').modal('show');
				carregadorOculta();
			}
		});
	}
	
	//funções básicas
	
	function base(dragg){
		
		dragg = typeof dragg !== 'undefined' ? dragg : false;
		
		//exibe os toltips:
		$('.ttip').tooltip();
		
		//ajusta as tabelas
		$('.table-ajax').dataTable();
		
		//Habilita arrastar objetos
		if(dragg)$( '.dragg' ).draggable({ containment: 'body' });
	}
	
	//carregador
	
	function carregadorMostra(mensagem,preloader,header){
		mensagem = typeof mensagem !== 'undefined' ? mensagem : false;
		preloader = typeof preloader !== 'undefined' ? preloader : true;
		header = typeof header !== 'undefined' ? header : true;
		
		if(mensagem){
			$('#carregador .modal-mensagem').html(mensagem);
		}
		if(preloader){
			$('#carregador .progress').show('slow');
		}else{
			$('#carregador .progress').hide('slow');
		}
		if(header){
			$('#carregador .modal-header').show('slow');
		}else{
			$('#carregador .modal-header').hide('slow');
		}
		
		$('#carregador').modal('show');
	}
	function carregadorOculta(){
		$('#carregador .modal-mensagem').text('Aguarde alguns instantes...');
		$('#carregador').modal('hide');
	}
	
	//CKEDITOR
	function CkEditorReload(){
		var seletor_base = $("#cms-site").contents().find('.cms-conteudo');
		
		if(seletor_base.length > 0) {
			var iframe_CKEDITOR = document.getElementById("cms-site").contentWindow.CKEDITOR;
			for(name in iframe_CKEDITOR.instances)
			{
				iframe_CKEDITOR.instances[name].destroy()
			}
			
			seletor_base.find('.campo-edita').each(function(i){
				$(this).attr('contenteditable','true')
			});
			
			//$('.cms-conteudo img').resizable();
			iframe_CKEDITOR.inlineAll();
			
			for(name in iframe_CKEDITOR.instances)
			{
				iframe_CKEDITOR.instances[name].on('change',function(){
					if(!$('#Salvar i').hasClass('red')) $('#Salvar i').addClass('red');
				});
			}
		}
		
	}
});