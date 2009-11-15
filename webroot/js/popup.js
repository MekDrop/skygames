



function openWindow(url, title)
{
   window.open(url, title, 'width=600, height=400, menubar=no, status=yes, location=no, toolbar=no, scrollbars=yes');
}


function closeWindow()
{
   window.close();
   afterEdit();
   opener.focus();
}

function shutWindow()
{
	closeWindow();
}

function afterEdit()
{
  if (opener.refresh)
  	opener.refresh();
  
}