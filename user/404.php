<?php

// Supposed to be called by ./user/plugins/fallback-404/plugin.php

function show404($shorturl) {
	yourls_status_header( 404 );


	yourls_html_head( 'page404', 'This page does not exist' );
	yourls_html_logo();

?>

<div class="main-column">
	<div class="panel panel-teaser">
		<div class="panel-header">
			<h1>Page Not Found</h1>
		</div>
		<div class="panel-body">
			<p>Leider konnten wir keine Adresse unter dem Kürzel <strong><?php echo $shorturl; ?></strong> finden.
			Das bedeutet, dass diese Kurz-URL nicht existiert.
		</div>
	</div>
</div>
<div class="sidebar-column">

	<div class="panel panel-sidebar">
		<h2>Über den Kurz-URL-Dienst</h2>
		<div class="panel-body">
			<span class="caret"></span>

			<p>Auf der Website <?php echo $_SERVER['SERVER_NAME']; ?> lassen sich Kurzlinks
			zu Ressourcen der <a href="http://www.uni-frankfurt.de/">Goethe-Universität Frankfurt</a>
			erstellen. <a href="/">Zur Startseite</a>
		</div>
	</div>

</div>


<?php

yourls_html_footer();

}
