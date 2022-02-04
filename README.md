# Laravel 8

Laravel is a web application framework. There are a variety of tools and frameworks available to you when building a web application. However, we believe Laravel is the best choice for building modern, full-stack web applications.

## Server Requirements

- PHP >= 8.0
- MCrypt PHP Extension
- Composer

Laravel utilizes Composer to manage its dependencies. First, download a copy of the composer.phar. Once you have the PHAR archive, you can either keep it in your local project directory or move to usr/local/bin to use it globally on your system. 

## Getting Started

1. Clone the project from github/gitlab first.
2. Change file permission ``chmod -r 777`` of ``storage`` and ``bootstrap``
3. Setup ``.env`` file in root. You can copy ``.env.example`` and create ``APP_KEY``.
4. Update ``.env`` config for database including ``DB_DATABASE``, ``DB_USERNAME``, ``DB_PASSWORD``
5. Update  ``.env`` url for website ``APP_URL``
6. Update ``AWS_ACCESS_KEY_ID``, ``AWS_SECRET_ACCESS_KEY``, ``AWS_DEFAULT_REGION``, ``AWS_BUCKET``, ``AWS_USE_PATH_STYLE_ENDPOINT`` in ``.env`` for S3 storage.
7. Run ``composer install``
8. Setup nginx and set the root ``<project_folder>/public`` and point to ``index.php``
9. OK~ Done!


## Folder

- `/.env` is base config file for website.
- `/.routes/web.php`  is the routes for your application will be defined in the `app/routes.php` file. The simplest Laravel routes consist of a URI and a Closure callback.
- `/resources/views/*` is all of view for website.
- `/resources/views/components` is static components view. it is controlled by `/app/View/Components/*`
- `/resources/views/livewire` is dynamic components view. it is controlled by `/app/Http/Livewire/Components/*`
- `vendor` is all 3rd package for Laravel.

## Database
1. Config

Update ``.env`` config for database including ``DB_DATABASE``, ``DB_USERNAME``, ``DB_PASSWORD``

2. Model

This model is the Eloquent ORM. To get started, create an Eloquent model. Models typically live in the ``/app/Models`` directory. Note that you will need to place ``updated_at`` and ``created_at`` columns on your table by default.

3. How to create / update model.

you need to setup `primaryKey`, `table`, and `fillable` to define model.

Example:
```
public $primaryKey = 'order_id';
protected $table = 'order';
protected $fillable = [
    'order_id',
    'member_id',
    'status',
    'amount',
    'paid',
    'client_secret',
    'remark',
    'created_at',
];
```
