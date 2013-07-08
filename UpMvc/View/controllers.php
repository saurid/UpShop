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

<h3>Controllers, actions och routing</h3>

<p>En controller är egentligen en vanlig klass som du definerar upp själv. Men vad ska den
användas till? Controller-lagret är oftast det som är svårast att greppa med ett MVC-mönster
och därför också svårast att förklara. För att göra ett försök känner jag att jag måste blanda in
ytterligare ett begrepp - Routing.</p>

<p>Routing används för att beskriva det sätt som ett MVC öppnar och kör dina
controllers och routingen i Up MVC bestäms enbart med hjälp av adressen i din webbläsare.
Om vi förutsätter att du använder standardinstallationen av Up MVC i din lokala webbserver och läser
detta, så står det förmodligen följande adress i din webbläsare:</p>

<p><code>http//localhost/Up-MVC/</code></p>

<p>Skulle du lägga en route till adressen kan den se ut på detta viset:</p>

<p><code>http//localhost/Up-MVC/Post</code></p>

<p>Om du kör denna adressen i Up MVC kommer systemet att försöka öppna motsvarande controller-fil
(Post) och skapa en instans av klassen. Ramverket använder namespaces, som följer namnet på den mapp
som klasserna ligger i. Så du sparar filen med namn <code>Post.php</code> i mappen
<code>App/Controller/</code>. Klassnamnet blir <code>Post</code> och namespace blir
samma som mappen <code>App\Controller</code>

<p>Så den controller som körs vid URL&apos; ovan
ska se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Actions</span>
}
</pre>

<p>Om du sparar den controllern och öppnar URL&apos;n så kommer du att märka att
det fortfarande saknas något, eftersom ett felmeddelande kommer att visas. Det som
saknas är en action i din controller. En action är den metod som kommer att köras
baserat på URL&apos;en.<p>

<p>Default-action har namnet <code>index()</code>. Om du inte anger något efter post i routen,
så är det den metoden som kommer att köras. Exempel:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Default-action</span>
    public function index()
    {
        echo &apos;Utskrift från post-controllerns default-action&apos;;
    }
}
</pre>

<p>Om du återigen sparar och uppdaterar webbläsaren så borde felmeddelandet försvinna
och meddelandet i koden ovan kommer att skrivas ut.</p>

<p>Även controllers har ett default-värde, precis som den action som körs i controllern.
Default-kontrollern har samma namn som default-action - <code>index</code>. Controllern/action som körs
när denna dokumentationen visas, är således:</p>

<pre>
&lt;?php
<span class="comment">// Default-controller (index), fil: App/Controller/index.php</span>
namespace App\Controller;
use UpMvc;

class Index
{
    <span class="comment">// Default-action</span>
    public function index() {}
}
</pre>

<p>En controller innehåller vanligtvis flera än en action, så hur anropar du olika actions i
samma kontroller? Återigen riktar vi vår uppmärksamhet till routingen i webbläsarens URL. För
att anropa controllern post och action show så skriver du in följande URL:</p>

<p><code>http//localhost/Up-MVC/Post/show</code></p>

<p>Och controllern ska se ut på detta viset:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// show-action</span>
    public function show() {}
}
</pre>

<p>Genom URL&apos;n kan du alltså välja vilken kod som ska köras och du organiserar den koden
i olika controllers och actions. Tänk på dem som olika kommandon som du använder för att 
uppnå olika resultat på din webbplats.</p>

<p>Genom att använda följade URL:</p>

<p><code>http//localhost/Up-MVC/Post/delete</code></p>

<p>Så kommer samma controller att köras, men med en annan action. Controllern kan då se ut
som följande:</p>

<pre>
&lt;?php
<span class="comment">// post-controller, fil: App/Controller/Post.php</span>
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// show-action</span>
    public function show()
    {
        <span class="comment">// Kod för att visa något</span>
    }
    
    <span class="comment">// delete-action</span>
    public function delete()
    {
        <span class="comment">// Kod för att radera något</span>
    }
}
</pre>





<h3>Actions och parametrar</h3>

<p>För att dina controllers/actions ska bli riktigt användbara och flexibla, så krävs det att
du har möjligheten att skicka med parametrar till dem. Du kan i teorin skicka med hur många
parametrar som helst genom att återigen helt enkelt använda routingen i URL&apos;n:</p>

<p><code>http//localhost/Up-MVC/Post/show/10</code></p>

<p>Här skickar vi alltså med värdet 10 med URL&apos;n. För att sedan fånga upp detta värdet
som argument till din action gör du som följande:</p>

<pre>
&lt;?php
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Ta emot parametern som argumentet $id</span>
    public function show($id)
    {
        <span class="comment">// Skriv ut argumentet, dvs 10:</span>
        echo $id;
    }
}
</pre>

<p>Parametrarna i din URL skickas alltså in i din action som ett argument. Här kommer ett annat exempel:</p>

<p><code>http//localhost/Up-MVC/Post/show/2011/10/01</code></p>

<p>I routen ovan så kan du alltså nå parametrarna i din action genom följande:</p>

<pre>
&lt;?php
namespace App\Controller;
use UpMvc;

class Post
{
    <span class="comment">// Ta emot parametrarna som argument</span>
    public function show($year, $month, $date)
    {
        <span class="comment">// Skriver ut det kompletta datumet (2011-10-01) från argumenten</span>
        echo &quot;$year-$month-$date&quot;; 
    }
}
</pre>

<p>Om du utelämnar en parameter i URL&apos;n så kommer du att sakna ett argument i metodanropet och
PHP kommer att generera ett fel, precis som vanligt. Så om du vill ha den möjligheten så behöver du
ange standard-värden till argumenten:</p>

<pre>
    <span class="comment">// Sätt defaultvärden för att kunna utelämna paramerar i URL&apos;n</span>
    public function show($year = '2012', $month = '01', $date = '14')
</pre>

<p>Inte så logiskt att använda defaultvärden med datum kanske, men man kan tänka sig att sätta dem
till false och ge mer kontrollerade felmeddelanden i controllern som visar att argumenten
inte får utelämnas. Detta för att undvika ett PHP fatal error.</p>

<div class="note">
    <p>Lägg märke till att du inte kan utelämna defaultcontroller, eller defaultaction
    i routen om du har behov av att använda parametrar. I såfall skulle Up MVC misstolka
    dina parametrar som en Controller/action. Men i praktiken brukar det inte vara svårt att
    undvika parametrar i defaultactions.</p>
</div>

<p>Nu har du förhoppningsvis lärt dig hur routingen fungerar och hur den används för att styra
vilken controller och action som körs, samt hur du skickar med parametrar.</p>

<p>Up MVC använder en sk. front controller tillsammans med en .htacess-fil och rewrite rules
för att uppnå denna funktionaliteten. Lek helst runt lite med olika URL&apos;er och se så att
Up MVC gör vad du förväntar att den ska göra, så att du är helt bekväm med hur det fungerar
innan du fortsätter.</p>
