run:
	docker compose up --build

launch:
	docker compose up

clean:
	docker compose down; \
	docker image rm mysql:5.5; \
	docker image rm php:8.0-fpm; \
	docker image rm nginx:stable-alpine;
