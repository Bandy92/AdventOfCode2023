<?php
/* Alessandro Pietracatella (ID: Bandy92), Advent Of Code 2023, Day One. Link: https://adventofcode.com/2023/day/1
   Qualora il link non fosse consultabile, 
   per leggere la traccia del problema è possibile consultare il file "Traccia Day 1 - Parte 1.txt */
   

// richiedo il file "input_1imo_Step.php" (al suo interno c'è il primo codice input)
require 'input_1imo_Step.php';

// Utilizzo la funzione PHP "explode" per suddividere i singoli elementi dell'array ogni volta che il testo va a capo
$arrayinput1 = explode("\n", $input1);

// Inizializzo la somma a zero
$somma = 0;

// Eseguo un foreach per scansionare tutti gli elementi singolarmente
foreach ($arrayinput1 as $risulato) {
    
	
	// Utilizzo la funzione PHP "preg_match_all" per eliminare dalla stringa i caratteri che NON sono numeri. L'espressione iniziale "!\d+!" è infatti un modo per indicare che a me interessa lavorare solo i numeri. Riporto i dati trattati in $corrispondenze
    preg_match_all('!\d+!', $risulato, $corrispondenze);

    // Estraggo tutti i numeri trovati e li preparo per l'analisi
    $numero = $corrispondenze[0];
	
	// Per evitare problemi con cifre attaccate pongo una variabile di controllo
	$controlloCifre = intval($numero[0]);

    // Se ci sono più numeri nella stringa, prendiamo solo la prima e l'ultima cifra. Altrimenti poniamo accanto la cifra uguale
    if (count($numero) > 1 || $controlloCifre > 9) {
        $primoNumero = intval(substr($numero[0], 0, 1));
        $ultimoNumero = intval(substr($numero[count($numero) - 1], -1));
        // echo "Primo valore: " . $primoNumero . "<br>";
        // echo "Secondo valore: " . $ultimoNumero . "<br>";

        // Concateno il valore della prima e dell'ultima cifra
        $valore = intval($primoNumero . $ultimoNumero);
        // echo $valore . "<br>";
    } else {
        // Se c'è solo una cifra, duplico la stessa cifra (non nel senso della moltiplicazione, ma che ne pongo accanto la cifra uguale)
        $valore = intval($numero[0] . $numero[0]);
		// echo $valore . "<br>";
    }

    // Sommo tutto
    $somma += $valore;
}

// Stampo il risultato finale
echo "La somma di tutti i valori è: " . $somma;

?>