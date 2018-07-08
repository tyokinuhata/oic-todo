setup:
	composer install
	npm install
	cp .env.example .env
	php artisan key:generate
	php vendor/bin/homestead make
	touch ./database/database.sqlite

vup:
	vagrant up
	vagrant ssh

fix:
	./node_modules/.bin/eslint --fix resources/assets/js/**/*.vue
	php ./vendor/bin/php-cs-fixer fix ./app
	php ./vendor/bin/php-cs-fixer fix ./database

deploy:
	git push heroku master
	heroku run composer dump-autoload --optimize
	heroku run php artisan route:cache
	heroku run php artisan config:cache
