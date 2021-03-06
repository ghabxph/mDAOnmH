build:
	@echo ---- builds the necessary docker containers ----
	docker-compose build

up:
	@echo ---- runs the web services ----
	docker-compose up -d

down:
	@echo ---- stops web services ----
	docker-compose down

ps:
	@echo ---- processlist ----
	docker-compose ps

logs:
	@echo ---- logs -----
	docker-compose logs

db:
	@echo ---- ssh to db ----
	docker exec -it mdaonmh_db_1 mysql -uroot -pcpuSUW49oS9TNIzB exam

test: tbetter

tbetter:
	@echo ---- Runs test for better ----
	docker exec -it mdaonmh_better-php_1 php test.php
