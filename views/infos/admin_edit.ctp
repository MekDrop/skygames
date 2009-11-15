<?php
if(isset($javascript)):
echo $javascript->link('tiny_mce/tiny_mce.js');
endif;
?>
<div class="infos index"><script type="text/javascript">
    tinyMCE.init({
		theme : "advanced",
	  	mode : "textareas",
      	plugins : "advimage,simplebrowser",
      	convert_urls : false,
      	plugin_simplebrowser_width : '640', //default
      	plugin_simplebrowser_height : '480', //default
      	plugin_simplebrowser_browselinkurl : '/js/tiny_mce/plugins/simplebrowser/browser.html?Connector=connectors/php/connector.php',
      	plugin_simplebrowser_browseimageurl : '/js/tiny_mce/plugins/simplebrowser/browser.html?Type=Image&Connector=connectors/php/connector.php',
      	plugin_simplebrowser_browseflashurl : '/js/tiny_mce/plugins/simplebrowser/browser.html?Type=Flash&Connector=connectors/php/connector.php'        
    });
</script>
<div class="infos form"><?php echo $form->create('Info');?>
<fieldset><legend><?php __('Edit Info');?></legend> <?php
echo $form->input('id');
echo $form->input('title');
echo $form->input('desc');
echo $form->input('body', array('rows'=>'15'));
echo $form->input('infocat_id');
echo $form->input('lang_id');
echo $form->input('game_id');
?></fieldset>
<?php echo $form->end('Submit');?></div>