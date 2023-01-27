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

