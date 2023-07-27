# How to run this project(laravel 10)
1. Clone this repository
```
git clone #repo-link
```

2. Install/update all dependencies
```
composer install / composer update
```

3. Create a copy of your .env file
```
cp .env.example .env
```

4. Generate an app encryption key
```
php artisan key:generate
```

5. Create an empty database for our application

6. In the .env file, add database information to allow Laravel to connect to the database
(in this case i would recommend planetscale for the database, here is the documentation how to use laravel with [planetscale](https://planetscale.com/docs/tutorials/connect-laravel-app))



7. Migrate the database
```
php artisan migrate
```

8. Seeding the database
```
php artisan db:seed --class=AdminSeeder
```

9. Run the application
```
php artisan serve
```