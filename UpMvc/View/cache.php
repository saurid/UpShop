<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.10
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>

<h3>Cachning av information</h3>

<p>Up MVC&apos;s cachningsfunktion är enkel och liten, men naggande god. Den består
av en enda klass som du använder för att kontrollera om en lagrad cache
finns, och är så aktuell som du vill att den ska vara, för ett givet id.
Om cache finns kan du välja att skriva ut den, om  den inte finns skapar du ett
nytt innehåll och lagrar den i cachen istället.</p>

<p>För att skapa en instans av cacheklassen skriver du följande:</p>

<pre>
<span class="comment">// Skapa ett cacheobjekt</span>
$cache = new UpMvc\Cache($id, $mapp);
</pre>

<p>Första argumentet är det id du vill använda för att lagra cachen med. Samma
id använder du sedan för att hämta eventuell cache igen. Andra argumentet är
den mapp i systemet där du vill lagra informationen som filer, relativt till
Cache-klassen.</p>

<p>Båda argumenten kan utelämnas. Om det görs så sätts mappen till
<code>Cache</code> och om den inte redan finns så skapas den av skriptet.
Id skapas efter aktuell URL enligt följande:</p>

<pre>
$key = md5(
    $_SERVER['SERVER_PROTOCOL'] .
    $_SERVER['REQUEST_METHOD'] .
    $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI']
);
</pre>

<p>All denna information tillsammans i en sträng gör att det är rimligt att
anta att det är ett hyffsat unikt id för URL&apos;en som ska cachas. Slutligen
skapas en md5-hash av strängen som används som filnamn för cachen.</p>

<div class="note">
    <p>Var försiktig med vad du cachar och med vilket id det sker. Risken
    finns annars att du visar känsligt innehåll som cachats av administratörer
    för vanliga användare. Du kan med olika villkor behöva se till att
    cachen är helt säker och verkligen innehåller det du vill ska visas.
    Ett sätt är att aldrig använda cachen så länge admin är inloggade.</p>
</div>

<p>Om du har behov av att sätta andra argumentet, cachemappen, men vill
behålla standard-id så sätter du första argumentet till <code>false</code> enligt:</p>

<pre>
$cache = new UpMvc\Cache(false, 'DinCacheMapp');
</pre>

<p>För att hämta data ur cachen använder du metoden
<code>$cache-&gt;get($sekunder)</code>. Den returnerar datan om den finns och
är aktuell, om inte så returnerar den false. Om du utelämnar argumentet, dvs
antal sekunder cachen ska gälla, så sätts den som default till 3600 sek, dvs
en timme.</p>

<p>Eftersom metoden returnerar informationen eller false, så kan du lagra
uppgifterna i en variabel samtidigt som du testar den med ett villkor:</p>

<pre>
<span class="comment">// Kontrollera om det finns aktuell cachad data</span>
if ($data = $cache-&gt;get()) {
    <span class="comment">// Skriv ut cachat innehåll</span>
    echo $data;
}
</pre>

<p>För att spara data i cachen så använder du dig av metoden 
<code>$cache-&gt;set($output)</code> där argumentet är en sträng med innehållet
du ska lagra. Metoden returnerar samma data som du skickat med som argument,
vilket gör det möjligt att skriva ut informationen samtidigt som du sparar den.</p>

<pre>
<span class="comment">// Spara data i cachen</span>
$cache-&gt;set($output);

<span class="comment">// Eller skriv ut samtidigt som den sparas</span>
echo $cache-&gt;set($output);
</pre>

<p>Allt vi gått igenom ger oss då en slutlig och komplett kod som visar
hur cache-klassen kan användas. Den skapar ett cache-objekt med standard-id
och standard-mapp, kontrollerar om det finns en giltig cache (max en timme
gammal, dvs standard) sparad. Om den finns skrivs den ut, annars skapar vi upp
ett nytt innehåll och sparar/skriver ut den nya datan.</p>

<pre>
<span class="comment">// Skapa ett cacheobjekt</span>
$cache = new UpMvc\Cache();

<span class="comment">// Kontrollera om det finns aktuell cachad data</span>
if ($data = $cache-&gt;get()) {
    <span class="comment">// Skriv ut cachat innehåll</span>
    echo $data;
}
else {
    <span class="comment">// Skapa nytt innehåll i $output-variabeln</span>
    $output = 'Innehåll som ska cachas';

    <span class="comment">// Skriv ut samtidigt som den lagras i cachen</span>
    echo $cache-&gt;set($output);
}
</pre>

<p>Raden där innehållet i <code>$output</code> skapas är såklart starkt
förenklad i exempelkoden! Varför skulle du vilja cacha en så enkel sträng?
I en vanlig webbapplikation innehåller strängen stora delar genererad HTML-kod
baserad på en eller flera databasfrågor mm. Allt det du vill bespara
servern under tiden som cachen är giltig.</p>