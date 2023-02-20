DC := docker compose
FPM := $(DC) exec fpm
ARTISAN := $(FPM) php artisan

env:
	cp .env.example .env

build:
	@$(DC) build

start-logs:
	@$(DC) up

start:
	@$(DC) up -d

stop:
	@$(DC) stop

down:
	@$(DC) down

ssh:
	@$(FPM) /bin/bash

composer-install:
	@$(FPM) composer install

keygen:
	@$(ARTISAN) key:generate

migrate:
	@$(ARTISAN) migrate

seed:
	@$(ARTISAN) db:seed

start-expanded: start migrate seed

refresh: composer-install migrate seed

setup: env build start composer-install