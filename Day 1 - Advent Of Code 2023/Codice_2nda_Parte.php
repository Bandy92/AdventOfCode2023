<?php
/* Alessandro Pietracatella (ID: Bandy92), Advent Of Code 2023, Day One - Part Two. 
   Link: https://adventofcode.com/2023/day/1#part2
   Qualora il link non fosse consultabile, 
   per leggere la traccia del problema è possibile consultare il file "Traccia Day 1 - Parte 2.txt */



// Richiedo il file "input_2ndo_Step.php" (al suo interno c'è il secondo codice input2)
require 'input_2ndo_Step.php';

// Utilizzo la funzione PHP "explode" per suddividere i singoli elementi dell'array ogni volta che il testo va a capo
$arrayinput2 = explode("\n", $input2);

/* Suddivido il problema in due passaggi. Primo passaggio: 
Compongo l'array per mappare parole delle cifre con i numeri. 
Essendo pochi valori, posso inserirli a mano (altrimenti avrei pensato ad uno stratagemma).
Strategicamente impongo che i numeri dovranno riportare l'ultima lettera del numero associato,
questo perchè alcuni componenti dell'array possono sovrascrivere altri numeri. Esempio eightwo rischia
di non essere decodificato come 82, ma come 8wo. Mettendo "8t" vado a risolvere il pronlema in questa
prima fase del codice. Quindi: */
 
$mappaturaParoleCifre = array(
    "one" => "1e",
    "two" => "2o",
    "three" => "3e",
    "four" => "4r", 
    "five" => "5e", 
    "six" => "6x", 
    "seven" => "7n",
    "eight" => "8t", 
    "nine" => "9e"
);

// Creo un array per contenere le stringhe convertite
$stringheConvertite = array();

// Effettuo un ciclo foreach che mi permette di decodificare prese da "$arrayinput2"
foreach ($arrayinput2 as $stringa) {
    // Prima di iniziare rimuovo eventuali spazi bianchi
    $stringa = trim($stringa);

    // Sostituisco le parole mappate con i numeri utilizzando preg_replace_callback
    $stringaConvertita = preg_replace_callback('/(' . implode('|', array_keys($mappaturaParoleCifre)) . ')/', function ($matches) use ($mappaturaParoleCifre) {
        return $mappaturaParoleCifre[$matches[0]];
    }, $stringa);

    // Aggiungo la nuova stringa convertita all'array
    $stringheConvertite[] = $stringaConvertita;
}

/* Stampo il contenuto dell'array con le stringhe convertite per controllare se il primo passaggio è ok
   echo "<pre>";
   print_r($stringheConvertite);
   echo "</pre><br><br>"; */



// Ora inzio il secondo passaggio e ritorno alla mappatura con la logica originale
$mappaturaParoleCifre = array(
    "one" => 1,
    "two" => 2,
    "three" => 3,
    "four" => 4, 
    "five" => 5, 
    "six" => 6, 
    "seven" => 7,
    "eight" => 8, 
    "nine" => 9
);

// Creo un nuovo array per contenere le nuove stringhe
$stringheConvertiteFinale = array();

// Di nuovo eseguo un foreach per convertire le stringhe che provengono dal primo passaggio
foreach ($stringheConvertite as $stringa) {
    // Eseguo l'operazione di sostituzione tra lettere e numeri della mappatura
    $stringaConvertitaFinale = str_replace(array_keys($mappaturaParoleCifre), $mappaturaParoleCifre, $stringa);

    // Aggiungo la nuova stringa convertita al secondo array
    $stringheConvertiteFinale[] = $stringaConvertitaFinale;
}

/* Stampo il contenuto a video dell'array con le stringhe convertite dopo il secondo passaggio per verificare che sia tutto come desiderato
echo "<pre>";
print_r($stringheConvertiteFinale);
echo "</pre><br><br>"; */


// Creo un nuovo array per contenere la prima e ultima cifra
$cifrePrimaUltima = array();

// Ciclo attraverso le stringhe convertite
foreach ($stringheConvertiteFinale as $stringa) {
    // Estraggo le cifre numeriche, ma a differenza della parte 1, nel "preg_match_all" usiamo "/\d/"
    preg_match_all('/\d/', $stringa, $matches);

    // Se ci sono almeno due cifre numeriche, aggiungo il primo e l'ultimo numero all'array
    if (count($matches[0]) >= 2) {
        $cifrePrimaUltima[] = $matches[0][0] . end($matches[0]);
    } elseif (count($matches[0]) == 1) {
        // Se c'è solo una cifra numerica, concateno con se stessa (esattamente come nella parte 1)
        $cifrePrimaUltima[] = $matches[0][0] . $matches[0][0];
    }
}

/* Stampo il contenuto dell'array con le prime e le ultime cifre per controllare se sia tutto ok
echo "Contenuto di cifrePrimaUltima: ";
print_r($cifrePrimaUltima); */

// Sommo gli elementi dell'array
$risultatoFinaleConcatenato = array_sum($cifrePrimaUltima);

// Per concludere stampo il risultato finale
echo "<br><br>Risultato finale concatenato: " . $risultatoFinaleConcatenato;
?>