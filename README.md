# Weather API

This is an API provides **real-time weather information** for a given city. It integrates with the **OpenWeatherMap API** and demonstrates caching, clean backend structure, and automated tests.  

## Features

- **GET /api/weather/{city}** – fetch live weather from OpenWeatherMap  
- **GET /api/weather/{city}/cached** – same data, cached for 10 minutes  
- **Laravel 10 + PHP 8** code   
- PHPUnit **feature tests** for API + cache  


## Setup

1. **Clone the repo**

- git clone https://github.com/<your-username>/takehome.git
- cd takehome

2. **Copy .env.example to .env**

3. **Fill in your API keys and database credentials**

- APP_NAME=Laravel
- DB_DATABASE=takehome_exam
- DB_USERNAME=root
- DB_PASSWORD=
- WEATHER_API_KEY=YOUR_API_KEY

4. **Install dependencies**

- composer install

5. **Generate Laravel key**

- php artisan key:generate

6. **Run the server**

- php artisan serve
