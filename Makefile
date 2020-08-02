start :
	# запуск контейнеров
	docker-compose up -d

install :
	# установка проекта по средствам composer (в данном случае symfony)
	sudo docker-compose exec php composer create-project symfony/skeleton ./project-name


