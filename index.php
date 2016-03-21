<?php
/* Build based on sample-public-front-page.txt, go.ufopixel.de horizon etc.  */

// Start YOURLS engine
require_once( dirname(__FILE__).'/includes/load-yourls.php' );

// Change this to match the URL of your public interface. Something like: http://yoursite.com/index.php
$page = YOURLS_SITE . '/'; // wird nur bei Bookmarks genutzt

// if FORM has been submitted:
$formSubmitted = isset( $_REQUEST['url'] ) && $_REQUEST['url'] != 'http://';
$context = $formSubmitted ? 'public-submitted' : 'index';

if($formSubmitted) {
	// Get parameters -- they will all be sanitized in yourls_add_new_link()
	$url     = $_REQUEST['url'];
	$keyword = isset( $_REQUEST['keyword'] ) ? $_REQUEST['keyword'] : '' ;
	$title   = isset( $_REQUEST['title'] ) ?  $_REQUEST['title'] : '' ;
	$text    = isset( $_REQUEST['text'] ) ?  $_REQUEST['text'] : '' ;

	// Create short URL, receive array $return with various information
	$return  = yourls_add_new_link( $url, $keyword, $title );

	$shorturl = isset( $return['shorturl'] ) ? $return['shorturl'] : '';
	$message  = isset( $return['message'] ) ? $return['message'] : '';
	$title    = isset( $return['title'] ) ? $return['title'] : '';
	/* status is something like 'success' or 'fail' */
	$status   = isset( $return['status'] ) ? $return['status'] : '';
	/* code is something like 'error:whatever ...  */
	$code     = isset( $return['code'] ) ? $return['code'] : '';

	// Stop here if bookmarklet with a JSON callback function ("instant" bookmarklets)
	if( isset( $_GET['jsonp'] ) && $_GET['jsonp'] == 'yourls' ) {
		$short = $return['shorturl'] ? $return['shorturl'] : '';
		$message = "Short URL (Ctrl+C to copy)";
		header('Content-type: application/json');
		echo yourls_apply_filter( 'bookmarklet_jsonp', "yourls_callback({'short_url':'$short','message':'$message'});" );

		die();
	}
}

// Insert <head> markup and all CSS & JS files
yourls_html_head($context);
yourls_html_logo();

