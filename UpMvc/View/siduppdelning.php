<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>

<h3>Siduppdelning / Pagination</h3>

<p>Pagination använder du när du behöver dela upp större mängder data på flera
sidor. Istället för att visa allt på en gång delar du helt enkelt upp det på
ett antal sidor, med länkar för att hoppa till respektive sida.</p>

<p>För att kunna räkna ut hur många sidor din data ska delas upp på så krävs
ett två variabler; Det totala antalet poster som datan som ska visas innehåller,
samt hur många poster som ska visas per sida. Genom att dividera antal poster
med poster per sida och avrundar uppåt så får du antalet sidor som ska
visas. Detta kan såklart klassen <code>UpMvc\Pagination</code> hjälpa dig
med.</p>

<p>För att sedan kunna generera ett antal länkar behöver scriptet också
veta på vilken sida du befinner dig på för tillfället (för att denna ska
vara markerad och ej klickbar).</p>

<p>Begrunda exemplet nedan:</p>

<pre>
$total   = 99; <span class="comment">// Totalt antal poster</span>
$current = 1;  <span class="comment">// Aktuell sida</span>
$per     = 20; <span class="comment">// Poster/sida</span>

<span class="comment">// Skapa instans av paginationobjekt</span>
$page = new UpMvc\Pagination($total, $current, $per);

<span class="comment">// Skriv ut navigation som HTML</span>
echo $page-&gt;getNav();
</pre>

<p>Här definerar vi de variabler vi behöver i tur och ordning för att skapa ett
pagination-objekt med <code>new</code>. De två första går inte att tulla på, men
det tredje argumtentet har ett standardvärde på 10 om du väljer att utelämna
det.</p>

<p>Efter att objektet är instansierat så anropar vi metoden
<code>getNav()</code> och skriver ut den med echo. Utskriften som då
genereras kommer att se ut som den nedan:</p>

<pre>
<span class="comment">&lt;!-- Genererad HTML-kod --&gt;</span>
&lt;nav class="UpMvc_Pagination"&gt;
    &lt;ul&gt;
        &lt;li class="UpMvc_Page_Current"&gt;1&lt;/li&gt;
        &lt;li class="UpMvc_Page"&gt;&lt;a href="?page=2"&gt;2&lt;/a&gt;&lt;/li&gt;
        &lt;li class="UpMvc_Page"&gt;&lt;a href="?page=3"&gt;3&lt;/a&gt;&lt;/li&gt;
        &lt;li class="UpMvc_Page"&gt;&lt;a href="?page=4"&gt;4&lt;/a&gt;&lt;/li&gt;
        &lt;li class="UpMvc_Page"&gt;&lt;a href="?page=5"&gt;5&lt;/a&gt;&lt;/li&gt;

        &lt;li class="UpMvc_Page_Next"&gt;&lt;a href="?page=2"&gt;Framåt &rsaquo;&lt;/a&gt;&lt;/li&gt;
        &lt;li class="UpMvc_Page_Last"&gt;&lt;a href="?page=5"&gt;Sista &raquo;&lt;/a&gt;&lt;/li&gt;

        &lt;li class="UpMvc_Page_Sum"&gt;&lt;small&gt;Visar 1 - 20 av 99 poster&lt;/small&gt;&lt;/li&gt;
    &lt;/ul&gt;
&lt;/nav&gt;
</pre>

<p>Helt enkelt en enkel rad med länkar varav den aktuella sidan inte
är klickbar, medan de andra är det. För att markera vilken sida som vi för
tillfället är inne på, används URL-variabeln <code>page</code>. Det är alltså
den variabeln som ska läggas in som andra argument när du skapar objektet
<code>UpMvc\Pagination</code>.</p>

<p>Ett mer realistiskt exempel följer:</p>

<pre>
<span class="comment">// Exempel:</span>
<span class="comment">// Hämta totalt antal poster från din modell och lagra i variabel</span>
$postmodel = new App\Model\Post();
$total     = $postmodel-&gt;getCount();

