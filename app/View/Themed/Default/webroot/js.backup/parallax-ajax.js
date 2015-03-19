$(window).load(function() {
	$.stellar({
	  horizontalScrolling: false,
	  positionProperty: 'transform'
	});
	/*$.history.on('load change push', function(event, url, type) {
		vaiPara(url);
	}).listen('hash');
	$('body').on('click','a',function(event) {
		if($(this).attr('rel')!='external'){
			var url = $(this).attr('href');
			if(base_url==url)url='home';
			vaiPara(url);
			$.history.push(url);
			return false;
		}
	});*/
	rolagem=true;

	$('a.logotipo').each(function() {
		palavras = $(this).text().split(' ').length;
		if(palavras>1){
			var html = $(this).html();
			var word = html .substr(0, html.indexOf(" "));
			var rest = html .substr(html.indexOf(" "));
			$(this).html(rest).prepend($("<span/>").html(word).addClass("em"));
		}
	});
	
	//
	function vaiPara(hash){
		if(!hash)hash='home';
		if(hash!='#'){
			$('html, body').animate({
				scrollTop: $('#conteudo').offset().top
			}, 2000);
			$('.dropdown').removeClass('open');
			$('#conteudo .cms-conteudo').html('<h1 class="text-center sozinho"><img src="img/ajax-loader.gif" /></h1>');
			$.ajax({
				url:base_url+'ajax/'+hash,
				dataType:'html',
				success:function(data){
					$('#conteudo .cms-conteudo').html(data);
				},
				error:function(){
					$('#conteudo .cms-conteudo').html('<h1 class="text-center sozinho">Página não encontrada</h1>');
				}
			});
		}
	}
});
