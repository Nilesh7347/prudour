<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Installation 

composer create-project --prefer-dist laravel/laravel prudour

cd /prudour

composer require spatie/laravel-permission

composer require laravelcollective/html

added  config/app.php

'providers' => [

	Spatie\Permission\PermissionServiceProvider::class,

],


custom changes 

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

runing migrate 
php artisan migrate

php artisan make:migration create_departments_table
php artisan make:migration create_projects_table
php artisan make:migration create_user_tracking_table

php artisan make:model User 
php artisan make:model Department
php artisan make:model Project 
php artisan make:model UserTrack

Adding role and permission

app/Http/Kernel.php

protected $routeMiddleware = [
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
]

install laravel/ui package

composer require laravel/ui

php artisan ui bootstrap --auth

Install NPM:

npm install

Run NPM:

npm run dev
--location=global


Create a All CRUD operation for Deparment,Project and also create a All Roles CRUD and then

create seeder for permissions

php artisan make:seeder PermissionTableSeeder

After created edit seeder file and add roles,department,project permission
then run PermissionTableSeeder seeder

php artisan db:seed --class=PermissionTableSeeder

Ater
create new seeder for creating admin user

php artisan make:seeder CreateAdminUserSeeder

then edit CreatedminSeeder file wit Admin Credentials and run below command

php artisan db:seed --class=CreateAdminUserSeeder

run bellow command for quick run

php artisan serve

Access By

http://localhost:8000/


installing logviewer
Laravel log viewer
composer require rap2hpoutre/laravel-log-viewer
Add Service Provider to config/app.php in providers section

Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,

And rgister the route and check using 

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

http://127.0.0.1:8000/logs

After this export excel for user

Install maatwebsite/excel package

composer require maatwebsite/excel

then  publish the config
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

 Create Export Class
php artisan make:export ExportUser --model=User

then Register route
Route::get('/export-users',[UserController::class,'exportUsers'])->name('export-users');

then 
add button or anchor tage on user management page


Thanks



