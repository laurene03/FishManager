## Variables
SYMFONY_CONSOLE = symfony console

cache-clear: ## Clear cache
	$(SYMFONY_CONSOLE) cache:clear --no-warmup --env=dev


## ---  Initialisation du projet ---
project-init: 
	$(MAKE) composer-i
	$(MAKE) docker
	$(MAKE) start-server
	$(MAKE) database-init

composer-i: ## Install composer dependencies
	composer install --no-interaction 

start-server: ## Start symfony server
	symfony server:start 

docker: ## Build docker containers
	docker-compose up -d

local: ## Ouvrir en local 
	symfony open:local



## ---  Database ---
database-init:
	$(MAKE) database-remove
	$(MAKE) database-create
	$(MAKE) database-migrate
	$(MAKE) database-fixtures-load

database-remove: ## delete database
	$(SYMFONY_CONSOLE) d:d:d --force --if-exists

database-create: ## create database
	$(SYMFONY_CONSOLE) d:d:c --if-not-exists

database-test: ## test la connexion à la base de données
	$(SYMFONY_CONSOLE) doctrine:query:sql "SELECT 1"

database-migrate: ## Migrate migrations
	$(SYMFONY_CONSOLE) d:m:m --no-interaction

migrate: ## Alias: database-migrate
	$(MAKE) database-migrate	

database-fixtures-load: ## Load fixtures
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

fixtures: ## Alias : database-fixtures-load
	$(MAKE) database-fixtures-load

