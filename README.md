Application Setup for demo:

## Laravel

- git clone https://github.com/debasishdhara/DemoManagement.git

- cd DemoManagement

-  composer install
-  mv .env.example .env
-  php artisan jwt:secret
-  php artisan migrate
-  php artisan db:seed



## Angular

- cd public
- cd admin
-  npm i
-  set up base url from src/environments/ two files one for development build and another one for production build
- ng build --prod --base-href=/superadmin/



## License

Demo Management Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
