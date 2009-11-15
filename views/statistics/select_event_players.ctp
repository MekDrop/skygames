<?php
	echo "<option  value=''>". __('All',true) ."</option>";

	if(!empty($events)) {
		
	  foreach($events as $k => $v) {
	
	    echo "<option ".($selected == $k ? "selected='1'" : "")." value='".$k."'>".$v."</option>";
	
	  }
	
	}
?>
