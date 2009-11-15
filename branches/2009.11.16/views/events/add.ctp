
<script>
	function createTableToggle()
	{
		var createTableCB = document.getElementById("EventCreatePtable");
		var initMatchesCB = document.getElementById("EventGenmatches");
		var radio1 = document.getElementById("EventTableTypeD");
		var radio2 = document.getElementById("EventTableTypeS");
		var select1 = document.getElementById("EventTableTheme");
		if (createTableCB.checked)
		{
			radio2.checked = true;
			initMatchesCB.checked = true;
			initMatchesCB.value = 1;
			initMatchesCB.disabled = false;	
			radio1.disabled = false;
			radio2.disabled = false;	
			select1.disabled = false;	
		}
		else
		{			
			radio2.checked = false;
			initMatchesCB.checked = false;
			initMatchesCB.value = 0;
			initMatchesCB.disabled = true;
			radio1.disabled = true;
			radio2.disabled = true;	
			select1.disabled = true;			
		}
	}	
	
	function toggleStartDate()
	{
		var mon = document.getElementById("EventStartdateMonth");		
		var yr = document.getElementById("EventStartdateYear");
		var day = document.getElementById("EventStartdateDay");
		var hr = document.getElementById("EventStartdateHour");
		var min = document.getElementById("EventStartdateMin");
		
		
		var startUnknown = document.getElementById("EventStartIsUnknown");				
		
		
		if (startUnknown.checked)
		{
			startUnknown.value = "1";
			mon.disabled = true;
			yr.disabled = true;	
			day.disabled = true;
			hr.disabled = true;		
			min.disabled = true;
			

			mon.value = "";
			yr.value = "";	
			day.value = "";
			hr.value = "";		
			min.value = "";			
		}
		else
		{			
			startUnknown.value = "0";
			mon.disabled = false;
			yr.disabled = false;	
			day.disabled = false;
			hr.disabled = false;		
			min.disabled = false;
		
		}
	}
	
	function limitTabloThemes(tableSize)
	{
		//var themeControl = document.getElementById("EventTableTheme");
		//var tableTypeS = document.getElementById("EventTableTypeS");				
				
		//if (tableSize.value == '4' || (tableSize.value == '8' && tableTypeS.checked))
		//{				
		//	themeControl.options[0].value = themeControl.options[0].text = "cs8" 			  			
		//	themeControl.options[1].value = themeControl.options[1].text = "skygames8";			
		//	if (!themeControl.options[2])
		//		themeControl.add(document.createElement('option'), null);
		//	themeControl.options[2].value = themeControl.options[2].text = "nga8";
		//}
			
		//else
		//{
		//	themeControl.options[0].value = themeControl.options[0].text = "cs16" 			  			
		//	themeControl.options[1].value = themeControl.options[1].text = "skygames16";
		//	themeControl.remove(2);
		//}
		
		
	}
	
	function limitEventSize(tableRadio)
	{
		var eventControl = document.getElementById("EventTeamcount");
						
		if (tableRadio.value == 'D')
		{	
			if (eventControl.options[eventControl.length -1].selected)
			{
				 eventControl.options[eventControl.length -1].selected = false;
	 			 eventControl.options[eventControl.length -2].selected = true;				 
			}
			eventControl.options[eventControl.length -1].disabled = true;
		}
		else
			eventControl.options[eventControl.length -1].disabled = false;
			
		limitTabloThemes(eventControl);
	}
</script>

<div class="view">
<table class="contentpaneopen">
	<tr>
		<td valign="top">
		<div class="events form"><?php echo $form->create('Event');?> <?php
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
			
		$orgSelect = array();
		foreach ($orgs as $key => $org)
		{
			$i = 0;
			$orgSelect[$org['Org']['id']] = $org['Org']['name'];
		}

		echo $form->input('game_id');

		echo $form->label(__('Title', true));
		echo $form->input('name', array('label' => false));
		
		echo $form->label('Event.org_id', __('Organization', true));
		echo $form->select('org_id', $orgSelect, array('class' => 'ivestis'), array(), false);		

		echo $form->label('Event.teamcount', __('Team count', true));
		echo $form->select('teamcount', array("4"=>"4","6"=>"6","8"=>"8","10"=>"10","12"=>"12","14"=>"14","16"=>"16","32"=>"32"), array('class' => 'ivestis'), array('onchange' => 'limitTabloThemes(this)'), false);

		echo $form->label('Event.teamsize', __('Team type', true));
		echo $form->select('teamsize', array("1"=>"1on1","2"=>"2on2","5"=>"5on5"), array('class' => 'ivestis'), array(), false);
		
		echo $form->input('eventtype_id');

		echo $form->label('Event.starttype', __('Cup starts when enough teams approved', true));
		echo $form->checkbox('start_is_unknown', array("value"=>"0","checked"=>"false","onchange"=>"toggleStartDate();", 'label'=>'a'));

		echo $form->label('Event.startdate', __('Cup start date', true));
		echo $form->datetime('startdate', "YMD", "24", "", array("monthNames"=>array("1"=>"",)), false);		
		
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";		

		echo $form->label('Event.create_ptable', __('Create Playoff table', true));

		echo $form->checkbox('create_ptable', array("value"=>"1","checked"=>"true","onchange"=>"createTableToggle();"));
		echo $form->radio('table_type', array("S"=>__("Single Elimination", true),"D"=>__("Double Elimination", true)), array('label'=>'','value'=>'S', 'onchange' => 'limitEventSize(this);'));

		echo $form->label('Event.table_theme', __('Playoff table theme', true));
		echo $form->select('table_theme', array("cs8"=>"cs8","ut8"=>"ut8","skygames8"=>"skygames8"), array('class' => 'ivestis'), array(), false);

		echo $form->label('Event.gen_init_matches', __('Generate matches in playoff table', true));
		echo $form->checkbox('genmatches', array("value"=>"1","checked"=>"true"));
		
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";	
		
		echo $form->label('Event.groups', __('Group count', true));
		echo $form->select('groups', array("0"=>"0","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6",
													"7"=>"7","8"=>"8"), null, array(), false);
		
		echo $form->label('Event.qualifycount', __('Qualify count', true));
		echo $form->select('qualifycount', array("0"=>"0","1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6",
													"7"=>"7","8"=>"8"), null, array(), false);
		
		echo $form->label('Event.gengroups', __('Generate matches in groups', true));
		echo $form->checkbox('gengroups', array("value"=>"1","checked"=>"true"));
		

		?> <br />
		<br />
		<?php echo $form->end(strtoupper(__('Submit', true)));?></div>
		</td>
	</tr>
</table>
</div>
<script>

	var tc = document.getElementById("EventTeamcount");
	tc.options[2].selected = true;
	document.getElementById("EventTableTypeS").checked = true;
	toggleStartDate();
</script>
