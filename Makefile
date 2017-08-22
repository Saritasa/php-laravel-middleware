all: install run

cs:
	phpcs

csfix:
	phpcbf

test:
	composer test
