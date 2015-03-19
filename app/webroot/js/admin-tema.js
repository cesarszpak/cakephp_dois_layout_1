$(document).ready(function(){
	$('.table-ajax').dataTable();
	$('.ttip').tooltip();
	$('.tabs a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})
	$('body').on('click','a.confirm',function(){
		if(confirm('Tem certeza que quer continuar?')){
			window.location.href=$(this).attr('href');
		}
		return false;
	});
	
	if($("*[data-intro]").length){
		$('#alert-login-ajuda').delay(2000).animate({'opacity':'1'},'slow',function(){
			$('#alert-login-ajuda').delay(5000).animate({'opacity':'0'},'slow',function(){
				$('#alert-login-ajuda').remove();
			});
		});
                $('#alert-login-ajuda').click(function(){
                    $('#alert-login-ajuda').remove();
                });
	}else{
		$('#btn-ajuda').parent().remove();
	}
        
        $('.table-acl a.cursor-arrow').click(function(){
            return false;
        });
});