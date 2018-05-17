install:
	composer install
	npm install
	cp .env.example .env
	php artisan key:generate
	php vendor/bin/homestead make
	touch ./database/database.sqlite

up:
	vagrant up
	vagrant ssh
