<?php

// Make sure we're in YOURLS context
if( !defined( 'YOURLS_ABSPATH' ) ) {
	// Attempt to guess URL via YOURLS
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace( array( '/pages/', '.php' ) , array ( '/', '' ), $_SERVER['REQUEST_URI'] );
	echo "Try this instead: <a href='$url'>$url</a>";
	die();
}

// Display page content. Any PHP, HTML and YOURLS function can go here.
$url = YOURLS_SITE . '/credits';

yourls_html_head( 'credits', 'Credits' );
yourls_html_logo();

?>
<div class="main-column">
	<div class="panel panel-teaser">
		<div class="panel-header">
			<h1>Über den KurzURL-Dienst an der Goethe-Universität</h1>
		</div>
		<div class="panel-body">
			<p>Dieser Kurz-URL-Dienst entstand auf Initiative durch Studenten des Projektes
			<a href="http://riedberg.tv">RiedbergTV</a>, welches durch den
			<a href="http://www.studiumdigitale.uni-frankfurt.de/elf/self15/index.html">studentischen eLearning-Förderfonds (SeLF) 2015/16</a>
			finanziert wird. Mit <a href="http://www.studiumdigitale.uni-frankfurt.de">Studiumdigitale</a>
			besitzt dieser Kurz-URL-Dienst einen Partner, der die langfristige Funktion dieses Dienstes
			garantieren kann.

			<p>Mit dem <a href="http://th.physik.uni-frankfurt.de">Institut für theoretische Physik</a>
			haben wir einen weiteren Unterstützer, der den reibungslosen technischen Betrieb dieses Dienstes
			bestärkt. Betrieben wird dieser Dienst durch das
			<a href="http://elearning.physik.uni-frankfurt.de/projekt">eLearning-Projekt des Fachbereichs Physik</a>.
			Das technische Hosting wird durch das <a href="http://pokal.uni-frankfurt.de">POKAL-Einsatzteam</a>
			des Instituts für theoretische Physik sichergestellt.	
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-box"><div class="panel-body">
				<h3>Kontakt</h3>

				<p>Bitte wenden Sie sich bei allen Fragen zu diesem Projekt an das
				<strong><a href="https://elearning.physik.uni-frankfurt.de/go/impressum">Supportteam von PhysikOnline</a></strong>.

				<p><a href="https://elearning.physik.uni-frankfurt.de/go/impressum"><img src="https://elearning.physik.uni-frankfurt.de/projekt/raw-attachment/wiki/Allgemein/eLearning-Team%20Feb2014.jpg" style="width:100%;"></a>
			</div></div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-box"><div class="panel-body">
				<h3>Mitmachen</h3>

				<p>Wir suchen jederzeit Unterstützer, die sich für die frische Ideen
				und Konzepte innerhalb der Goethe-Universität begeistern können. Wenn Sie die Idee
				des KurzURL-Dienstes mögen und gerne zu seiner Sicherung beitragen möchten, weitere
				Kurz-Domains zur Verfügung stellen möchten oder vorschlagen möchten oder vielleicht
				sogar eine Abspaltung betreiben möchten, steht Ihnen das jederzeit zur Verfügung.
				Sie können den Quellcode dieses Programmes einsehen (<a href="/infos">mehr Infos</a>)
				und auch nach Belieben <a href="https://de.wikipedia.org/wiki/Abspaltung_%28Softwareentwicklung%29">forken</a>.
			</div></div>
		</div>
	</div>

</div>
<div class="sidebar-column">

	<div class="panel panel-sidebar">
		<h2>Unterstützer</h2>
		<div class="panel-body" style="text-align: center">
			<span class="caret"></span>

<!-- SD+Self-Logo
			<a href="http://www.studiumdigitale.uni-frankfurt.de/"><img src="https://pokal.uni-frankfurt.de/data/sage/images/pokal/RZ_self_logo.gif" style="max-width: 100%"></a>
-->
			<a href="http://self.studiumdigitale.uni-frankfurt.de/"><img src="https://pokal.uni-frankfurt.de/pages/thumbs/1000x1000r/self_logo.jpg" style="max-width: 100%"></a>
			<br>
			<br>

			<a href="http://riedberg.tv"><img src="https://pokal.uni-frankfurt.de/pages/thumbs/1000x1000r/2015-08/riedbergtv-logo-sven.png" style="width:90%;"></a>
			<br>
			<br>

<!--
			<a href="http://www.starkerstart.uni-frankfurt.de/"><img src="http://www.starkerstart.uni-frankfurt.de/49608132/Starker-Start_Logo_alpha_214x90.png?size=sidebar_image" style="max-width:100%;"></a>
			<br>
			<br>
-->
			<a href="http://elearning.physik.uni-frankfurt.de/projekt"><img src="http://podcast-wiki.physik.uni-frankfurt.de/w/images/thumb/7/7d/Logo_PhysikOnline.png/120px-Logo_PhysikOnline.png" style="max-width: 60%"></a>
			<br>
			<br>
			<a href="http://fias.uni-frankfurt.de/"><img src="https://th.physik.uni-frankfurt.de/~koeppel/logos/fias-web-official.png" style="max-width:100%;"></a>
<!--			<br>
			<br>
			<a href="http://itp.uni-frankfurt.de/"><img src="https://elearning.physik.uni-frankfurt.de/projekt/raw-attachment/wiki/Server/ITP/Selbstgemachtes%20ITP-Logo,%20gross.png" style="max-width:100%"></a>
			<br>
			<br>
			<a href="http://csc.uni-frankfurt.de/"><img src="https://pokal.uni-frankfurt.de/data/sage/images/pokal/csc_logo_new210x70.png" style="max-width:80%"></a>#
-->
			<br>
			<br>
			<a href="http://www.uni-frankfurt.de/"><img src="https://th.physik.uni-frankfurt.de/~koeppel/logos/GU-Logo-blau-250px.png" style="max-width:60%;"></a>

		</div>
	</div>
</div>


<?php

yourls_html_footer();

