<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.8
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>

<p><em>Obervera att denna informationen är något inaktuell.
Den skrevs innan namepaces infördes, och routingen skrevs om.
Men i det stora hela är flödet fortfarande detsamma.</em></p>





<h3>Hur fungerar Up MVC?</h3>

<p>För att djupare förstå hur kärnan av Up MVC fungerar kan det nog vara lämpligt att använda sig
av lite bilder. Ta en titt nedan, förklaring följer efteråt.</p>





<h4>Ramverket som ett UML-diagram</h4>

<img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/UpMvc_uml.png" class="center" width="499" height="507" alt="UML-diagram över Up MVC&apos;s kärna" />

<p>Här ser vi att det är service containern (UpMvc\Container) som är ramverkets hjärta. Containern
kan skapa upp och lagra instanser av alla de viktigaste objekten som du och systemet behöver.</p>

<p>Frontcontrollern (UpMvc\FrontController) till höger håller en referens till ett router-objekt (UpMvc\Router)
som tolkar URL&apos;en. När routern har gjort sitt startar frontcontrollern rätt controller (i detta exemplet
visat som App\Controller\...).</p>

<p>Controllern har nu möjlighet att via containern hämta in ett view-objekt (UpMvc\View) och fylla det
objektet med data som behövs för den aktuella sidan. Bland annat används säkert en eller flera
modeller (visat som App\Model\...) för att hämta data fråm modell-lagret. Det kan vara databaser,
filer eller sessionsvariabler m.m. I fallet med databaserna så används ett databas-objekt (UpMvc\Database)
som håller en referens av ett PDO-objekt som sköter kommunikationen med servern.</p>

<p>Alla dessa relationer mellan objekten i Up MVC håller service containern reda på, utan att man behöver lägga någon
energi på det.</p>

<p>Genom view-objektet tolkas (rendreras) slutligen dina mallar/templates i viewmappen, ersätter de
satta variablerna och skapar det slutliga dokumentet.</p>





<h4>Ramverkets manual visad i en tidlinje</h4>

<p>För att förstå vad som händer när kan vi titta på vad som egentligen sker bakom kulisserna
när till exempel denna manualen visas. Uppifrån och ner visas de filer/objekt som används i samma ordning som 
de laddas/skapas. Från vänster till höger visas livslängden för objekten. När den gula stapeln
visas så skapas objektet upp och när den avslutas så har objektet spelat ut sin roll (fast den ligger kvar
i service containern tills sidan är klar).</p>

<img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/upmvc_lifeline.png" class="center" width="515" height="253" alt="En sidas livslinje" />
<ol>
    <li>Här registrerar index-sidan autoloadern som ser till att alla klasser laddas in av systemet automatiskt.</li>
    <li>Sedan hämtar index upp en instans av service containern</li>
    <li>Till sist anropar index frontcontrollern via containern, som samtigt skapar upp routern som frontcontrollern är beroende av</li>
    <li>Nu har indexsidan lämnat över körningen helt till router/frontcontroller som läser in rätt controller baserat på din URL. En referens till samtliga objekt finns hela tiden i service containern</li>
    <li>Controllern hämtar in det viktiga viewobjektet</li>
    <li>Och så hämtas även modellen model_Lipsum in (som innehåller lite exempeldata som visats här i dokumentationen)</li>
    <li>Controllern hämtar data från modellen och lagrar den i view-objektet</li>
    <li>Controllern säger till view att rendrera själva innehållet på sidan, denna manualen</li>
    <li>Och så rendrerar controllern layouten och därmed är den kompletta sidan klar</li>
    <li>Och till sist så skrivs det kompletta dokumentet ut och visas i webbläsaren</li>
</ol>

<p>Det är inget som kan förklara ett system som lite bilder. Det stämmer verkligen som man säger 
att en bild kan säga mer än tusen ord.</p>
