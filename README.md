# Laravel FitCount

<!-- laravel fitcount description (for example, a BMI check) -->
<!-- Laravel FitCount is a modern web application designed to help users track and manage their fitness metrics. The application provides tools for calculating and monitoring Body Mass Index (BMI), allowing users to set fitness goals and track their progress over time. Built with Laravel 11, it offers a robust and secure platform for health-conscious individuals to maintain their wellness journey. -->

## Table of Contents

- [Laravel FitCount](#laravel-fitcount)
  - [Table of Contents](#table-of-contents)
  - [Tech Stack](#tech-stack)
  - [Installation](#installation)
  - [Development](#development)
  - [Contributing](#contributing)
  - [License](#license)
  - [Contact](#contact)

## Tech Stack

- **Laravel 11.x**: The PHP framework used to build the application.
- **Vite**: Frontend build tool
- **TailwindCSS**: Utility-first CSS framework
<!-- - **SQLite**: Default database for quick setup -->
- **MySQL 8.0**: Database for production

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

2. **Install dependencies**:

   ```bash
   composer install
   npm install
   ```

3. **Copy the `.env.example` file to `.env`**:

    linux/macOS:

    ```bash
    cp .env.example .env
    ```

    windows:

    ```powershell
    copy .env.example .env
    ```

    The `copy` command is the Windows equivalent of the Unix/Linux `cp` command. This will work correctly on Windows systems to create a copy of the `.env.example` file as `.env`.

    Both methods achieve the same result - creating a copy of the environment configuration file - just using the appropriate command for the operating system.

4. **Generate application key**:

   ```bash
   php artisan key:generate
   ```

5. **Set up your database**:
   - Update the `.env` file with your database credentials
   - Run migrations and seeders:
  
     ```bash
     php artisan migrate --seed
     ```

## Development

Start all development servers with a single command:

```bash
composer dev
```

This command runs:

- Laravel development server
- Queue listener for background jobs
- Real-time log viewer
- Vite development server for frontend assets

Each process runs in parallel with color-coded output for easy monitoring.

## Contributing

Contributions are welcome! Please follow the standard GitHub flow:

1. Fork the repository
2. Create a new branch
3. Make your changes
4. Submit a pull request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Contact

For any inquiries, please contact Ilham Ghaza at [Email](cb7ezeur@selenakuyang.anonaddy.com).
