# Répertoire

Application de gestion d'un répertoire de chants.

## Installation de l'application

```bash
cd /var/www
sudo gh repo clone ppitette/repertoire
sudo chown -R debian:www-data repertoire
cd repertoire
composer install
npm install
npm install bootstrap @fortawesome/fontawesome-free @popperjs/core
npm run build
cp .env .env.local
```

## FOSCKEditorBundle

```
composer require friendsofsymfony/ckeditor-bundle
php bin/console ckeditor:install

[npm install --save ckeditor4@^4.13.0]

npm run build
php bin/console assets:install public
```

fichier `config/packages/twig.yaml`

```yaml
twig:
    form_themes:
        - '@FOSCKEditor/Form/ckeditor_widget.html.twig'
```

## Suite

fichier `.env.local`

```env
APP_ENV=prod
...

...
###> doctrine/doctrine-bundle ###
DB_USER='xxxx'
DB_PASSWORD='xxxx'
DB_NAME='xxxx'
DB_VERSION='mariadb-10.x.x'
DATABASE_URL=mysql://${DB_USER}:${DB_PASSWORD}@127.0.0.1:3306/${DB_NAME}?serverVersion=${DB_VERSION}
###< doctrine/doctrine-bundle ###
```

```bash
composer dump-env prod
symfony console cache:clear --env=prod
cd ..
sudo chown -R debian:www-data repertoire
```

## Migration

```bash
cd /var/www
sudo chown -R debian:www-data repertoire
cd repertoire
git pull
composer install
composer dump-env prod
symfony console doctrine:migration:migrate
yarn install --force
yarn encore prod
symfony console cache:clear --env=prod
cd ..
sudo chown -R www-data:www-data repertoire
```

## Base de données

Récupérer la sauvegarde de la base de données depuis le répertoire /home/debian

```bash
docker exec -i rep_database mysql -uroot -ppassword main < devel/sql/rep_database_sav.sql
```

## copie sur le site OVH

## sauvegarde de la base de données

```bash
docker exec -i rep_database mysqldump -uroot -ppassword main > devel/sql/rep_database_sav.sql
```

## Contributing

## License

[GNU GPLv3](https://choosealicense.com/licenses/gpl-3.0/)
