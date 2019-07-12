ifndef PHP
	PHP=7.2
endif
ifndef PHPUNIT
	PHPUNIT=8.2
endif

qa_image=jakzal/phpqa:php${PHP}-alpine
composer_args=--prefer-dist --no-progress --no-interaction --no-suggest
phpunit_args=--do-not-cache-result

dockerized=docker run --init -it --rm \
	-u $(shell id -u):$(shell id -g) \
	-v $(shell pwd):/app \
	-w /app
qa=${dockerized} \
	-e COMPOSER_CACHE_DIR=/app/var/composer \
	-e SYMFONY_PHPUNIT_VERSION=${PHPUNIT} \
	${qa_image}
mkdocs=${dockerized} -p 8000:8000 squidfunk/mkdocs-material

# deps
install:
	${qa} composer install ${composer_args}
update:
	${qa} composer update ${composer_args}
install-standalone:
	${qa} bin/package-exec composer install ${composer_args}
update-standalone:
	${qa} bin/package-exec composer update ${composer_args}
update-standalone-lowest:
	${qa} bin/package-exec composer update ${composer_args} --prefer-stable --prefer-lowest

# tests
phpunit:
	${qa} bin/package-exec simple-phpunit ${phpunit_args}
phpunit-coverage:
	${qa} bin/package-exec phpdbg -qrr /tools/simple-phpunit ${phpunit_args} --coverage-clover=coverage.xml
phpunit-pull:
	rm -rf var/phpunit
	${qa} sh -c "cp -RL /tools/.composer/vendor-bin/symfony/vendor/bin/.phpunit/phpunit-${PHPUNIT} var/phpunit"

# code style
cs:
	${qa} php-cs-fixer fix --dry-run --verbose --diff
cs-fix:
	${qa} php-cs-fixer fix

# static analysis
psalm: install phpunit-pull
	mkdir -p src/Domain/vendor
	${qa} psalm --show-info=false
psalm-info: install phpunit-pull
	mkdir -p src/Domain/vendor
	${qa} psalm --show-info=true

# docs
docs-serve:
	${mkdocs}
docs-build:
	${mkdocs} build --site-dir var/build/docs

# linting
lint-yaml:
	${dockerized} sdesbure/yamllint yamllint .yamllint .*.yml *.yml

# CI
ci-install:
	#${qa} bin/package-exec composer require --no-update --quiet symfony/debug:^4.2.2
	${qa} bin/ci-packager HEAD^ $$(find src/*/composer.json -type f -printf '%h\n')

# phpqa
qa-update:
	docker rmi -f ${qa_image}
	docker pull ${qa_image}

# misc
clean:
	git clean -dxf var/
smoke-test: clean update-standalone phpunit cs psalm
shell:
	${qa} /bin/sh
composer-normalize: install install-standalone
	${qa} composer normalize
	${qa} bin/package-exec composer normalize
link: install install-standalone
	${qa} bin/package-exec composer link --working-dir=/app "\$$(pwd)"
test-project:
	${qa} composer create-project --prefer-dist --no-progress --no-interaction symfony/skeleton var/test-project
	${qa} composer config --working-dir=var/test-project extra.symfony.allow-contrib true
	${qa} composer config --working-dir=var/test-project repositories.msgphp path "../../src/*"
	${qa} composer require --no-update --working-dir=var/test-project ${composer_args} orm
	${qa} composer require --working-dir=var/test-project --dev ${composer_args} debug maker
