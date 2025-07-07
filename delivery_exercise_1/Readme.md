
DEVOPS soldier93it
L'applicazione espone una pagina web che mostra un semplice messaggio.

---
## Struttura del progetto
delivery_exercise_1/
├── Dockerfile # Definisce l'immagine Docker per l'app PHP
├── index.php # Semplice pagina PHP
├── deploy.yml # Playbook Ansible per installare Docker, buildare l'immagine e avviare il container
├── hosts # Inventory Ansible per localhost
└── README.md # Questo file

## Prerequisiti

- Sistema operativo Linux (testato su Ubuntu 22.04)
- Docker installato
- Ansible installato
- Privilegi sudo sulla macchina

---

## Come eseguire

### 1. Clonare il repository

git clone https://github.com/ivan-devops/devops-exercise-1.git
cd devops-exercise-1/delivery_exercise_
2. Eseguire il playbook ansible:

ansible-playbook -i hosts deploy.yml

3. Aprire il browser e visitare:
http://localhost:8080

Comandi utili
Fermare il container:
	docker stop my-php-app
	docker rm my-php-app
Se modifichiamo il codice PHP o il Dockerfile:
	docker build -t my-php-app .
Avviare nuovamente il container:
	docker run -d --name my-php-app -p 8080:80 my-php-app


