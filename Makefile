
green=`tput setaf 2`
white=`tput setaf 7`

help:
	@ echo "$(green) build			$(white) Build or rebuild services"
	@ echo "$(green) up			$(white) Run services"
	@ echo "$(green) create-db		$(white) Create database and populate it with initial data"
	@ echo "$(green) migrate		$(white) Run migrations"
	@ echo "$(green) sh:php			$(white) Execute php container"
	@ echo "$(green) sh:nginx		$(white) Execute nginx container"
	@ echo "$(green) sh:mysql		$(white) Execute mysql container"

build:
	docker-compose up --build

up:
	docker-compose up

create-db:
	docker exec -it php-container php bin/console doctrine:database:create
	docker exec -it php-container php bin/console doctrine:migrations:migrate

migrate:
	docker exec -it php-container php bin/console doctrine:migrations:migrate

sh\:php:
	docker exec -it php-container bash

sh\:mysql:
	docker exec -it mysql-container bash

sh\:nginx:
	docker exec -it nginx-container bash