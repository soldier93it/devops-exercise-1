# DevOps Exercise 3

Questo è il mio esercizio 3 per il percorso DevOps.  

L’obiettivo è:
- Creare un cluster Kubernetes a 3 nodi (con Kind)
- Deployare la mia app PHP scritta nell’esercizio 1
- Deployare MariaDB
- (Per ora senza persistenza dati)
- Esporre e testare l’app sul cluster

---

## Prerequisiti

Per far funzionare tutto servono:
- Docker installato
- kind installato
- kubectl installato

---

## Build e caricamento immagine app PHP

### Costruzione dell’immagine

Mi sono spostato nella cartella dell’esercizio 1 e ho costruito l’immagine Docker della mia app PHP:

cd ../delivery_exercise_1
docker build -t soldier93it/devops-php-app:latest .
Caricamento dell’immagine in Kind
Poi ho caricato l’immagine nel cluster Kind, così Kubernetes la trova localmente senza bisogno di scaricarla da Docker Hub:


kind load docker-image soldier93it/devops-php-app:latest --name devops-exercise3

Manifests Kubernetes

Tutti i miei manifest si trovano nella cartella manifests/:

db-deployment.yaml → Deployment di MariaDB

db-service.yaml → Service ClusterIP per MariaDB

web-deployment.yaml → Deployment dell’app PHP

web-service.yaml → Service NodePort per l’app PHP

Nota importante:
Nel mio web-deployment.yaml ho impostato così:


image: soldier93it/devops-php-app:latest
imagePullPolicy: Never
imagePullPolicy: Never serve per dire a Kubernetes di non cercare l’immagine online, ma di usare quella caricata localmente nel cluster Kind.

Deploy nel cluster
Ho applicato tutti i manifest con:


kubectl apply -f manifests/
Poi ho verificato i pod:


kubectl get pods
E l’output atteso è questo:

NAME                       READY   STATUS    RESTARTS   AGE
mariadb-xxxxxxx            1/1     Running   0          Xm
php-app-xxxxxxx            1/1     Running   0          Xm

Test dell’app
Per testare l’app sul cluster, ho esposto il servizio PHP in locale usando il port-forward:


kubectl port-forward service/php-service 8080:80

Così posso vedere l’app dal mio browser o da curl:


http://localhost:8080
E il mio messaggio personalizzato appare:

questo è il mio DevOps Exercise!
