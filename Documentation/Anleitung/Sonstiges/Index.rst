.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt



Sonstiges
================

.. _OnlineIds:

OnlineIds
"""""""""


Um ein bestimmtes Immobilienobjekt für ein Exposé-Plugin anzuzeigen oder bestimmte Objekte in der Liste als "Premiumobjekt" zu markieren,
brauchen Sie die Immowelt-OnlineIds der Objekte.
Um die OnlineId eines Objekts herauszufinden, öffnen Sie das gewünschte Exposé zunächst
auf www.immowelt.de. Unter "Objektdaten" finden sie den Punkt "Online-ID". Die dort angezeigte Zeichenfolge entspricht der OnlineId des Objekts.



Listenlayout
""""""""""""

Im ausgelieferten Standard-Template für die Objektliste werden für die einzelnen Objekteinträge abwechselnd die CSS-Klassen "odd" und "even" angegeben,
sodass die Objekte in der Liste alternierend dargestellt werden können.



Premiumobjekte
""""""""""""""


Sie können ausgewählte Objekte auf dem Listen-Plugin gesondert darstellen. Objekte, deren OnlineIds im Listen-Plugin als Premiumobjekt
eingetragen sind, erhalten im Markup die CSS-Klasse "premium".



Kontaktanfrage
""""""""""""""

Für die Funktion der Kontaktanfrage sind zwei seperate Plugins vom Typ "Immowelt Kontaktanfrage" notwendig.
Das Eine muss auf der gleichen Seite wie das Exposé-Plugin liegen.
Das Zweite muss auf einer eigenen Seite liegen und zeigt die Versandbestätigung an.
Wird auf dem zugehörigen Exposé-Plugin eine OnlineId hinterlegt, um ein bestimmtes Objekt anzuzeigen, muss diese OnlineId ebenfalls auf den
Kontaktanfrage-Plugins eingestellt werden.




