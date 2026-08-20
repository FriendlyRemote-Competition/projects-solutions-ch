# projects-solutions-ch
It will be used exclusively for the development, submission, and management of the competitor's work during the Remote Friendly Competition.

Would recommend running `chmod -R 777 /var/www/html` to be sure to avoid permission issues.

## Module A - Speed Tasks

http://localhost/CH_module_a/XX (Where `XX` is the Module ID, e.g. `A1`)

All tasks where developed for desktop screens on firefox, unless overwise mentioned in the task. 

## Module B - Backend

```
cd /var/www/html/CH_Module_B
composer install
npm i
npm run build
php artisan migrate --seed
```

http://localhost/CH_Module_B

When testing using Bruno, I had to use the baseUrl `http://127.0.0.1/CH_Module_B`

## Module C - Frontend

http://localhost/CH_Module_C

As the TP doesn't specify, pages where developed primarily for firefox.

### Development Files

```cd
cd /var/www/html/CH_Module_C_dev
npm i
npm run dev
```

http://localhost:3000/CH_Module_C

Requires port 3000 to be exposed by docker. Can be edited in the `docker-compose.yml`.

## Module D - Design Implementation

http://localhost/CH_Module_D
