<?php
/**
 * HTML-dokumentationen för Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.7
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>

<h3>Rättigheter, grupper och roller</h3>

<p>Up MVC innehåller en mycket litet, men flexibelt rättighetssystem, 
<code>UpMvc\Role</code>. Det bygger på att du sätter upp grupper av
objektet som du sedan sätter olika roller till.</p>

<p>Grupper kan vara tex användare eller administratörer. Roller kan vara läsa,
skriva eller radera. En grupp av roller kan även ärva en annan, vilket gör att
du kan sätta upp trädliknande rättigheter i ditt system.</p>

<p>Du använder samma typ av objekt för att skapa både grupper och roller,
men det är upp till dig att avgöra hur du ska använda dig av grupperna. Mer
om detta längre ner.</p>

<p>Dina roller sätter du lämpligen upp i en model som du kan anropa i
alla controllers där du behöver göra någon form av kontroll av rättigheter.
Låt oss bygga upp ett exempel:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Model/Permission.php</span>
namespace App\Model;
use UpMvc;

class Permission
{
    <span class="comment">// Variabel där du lagrar dina grupper</span>
    private $group;
}
</pre>

<p>Modellen sparar du i <code>App/Model</code> som vanligt och jag har valt att kalla
den <code>Permission</code>. Alltså filen <code>App/Model/Permission.php</code>.
Namespace anges till <code>App\Model</code> och sätt <code>use UpMvc</code> för
att kunna använda ramverkets objekt.</p>

<p>I modellen behöver du en medlemsvariabel där du lagrar dina olika grupper, i
exemplet är det den privata variabeln <code>$group</code>.</p>

<p>Vi fortsätter:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Model/Permission.php</span>
namespace App\Model;
use UpMvc;

class Permission
{
    private $group;

    <span class="comment">// Konstruktor</span>
    public function __construct()
    {
        <span class="comment">// Sätt upp grupperna visitor, editor och administrator</span>
        $this-&gt;group[&apos;visitor&apos;]       = new UpMvc\Role(&apos;visitor&apos;);
        $this-&gt;group[&apos;editor&apos;]        = new UpMvc\Role(&apos;editor&apos;);
        $this-&gt;group[&apos;administrator&apos;] = new UpMvc\Role(&apos;administrator&apos;);
    }
}
</pre>

<p>Nu skapar vi en konstruktor där var och en av grupperna vi behöver definieras
och lagras i <code>$this-&gt;group</code> som en array. Följande kod:</p>

<pre>
$this-&gt;group[&apos;visitor&apos;] = new UpMvc\Role(&apos;visitor&apos;);
</pre>

<p>... sätter alltså upp en grupp, visitor, genom att skapa ett objekt av
typen <code>UpMvc\Role</code> med argumentet visitor för att sätta id.
Detsamma görs sedan så klart med de andra grupperna du behöver i din
applikation.</p>

<p>Nu är det dags att sätta roller till dina grupper:</p>

<pre>
&lt;?php
<span class="comment">// Fil: App/Model/Permission.php</span>
namespace App\Model;
use UpMvc;

class Permission
{
    private $group;

    public function __construct()
    {
        $this-&gt;group[&apos;visitor&apos;]       = new UpMvc\Role(&apos;visitor&apos;);
        $this-&gt;group[&apos;editor&apos;]        = new UpMvc\Role(&apos;editor&apos;);
        $this-&gt;group[&apos;administrator&apos;] = new UpMvc\Role(&apos;administrator&apos;);

        <span class="comment">// Sätt rättigheter/roller för gruppen visistor</span>
        $this-&gt;group[&apos;visitor&apos;]
            -&gt;set(new UpMvc\Role(&apos;read public&apos;))
            -&gt;set(new UpMvc\Role(&apos;create topic&apos;))
            -&gt;set(new UpMvc\Role(&apos;create user&apos;));

        <span class="comment">// editor, ärver visitor genom att lägga till gruppen visitor med set()</span>
        $this-&gt;group[&apos;editor&apos;]
            -&gt;set(new UpMvc\Role(&apos;read private&apos;))
            -&gt;set(new UpMvc\Role(&apos;create category&apos;))
            -&gt;set(new UpMvc\Role(&apos;change user&apos;))
            -&gt;set($this-&gt;group[&apos;visitor&apos;]); <span class="comment">// ärver visitor</span>

        <span class="comment">// administrator, ärver editor och därmed även visitor</span>
        $this-&gt;group[&apos;administrator&apos;]
            -&gt;set(new UpMvc\Role(&apos;delete user&apos;))
            -&gt;set(new UpMvc\Role(&apos;delete category&apos;))
            -&gt;set($this-&gt;group[&apos;editor&apos;]); <span class="comment">// ärver editor</span>
    }
}
</pre>

<p>För att ge dina grupper roller använder du metoden <code>set()</code>. för
att lagra ytterligare namngivna Role-objekt. Koden:</p> 

<pre>$this-&gt;group[&apos;visitor&apos;]-&gt;set(new UpMvc\Role(&apos;read public&apos;));</pre>

<p>... Sätter alltså en ny roll, read public, till gruppen visitor. Med andra ord
är read public en av visitors roller. Så om du i din applikation ska kontrollera
vilka som har rättigheter att läsa publika poster (read public), så har du nu
sagt att besökare (visitor) får göra just det.</p>

<p>Vi fortsätter på samma sätt att sätta roller till de olika grupperna.</p>

<p>Visitor-gruppen får förutom read public, även rollerna create topic och
create user. Editor-gruppen får rollerna read private, create category och
change user. Administratior-gruppen får delete user och delete catgory.</p>

<p>SKulle vi endast lämna det där, så skulle inte redigerare (editors) eller
administratörer kunna läsa publika poster. Och det blir ju inte rätt. Vi 
förväntar oss (oftast) att de högra rollerna ska ha samma rättigheter
som de lägre. Så för att slippa att sätta samma roller återigen, kan vi
istället låta de högre grupperna ärva de lägre. Koden nedan gör just detta:</p>

<pre>$this-&gt;group[&apos;editor&apos;]-&gt;set($this-&gt;group[&apos;visitor&apos;]);</pre>

<p>Du låter genom detta gruppen editor (<code>$this-&gt;group[&apos;editor&apos;]</code>)
ärva visitor genom att lägga till hela visitor-gruppen
(<code>$this-&gt;group[&apos;visitor&apos;]</code>) med metoden <code>set()</code>.
Samma sak gör du sedan för att låta administrator ärva editor, och därmed så
kommer administrator att ha samtliga rättigheter i systemet.</p>

<p>Nu har du satt upp alla dina grupper klart, men du har ännu inget sätt
att kontrollera dina rättigheter. Objektet <code>UpMvc\Role</code> har ett sätt att
kontrollera om rollen är satt, antingen direkt i gruppen, eller i något
av de nedärvda rollerna genom metoden <code>has()</code>.</p>

<p>Lägg till metoden nedan till din modell:</p>

<pre>
class Permission
{
    <span class="comment">...</span>

    <span class="comment">// Kontrollera om en grupp innehåller en roll</span>
    public function check($group, $role)
    {
        return $this-&gt;group[$group]-&gt;has($role);
    }
}
</pre>

<p>Genom att anropa <code>check()</code> där första argumentet är en av grupperna
och där andra argumentet är rollen du ska testa emot, så får du svar
tillbaka om gruppen har rollen eller inte.</p>

<p>Nedan följer ett par exempel på hur du kan använda metoden:</p>

<pre>
<span class="comment">// Användaren du ska testa hör till gruppen administrator</span>
$userrole = &apos;administrator&apos;;

<span class="comment">// Skapa upp din rättighetsmodell</span>
$permission = new Model\Permission();

<span class="comment">// Testa om användaren är en administratör</span>
if ($permission-&gt;check($userrole, &apos;administrator&apos;)) {
    echo &apos;Användaren är en administratör&apos;;
}

<span class="comment">// Testa om användaren får skapa kategorier</span>
if ($permission-&gt;check($userrole, &apos;create category&apos;)) {
    echo &apos;Användaren med får skapa nya kategorier&apos;;
}
</pre>

<p>Hela klassen/modellen som vi gått igenom i detta kapitlet finns i sin
helhet som exempel i filen <code>UpMvc/Model/Permission.php</code>.
Antingen kan du testa rättigheter direkt från den modellen (för att
se hur rollerna är uppbyggda), eller så kopierar du den till ditt projekt
och byter ut din namespace (vanligtvis <code>App\Model</code>).</p>