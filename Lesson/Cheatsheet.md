## Warum man sich nicht auf die Clientseitige Validirung verlassen kann
    
    Clientseitige Validierung dient zur besseren usability. Es legt dinge wie Format Pflichtfeld oder die Länge der Eingabe

    - Browser welcher keine HTML5-Formularfelder unterstützt 
    - JavaScript deaktiviert 
    - Eigenes Formular an den Server senden

## Serverseitige  Validierung muss mit der Clientseitigen abgestimmt werden

    - Wird eine Eingabe verlangt NOT NULL
    - Feldlänge
    - Schädliche Zeichen (htmlspecialchars)

Als Ausgangslage dient immer die DB-Tabelle

Die Clientseitige Validierung gibt Bedinnungen bereits bei dem Formular bekannt. 
Dies verbessert die Usability weil das Formularnicht zuerst an den Server geschickt werden muss, 
sondern weil dies bereits beim Formular getan werden kann.

Die Clientseitige Validierung ist aber leicht umgänglich wenn der Browser nicht HTML5 konform ist oder
JavaScript deaktiviert ist.


Input Typen werden beim HTML Tag festgelegt

```<input type="email, number, password, etc">```

## Attribute

```<input type="text" required>```

required	macht ein Eingabefeld zu einem Pflichtfeld
maxlength	beschränkt die maximale Eingabelänge
max / min	beschränkt die Eingabe von Zahlen und Daten auf einen bestimmten Bereich
pattern     ermöglicht die Eingabe gegen eine Regular Expression zu testen



PHP und DB-Tabelle --> Serverseitig
HTML --> Clientseitig

```CREATE USER 'username' @localhost IDENTIFIED BY 'password';```

```GRANT SELECT, UPDATE, INSERT, DELETE ON 'database'.'table' TO 'user' @ 'localhost';```

```FLUSH PRIVILEGES;```

die 4 Wichtigsten Angaben für die Verbindung

	- Host
	- User
	- Passwort
    - Database


MySQLi (improved) nur MySQL, OOP + Procedural
PDO (PHP Data Objects) läuft auf 12 verschiedenen DB Systemen, OOP
