<!DOCTYPE html>
<HTML>
	<HEAD>
		<TITLE>CXO Test Driven Development Workshop console</TITLE>
	</HEAD>
	<LINK rel="stylesheet" href="css/main.css" />
	<SCRIPT type="text/javascript" src="js/jquery-1.7.1.min.js"></SCRIPT>
	<SCRIPT type="text/javascript" src="js/app.js"></SCRIPT>
	<BODY>
		<H1><span>TDD Liveticker</span></H1>
		<div class="new-entry">
			<b>Neuen Eintrag schreiben:</b><br />
			<form action="api.php" method="post">
				<textarea name="new-msg"></textarea>
				Posten als:
				<select name="userid"></select> <span class="new-user">[+]</span><br />
				<input type="submit" value="Posten" />
			</form>
		</div>
		<div class="new-user">
			<b>Neuen Benutzer anlegen</b>
			<form action="api.php" method="post">
				Name: <input type="text" name="new-user-name" /> <br />
				Passwort: <input type="password" name="new-user-password" /><br />
				<input type="submit" value="Anlegen" />
			</form>
		</div>
		<DIV class="newsticker"></DIV>
	</BODY>
</HTML>
