<?php

// Make sure we're in YOURLS context
if( !defined( 'YOURLS_ABSPATH' ) ) {
	// Attempt to guess URL via YOURLS
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace( array( '/pages/', '.php' ) , array ( '/', '' ), $_SERVER['REQUEST_URI'] );
	echo "Try this instead: <a href='$url'>$url</a>";
	die();
}

// Display page content. Any PHP, HTML and YOURLS function can go here.
$url = YOURLS_SITE . '/specs';

yourls_html_head( 'specs', 'Technische Details zur laufenden YOURLS-Installation' );
yourls_html_logo();

?>
<div class="main-column">
	<div class="panel panel-teaser">
		<div class="panel-header">
			<h1>Der Kurz-URL-Dienst an der Goethe-Universität</h1>
			<p>Technische Details</p>
		</div>
		<div class="panel-body">
			Diese Seite ist zur schnellen Übersicht über die technischen Hintergründe, wo diese
			Installation derzeit läuft und welcher Datenbestand genutzt wird. Damit soll auch die
			gemeinsame Entwicklung des KurzURL-Dienstes über Github gestärkt werden.
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-box"><div class="panel-body">
				<h3><i class="fa fa-linux"></i> Basics</h3>
				<p>Folgende Informationen geben Aufschluss, <em>auf welchem Server</em>
				dieser Dienst derzeit läuft. Dies ist wichtig, da er auf mehreren Maschinen
				installiert ist.</p>

				<dl>
					<dt>Hostname</dt>
					<dd><?php echo gethostname(); ?></dd>

					<dt>HTTP-Hostname (vom Client)</dt>
					<dd><?php echo $_SERVER['HTTP_HOST']; ?></dd>

					<dt>Servername (vom Webserver)</dt>
					<dd><?php echo $_SERVER['SERVER_NAME']; ?></dd>

					<dt>Webserver-Software</dt>
					<dd><?php echo $_SERVER['SERVER_SOFTWARE']; ?></dd>

					<dt>Username des Prozesses</dt>
					<dd><?php echo get_current_user(); ?></dd>
				</dl>
			</div></div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-box"><div class="panel-body">
				<h3><i class="fa fa-database"></i> Datenbestand</h3>
				<p>Folgende Informationen geben darüber Aufschluss, auf welche Daten
				YOURLS derzeit zugreift. Da alle Daten in einer MySQL-Datenbank gespeichert sind,
				ist diese Information ausreichend zur Identifikation. Es ist problemlos
				möglich, dass mehrere (identische) YOURLS-Instanzen auf mehrern Servern auf den gleichen
				Datenbestand zugreifen.
				</p>

				<dl>
					<dt>MySQL-Server</dt>
					<dd><?php echo constant('YOURLS_DB_HOST'); ?></dd>

					<dt>MySQL-Datenbank</dt>
					<dd><?php echo constant('YOURLS_DB_NAME'); ?></dd>

					<?php $stats = yourls_get_db_stats(); ?>
					<dt>Anzahl gespeicherter Kurz-URLs</dt>
					<dd><?php echo $stats['total_links']; ?></dd>

					<dt>Anzahl aller Klicks</dt>
					<dd><?php echo $stats['total_clicks']; ?></dd>
				</dl>
			</div></div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-box"><div class="panel-body">
				<h3><i class="fa fa-code-fork"></i> Code</h3>
				<p>Folgende Informationen sind eine erste Näherung, welche Codeversion
				gerade läuft.</p>

				<dl>
					<dt>Aktueller HEAD-Commit</dt>
					<dd style="font-family:monospace; overflow-x: scroll">
						<?php $head = shell_exec('git rev-parse --verify HEAD 2>&1');
						echo "<a href='https://github.com/PhysikOnline-FFM/gu-urlshorter/commit/$head'>$head</a>"; ?></dd>

					<dt>Aktueller Branch</dt>
					<dd style="font-family:monospace; white-space: pre"><?php
						echo shell_exec('git branch 2>&1'); ?></dd>

					<dt>Git-Status</dt>
					<dd style="font-family:monospace; white-space: pre; overflow-x: scroll"><?php
						echo shell_exec('git status --untracked-files=no'); ?></dd>
				</dl>
			</div></div>
		</div>
	</div>
</div>
<div class="sidebar-column">

	<div class="panel panel-sidebar">
		<h2>Mitmachen</h2>
		<div class="panel-body">
			<span class="caret"></span>

			<p>Der Goethe-Universität URL-Shortener ist eine typische PHP/MySQL-Anwendung
			auf Basis von <a href="http://www.yourls.org">YOURLS</a>. Der Quelltext ist
			auf Github öffentlich zugänglich im Projekt <a href="https://github.com/PhysikOnline-FFM/gu-urlshorter/">PhysikOnline-FFM/gu-urlshorter</a>.
			Dort werden auch Fragen beantwortet

			<div style="background-color: white;">
				<a href="https://github.com/PhysikOnline-FFM/gu-urlshorter/"><img src="https://octodex.github.com/images/socialite.jpg" style="width:60%;" class="img-responsive center-block"></a>
			</div>
		</div>
	</div>

	<div class="panel panel-sidebar">
		<h2>Feedback/Probleme berichten</h2>
		<div class="panel-body">
			<span class="caret"></span>

			<p>Probleme zum Goethe Universität-URL-Shortener werden ebenfalls auf Github
			bearbeitet, und zwar als <a href="https://github.com/PhysikOnline-FFM/gu-urlshorter/issues">Issues</a>.

			<p>Es gibt auch die möglichkeit, ein neues Ticket ohne Login anzulegen, und zwar bei
			<a href="https://gitreports.com/issue/PhysikOnline-FFM/gu-urlshorter">Gitreports: Problem melden</a>.
		</div>
	</div>


</div>


<?php

yourls_html_footer();

