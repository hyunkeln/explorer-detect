<?php
	function explorerDetect(){
		$browser = array();
		$browser["os"]="Windows";
		$browser["os_version"]="6.2";
		$browser["name"]="Explorer";
		$browser["version"]="10";
		preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $explorer);
		preg_match('/Windows NT (.*?);/', $_SERVER['HTTP_USER_AGENT'], $windows);
		if (count($windows)>1){
		  if(count($explorer)>1) {
		  	$browser["version"]=$explorer[1];
		  	$browser["os_version"]=$windows[1];
		  }
		  else $browser["name"]="other";
		}else $browser["os"]="other";
		print_r($browser);
		return $browser;
	}
	
	function insertHitslink(){ 
	?>
		<!-- HitsLink.com tracking script -->
		<script type="text/javascript" id="wa_u" defer></script>
		<script type="text/javascript" async>//<![CDATA[
		var wa_pageName=location.pathname;    // customize the page name here;
		wa_account="ADBBCDCFCECE"; wa_location=102;
		wa_MultivariateKey = '';    //  Set this variable to perform multivariate testing
		var wa_c=new RegExp('__wa_v=([^;]+)').exec(document.cookie),wa_tz=new Date(),
		wa_rf=document.referrer,wa_sr=location.search,wa_hp='http'+(location.protocol=='https:'?'s':'');
		if(top!==self){wa_rf=top.document.referrer;wa_sr=top.location.search}
		if(wa_c!=null){wa_c=wa_c[1]}else{wa_c=wa_tz.getTime();
		document.cookie='__wa_v='+wa_c+';path=/;expires=1/1/'+(wa_tz.getUTCFullYear()+2);}wa_img=new Image();
		wa_img.src=wa_hp+'://counter.hitslink.com/statistics.asp?v=1&s=102&eacct='+wa_account+'&an='+
		escape(navigator.appName)+'&sr='+escape(wa_sr)+'&rf='+escape(wa_rf)+'&mvk='+escape(wa_MultivariateKey)+
		'&sl='+escape(navigator.systemLanguage)+'&l='+escape(navigator.language)+
		'&pf='+escape(navigator.platform)+'&pg='+escape(wa_pageName)+'&cd='+screen.colorDepth+'&rs='+escape(screen.width+
		' x '+screen.height)+'&je='+navigator.javaEnabled()+'&c='+wa_c+'&tks='+wa_tz.getTime()
		;document.getElementById('wa_u').src=wa_hp+'://counter.hitslink.com/track.js';//]]>
		</script>	
	<?php
	}
	
	$link = "<a href='http://www.todoexplorer.com'  target='_blank'>Descargar</a>";
	$imagenTrackConIE="<img height='1' width='1' src='http://view.atdmt.com/action/Galerias_ConIE'/>";
	$imagenTrackSinIE="<img height='1' width='1' src='http://view.atdmt.com/action/Galerias_SinIE'/>";
	$detected = explorerDetect();
	if($detected["os"]!="Windows"){
		echo "Usa tu compu con windows para ver este contenido $imagenTrackSinIE"; //No es windows
	}else{
		if($detected["name"]!="Explorer"){
			echo "Descarga Internet Explorer para ver este sitio. $link $imagenTrackSinIE";	//Es windows pero no es explorer
		}else{
			if($detected["os_version"]<=5.2 && $detected["version"]<8) echo "Actualízate a Internet Explorer 8: $link $imagenTrackConIE";  //Es windows xp con explorer antiguo.
			else if($detected["version"]<10) echo "Actualízate a Internet Explorer 10 $link $imagenTrackConIE";  //Es windows reciente sin explorer nuevo
			else echo "Puedes ver este contenido $imagenTrackConIE";  //Es windows reciente con navegador nuevo o windows xp con explorer 8
			insertHitslink();
		}
	}
	
?>