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

<h3>Requestobjektet</h3>

<p><code>UpMvc\Request</code> är en klass som är en enkel wrapper runt PHP&apos;s globala variabel
$_REQUEST. <code>UpMvc\Request</code> kan vara bra att använda istället för $_REQUEST då
den alltid returnerar något. Om variabeln inte finns i $_REQUEST så genererar PHP ett felmeddelande,
men <code>UpMvc\Request</code> returnerar en tom sträng.</p>

<p>Så varför är detta bra? Jo, det kan vara ett bra sätt att tex. återpopulera formulärfält
med POST-, eller GET-data. Om formuläret ännu inte är postat, så behöver man inte ställa
några villkor för att kontrollera om variablerna finns för att använda dem.</p>

<p>Du når objektet som vanligt genom service containern. Objektet har en enda metod,
<code>get()</code>, som du använder för att returnera dina REQUEST-variabler:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Skriver ut värdet i $_REQUEST[&apos;variabel&apos;]
// Om variabeln inte är satt returneras en tom sträng</span>
echo $c-&gt;request-&gt;get(&apos;variabel&apos;);
</pre>

<p>Om du inte nöjer dig med en tom sträng om nyckeln inte finns, utan
har behov av att något annat returneras, så kan du utnyttja get-metodens andra argument:</p>

<pre>
<span class="comment">// Om variabeln inte är satt returneras strängen i andra argumentet: &quot;Defaultsträng&quot;</span>
echo $c-&gt;request-&gt;get(&apos;variabel&apos;, &apos;Defaultsträng&apos;);
</pre>
