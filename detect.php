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
		return $browser;
	}
	$link = "<a href='http://www.todoexplorer.com'  target='_blank'>Descargar</a>";
	$imagenTrackConIE="<img height='1' width='1' src='http://view.atdmt.com/action/Galerias_ConIE'/>";
	$imagenTrackSinIE="<img height='1' width='1' src='http://view.atdmt.com/action/Galerias_SinIE'/>";
	$detected = explorerDetect();
	if($detected["os"]!="Windows"){
		echo "Usa tu compu con windows para ver este contenido $imagenTrackSinIE"; //No es windows
	}else{
		if($browser["name"]!="Explorer"){
			echo "Descarga Internet Explorer para ver este sitio. $link $imagenTrackSinIE";	//Es windows pero no es explorer
		}else{
			if($detected["os_version"]<=5.2 && $detected["version"]<8) echo "Actualízate a Internet Explorer 8: $link $imagenTrackConIE";  //Es windows xp con explorer antiguo.
			else if($detected["version"]<10) echo "Actualízate a Internet Explorer 10 $link $imagenTrackConIE";  //Es windows reciente sin explorer nuevo
			else echo "Puedes ver este contenido $imagenTrackConIE";  //Es windows reciente con navegador nuevo o windows xp con explorer 8
		}
	}
	
?>