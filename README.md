Up Shop
=======

Beskrivning
-----------

Up Shop är baserad på ramverket Up MVC, som du hittar här:
https://github.com/saurid/UpMvc2


Senaste version
---------------

Du kan hämta den senaste versionen av Up Shop på github
https://github.com/saurid/UpShop


Installation
------------

### Systemkrav

* Webbserver med stöd för URL-rewrite (tex Apache och rewrite_module)
* PHP >= 5.3.0
* PDO extension
* MySQL

### Installera i testmiljö:

* Packa upp zip-filen i din webbservers webbrot
* Skapa en ny databas i mySQL
* Importera exempeldatan i filen `upshop.sql` till din nya databas
* Öppna filen `App/config.php` och redigera variablerna med prefix `db_`
till dina egna uppgifter för värd, användarnamn, lösenord och data-
basnamn.
* Surfa till `http://localhost/UpShop/` för att se exempelshoppen
* Surfa till `http://localhost/UpShop/Admin` för att komma till adminsidorna
* Logga in med E-postadress: `admin@admin.se` och Lösenord: `admin`

Up Shop är utvecklad av (kontaktinformation)
-------------------------------------------

* https://github.com/saurid
* http://www.waljefors.se
