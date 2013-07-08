<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.6
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>

<h3>Model-lagret</h3>

<p>Modellerna utgör ditt data-lager, där du uppdaterar och hämtar data från exempelvis en databas,
sessionsvariabler, xml, textfiler. Du anropar din model från controllern och använder den som vilket
objekt som helst. Det viktiga i din model är gränssnittet, hur du använder den. Det som sker bakom
kulisserna i model ska vara dolt för controllern.</p>

<p>Dina modeller ska framförallt syssla med ren data. Hur du använder datan behöver inte modellen
veta, den ska bara leverera relevant data som controllern ber om, eller manipulera och uppdatera
data om controllern ber om det. Controllern i sin tur behöver inte veta hur datan lagras eller
uppdateras, den är bara intresserad av hur du ber om den, dvs. gränssnittet.</p>

<p>Se modellen som ett gränssnitt mot din
data, en byrå med olika lådor och fack för olika typer av data och modellen är den som öppnar,
sorterar, lägger nya saker och ger dig information om vad som finns där.</p>

<p>En controller är precis som dina controllers en vanlig klass som du definerar upp själv.
Klassnamnet i din model sätter du själv till ett passande namn, du sparar filen med samma namn
plus filändelse i mappen <code>App/Model/</code>. Namespace blir samma som mappen, dvs
<code>App\Model.</code>

<p>En model för att hantera poster i en databas, tex i en gästbok, kan se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Model/Post.php</span>
namespace App\Model;
use UpMvc;

class Post
{
    <span class="comment">// Metod för att hämta alla inlägg</span>
    public function getAll() {}

    <span class="comment">// Metod för att hämta ett inlägg</span>
    public function get() {}

    <span class="comment">// Metod för att spara ett nytt inlägg</span>
    public function insert() {}

    <span class="comment">// Metod för att uppdatera ett inlägg</span>
    public function update() {}
}
</pre>

<p>I modellen definerar du upp de metoder du har nytta av för att hämta och spara
data i ex. en databas. Det är upp till dig att avgöra vad du behöver och inte behöver,
Up MVC drar inga slutsatser själv.</p>

<p>I vårt lilla exempel har jag definerat upp metoder<br />
för att hämta alla inlägg - <code>getAll()</code><br />
för att hämta ett enskilt inlägg - <code>get()</code><br />
för att spara ett nytt inlägg - <code>insert()</code> och <br />
för att uppdatera ett redan befintligt - <code>update()</code>.</p>

<p>Om vi skulle titta närmare på den första av dessa metoderna. <code>getAll()</code> är den enklaste
av de fyra och skulle kunna se ut så här:</p>

<pre>
    <span class="comment">// Metod för att hämta alla inlägg</span>
    public function getAll()
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Förbered SQL-satsen</span>
        $c-&gt;database-&gt;prepare(&apos;
            SELECT id, date, message, author
            FROM guestbook
            ORDER BY date ASC
        &apos;);
        
        <span class="comment">// Utför SQL-frågan</span>
        $c-&gt;database-&gt;execute();
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>

<p>I dina modeller har du åtkomst till databasen via ett gränssnitt mot PDO genom
service containern och <code>$c-&gt;database</code> och metoderna <code>prepare(), execute(), fetchAll</code>
och <code>lastInsertId()</code>. Läs mer på php.net om PDO&apos;s funktioner med samma namn
för att förstå hur Up MVC&apos;s databas-funktioner fungerar.</p>

<p><code>$c-&gt;database-&gt;prepare()</code> tar ett argument, en sträng med din SQL-sats. Vid en enkel
select som denna är det inte svårare än sådär, men om du behöver använda variabler så
kommer du att utnyttja sk. placeholders. Vi kommer in på det i nästa metod.</p>

<p><code>$c-&gt;database-&gt;execute()</code> tar ett argument, en array med placeholders.
Eftersom vi inte använder placeholders i denna SQL-satsen, så utelämnar vi bara argumentet.
När <code>execute()</code> anropas så körs frågan mot databasen.</p>

<p><code>$c-&gt;database-&gt;fetchAll()</code> använder vi till sist för att returnera
resultatet av databasfrågan i form av en associativ array.</p>

<p>Ska vi ta och titta på en metod till? För att kunna returnera ett enskilt inlägg måste vi
ställa ett villkor i SQL-satsen. Alltså dags att introducera placeholders. Se nedan:</p>

<pre>
    <span class="comment">// Metod för att hämta ett inlägg med id som argument</span>
    public function get($id)
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();

        <span class="comment">// Förbered SQL-satsen med :id som placeholder</span>
        $c-&gt;database-&gt;prepare(&apos;
            SELECT id, date, message, author
            FROM guestbook
            WHERE id = :id
            ORDER BY date ASC
        &apos;);
        
        <span class="comment">// Utför SQL-frågan och sätt värdet på placeholdern</span>
        $c-&gt;database-&gt;execute(array(&apos;:id&apos; => $id));
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>

<p>Metoden <code>get()</code> tar ett argument, id&apos;t på inlägget i databasen.
I SQL-satsen skriver vi <code>:id</code> som placeholder där variabeln ska föras in. Och slutligen,
när <code>execute()</code> kallas, så för vi in variabeln <code>$id</code> i
placeholderns ställe.</p>

