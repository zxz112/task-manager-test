start:
	php -S localhost:8000
lint:
	composer run-script phpcs -- --standard=PSR12 conf controllers models