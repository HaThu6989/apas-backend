# Apas backend

Une application pour les déclarations de salaire pour APAS-BTP

## À propos
 
Ce référentiel implémente l'API backend qui utilise Jenkins pour l'intégration continue, Symfony comme framework principal et Docker pour l'orchestration des conteneurs.

## Dépôt Git

Le code source du projet est disponible sur GitHub : [apas-backend](https://github.com/HaThu6989/apas-backend.git)

## Prérequis
- Docker et Docker Compose installés sur votre machine.
- Jenkins configuré et opérationnel

## Configuration de l'environnement de développement

1. Clonez le dépôt Git :
    ```bash
    git clone https://github.com/HaThu6989/apas-backend.git
    cd apas-backend
    ```

2. Démarrez les services avec Docker Compose :
    ```bash
    docker-compose up -d
    ```

3. Initialisez la base de données :

    ```bash
    docker-compose exec symfony php bin/console doctrine:database:create
    ```

4. Appliquez les migrations :

    ```bash
    docker-compose exec symfony php bin/console doctrine:migrations:migrate
    ```

5. Chargez les fixtures :

    ```bash
    docker-compose exec symfony php bin/console doctrine:fixtures:load
    ```
6. Démarez le serveur Symfony à l'intérieur du conteneur:

    ```bash
    docker-compose exec symfony symfony server:start
    ```

## Tests
Pour exécuter les tests, suivez les étapes ci-dessous :

1. Créez une base de données pour les tests :
    ```bash
    docker-compose exec symfony php bin/console doctrine:database:create --env=test
    ```

2. Appliquez les migrations sur la base de données de test :
    ```bash
    docker-compose exec symfony php bin/console doctrine:migrations:migrate --env=test
    ```

3. Lancez PHPUnit pour exécuter les tests :
    ```bash
    docker-compose exec symfony php ./vendor/bin/phpunit
    ```

## Utilisation de Jenkins

1. Commandes Utilisées dans Jenkins pour test:
    ```bash
    docker-compose up -d
    docker-compose exec symfony php bin/console doctrine:database:create --env=test
    docker-compose exec symfony php bin/console doctrine:migrations:migrate --env=test
    docker-compose exec symfony php ./vendor/bin/phpunit
    ```
