# GradTrack

GradTrack is a web application designed to manage student data effectively. Administrators and educators can add, update, delete, and search student records; the system also calculates overall performance metrics (like average marks) and presents a modern, responsive UI for streamlined data management.

---

## Table of Contents

1. [Project Overview](#project-overview)  
2. [Key Features & Options](#key-features--options)  
3. [Technologies Used](#technologies-used)  
4. [Requirements](#requirements)  
5. [Installation](#installation)  
6. [Usage](#usage)  

---

## Project Overview

GradTrack helps schools and institutions track student performance securely and interactively.  
- Secure sessions ensure only authenticated users can access data.  
- Modular MVC architecture keeps business logic, data access, and presentation separate.  
- Real‑time AJAX live search speeds up record retrieval without full page reloads.  

---

## Key Features & Options

### 1. User Authentication & Session Management
- **Login System**: Secure login with prepared‑statement authentication to prevent SQL injection.  
- **Session Handling**: Creates PHP sessions upon login and redirects to a protected dashboard.  
- **Logout**: Destroys session safely to prevent unauthorized access.

### 2. Student Data Management (CRUD)
- **Create**: Add new student with profile picture, name, email, total mark, percentage, and grade.  
- **Read**: List all students in a searchable, paginated table.  
- **Update**: In‑place editing via modal forms with data validation.  
- **Delete**: Confirmation prompt prevents accidental record removal.  
- **Average Calculation**: Dashboard displays the average total marks automatically.

### 3. Search & Live Suggestions
- **Live Search**: AJAX‑driven suggestions appear as you type a student’s name or email.  
- **Search Button**: Performs full search and shows “No data found” if no matches.

### 4. Data Security
- **Prepared Statements**: All database queries use PDO prepared statements.  
- **Validation**: Client‑side (JavaScript) and server‑side (PHP) validations enforce data integrity.

### 5. UI/UX
- **Bootstrap**: Ensures responsive layout on desktop and mobile.  
- **Custom CSS & JS**: Adds hover effects, modals, and dynamic interactions for a modern look.

### 6. Error Handling & Feedback
- **Inline Messages**: Validation errors appear next to form fields.  
- **Success Alerts**: Confirmation messages display after create/update/delete actions.

---

## Technologies Used

- **Core PHP (MVC)**  
- **HTML**, **CSS**, **Bootstrap**  
- **JavaScript**, **jQuery**, **AJAX**  
- **PDO / MySQL**  
- **XAMPP / phpMyAdmin**  

---

## Requirements

- **XAMPP** (Apache, PHP, MySQL) installed locally.  
- **phpMyAdmin** for database import.  
- PHP extensions: `pdo_mysql`, `session`, `fileinfo`.  
- Modern browser (Chrome, Firefox, Edge).  

---

## Installation

1. **Clone the repository**  
   git clone https://github.com/yourusername/GradTrack.git
   cd GradTrack

3. **Import the database**

   Launch phpMyAdmin: http://localhost/phpmyadmin
   Create database named gradtrack_db
   Use Import tab to upload gradtrack_db.sql

3. **Configure your environment**

   Open includes/config.php
   Set your DB credentials:

   define('DB_HOST', 'localhost');
   define('DB_NAME', 'gradtrack_db');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('BASE_URL', 'http://localhost/GradTrack/');

4. **Start the server**

   Open XAMPP Control Panel
   Start Apache and MySQL
   Access application at: http://localhost/GradTrack/

---

## Usage

1. **Register / Login**
- Go to /register.php to create an account.
- Login via /login.php.

2. **Dashboard**
- After login, view, add, edit, or delete student records.
- Navigate using the search box or action buttons.

3. **Live Search**
- Begin typing a name/email; suggestions pop up instantly.
- Click a suggestion to view that student’s row.

4. **Edit & Delete**
- Edit: Click the edit icon, modify fields in modal, and save.
- Delete: Click the trash icon and confirm removal.

5. **Logout**
- Click Logout in the navigation bar to end your session.