<span class="comment">// Hämta vald sida från URL med hjälp av request-objektet</span>
<span class="comment">// Om ingen sida är vald, sätts 1 som standard</span>
$current = $c-&gt;request-&gt;get('page', 1);

<span class="comment">// Skapa instans och skriv ut navigation</span>
<span class="comment">// Om tredje argumentet (per/sida) utelämnas, sätts 10 som standard</span>
$page = new UpMvc\Pagination($total, $current);
echo $page-&gt;getNav();
</pre>

<p>Börja med att sätta upp din model (<code>App\Model\Post()</code>) så att du
kan hämta totalt antal poster från det urval du ska visa på sidan (<code>getCount()</code>).</p>

<p>För att hämta vald sida kan du använda ramverkets inbyggda request-objekt.
Genom att anropa metoden <code>$c-&gt;request-&gt;get('page', 1)</code> så
hämtar du den globala variabeln <code>$_GET[&apos;page&apos;]</code> om
den är satt, annars returnerar metoden 1 (ett).</p>

<p>Titta på tabellen nedan. Där har jag satt upp exempeldata för att
illustrera vad som händer, och vilka metoder du kan ha nytta av i 
<code>UpMvc\Pagination</code>. Tabellen motsvarar ett uppsatt objekt
med koden:</p>

<pre>
new UpMvc\Pagination(99, $c-&gt;request-&gt;get('page', 1), 20);
</pre>

<p>Faktum är att du kan klicka på länkarna i tabellen för att se
exakt vad som förändras i det som returneras när olika sidor är valda!</p>

<table>
    <tr>
        <th>metod</th>
        <th>returnerar</th>
        <th>beskrivning</th>
    </tr>
    <tr>
        <td><code>getTotal()</code></td>
        <td><?php echo $page->getTotal() ?></td>
        <td>Totalt antal poster</td>
    </tr>
    <tr>
        <td><code>getCurrent()</code></td>
        <td><?php echo $page->getCurrent() ?></td>
        <td>Aktuell/vald sida</td>
    </tr>
    <tr>
        <td><code>getPer()</code></td>
        <td><?php echo $page->getPer() ?></td>
        <td>Antal poster per sida</td>
    </tr>
    <tr>
        <td><code>getLimit()</code></td>
        <td><?php echo $page->getLimit() ?></td>
        <td>Limit-värde för SQL (samma som ovan)</td>
    </tr>
    <tr>
        <td><code>getOffset()</code></td>
        <td><?php echo $page->getOffset() ?></td>
        <td>Offset-värde för SQL</td>
    </tr>
    <tr>
        <td><code>getPages()</code></td>
        <td><?php echo $page->getPages() ?></td>
        <td>Totalt antal sidor</td>
    </tr>
    <tr>
        <td><code>getSqlLimit()</code></td>
        <td><?php echo $page->getSqlLimit() ?></td>
        <td>Komplett SQL-sträng med limit/offset</td>
    </tr>
    <tr>
        <td><code>getNav()</code></td>
        <td><?php echo $page->getNav() ?></td>
        <td>Sträng med HTML-navigation</td>
    </tr>
</table>

<p>Genom dessa metoderna kan du nu använda pagination-objektet för att skapa
lämpliga anrop från controller till model för att göra rätt urval av data
ur databasen.</p>

<div class="note">
    <p>Tänk på att <code>getSqlLimit()</code> returnerar en sträng. Om du använder
    PDO (vilket ramverkets databas-klass gör) med prepared statements och
    placeholder, så kommer PDO att sätta apostrofer runt strängen och 
    därmed förstöra SQL-satsens syntax.
    <br />
    <br />
    Så antingen använder du inte placeholder i SQL-satsen (utan för in strängen
    direkt), eller så använder du <code>getLimit()</code> och
    <code>getOffset()</code> istället, som båda returnerar siffror.</p>
</div>

<p>Ett förslag att fundera över är att du kan välja att skicka med ett
pagination-objekt som argument till din model. Då får du lätt åtkomst till alla
metoder du behöver för att skapa din siduppdelade SQL-fråga. Det kan vara
lättare i vissa fall, men en överdrift i andra.</p>
