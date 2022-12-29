reset:
	docker compose down --remove-orphans --volumes
	sudo rm -rf data
	docker compose build --no-cache
	make run
run:
	docker compose up -d --build
	docker exec -it fisiocefan_app bash -c "composer install"
	docker compose logs -f
db-dump:
	docker exec fisiocefan_db sh -c 'exec mariadb-dump --all-databases -uroot -p"$MARIADB_ROOT_PASSWORD"' > /home/$(date +"%Y_%m_%d__%H_%M_%S").sql
db-restore:
	docker exec -i fisiocefan_db sh -c 'exec mariadb -uroot -p"$MARIADB_ROOT_PASSWORD" < "/home/$(sql)"'
db-terminal:
	docker exec -it fisiocefan_db sh -c 'mysql -p'
db-reset:
	docker compose rm -s -v -f db
	sudo rm -rf data
	docker compose up -d db
	docker compose logs -f