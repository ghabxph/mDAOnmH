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

ssh-secure:
	@echo ---- ssh ----
	docker exec -it mdaonmh_secure-php_1 sh

db:
	@echo ---- ssh to db ----
	docker exec -it mdaonmh_db_1 mysql -uroot -pcpuSUW49oS9TNIzB exam
