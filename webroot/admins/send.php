<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>SkyGames.LT - Adminų atrankos forma</title>
</head>

<body>

<center>
<form action="send.php" method="POST">
<table border="0" cellspacing="0" width="405" height="373" bordercolordark="black" bordercolorlight="black" >
  <tr>
    <td height="371" valign="top">
    <p align="center"><img src="333.PNG" width="225" height="226">
    
    <table border="0" cellspacing="0" width="474" height="200" bordercolordark="black" bordercolorlight="black" >
    <tr>
        <td>
            <p align="center">
<font size=4 face=Verdana>
<b>Anketa sėkmingai užpildyta.</b></font><font size=5 face=Verdana><br>
<br>
            </font>
<font size=5 face=Verdana color=#FFFFFF>
            <p><input TYPE="button" VALUE="Uzdaryti langa" onClick="window.close()"></p>
          </font>
<font size=5 face=Verdana color=#FFFFFF>
            <input TYPE="button" VALUE="Gryzti" onClick="history.back(-1)"></font><p align="center">2008<span lang="lt"> </span>&copy;<span lang="lt"> </span><strong> <span lang="lt"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sky<font color="#2D7EE7">Games</font>.LT</font></span></strong>
        </table>
</center>
</html>
<?
$fp= fopen("cv.txt", 'a+');
fwrite($fp, "Slapyvardis: ".$_POST['name']."\n Amžius: ".$_POST['2']."\n Kur dare gather žaidimus: ".$_POST['3']."\n Kiek laiko žaidžiate Counter-Strike: ".$_POST['4']."\n Kaip vertinate SkyGames kolektyvą: ".$_POST['5']."\n Ką norėtumėte pakeisti projekte, pasiūlyti: ".$_POST['6']."\n Komentaras: ".$_POST['7']."\n Susipažino? ".$_POST['8']."\n"  );
?></font></span></b></p>
    </td>
  </tr>
</table>
</center>
</td><br>
    <br>
    <br>
    <br>
    &nbsp;</p>
    </td>
  </tr>
</table>
</center>

</body>

</html>