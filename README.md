Der Goethe-Universität Kurz-URL-Dienst
======================================

Dieses Repository beinhaltet den Code für den Kurz-URL-Dienst an der Goethe-Universität (Frankfurt am Main). Die Software basiert auf [YOURLS](http://yourls.org) (*Your Own URL Shortener*). Für eine ausführliche Readme-File zur YOURLS-Codebase siehe die [README](https://github.com/YOURLS/YOURLS/blob/master/README.md) im [YOURLS-Repository](https://github.com/YOURLS/YOURLS).

Unsere Version von YOURLS wurde im August 2015 gestartet und basiert auf [YOURLS 1.7](https://github.com/YOURLS/YOURLS/releases/tag/1.7).

Benutzen
--------

Diese Software ist bewusst so geschrieben, dass eine einzelne Installation unter mehreren Adressen gleichzeitig benutzt werden kann. An dieser Stelle sei **http://tinygu.de** erwähnt. Dies ist für den Anwender sicher die interessanteste Adresse, um Links zu kürzen.

Weitere Informationen, wo wir diese Software installiert haben und hosten, gibt es im [PhysikOnline Teamtracker](https://elearning.physik.uni-frankfurt.de/projekt/) unter [Allgemein/URL-Shortener](https://elearning.physik.uni-frankfurt.de/projekt/wiki/Allgemein/URL-Shortener). Ausführliche Informationen finden sich auch in den Dateien im [pages](https://github.com/PhysikOnline-FFM/gu-urlshorter/tree/master/pages)-Verzeichnis, etwa http://tinygu.de/infos, http://tinygu.de/credits sowie http://tinygu.de/specs.

Um das Design nutzen zu können muss ein externes Package hinzugefügt werden:
```
git submodule init
git submodule update
```

Mitmachen
---------

Mitarbeit durch Studenten und Interessierte wird ausdrücklich gewünscht. Wir haben einen öffentlichen [Issue/Bug-Tracker](https://github.com/PhysikOnline-FFM/gu-urlshorter/issues), auf dem technische wie gleichermaßen inhaltiche Probleme diskutiert werden. Zum Posten wird ein [Github-Account benötigt](https://github.com/join). Über den Dienst [GitReports](https://gitreports.com/) ist es aber auch möglich, anonym bzw. ohne Login auf Github [Feedback zu senden](https://gitreports.com/issue/PhysikOnline-FFM/gu-urlshorter).


Lizenz
------
Dies ist freie Software gemäß der MIT-Lizenz. Siehe [license](LICENSE.md) für Details. Mit dieser Lizenz benutzen wir die gleiche Lizenz wie YOURLS selber.
