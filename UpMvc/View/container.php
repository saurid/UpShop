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

<h3>Servicecontainern</h3>

<p>Du har redan sett flera exempel på hur containern används i Up MVC och den är en viktig
del av ramverket. En Dependency Injection Container gör att alla klasser och objekt kan
optimeras efter best practice, samtidigt som skapandet (instansieringen) av dem kan
göras enkel. Du skapar och hämtar dem genom ett enkelt metodanrop, men du behöver inte veta
hur de skapas (beroenden av andra objekt eller variabler t.ex.), det håller containern reda på.</p>

<p>Objekten skapas bara upp när de först anropas, så inga objekt laddas/skapas upp i onödan
(s.k. lazy loading). Containern lagrar dessutom instanser av varje objekt, vilket gör att endast
ett objekt av varje typ finns aktivt i systemet samtidigt. Varje gång du använder ett objekt som
är lagrad i containern så är det exakt samma oavsett varifrån du anropar den.</p>

<p>Det finns ett gäng fördefinierade metoder som används för att nå ramverkets kärna. De är:</p>

<pre>
<span class="comment">// Hämta en instans av containern</span>
$c = UpMvc\Container::get();

<span class="comment">// Lagra eller skriv över egna variabler</span>
<span class="comment">// (Använder den magiska metoden __set())</span>
$c-&gt;nyckel  = &apos;värde&apos;;
$c-&gt;nyckel2 = &apos;ett annat värde&apos;;

<span class="comment">// Använd egna variabler</span>
<span class="comment">// (Använder den magiska metoden __get())</span>
echo($c-&gt;nyckel);    <span class="comment">// Skriver ut &quot;värde&quot;</span>
echo($c-&gt;nyckel2);   <span class="comment">// Skriver ut &quot;ett annat värde&quot;</span>

<span class="comment">// Fördefinerade variabler</span>
$c-&gt;site_path;       <span class="comment">// Sökväg till ramverket</span>
$c-&gt;database;        <span class="comment">// UpMvc\Database object</span>
$c-&gt;form;            <span class="comment">// UpMvc\Form object</span>
$c-&gt;pdo;             <span class="comment">// PDO object</span>
$c-&gt;pagination;      <span class="comment">// UpMvc\Pagination object</span>
$c-&gt;request;         <span class="comment">// UpMvc\Request object</span>
$c-&gt;view;            <span class="comment">// UpMvc\View object</span>
</pre>

<div class="note">
    <p>Var försiktig med de fördefinerade variablerna - Det finns i skrivande
    stund inget som hindrar att du skriver över dem med annat. Det kan därför 
    vara en bra idé att använda ett prefix till dina egna variabler som du
    lagrar i containern.</p>
</div>

<p>Du kan lagra allt från enkla siffror eller strängar, till stora arrays eller
komplicerade objekt. Nyckeln måste vara ett giltigt variabelnamn, om inte så kommer Up MVC
att generera ett felmeddelande.</p>

<p>Nästan alla dessa variabler använder du för att hämta objekt från ramverkets kärna.
Av dem är <code>pdo</code> lite annorlunda, eftersom den innehåller en instans av ett
standardobjekt i PHP och <code>site_path</code> som är en vanlig enkel sträng.
Det är sällan du behöver använda pdo-objektet dock, oftast kommer du att använda
den genom database-objektet som använder pdo internt.</p>

<p>Du har kanske lagt märke till i tidigare exempel att du inte behövt använda paranteserna
när du använder metoderna (som om du istället hämtar en publik objektegenskap)?
Det beror på att containern implementerat en lösning med den magiska
php-metoden <code>__get()</code>.</p>