if($formSubmitted) {
	if( $status == 'success' ) {
		// Include the Copy box and the Quick Share box
		# find die irgendwie nicht so genial, diese Box
		yourls_share_box( $url, $shorturl, $title, $text );

		// TBD: Durch irgendwas sinnvolleres ersetzen, vgl. tini.io
	} else {
		// $status == 'fail' will be the case

		$titles = array(
			'_default' =>  'Ein Fehler trat auf!',
			'error:noloop' => 'Kurz-URLs werden nicht noch kürzer!',
			'error:keyword' => 'Kurz-Bezeichner bereits in Benutzung!',
			'error:db' => 'Die Datenbank ist böse.',
			'error:nourl' => 'Keine gültige Adresse angegeben!',
			'error:url' => 'Diese Adresse haben wir bereits gekürzt!',
			'error:whitelist' =>  'Nur Adressen mit Bezug zur Goethe-Universität erlaubt!',
		);

		?>
		<div class="main-column">
			<div class="panel panel-regular">
				<div class="panel-header">
					<h1><?php print isset($titles[$code]) ? $titles[$code] : $titles['_default']; ?></h1>
					<?php
						if($message) echo "<p>$message</p>";
					?>
				</div>
				<div class="panel-body">
					<p>Leider konnte die Kurz-URL nicht erzeugt werden. <?php
						switch($code) {
							case 'error:noloop':
								print "<strong>Wir erlauben nämlich keine Kurz-URLs, die auf den Kurz-URL-Dienst zeigen.</strong>";
								break;
							case 'error:keyword':
								print "Der Kurzbezeichner <strong>$keyword</strong> ist nämlich <strong>bereits in Benutzung</strong>.";
								$stats = yourls_get_link_stats($keyword);
								if(isset($stats['link']['url'])) {
									print "<p>Die Kurz-URL <a href='{$stats['link']['shorturl']}'>{$stats['link']['shorturl']}</a> verweist seit dem <strong>{$stats['link']['timestamp']}</strong> auf <a href='{$stats['link']['url']}'>{$stats['link']['url']}</a>.";
									/*TODO*/ print "<p><em>Hier könnten auch die Detailsinfos direkt eingeblendet werden</em>";
								}
								break;
							case 'error:db':
								print "<strong>Bitte schreiben Sie uns eine E-Mail.</strong>";
								break;
							case 'error:whitelist':
								print "Die zu kürzende Adresse";
								print "<blockquote><a href='$url'>$url</a></blockquote>";
								print "<p>gehört <a href='/erlaubte-domain-liste'>gemäß unserer Liste erlaubter Domains</a> <strong>nicht</strong> zur Goethe-Universität Frankfurt. ";
								print "Bitte <a href='/credits'>kontaktieren Sie uns</a>, wenn Sie glauben, dass es sich dabei um einen Fehler handelt. Bei Bedarf können wir unsere Liste erweitern. ";
								print "<p>Für den Moment können wir Sie nur an <strong>einen externen Kürzungsdienst</strong> verweisen, zB. <a href='http://tinyurl.com'>tinyurl.com</a>.";
								break;
							case 'error:nourl':
								if(preg_match('/^\s*$/', $url)) {
									print "Die Angabe eine Adresse zum Kürzen wäre schon von Vorteil! <a href='/'>Nochmal probieren</a>.";
								} else {
									print "Die zu kürzende Adresse";
									print "<blockquote><a href='$url'>$url</a></blockquote>";
									print "<p>ist unserer Meinung nach keine gültige Webadresse. Was passiert in ihrem Browser, wenn Sie auf sie klicken? <a href='/credits'>Lassen Sie es uns wissen!</a>";
								}
								break;
							case 'error:url':
								print "Diese Adresse haben wir bereits gekürzt. <strong>TODO</strong>: Entscheiden ob wir wirklich verhindern wollen, URLs mehrfach zu kürzen.";
								break;
							default:
								print "Mehr weiß ich leider auch nicht.";
						}
					?>
				</div>
			</div>
		</div>
		<div class="sidebar-column">
			<div class="panel panel-sidebar">
				<h2>Kontakt</h2>
				<div class="panel-body">
					<span class="caret"></span>
					<p>Wir helfen immer gerne. <a href="/credits">Kontakt</a></p>
				</div>
			</div>
		</div><!-- /.sidebar-column -->
		<?php

		// Display result message of short link creation


	}
} else { // when no form has been submitted
	$site = YOURLS_SITE;
	?>
	<div class="main-column">
		<h2>Erstelle einen Goethe-Universität-Kurzlink</h2>
		<form method="post" action="">
			<input tabindex="1" type="text" name="url" placeholder="http://etwas.uni-frankfurt.de/..." class="form-control input-lg" autofocus />
			<br>
			<div class="pull-right">
				<button type="submit" tabindex="2" class="btn btn-primary btn-lg" title="Tipp: Einfach Enter drücken"><i class="fa fa-rocket"></i> Kürzen</button>
			</div>
			<input type="text" tabindex="3" name="keyword" placeholder="Optionales Kürzel" class="form-control input"
				style="width:20%" maxlength="30" <?php if(isset($_GET["suggest-keyword"])) print 'keyword="'.htmlentities($_GET['suggest-keyword']).'"'; ?>
				title="Ohne Kürzel wird ein zufälliges Kürzel mit vier Buchstaben erzeugt">


		<!--

		<p style="margin: 2em; text-align: center;"">
			<input type="text" name="keyword" placeholder="keyword" class="btn btn-lg">
			<input type="text" name="title" placeholder="title" class="btn btn-lg">
			<button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-rocket"></i> Kürzen</button>
		</p>
		-->
	</div>
	<div class="sidebar-column">

		<div class="panel panel-sidebar">
			<h2>Der KurzURL-Dienst</h2>
			<div class="panel-body">
				<span class="caret"></span>
				<p>Auf dieser Seite können Abkürzungen für Webseiten
				der <a href="http://www.uni-frankfurt.de">Goethe-Universität Frankfurt</a>
				erstellt werden.</p>
				<p>Es werden <a href="/erlaubte-domain-liste">universitäts&shy;zugehörige Adressen</a> gekürzt.</p>
			</div>
		</div>
	</div>
<?php
}

// Display page footer
yourls_html_footer();
?>
