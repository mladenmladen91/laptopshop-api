## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This project is api laptop webshop simulator. it provide slaptop lists downoladed from an external api for the test. I am sending database with this project for test
	
## Technologies
Project is created with:
* Laravel version : 8

	
## Setup
To run this project, install it locally:

```
$ cd ../project_directory
$ git clone https://github.com/mladenmladen91/laptopshop-api.git
$ composer install
$ create .env file and enter nesscessary data
$ php artisan key:generate
$ php artisan migrate
$ php artisan passport:install
$ php artisan db:seed
$ php artisan command:import