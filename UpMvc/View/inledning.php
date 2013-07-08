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

<h3>Vad är Up MVC?</h3>

<p>Up MVC är ett minimalistiskt less-is-more-ramverk för undervisningssyfte
programmerat i objektorienterat PHP och följer designmönstret HMVC.
Det är inte direkt avsett att användas i produktionsmiljöer även om det är
möjligt att göra så. Använd med omdöme, men framförallt - Lär så mycket ni kan!</p>

<h3>HMVC, vad då för nå&apos;t?</h3>

<p>HMVC är en förkortning för Hierarchical Model View Controller och är ett sk.
designmönster. MVC eller HMVC används för att separera datalager (model) och
presentationsager (view) från varandra, så att förändringar i den
ena lagret inte får så stor inverkan på det andra. Data från model
kan ändras utan att presentationen (ofta HTML) behöver ändras.</p>

<p>Controllerlagret ligger mellan view och model och är det lager som
handskas med interaktionen från användaren. Controllern kan tex hämta
data från model och skicka vidare till view som presenterar den.</p>

<p>Läs gärna mer på <a href="http://sv.wikipedia.org/wiki/Model-View-Controller">Wikipedia</a>
eller sök på MVC eller HMVC i din sökmotor för att få mer information.</p>
