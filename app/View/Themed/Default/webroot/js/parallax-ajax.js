$(window).load(function() {
	$(".fancy").fancybox();
	$.stellar({
	  horizontalScrolling: false,
	  positionProperty: 'transform'
	});
	$.history.on('load change push', function(event, url, type) {
		vaiPara(url);
	}).listen('hash');
	$("body").on('click','a',function(event) {
		if(!$(this).hasClass('fancy')){
			if(!$(this).hasClass('no-ajax')){
				var url = $(this).attr('href');
				vaiPara(url);
				$.history.push(url);
				return false;
			}
		}
	});
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
	function vaiPara(hash){
		if(!hash)hash='home';
		
		$('html, body').bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
		if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
			$('html, body').stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
		}
		});
		
		$('html, body').animate({
			scrollTop: $('#conteudo').offset().top
		},{'duration':5000,'easing':'easeOutQuint'});
		
		$('.dropdown').removeClass('open');
		$('#conteudo .conteudo').html('<h1 class="text-center sozinho"><img src="'+base_url+'theme/default/img/ajax-loader.gif" /></h1>');
		$.ajax({
			url:hash,
			dataType:'html',
			success:function(data){
				$('#conteudo .conteudo').html(data);
				$(".fancy").fancybox();
			},
			error:function(){
				$('#conteudo .conteudo').html('<h1 class="text-center sozinho">Página não encontrada</h1>');
			}
		});
	}
});