.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt



Referenzierung
================



Beispiel für die Einbindung der iwImmo über TypoScript
""""""""""""""""""""""""""""""""""""""""""""""""""""""

.. code-block:: ts

	temp.iwImmoListe= USER
	temp.iwImmoListe {
	    userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
	    vendorName = IWAG
	    extensionName = IwImmo
	    pluginName = list
	    controller = List
	    settings.list.pid = 251
	    settings.list.geoid = 108
	    settings.list.parameters.etype = 3
	    settings.list.parameters.eqid = -24

	}
	page.50 < temp.iwImmoListe



plugin.tx_iwimmo.settings
"""""""""""""""""""""""""


search
""""""

.. container:: table-row

   Property
         search.geoid

   Data type
         int

   Description
         Land muss mit der Einstellung des referenzierten Listenobjekts übereinstimmen.
         Für Deutschland, Österreich und die Schweiz ist ein Autocompleter für die Ortsauswahl verfügbar.


   Default
         108



list
""""

.. container:: table-row

   Property
         list.pid

   Data type
         int

   Description
		Pid mit der Listenansicht

   Default
		-


.. container:: table-row

   Property
         list.properties.equipmentLimit

   Data type
         int

   Description
		Hier kann die Anzahl der Ausstattungsmerkmale, die auf der Listenasicht angezeigt werden, eingeschränkt werden.

   Default
		-


.. container:: table-row

   Property
         list.properties.premium

   Data type
         string

   Description
		  Hier können Sie mittels kommaseparierter Liste Objekte als Premiumobjekte markieren, dazu müssen die OnlineIDs der Objekte angegeben werden.
		  Diese Objekte erhalten eine eigene CSS Klasse (premium).

   Default
		-


.. container:: table-row

   Property
         list.parameters.geoid

   Data type
         int

   Description
         Geoid zur Einschränkung der Immobilienliste. Bei vorgeschalteter Suche muss die Geoid mit der Suche übereinstimmen.

   Default
         108

.. container:: table-row

   Property
         list.parameters.etype

   Data type
         string

   Description
         Einschränkung der Immobilieniste auf Immobilienarten. Es können mehrere Wert kommasepariert angegeben werden.
         Für Ausschluss von Objekten Werte mit einem „-“angeben.

         :ref:`Immobilienarten`

   Default
		-

.. container:: table-row

   Property
         list.parameters.ecat

   Data type
	     string

   Description
          Einschränkung der Immobilienliste auf Immoiblienkategorien. Es können mehrere Wert kommasepariert angegeben werden.
          Für Ausschluss von Objekten Werte mit einem „-“angeben.

          :ref:`Immobilienarten`

   Default
		-

.. container:: table-row

   Property
         list.parameters.esr

   Data type
         int

   Description
         Einschränkung der Immobilienliste auf Kauf- oder Mietobjekte.
         (0: alle, 1: Kauf, 2: Miete)

   Default
		-

.. container:: table-row

   Property
         list.parameters.eqid

   Data type
         string

   Description
         Einschränkung der Immobilienliste auf Objekte mit angegebenen Ausstattungsmerkmalen. Es können mehrere Wert kommasepariert angegeben werden.
         Für Ausschluss von Objekten Werte mit einem „-“angeben.

         :ref:`Ausstattungsmerkmale`

   Default
		-

.. container:: table-row

   Property
         list.parameters.roomi

   Data type
         int

   Description
         Einschränkung der Immobilienliste auf Objekte mit Mindestwert für die Zimmeranzahl.

   Default
		-

.. container:: table-row

   Property
         list.parameters.rooma

   Data type
         int

   Description
         Einschränkung der Immobilienliste auf Objekte mit Maximalwert für die Zimmeranzahl.

   Default
		-

.. container:: table-row

   Property
         list.parameters.primi

   Data type
         int

   Description
         Einschränkung der Immobilienliste auf Objekte mit Minimalpreis.

   Default
		-

.. container:: table-row

   Property
         list.parameters.prima

   Data type
         int

   Description
         Einschränkung der Immobilienliste auf Objekte mit Höchstpreis.

   Default
		-

.. container:: table-row

   Property
         list.parameters.customerprojects

   Data type
         bool

   Description
         Mittels dieses Parameters können auch Objekte angezeigt werden, die in der Immowelt-Datenbank als „Projekt extern“ markiert sind.

   Default
		-

.. container:: table-row

   Property
         list.parameters.includeiwobj

   Data type
         bool

   Description
         In Kombination mit dem Parameter „customerprojects“ wird hier festgelegt, ob Objekte, die nicht als „projekt extern“ gekennzeichnet sind, auch angezeigt werden sollen.

   Default
		-

.. container:: table-row

   Property
         list.parameters.intranet

   Data type
         string

   Description
   		Optionale Einstellung zum Abfragen des Intranet-Feldes in der Immowelt-Datenbank. Es werden nur Objekte angezeigt, bei denen der hier angegebene String im Datenbank-Feld Intranet steht.
		(z. B.: intranet  =  Referenz)

   Default
		-

.. container:: table-row

   Property
         list.paginate.itemsPerPage

   Data type
         int

   Description
         Anzahl der Objekte die maximal pro Seite angezeigt werden.

   Default
         10


.. container:: table-row

   Property
         list.paginate.insertAbove

   Data type
         bool

   Description
         Schalter um die Sortierung über der Liste ein- und auszuschalten.

   Default
         0



.. container:: table-row

   Property
         list.paginate.insertBelow

   Data type
         bool

   Description
         Schalter um dem Pagebrowser unter der Liste ein- und auszublenden.

   Default
         1



.. container:: table-row

   Property
         list.paginate.addQueryStringMethod

   Data type
         string

   Description
		Benötigte Parameter werden vom Pagebrowser gesammelt und übergeben. Hier kann festgelegt werden, welche Art der Parameter verwendet und übergeben werden sollen und in welcher Prioritätenreihenfolge.

   Default
         GET,POST



.. container:: table-row

   Property
         list.paginate.maximumNumberOfLinks

   Data type
         int

   Description
         Maximale Anzahl der Links zu einzelnen Seiten, die im Pagebrowser angezeigt werden sollen.

   Default
         7



detail
""""""

.. container:: table-row

   Property
         detail.pid

   Data type
         int

   Description
         Seite mit dem Detail-Plugin.

   Default
		-


.. container:: table-row

   Property
         detail.defaultExposeId

   Data type
         string

   Description
         OnlineID eines Objektes, das auf der Detailseite angezeigt werden soll. So können einzelne Objekte ohne eine vorgeschaltete Suche auf der Website angezeigt werden.

   Default
		-


contact
"""""""

.. container:: table-row

   Property
         contact.confirmation.pid

   Data type
         int

   Description
         Pid der Seite mit der Kontaktanfragebestätigung.

   Default
		-


.. container:: table-row

   Property
         contact.domain

   Data type
         int

   Description
         Hier kann angegeben werden, welche Absender-Domain im Betreff der Anfrage angegeben wird.

   Default
		-





