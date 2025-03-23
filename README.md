# GADGET.TN(native php project)

## Overview
This project is a PHP-based web application following the Model-View-Controller (MVC) architecture. It includes user authentication, product management, and a shopping cart system. It is built using PHP and MySQL with PDO for database interactions.

## Features
- User authentication (login/logout using sessions)
- Product listing and management
- Shopping cart functionality
- Secure database operations using PDO
- Organized MVC architecture for better maintainability

## Technologies Used
- PHP
- MySQL
- HTML, CSS, JavaScript
- PDO (PHP Data Objects) for secure database interaction
- MVC Design Pattern

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/AmineHamdi-hub/GADGET.TN.git
   ```
2. Navigate to the project directory:
   ```sh
   cd Src
   ```
3. Import the database:
   - Create a database in MySQL.
   - Import the provided `database_export.sql` file.
4. Configure database connection:
   - Update `config/App.php` with your database credentials.

## Usage
1. Start Wamp/Laragon server:
2. Open `http://localhost:8000` (or the port you configured) in your browser. 
3. Register/Login to access features.

## Folder Structure
```
php-project/
├── app/
│   ├── controller/
│   ├── model/
│   ├── view/
├── config/
│   ├── database.php
├   |── adminsconfig.php
├── inc/ 
│   ├── css/
│   ├── js/
│   ├── images/
│   ├── footer.php
│   ├── header.php
│   ├── header_default.php
├── Adminpage.php
├── index.php
```

## Contributing
Feel free to fork the repository and submit pull requests for improvements.

## License
This project is licensed under the MIT License.

