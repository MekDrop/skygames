<script>

	function enterDateToggle()
	{
		
		var mon = document.getElementById("MatchDateMonth");		
		var yr = document.getElementById("MatchDateYear");
		var day = document.getElementById("MatchDateDay");
		var hr = document.getElementById("MatchDateHour");
		var min = document.getElementById("MatchDateMin");
		
		
		var known = document.getElementById("MatchDateIsKnown");		
		var submitButton = document.getElementById("MatchSubmit");
		
		
		if (!known.checked)
		{
			
			mon.disabled = true;
			yr.disabled = true;	
			day.disabled = true;
			hr.disabled = true;		
			min.disabled = true;
				
		}
		else
		{			
		
			mon.disabled = false;
			yr.disabled = false;	
			day.disabled = false;
			hr.disabled = false;		
			min.disabled = false;
			
		}
		
	}
	
	function checkPlayofftable(pt)
	{
		var tx = document.getElementById("MatchTpositionX");
		var ty = document.getElementById("MatchTpositionY");		
		
		if (pt.value == "")
		{		
			tx.disabled = true;		
			ty.disabled = true;
		}
		else
		{
			tx.disabled = false;		
			ty.disabled = false;					
		}
				
	}
		
</script>

<div class="matche view">
	<div class="matche form">
		<div class="caption">
			<?php __('Edit match');?>
		</div>
		<br/>
		<?php
			$monthNames = array(
				"1"=>__("",true),
				"2"=>__("",true),
				"3"=>__("",true),
				"4"=>__("",true),
				"5"=>__("",true),
				"6"=>__("",true),
				"7"=>__("",true),
				"8"=>__("",true),
				"9"=>__("",true),
				"10"=>__("",true),
				"11"=>__("",true),
				"12"=>__("",true),
			);
		?>		
		
		<?php echo $form->create('Match', array('action' => 'add'));?>
		<?php
			echo $form->label(__('Date',true));
			
			if (isset($this->data['Match']['date']))
				echo $form->checkbox('date_is_known', array("checked"=>"true","onchange"=>"enterDateToggle();", "div" => false));
			else
		  		echo $form->checkbox('date_is_known', array("checked"=>"false","onchange"=>"enterDateToggle();", "div" => false));  
					
			echo $form->dateTime('date', "YMD", "24", $this->data['Match']['date'], $monthNames, false);
			//echo $form->input('id');
			echo $form->input('team1_id');
			echo $form->input('team2_id');
			echo $form->input('event_id', array ('type' => 'hidden', 'value' => $event_id));			
			echo $form->label('playofftable_id');
			echo $form->select(__('playofftable_id', true), $playofftables, null, array("onchange"=>"checkPlayofftable(this);"), true);
			echo $form->input('tposition_x');
			echo $form->input('tposition_y');
			echo $form->label('grouptable_id');			
			echo $form->select(__('grouptable_id', true), $grouptables, null, array(), true);						 
			
		?>
		<br/>
		<br/>
		
		<?php echo $form->button(__('Submit', true), array('onClick' => "getElementById('MatchAddForm').submit();"));?>
		
		<?php echo $form->end();?>
		
	</div>
	
	
	<br/>
	<br/>
	<br/>
	<br/>	
	<div align="center">
		<?php echo $html->link(__('Close this window', true), 'javascript:window.close();')?>
	</div>
</div>	


<script>
	enterDateToggle();
	
	checkPlayofftable(document.getElementById('MatchPlayofftableId'));
</script>