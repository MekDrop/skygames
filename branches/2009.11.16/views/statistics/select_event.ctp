<?php

	echo "<option ".($selected == $k ? "selected='-5'" : "")." value='-5'>". __('All',true) ." 5on5</option>";
	echo "<option ".($selected == $k ? "selected='-2'" : "")." value='-2'>". __('All',true) ." 2on2</option>";
		
	if(!empty($events)) {
		
	  foreach($events as $k => $v) {
	
	    echo "<option ".($selected == $k ? "selected='1'" : "")." value='".$k."'>".$v."</option>";
	
	  }
	
	}
	


?>
