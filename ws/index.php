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
				<input type="submit" value="Posten" />
			</form>
		</div>
		<DIV class="newsticker"></DIV>
	</BODY>
</HTML>
