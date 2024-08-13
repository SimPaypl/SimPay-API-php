bash-root: #login into container as root
	docker exec -it -u root php bash

bash: ## login into container
	docker-compose exec php bash

lint: ## Check code style
	docker-compose exec php bin/ecs check --ansi --config ecs.php --fix
	docker-compose exec php bin/rector --ansi
	docker-compose exec php bin/phpstan analyse --ansi --no-progress --configuration phpstan.neon --memory-limit=1G

test: ## Run tests
	docker-compose exec php bin/phpunit --colors=always --coverage-text --coverage-html=build/coverage

build: ## Builds the Docker images
	docker-compose build --pull --no-cache

up: ## Start containers in detached mode (no logs)
	docker-compose up --detach

stop: ## Stop containers
	docker-compose stop

remove: ## Remove containers
	docker-compose stop
	docker-compose rm -fv php

