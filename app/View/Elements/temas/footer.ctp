<?php
	echo $this->fetch('script');
	if(preg_match('/<script[^>]*?>([\s\S]*?)<\/script>/',$configs['rastreio'],$rastreio)){
		$rastreio=$rastreio[1];
		echo $this->Html->scriptBlock($rastreio);
	}
