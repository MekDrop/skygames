<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>SkyGames</title>
    <?php
		echo $html->charset();	
		echo $html->css('skygames');
		//if ($css_for_layout)
		//	echo $html->css($css_for_layout, true);	
		echo $scripts_for_layout;
	?>
</head>
<body>

<table align="center" cellspacing="0" cellpadding="0" class="mainonbg" style="vertical-align:top">
<tr>
<td style="width:10px;height:100%;vertical-align:top;background-image:url('/img/bgleft.jpg');">
</td>

<td class="main" style="vertical-align:top">


    <table align="center" cellspacing="0" cellpadding="0" class="main" style="vertical-align:top">
        <tr>
            <td class="zydra">
            </td>
            <td class="baltabalta" style="vertical-align:top">
                <table align="center" cellspacing="0" cellpadding="0" class="vatop">
                    <tr>
                        <td class="headbaneris" style="text-align:right;vertical-align:top">
                        	<span class="list">
                        	<?php echo $html->link('LT', '/lang/lit', null, null, false); ?>		
							<?php echo $html->link('EN', '/lang/eng', null, null, false); ?>
							</span>		
							&nbsp;&nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td class="meniubg">
                            <?php echo $this->renderElement('menu', array('cache'=>'1 day'));?>
                        </td>
                    </tr>
                    <tr>
                        <td class="dupxheight">
                        </td>
                    </tr>
                    <tr>
                        <td class="devynivienasvienas">
                            <table align="left" cellspacing="0" cellpadding="0" style="vertical-align: top;">
                                <tr>
                                    <td style="width: 5px">
                                    </td>
                                    <td style="width: 700px;vertical-align: top;">
                                        <table align="left" cellspacing="0" cellpadding="0" style="width: 697px; vertical-align: top;
                                            text-align: center;">
                                            <tr>
                                                <td style="width: 700px; height: 160px;">
                                                    <?php echo $this->renderElement('preview', array('cache'=>'1 hour'));?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 2px;">
                                                		<?php
															if ($session->check('Message.flash')):
																	$session->flash();
															endif;
														?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 697px; vertical-align: top; text-align: center;">
                                                	<?php if (!$content_full_fill): ?>
                                                		<?php 
                                                			if (!$content_helpers) $size = '697';
                                                				else $size = '481';
                                                		?>
	                                                	<table align="left" cellspacing="0" cellpadding="0" style="width: 697px;">
	                                                		<tr>
		                                                       <td style="vertical-align: top;">
			                                                    <table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;
			                                                        text-align: center;">
			                                                        <tr>
			                                                            <td style="background-image: url('/img/didelelentelevirsus<?php echo $size;?>.jpg'); width: <?php echo $size;?>; height: 35px;
			                                                                vertical-align: middle; text-align: left;">
			                                                                &nbsp;&nbsp;&nbsp;<font style="font-family: tahoma; font-size: 11px; color: #616464;">
			                                                                <?php echo $title_for_content; ?>
			                                                                </font>
			                                                            </td>
			                                                        </tr>
			                                                    
			                                                        <tr>
			                                                            <td style="width: <?php echo $size;?>px;">
			                                                                <table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;
			                                                                    text-align: left;">
			                                                                    <tr>
			                                                                        <td style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
			                                                                        </td>
			                                                                        <td style="width: <?php echo ($size - 14);?>px;">
			                                                                           <?php echo $content_for_layout;?>
			                                                                        </td>
			                                                                        <td style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
			                                                                        </td>
			                                                                    </tr>
			                                                                </table>
			                                                            </td>
			                                                        </tr>
			                                                        <tr>
			                                                            <td style="background-image: url('/img/didelelenteleapacia<?php echo $size;?>.jpg'); width: <?php echo $size;?>px; height: 19px;">
			                                                            </td>
			                                                        </tr>
			                                                    </table>	
	                                                    	
	                                                            </td>
	                                                        
		                                                       	<td style="vertical-align: top;">
		                                                       	  <table cellspacing="0" cellpadding="0">

			                                                       <?php if (!empty($content_helpers)):?>
			                                                       		<?php foreach($content_helpers as $helper): ?>
				                                                       	  <tr>
				                                                       	   <td>			                                                       		
			                                                       				<?php if (isset($helper['cachetime']) && $helper['cachetime']) 
			                                                       						echo $this->renderElement($helper['name'], $helper['cachetime']);
			                                                       					  else
			                                                       					  	echo $this->renderElement($helper['name'], array('cache' => '1 hour'));
			                                                       				?>
					                                                       </td>
					                                                      </tr> 			
			                                                       		<?php endforeach; ?>
			                                                       <?php endif; ?>
			                                                      
		                                                       	</table>
		                                                       </td>
	                                                        </tr>
	                                                    </table>	                                                		                                            	
	                                            	<?php else: ?>
	                                            		
	                                            		<?php echo $content_for_layout;?>
	                                            	
	                                            	<?php endif;?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 7px;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 201px; vertical-align: top; text-align: center;">
                                        <table align="left" cellspacing="0" cellpadding="0" style="width: 201px; vertical-align: top;
                                           ">
                                            <tr>
                                                <td style="width: 195px; height: 160px; text-align: left; vertical-align: top;">
                                                    <table align="left" cellspacing="0" cellpadding="0" style="width: 195px; vertical-align: top;
                                                        ">
                                                        <tr>
                                                            <td style="background-image: url('/img/mazalentelevirsus.jpg'); width: 195px; height: 35px;
                                                                vertical-align: middle; text-align: center;">
                                                                <font style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #616464;">
                                                                    <?php echo strtoupper(__("For users")); ?></font>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 195px; vertical-align: top;">
                                                                <table align="left" cellspacing="0" cellpadding="0" style="width: 195px; height: 112px;
                                                                    vertical-align: top;">
                                                                    <tr>
                                                                        <td style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
                                                                        </td>
                                                                        <td style="width: 181px; vertical-align: top;">
                                                                        	<?php echo $this->renderElement('loginbox');?> 
                                                                        </td>
                                                                        <td style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
                                                                        </td>
                                                                                                                                                  
                                                                        </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-image: url('/img/mazalenteleapacia.jpg'); width: 195px; height: 13px;
                                                                vertical-align: middle; text-align: left;">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 195px; text-align: center; vertical-align: top;">
                                                    <a href="mailto:a@a.lt">
                                                        <img src="/img/tba.jpg" alt="tba"></a>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td style="width: 195px; text-align: center; vertical-align: top;">
                                                    <a href="http://www.skynet.lt">
                                                        <img src="/img/sponsors/sky.jpg" alt="tba"/></a>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td style="width: 195px; text-align: center; height: 15px; vertical-align: top;">
                                                
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 195px; text-align: center; vertical-align: top;">
                                                    <a href="http://www.steelseries.com">
                                                        <img src="/img/sponsors/ss.gif"/></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 5px">
                                    </td>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 20px; width: 911px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 7px; width: 911px; background-color: #a5c3d1;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 77px; width: 911px; text-align: center; vertical-align: middle;">
                            <?php __('copyright'); ?></td>
                    </tr>
                </table>
            </td>
            <td style="width: 7px; height: 100%; background-color: #a5c3d1;">
            </td>
        </tr>
    </table>
    
</td>
<td style="width:10px;height:100%;background-image:url('/img/bgright.jpg');">
</td>
</tr>
</table>


</body>
</html>