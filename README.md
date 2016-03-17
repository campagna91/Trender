### Welcome to Trender Pages.
Il progetto relativo il tracker la gestione di requisiti, casi d'uso, attori, verbali, package, classi e loro metodi.
![Requisiti](https://raw.githubusercontent.com/campagna91/Trender/master/public/requisiti.png)

### Tracciamento
Il sistema permette inoltre il tracciamento tra le parti gestite mediante le sezioni di modifica relative l'entità in questione (per accedere alla sezione, in seguito all'inserimento dell'entità richiesta cliccare sulla voce relativa il nome dell'entità dall'apposito listato presente sulla home di ogni sezione).
![Tracciamento e aggiornamento](https://raw.githubusercontent.com/campagna91/Trender/master/public/udpateClass.png)

### Classi e metodi
E' inoltre possibile modellare le classi con rispettivi metodi e o attributi.
![Metodi e attributi](https://raw.githubusercontent.com/campagna91/Trender/master/public/methods.png)

### Stampe
Entrando nelle impostazioni sarà inoltre possibile selezionare le stampe richieste per la propria documentazione
![Stampe](https://raw.githubusercontent.com/campagna91/Trender/master/public/prints.png)

### Backup
E' risaputo che qualcuno del gruppo potrebbe fare il macello con la base di dati o che per disservizi relativi al sevizio di hosting questi vengano persi. Dunque è possibile sempre dalle impostazioni fare il backup della base di dati e ripristinarli in un tempo successivo tramite i comandi appositi.
![Backup informazioni](https://raw.githubusercontent.com/campagna91/Trender/master/public/settings.png)

### Installazione
Per l'installazione del servizio sono necessari 4 semplici accorgimenti.
1. Accertarsi che i file abbiano correttamente i permessi settati;
2. Da una shell mysql dare il comando "source" seguito dal path relativo al file "install.sql" presente nella cartella "mysql" del servizio: il comando installerà la base di dati ed i tipi di default richiesti (dataNeed.sql);
3. Modificare nel file "Trender/cgi-bin/__ajaxBackups.php" alle righe 23 e 30 il path relativo l'utilità "mysqldump" necessaria per effettuare il backup della base di dati;
4. Includere negli eventuali fogli ".tex" i comandi presenti nella cartella "latexCommand" nella root del servizio.

Le credenziali per il servizio sono di default settate ad "admin" sia per lo username che per la password. Per modificarle sarà sufficiente recarsi sempre nel file "dataNeed.sql" e modificarle nella prima riga.

**NB:** abilitare il _short tag_ nel file php.ini altrimenti non verrà visualizzato nulla nelle pagine.

### BUG
* **CamleCase**: nn bug noto e non sanato è stato riscontrato nel nome dei metodi per il quale è richiesto lo stile di scrittura CamelCase;
* **Errori visivi**: nell'inserimento dei dati (inserimento di una nuova entità o correlazione di un'entità esistente con altre) i campi mancanti vengono segnalati di rosso fuorché i campi di tipo _select_ che per limiti imposti dalla libreria grafica non permettono la loro evidenziazione di rosso.

Per altre segnalazioni (se non risolvibili da voi visto che siete informatici) scrivete a campagna.simone.91@gmail.com con oggetto "BUG_Trender"


