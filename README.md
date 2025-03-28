<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
## Quick Installation
    git clone https://github.com/Peter-1000/job-board
    cd SD_Project/

### installation

    git clone https://github.com/Peter-1000/job-board
    cd project
    cp .env.example .env

you may use docker compose or docker-compose based on the version you have
I'm using some ports, if the ports are allocated already at your machine
please change them at docker-compose.yml

```
composer install 
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve --host=0.0.0.0 --port=8000
```

you may access the website at

```
http://localhost:8000/
```

### Postman

     file postman => job-board.postman_collection.json

### Usage Skills  in attendance Systems

    Repositry Design Pattern
    Adapter Design Pattern
    Service Provier
    Request Validation
    Feature Testing

### About Task

This Job Board application is a comprehensive solution for managing job listings and advanced filtering. The combination
of Entity-Attribute-Value (EAV) design with relational database models ensures flexibility and scalability, making it
easy to add new job attributes without disrupting the existing system. By providing powerful and dynamic filtering
options, users can efficiently find the most relevant job listings, while employers and administrators have the tools
they need to manage and monitor the system.

endpoints of api:

- our jobs
- job attributes.
- categories
- countries
- states
- cities
