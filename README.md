# Movies Project <p align="start"><a href="https://laravel.com" target="_blank"><img src="resources/img/logotipo.png" width="150" alt="Cinemagic Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Description:
- From last semester, the group had a project developed in Laravel using the Blade Framework. The project allows users to browse through a catalog of movies, check screenings, watch trailers, and securely purchase tickets online. It is built using Laravel as the backend framework and Blade for the frontend templating system.The system is backed by a database that manages movie information, session schedules, and ticket purchases, ensuring data consistency and easy retrieval.

- We took this project a step further by replacing the database-driven movie retrieval with data fetched from the **TMDB API**. The system now dynamically pulls movie details, including titles, descriptions, and trailers, directly from the API. We also created custom sessions for these movies, allowing users to view showtimes and purchase tickets as before.

### Accesses: 
 -  **Website :**   [localhost](http://localhost)
 -  **DataBase :**  [localhost:8080](http://localhost:8080)
 -  **TMDB API :**  https://developer.themoviedb.org/reference/intro/getting-started
  


## How to run successfully the project:

### Software Requirement:
- Docker Desktop: https://www.docker.com/products/docker-desktop/
- WSL:
  - On CMD or Powershell in Windows, insert this:

  ```
  wsl --install
  ```


### Commands required in order to get the latest version of the project:

In case of not having sail installed:
- Open on IDE VsCode a new WSL (UBUNTU) terminal and run this [WSL terminal]:
  
    ```
      ./vendor/bin/sail composer require laravel/sail --dev
    ```

1. Get the newest version of the packages of the project [WSL terminal]:

   ```
   ./vendor/bin/sail composer update
   ```
2. Build the containers on Docker [WSL terminal]:
   
   ```
   ./vendor/bin/sail up -d
   ```
3. Drop the tables and get the most recent version of DB [WSL terminal]:

   ```
   ./vendor/bin/sail art migrate:fresh
   ```
   This command may possibly take some time:
   ```
   ./vendor/bin/sail art db:seed
   ```
4. Automatic live reload, required [PS terminal]: 

    ```
   npm run dev
   ```
 


## Possible cases of event:

- Maria has a iOS system while the rest of the group have a Windows system. Came to our attention that the website can load faster on the iOS system while on Windows can take some time.


## Authors:

- Alexandre Figueiredo
- José Brites
- Maria Malato

