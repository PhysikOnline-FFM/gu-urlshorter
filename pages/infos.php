<?php

// Make sure we're in YOURLS context
if( !defined( 'YOURLS_ABSPATH' ) ) {
	// Attempt to guess URL via YOURLS
	$url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace( array( '/pages/', '.php' ) , array ( '/', '' ), $_SERVER['REQUEST_URI'] );
	echo "Try this instead: <a href='$url'>$url</a>";
	die();
}

// Display page content. Any PHP, HTML and YOURLS function can go here.
$url = YOURLS_SITE . '/infos';

yourls_html_head( 'infos', 'Infos about YOURLS an der Uni Frankfurt' );
yourls_html_logo();

?>
<div class="main-column">
	<div class="panel panel-teaser">
		<div class="panel-header">
			<h1>Der Kurz-URL-Dienst an der Goethe-Universität</h1>
		</div>
		<div class="panel-body">
			<?php $host = $_SERVER['HTTP_HOST'];
			      $hostlink = "<a href='$host'>$host</a>"; ?>
			<p>Willkommen beim Kurz-URL-Dienst an der <a href="http://www.uni-frankfurt.de">Goethe-Universität Frankfurt am Main</a>.
			Sie erreichen diesen Dienst unter der Adresse <strong><?=$hostlink; ?></strong>.

			<p>Dieser Dienst dient dazu, Webseiten innerhalb der Goethe-Universität mit einer kürzeren
			Adresse zugänglich zu machen (<a href="https://de.wikipedia.org/wiki/Kurz-URL-Dienst">Kurz-URL-Dienst</a>).
			Diese kurzen Adressen sind leichter abzuschreiben und, falls ein aussagekräftiges Kürzel gewählt wurde, leicht zu merken.
			Sie finden Verwendung in Vorlesungen, Seminaren und Vorträgen beim Tafelanschrieb oder Präsentationen, sowie auf
			Druckmaterialien wie Postern, Plakaten und Handzetteln. Sie sind auch dank ihrer Kürze leichter mit dem Handy einzugeben.

			<p>Dieser Kurz-URL-Dienst ist vertrauensvoll: Mit ihm lassen sich nur  <a href="/erlaubte-domain-liste">Webseiten innerhalb der Goethe-Universität</a>
			kürzen, also als Daumenregel alle Adressen, die ein <tt>uni-frankfurt.de</tt> beinhalten. So können sie
			sicher gehen, dass Adressen unterhalb von <?=$hostlink; ?> nicht auf böswillige Seiten
			weiterleiten. Anders als Dienste wie <a href="http://bit.ly">bit.ly</a> oder <a href="http://goo.gl">goo.gl</a>
			bietet <?=$hostlink; ?> einen Wiedererkennungswert und stellt einen direkten Bezug zur Goethe-Universität her, darauf
			hinweist, dass es sich beim Linkziel um eine Ressource der Goethe-Universität handelt.
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-box"><div class="panel-body">
				<h3>Regeln</h3>

				<p>Dieser Kurz-URL-Dienst steht allen Benutzern im Internet offen, um
				Kurz-Links zu <a href="/">erzeugen</a>. Kurzlinks können also auch von zuhause
				erstellt werden.

				<p>Die einzige Regel ist, dass die zu kürzende Adresse auf
				eine Website innerhalb der Goethe-Universität verweist. Die erlaubten
				Domains stehen auf unserer <a href="/erlaubte-domain-liste">Whitelist</a>.
			</div></div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-box"><div class="panel-body">
				<h3>API (kommend)</h3>

				<p>Zur automatischen Erstellung von Kurzlinks etwa aus
				universitären Websystemen heraus steht die <a href="http://yourls.org/#API">YOURLS-API</a>
				(Programmierschnittstelle) zur Verfügung. Sie ist unabhängig von der verwendeten
				Programmiersprache. Einzige Beschränkung: Wir bieten diese Programmierschnittstelle
				nur für Benutzer <strong>innerhalb des Netzes der Goethe-Universität</strong> an.

				<p><em>Dieses Feature steht noch nicht zur Verfügung</em>
			</div></div>
		</div>
	</div>
</div>
<div class="sidebar-column">

	<div class="panel panel-sidebar">
		<h2>Bookmarklets</h2>
		<?php $page = YOURLS_SITE; ?>
		<div class="panel-body">
			<span class="caret"></span>

			<p>Mit folgenden <a href="https://de.wikipedia.org/wiki/Bookmarklet">Bookmarklets</a>
			kann jederzeit bequem ein kurzer <?=$hostlink; ?>-Link erstellt werden.

			<p>

			<a href="javascript:(function()%7Bvar%20d=document,w=window,enc=encodeURIComponent,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),s2=((s.toString()=='')?s:enc(s)),f='<?php echo $page; ?>',l=d.location,p='?url='+enc(l.href)+'&title='+enc(d.title)+'&text='+s2,u=f+p;try%7Bthrow('ozhismygod');%7Dcatch(z)%7Ba=function()%7Bif(!w.open(u))l.href=u;%7D;if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();%7Dvoid(0);%7D)()" class="bookmarklet">Default</a>
			<a href="javascript:(function()%7Bvar%20d=document,w=window,enc=encodeURIComponent,e=w.getSelection,k=d.getSelection,x=d.selection,s=(e?e():(k)?k():(x?x.createRange().text:0)),s2=((s.toString()=='')?s:enc(s)),f='<?php echo $page; ?>',l=d.location,k=prompt(%22Custom%20URL%22),k2=(k?'&keyword='+k:%22%22),p='?url='+enc(l.href)+'&title='+enc(d.title)+'&text='+s2+k2,u=f+p;if(k!=null)%7Btry%7Bthrow('ozhismygod');%7Dcatch(z)%7Ba=function()%7Bif(!w.open(u))l.href=u;%7D;if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();%7Dvoid(0)%7D%7D)()" class="bookmarklet">Custom</a>
			<a href="javascript:(function()%7Bvar%20d=document,s=d.createElement('script');window.yourls_callback=function(r)%7Bif(r.short_url)%7Bprompt(r.message,r.short_url);%7Delse%7Balert('An%20error%20occured:%20'+r.message);%7D%7D;s.src='<?php echo $page; ?>?url='+encodeURIComponent(d.location.href)+'&jsonp=yourls';void(d.body.appendChild(s));%7D)();" class="bookmarklet">Popup</a>
			<a href="javascript:(function()%7Bvar%20d=document,k=prompt('Custom%20URL'),s=d.createElement('script');if(k!=null){window.yourls_callback=function(r)%7Bif(r.short_url)%7Bprompt(r.message,r.short_url);%7Delse%7Balert('An%20error%20occured:%20'+r.message);%7D%7D;s.src='<?php echo $page; ?>?url='+encodeURIComponent(d.location.href)+'&keyword='+k+'&jsonp=yourls';void(d.body.appendChild(s));%7D%7D)();" class="bookmarklet">Custom Popup</a>
		</div>
	</div>

	<div class="panel panel-sidebar">
		<h2>Powered by</h2>
		<div class="panel-body">
			<span class="caret"></span>

			<a href="http://yourls.org"><img src="/images/yourls-logo.png" style="max-width: 100%"></a>
			<p>Dieser Dienst nutzt die etablierte Open-Source-Software <a href="http://yourls.org">YOURLS</a>
			mit einigen Modifikationen, die die im Text genannten Regeln sicherstellen. Der Quellcode dieser
			Anwendung ist ebenfalls Open-Source und öffentlich einsehbar.
		</div>
	</div>
</div>


<?php

yourls_html_footer();

