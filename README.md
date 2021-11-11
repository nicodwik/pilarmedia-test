# Pilarmedia-Test
### _Employee management project built with Laravel_

## System Design
This project made with Model View Controller (MVC)

## Flow Diagram
![AD](https://i.ibb.co/Czm9LV5/Flow-Diagram-Pilarmedia-Test-1.jpg)

## Installation
- Fork this repository
- Clone from forked repository
- Change directory
```sh
cd pilarmedia-test
```
- Copy `env.example` to `.env`
```sh
cp env.example .env
```
- configure database, username, password in `.env`
- Migrate to database and start seeding
```sh
php artisan migrate && php artisan db:seed --class=UserSeeder
```
- Run the development server
```sh
php artisan serve
```
