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
- Add an .env file in the root of the project with the code in the .env.example
  

### Commands required in order to get the latest version of the project:

Open on IDE VsCode a new WSL (UBUNTU) terminal, check if it is on the project's directory and execute this [WSL terminal]:
  
```
  ./vendor/bin/sail build --no-cache
```
- If it is not on the project's directory:
    ```
    cd /mnt/c/Users/ *directory of the project*
    ```
1. Build the containers on Docker [WSL terminal]:
   
```
./vendor/bin/sail up -d
```
- It may take some time, desired output: 
    <em>
    <p>[+] Running 3/3 </p>
    <p> ✔ Container projeto-adminer-1       Running                                         0.0s </p>
    <p> ✔ Container projeto-mysql-1         Running                                         0.0s </p>
    <p> ✔ Container projeto-laravel.test-1  Running                                         0.0s</p>
    </em>
    
2. Get the newest version of the packages of the project [WSL terminal]:

```
./vendor/bin/sail composer update 
```

3. Drop the tables and get the most recent version of DB [WSL terminal]:

```
./vendor/bin/sail art migrate:fresh
```
   This next command may possibly take some time [WSL terminal]:
   <p>It will asked the language of the movies, press 0 (USA English).</p>

```
./vendor/bin/sail art db:seed
```

4. Automatic live reload, required [PS terminal]: 
```
npm run dev
```
 

## Possible cases of event:

- Maria has a iOS system while the rest of the group have a Windows system. Came to our attention that the website can load faster on the iOS system while on Windows can take some time.
- On users page, if the user doesn't have image and it is not loading a default one please execute this command [WSL Terminal]:
  ```
  ./vendor/bin/sail art optimize:clear
  ```
- Attached here is the video of the perfomance of the website on iOS system:
  - https://tvzhr-my.sharepoint.com/:f:/g/personal/mmalato_tvz_hr/EoYUWPAG3HNAnb49cnOVzUEBtXboeFqMYQxNq2NpH47aug?e=0zX12R

## User Roles:

- Admins
  - Cannot buy tickets to screenings;
  - Can edit screenings, theaters, genres, profile;
  - Can see all users;
  - Can create new screenings,theaters,genres, employee & admins;
  - Can see the statistics for occupancy rate and most sales.

- Employees
  - Can see and validate/invalidate tickets;
  - Can see the screenings details and see tickets for each screenings;
  - Cannot edit profile, only admins can.
    
- Customers
  - Can buy tickets for screeenings;
  - Get an extra discount on tickets because they are users of the application.
  - Can edit profile;
  - Can see purchases.
    
- Guests
  - Can buy tickets for screenings.
  - Can see movies, screenings, theaters.

## Authors:

- Alexandre Figueiredo
- José Brites
- Maria Malato