<p>För att spara saker i databasen använder man också placeholders, fast då med flera än en såklart.
Låt oss ta ett sista exempel med metoden <code>insert()</code>:</p>

<pre>
    <span class="comment">// Metod för att hämta ett inlägg med id som argument</span>
    public function insert($message, $author)
    {    
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();
        
        <span class="comment">// Förbered SQL-satsen</span>
        $c-&gt;database-&gt;prepare(&apos;
            INSERT
            INTO guestbook (message, author, date)
            VALUES (:message, :author, :date)
        &apos;);
        
        $date = date(&apos;Y-m-d&apos;); <span class="comment">// Hämta datum</span>
        
        <span class="comment">// Utför SQL-frågan</span>
        $c-&gt;database-&gt;execute(array(
            &apos;:date&apos;    =&gt; $date,
            &apos;:message&apos; =&gt; $message,
            &apos;:author&apos;  =&gt; $author
        ));
        
        <span class="comment">// Returnera resultatet av SQL-frågan</span>
        return $c-&gt;database-&gt;fetchAll();
    }
</pre>





<h4>Använda &quot;method chaining&quot; med model-objekt</h4>

<p>Precis som view-objektet så tillåter model-objekt method chaining, vilket gör att du kan
få koden ett litet snäpp mer läsbar om du vill. Skillnaden med och utan ser du i exemplet nedan:</p>

<pre>
<span class="comment">// Utan method chaining</span>
$c = UpMvc\Container::get();
$c-&gt;database-&gt;prepare(&apos;SELECT * FROM post&apos;);
$c-&gt;database-&gt;execute();
return $c-&gt;database-&gt;fetchAll();
    
<span class="comment">// Med method chaining</span>
return UpMvc\Container::get()
    -&gt;database
    -&gt;prepare(&apos;SELECT * FROM post&apos;)
    -&gt;execute()
    -&gt;fetchAll();
</pre>





<h3>Använda modeller i dina controllers</h3>

<p>Så nu när du skapat dina modeller, hur ska du använda dem i dina controllers? Det hela
är mycket enkelt.</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Controller/Guestbook.php</span>
namespace App\Controller;
use UpMvc;

class Guestbook
{
    <span class="comment">// Show-action med id som argument</span>
    public function show($id)
    {
        <span class="comment">// Hämta service-containern</span>
        $c = UpMvc\Container::get();

        <span class="comment">// Skapa en instans av din model</span>
        $postmodel = new App\Model\Post();

        <span class="comment">// Hämta posten med ett givet id</span>
        $post = $postmodel-&gt;get($id);

        <span class="comment">// Lagra post-array som variabel i view</span>
        $c-&gt;view-&gt;set(&apos;post&apos;, $post);
        
        <span class="comment">// ... Sätt ytterligare variabler och rendrera layout ...</span>
    }
}
</pre>

<p>För att visa denna posten så skulle du använda följade route i 
din URL: <code>/Post/show/10</code>, där <code>10</code> såklart är id på den posten
du vill visa.</p>





<h3>Exempelmodel - &quot;Lipsum&quot;</h3>

<p>Stycket efter detta (en lorem ipsum-text), kommer direkt från datalagret:</p>

<p><?php echo $lipsum ?></p>

<p>För att hämta data (i detta fallet en sträng) i en controller, från modellen och lagra i view,
så skriver du:</p>

<pre>
<span class="comment">// Skapa objekt, hämta data och lagra till view</span>
$lipsum = new UpMvc\Model\Lipsum();
$c-&gt;view-&gt;set(&apos;lipsum&apos;, $lipsum-&gt;get());
</pre>

<p>Och för att sedan skriva ut i mallen använder du så:</p>

<pre>
&lt;?php echo $lipsum ?&gt;
</pre>

<p>Modellen ser ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// Fil: UpMvc/Model/Lipsum.php</span>
namespace UpMvc\Model;

class Lipsum
{
    public function get()
    {
        $output = "
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Ut enim ad minim veniam, quis nostrud exercitation
            ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit
            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
            occaecat cupidatat non proident, sunt in culpa qui officia
            deserunt mollit anim id est laborum.
        ";
        return $output;
    }
}
</pre>

<p>Observera att denna exempelmodellen (och denna manual) ligger i mappen <code>UpMvc/Model</code> och inte
<code>App/Model</code> som är brukligt för användare. Den får därför också en namespace som återspeglar
det faktum. Detta är ju bara ett exempel för användning i manualen. Du skulle sparat din model som
i <code>App/Model/Lipsum.php</code> och använt namespace <code>App\Model</code>.
</p>

<p>Solklart! Inte sant? :)</p>

<div class="note">
    <p>Tänk på att det kan vara en potentiell säkerhetsrisk att skriva ut data direkt från modellen
    i din mall. Där kan ju finnas kod (JavaScript, HTML, m.m.) i strängen som skrivs ut fast du inte
    alls menar det. Risken är uppenbar ifall det inte är du själv som lagrar den (tex. en gästbok). Det
    är ditt ansvar att se till att strängen är säker för utskrift. Up MVC kan inte hjälpa till,
    för den vet inte om du har för avsikt att skriva ut ex. HTML-kod eller inte.</p>
</div>
