# laravel-api-boilerplate

This is a boilerplate for writing RESTful API projects using Laravel. This Boilerplate is a "starter kit" you can use to build your first API in seconds. As you can easily imagine, it is built on top of the awesome Laravel Framework. This version is built on Laravel 5.8!

It is built on top of three big guys:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Baserepo - [jsdecena/baserepo](https://github.com/jsdecena/baserepo)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)


## Features

* Ready To use User Authentications
* Users CRUD (list, create, show, update delete )
* Json API Format response.


## Installation

First, clone the repo:
```
$ git clone https://github.com/kennethtomagan/laravel-api-boilerplate.git
```
#### Install dependencies

```
$ cd laravel-api-boilerplate.git
$ composer install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```

#### Migrations and Seed the database
```
$ php artisan migrate:fresh --seed
```

#### Route API Endpoint

| Verb     |       URI           |  Action  |      Controller    |
| -------- | ------------------  | -------- | ------------------ |
| POST     | `api/v1/auth`       |  store   |   AuthController   |
| GET      | `api/v1/users`      |  index   |   UserController   |
| POST     | `api/v1/users`      |  store   |   UserController   |
| GET      | `api/v1/users/{id}` |  show    |   UserController   |
| PUT      | `api/v1/users/{id}` |  update  |   UserController   |
| DELETE   | `api/v1/users/{id}` |  destroy |   UserController   |