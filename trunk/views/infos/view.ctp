<div class="infos view">
<table cellpadding="5" cellspacing="0" class="list">
	
		<tr>		
			<td colspan="1">
				<div>
                    <table border="0"  cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2">
								<?php echo $info['Info']['body']; ?>
                                                                                                                                                  
                            </td>
                        </tr>
                        <tr>
                          <td style='width:100%'>
                                           
                          </td>
                          <td style='text-align: right;width:100%'>
								<br/>                              
								<table cellspacing="0" cellpadding="0" style='text-align: right;background: #e7e7e7;'>
									<tr>
										<td style="vertical-align: middle;">
											<?php __('By');?>:
										</td>
										<td style="vertical-align: middle;">
											<?php echo $html->image('/img/orgs/member.png') ?>
										</td>
										<td style="vertical-align: middle;">
											<?php echo $html->link($info['User']['username'], array('controller'=>'users','action'=>'view',  $info['User']['id'])); ?>
										</td>																
									</tr>
								
								</table>
							<td>
						</tr>
					</table>                                                   
				</div>
			</td>

		</tr>
			
				
	</table>
</div>
<br/>
<br/>

<?php echo $this->renderElement('comments', array('cache'=>false, 'controller' => 'Infocomment', 'action' => 'add', 'commentsModel' => 'Infocomment', 'commentParentName' => 'info_id', 'commentParentValue' => $info['Info']['id']));?>
