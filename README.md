# Laravel FitCount

<!-- laravel fitcount description (for example, a BMI check) -->
<!-- Laravel FitCount is a modern web application designed to help users track and manage their fitness metrics. The application provides tools for calculating and monitoring Body Mass Index (BMI), allowing users to set fitness goals and track their progress over time. Built with Laravel 11, it offers a robust and secure platform for health-conscious individuals to maintain their wellness journey. -->

## Table of Contents

- [Laravel FitCount](#laravel-fitcount)
  - [Table of Contents](#table-of-contents)
  - [Tech Stack](#tech-stack)
  - [Installation](#installation)
  - [Contributing](#contributing)
  - [License](#license)
  - [Contact](#contact)

<!-- - **Face Recognition**: Users can clock in and out using face recognition technology.
- **Geolocation**: Ensures that attendance is recorded only when users are at the specified location.
- **Absence Management**: Users can provide reasons and evidence for absences.
- **User-Friendly Interface**: Built with Filament to provide a clean and intuitive admin panel. -->

## Tech Stack

- **Laravel 11.x**: The PHP framework used to build the application.
<!-- - **Filament 3**: Used for the admin interface and resource management.
- **MySQL 8.0**: The database system used to store all records.
- **Sanctum**: For API authentication. -->

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/IlhamGhaza/laravel-fitcount.git
   cd laravel-fitcount
   ```

   use ssh:

   ```bash
   git clone git@github.com:IlhamGhaza/laravel-fitcount.git
   cd laravel-fitcount
   ```

   or download the zip file and extract it.

2. **Install dependencies**:

   ```bash
   composer install
   ```

3. **Copy the `.env.example` file to `.env`**:

   ```bash
   cp .env.example .env
   ```

4. **Generate application key**:

   ```bash
   php artisan key:generate
   ```

5. **Set up your database**:

   - Update the `.env` file with your database credentials.
   - Run migrations and seeders:
  
     ```bash
     php artisan migrate --seed
     ```

6. **Serve the application**:

   ```bash
   php artisan serve
   ```

<!-- ## Usage

- **Admin Panel**: Manage shifts, schedules, and attendance records via the Filament interface.
- **Attendance Tracking**: Users can log in via face recognition and geolocation. -->
<!-- 
## API

This project includes an API built with Laravel Sanctum and Orion for handling CRUD operations. -->

## Contributing

Contributions are welcome! Please follow the standard GitHub flow:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)


## Contact

For any inquiries, please contact Ilham Ghaza at [Email](cb7ezeur@selenakuyang.anonaddy.com).
