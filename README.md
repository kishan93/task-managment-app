# Task Management App

## Description
create project and add tasks to it. tasks can be added, edited, deleted, and it's status can be changed.
task can be rearranged by drag and drop.
User can only see his projects and tasks.

## Requirements
- php 8.1
- composer
- node 18.x
- mysql 8.x

## Installation
- install composer dependencies
```bash
composer install
```
- install npm dependencies
```bash
npm install
```
- create .env file
```bash
cp .env.example .env
```
- generate app key
```bash
php artisan key:generate
```
- create database and add it's name to .env file
- migrate database
```bash
php artisan migrate
```
- run the app
```bash
php artisan serve
```
- compile assets
```bash
npm run build
```

## extra
- run tests
```bash
php artisan test
```
- seed database
```bash
php artisan db:seed
```

## Usage
- register a new user
- login with the new user
- create a new project
- add tasks to the project
- edit, delete or change status of the tasks
