<?php

// Make sure we're in YOURLS context
if( !defined( 'YOURLS_ABSPATH' ) ) {
	// Attempt to guess URL via YOURLS
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace( array( '/pages/', '.php' ) , array ( '/', '' ), $_SERVER['REQUEST_URI'] );
	echo "Try this instead: <a href='$url'>$url</a>";
	die();
}

// Display page content. Any PHP, HTML and YOURLS function can go here.
$url = YOURLS_SITE . '/erlaubte-domain-liste';

yourls_html_head( 'erlaubte-domain-liste', 'Informationen über YOURLS an der Goethe-Universität' );
yourls_html_logo();

?>
<div class="main-column">
	<div class="panel panel-teaser">
		<div class="panel-header">
			<h1>Liste erlaubter Domains</h1>
		</div>
		<div class="panel-body">
			<p>Folgende Domains werden derzeit zum Kürzen erlaubt:</p>

			<dl class="dl">
				<?php
					global $allowed_domains;
					foreach($allowed_domains as $d) {	
						echo "<dt><a href='http://${d['domain']}' title='Mal ausprobieren, was da kommt'>${d['domain']}</a></dt><dd>${d['desc']}</dd>\n";
					}
				?>
			</dl>

			<p>Diese Liste ist wie folgt zu verstehen:
			<ul>
				<li>Alle Adressen, die gekürzt werden sollen, müssen auf einer dieser Domains <em>enden</em>.
				    Das bedeutet insbesondere, dass alle möglichen <em>Subdomains</em> erlaubt sind, wenn eine
				    Domain in obiger Liste steht.
			</ul>
		</div>
	</div>
</div>
<div class="sidebar-column">

	<div class="panel panel-sidebar">
		<h2>Domain hinzufügen</h2>
		<div class="panel-body">
			<span class="caret"></span>

			Wenn Sie der Meinung sind, dass eine Domain fehlt, dann <a href="/credshits">kontaktieren Sie uns</a>.
			Wir fügen diese Domain hinzu, wenn sie unseren Richtlinien entspricht.
		</div>
	</div>

</div>


<?php

yourls_html_footer();

