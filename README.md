# projects-solutions-ch
It will be used exclusively for the development, submission, and management of the competitor's work during the Remote Friendly Competition.

## Module A - Speed Tasks

http://localhost/CH_module_a/XX (Where `XX` is the Module ID, e.g. `A1`)

All tasks where developed for desktop screens on firefox, unless overwise mentioned in the task. 

## Module B - Backend:

```
cd /var/www/html/CH_Module_B
composer install
npm i
npm run build
php artisan migrate --seed
```

http://localhost/CH_Module_B

When testing using Bruno, I had to use the baseUrl `http://127.0.0.1/CH_Module_B`

## Vue:

http://localhost/test-vue

### Vue Development:

```cd
cd /var/www/html/test-vue-dev
npm i
npm run dev
```

http://localhost:3000/test-vue
