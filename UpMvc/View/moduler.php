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

<h3>Moduler</h3>

<p>Det är möjligt att använda Up MVC som ett modulbaserat ramverk om man så önskar. Det kräver
inte så väldigt mycket för att det ska fungera, men det finns en del saker att tänka på.</p>

<p>För att lägga till en modul skapar du en mapp med önskat namn i roten, bredvid de
befintliga mapparna <code>UpMvc/</code> och <code>App/</code>. App är faktiskt en modul även den,
men eftersom den är standardmodulen så har den ett litet annat beteende, tex behöver du aldrig ange den i
URL&apos;ens route. Den nya mappen/modulen ska precis som app innehålla mapparna <code>Controller/,
Model/</code> och <code>View/</code> (om du har behov av dem).</p>

<p>För att skapa modulen <code>Guestbook</code> ska det mao. se ut så här:</p>

<ul>
    <li class="folder">App/</li>
    <li class="folder">Guestbook/
        <ul>
            <li class="folder">Controller/</li>
            <li class="folder">Model/</li>
            <li class="folder">View/</li>
        </ul>
    </li>
    <li class="folder">UpMvc/</li>
</ul>

<p>Med controller och modeller gör du precis som du brukar, lägg dem i respektive
mapp och sätt namespace efter mappstrukturen.</p>

<p>En post-controller får i modulen klassnamnet <code>Post</code> och
namespace <code>Guestbook\Controller</code>. Modeller namnges likadant, tex.
<code>DinModell</code> respektive namespace <code>Guestbook\Model</code>.</p>

<p>Såklart sparar du dina mallar/vyer i modulens view-mapp och hämtar in dem enligt ordinarie
sökvägar, tex <code>$c-&gt;view-&gt;render(&apos;Guestbook/View/Post.php&apos;);</code>.</p>

<p>För att använda en modul i URL&apos;en, lägger du till modulens namn först i routen.
Denna dokumentationen ligger i en modul som också tjänstgör som Up MVC&apos;s systemmapp,
så genom att skriva <code>UpMvc/</code> först så hämtas standardcontroller och action i
modulen <code>UpMvc</code>. Sökvägen till manualen är i en standardinstallation således:</p>

<p><code>http://localhost/Up-MVC/UpMvc/Manual</code></p>

<p>Eller utskrivet i sin helhet:</p>

<p><code>http://localhost/Up-MVC/UpMvc/Manual/index</code></p>

<p>Alltså modul: <code>UpMvc/</code>, controller: <code>UpMvc\Controller\Manual</code> och action: <code>index()</code></p>

<div class="note">
    <p>Up MVC ser om första delen i routen är en modul genom att kontrollera om
    namnet är en mapp eller ej. Om det är en mapp, antas det vara en modul, annars antas
    det vara en controller (i app). Detta medför att du inte kan namnge en controller i app
    med samma namn som en modul, om du vill kunna köra controllern.</p>
</div>

<p>När du hämtar modeller skriver du alltid hela modellens klassnamn:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Använd en model från modulen Guestbook</span>
$postmodel = new Guestbook\Model\Post();
$post = $postmodel-&gt;getPost();

<span class="comment">// Använd en model från App</span>
$postmodel = new App\Model\Post();
$post = $postmodel-&gt;getPost();
</pre>

<p>När du hämtar och redrerar mallar (vyer) använder du även där sökvägen till modulen:</p>

<pre>
$c = UpMvc\Container::get();

<span class="comment">// Rendrera en mall från modulen Guestbook</span>
$post = $c-&gt;view-&gt;render(&apos;Guestbook/View/Post.php&apos;);

<span class="comment">// Rendrera en mall från App</span>
$post = $c-&gt;view-&gt;render(&apos;App/View/Post.php&apos;);
</pre>
