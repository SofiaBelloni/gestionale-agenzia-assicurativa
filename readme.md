# Elaborato per il corso di Basi di dati

Progetto di una base di dati per la gestione di un’agenzia assicurativa

A.A. 2020/2021

Belloni Sofia  sofia.belloni@studio.unibo.it

Il progetto consiste nella realizzazione di un sistema database che supporti la gestione di un'agenzia assicurativa e che consenta di immagazzinare informazioni relative ai dipendenti, ai clienti, ai diversi tipi di contratti che questi ultimi possono sottoscrivere e alle liquidazioni dei contratti alla scadenza


Nella cartella 'db' è presente il file 'create_database-insert.sql' che consente di creare il database utilizzato nel DBMS MySQL e di popolarlo con alcuni valori di esempio.

Nella cartella 'html' è invece presente il codice sorgente del proggetto. E' possibile eseguire il progetto in ambiente web utilizzando XAMPP.
In caso di errore di connessione al database è necessario modificare la seguente linea di codice presente nel file ".\html\bootstrap.php":

	$dbh = new DatabaseHelper("127.0.0.1", "root", "", "agenzia_assicurativa", 3307);

inserendo come ultimo paramentro il numero di porta utilizzato.