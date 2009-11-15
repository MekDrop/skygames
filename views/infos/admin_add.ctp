<?php 
if(isset($javascript)):    
    echo $javascript->link('tiny_mce/tiny_mce.js');    
endif;
?> 
<div class="infos index">
<script type="text/javascript">
    tinyMCE.init({
		theme : "advanced",
	  	mode : "textareas",
      	plugins : "advimage,simplebrowser",
      	convert_urls : false,      	
      	plugin_simplebrowser_width : '640', //default
      	plugin_simplebrowser_height : '480', //default
      	plugin_simplebrowser_browselinkurl : 'http://skygames.localhost/js/tiny_mce/plugins/simplebrowser/browser.html?Connector=connectors/php/connector.php',
      	plugin_simplebrowser_browseimageurl : 'http://skygames.localhost/js/tiny_mce/plugins/simplebrowser/browser.html?Type=Image&Connector=connectors/php/connector.php',
      	plugin_simplebrowser_browseflashurl : 'http://skygames.localhost/js/tiny_mce/plugins/simplebrowser/browser.html?Type=Flash&Connector=connectors/php/connector.php'        
    });
</script> 
<div class="infos form">
<?php echo $form->create('Info');?>
	<fieldset>
 		<legend><?php __('Add Info');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('desc');
		echo $form->input('body', array('rows'=>'15'));		
		echo $form->input('infocat_id');
		echo $form->input('lang_id');
		echo $form->input('game_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Infos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infocats', true), array('controller'=> 'infocats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Infocat', true), array('controller'=> 'infocats', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infocomments', true), array('controller'=> 'infocomments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Infocomment', true), array('controller'=> 'infocomments', 'action'=>'add')); ?> </li>
	</ul>
</div>
