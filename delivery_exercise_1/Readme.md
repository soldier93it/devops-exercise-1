# DEVOPS Exercise 1 - soldier93it

Questo progetto mostra come creare un'applicazione PHP containerizzata che si connette a un database MariaDB.  
Include inoltre un playbook Ansible per automatizzare l'installazione e il deploy locale.

---

## Struttura del progetto

delivery_exercise_1/
├── Dockerfile # Immagine Docker per il webserver PHP con mysqli
├── index.php # Pagina PHP che mostra un messaggio e si connette a MariaDB
├── docker-compose.yml # Definizione dei servizi: web e database MariaDB
├── deploy.yml # Playbook Ansible per installare Docker, buildare l'immagine e avviare container
├── hosts # Inventory Ansible per localhost
└── README.md # Questo file


---

## Prerequisiti

- Linux (testato su Ubuntu 22.04)
- Docker e Docker Compose installati
- Ansible installato
- Privilegi sudo

---

## Cosa fa il progetto

- **Dockerfile**:  
  Basato su `php:8.2-apache`, installa l'estensione `mysqli` per connettersi a MariaDB.  
  Copia `index.php` nella root web di Apache.

- **index.php**:  
  Mostra un messaggio personalizzato e si connette a MariaDB (host `db`, utente `root`, password `rootpass`, database `testdb`).  
  Se la connessione ha successo, mostra l'elenco dei database.

- **docker-compose.yml**:  
  Definisce due servizi:  
  - `db`: container MariaDB 11 con password e database predefiniti  
  - `web`: builda l'immagine dal Dockerfile, espone porta 8080, dipende da `db`

- **deploy.yml (Ansible)**:  
  Automatizza:  
  - installazione di Docker e Docker Compose  
  - build dell'immagine Docker  
  - avvio dei container tramite Docker Compose

---

## Come eseguire

### 1. Clona il repository


git clone https://github.com/ivan-devops/devops-exercise-1.git
cd devops-exercise-1/delivery_exercise_1


2. Esecuzione manuale con Docker Compose

docker compose up --build
Apri il browser su:
http://localhost:8080
Dovresti vedere:

pgsql
questo è il mio DevOps Exercise!
Connected to MySQL successfully!
<elenco database>
3. Esecuzione automatica con Ansible
ansible-playbook -i hosts deploy.yml
Questo playbook esegue tutte le operazioni necessarie per far partire il progetto su una macchina locale.

Comandi utili
Fermare i container:
docker compose down

Ricostruire le immagini:
docker compose up --build

Rimuovere tutti i container (pulizia):


docker rm -f $(docker ps -aq)

Note
La password MariaDB è rootpass e il database creato è testdb.

La connessione PHP usa l'host db (nome del servizio Docker Compose).

Ansible è configurato per funzionare su localhost 
