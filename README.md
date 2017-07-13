# Multi-tenant Application (Software-as-a-Service)

Laravel Multi-tenant with Postgres.

### Installation:

`git clone` this repository and `cd` inside the project root, then enter the following commands

1. `composer install --prefer-dist -vvv` (might take a while to complete)

2. `cp .env.example .env`

3. `php artisan key:generate`

    Now open `.env` file and make necessary changes to the **DB_** section.
    
    **Yes, of course, you'll have to setup a database and it's user already before the next step!**
    Otherwise, exactly what settings were you going to put in the _DB\__ section of the `.env` file?

4. `php artisan migrate`

5. `php artisan db:seed`

6. `php artisan serve` ain't gonna work in this case. You need to _Virtual Host_ server name in term of _Apache_ or _Server Blocks_ in terms of _Nginx_
 
**Note:** `server name` should be same as `.env` file `APP_URL` section 

### Please Note

This software uses the [Laravel](https://laravel.com/ "Laravel") framework.

Currently, [Laravel 5.4](https://laravel.com/docs/5.4 "Laravel 5.4") is being used.

If you are getting any error, it is most probably due to 
unfulfilled [requirements](https://laravel.com/docs/5.4#server-requirements "Server Requirements") 
of the framework itself.

Also, make sure that you have `postgres` database installed and proper driver `php-pgsql` package so that you can use `postgres` database with php7.1 in your project.

### Reference 
* https://github.com/pacuna/Laravel-PGSchema

* https://httpd.apache.org/docs/2.4/vhosts/name-based.html

* https://www.nginx.com/resources/wiki/start/topics/examples/server_blocks/