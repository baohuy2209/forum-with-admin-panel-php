# Modern PHP Forum & Admin Management System

[![PHP Version](https://img.shields.io/badge/PHP-7.4%20|%208.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-5.7%20|%208.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Web Server](https://img.shields.io/badge/Apache-XAMPP-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://www.apachefriends.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-3.x%20|%204.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![CKEditor](https://img.shields.io/badge/CKEditor-WYSIWYG-008EC2?style=for-the-badge&logo=ckeditor&logoColor=white)](https://ckeditor.com/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

A robust, full-featured web forum application and dedicated administrative management portal built with native PHP (PDO), MySQL, Bootstrap, and CKEditor. The platform provides a discussion space for community members alongside a secure admin back-office for moderation and taxonomy control.

---

## 📑 Table of Contents
- [Overview & Architecture](#-overview--architecture)
- [Key Features](#-key-features)
  - [Public Forum (Frontend)](#public-forum-frontend)
  - [Administration Panel (Backend / Portal)](#administration-panel-backend--portal)
- [System Architecture & Interaction Flow](#-system-architecture--interaction-flow)
- [Directory Structure](#-directory-structure)
- [Tech Stack Breakdown](#-tech-stack-breakdown)
- [Database Schema & ERD](#-database-schema--erd)
- [Installation & Getting Started](#-installation--getting-started)
  - [Prerequisites](#prerequisites)
  - [Step-by-Step Setup](#step-by-step-setup)
  - [Database Configuration](#database-configuration)
  - [Default Credentials](#default-credentials)
- [Application Usage & Workflows](#-application-usage--workflows)
- [Security & Optimization Recommendations](#-security--optimization-recommendations)
- [License](#-license)

---

## 🏛 Overview & Architecture

This project is built around the **Modular Page Controller** architecture in PHP. It separates customer-facing community features from back-office management while sharing a unified relational database connection managed through **PHP Data Objects (PDO)**.

```
+-------------------------------------------------------------------------------+
|                                Client Browser                                 |
+---------------------------------------+---------------------------------------+
                                        |
                 +----------------------+----------------------+
                 | HTTP GET/POST                               | HTTP GET/POST
                 v                                             v
+---------------------------------+           +---------------------------------+
|      Public Forum Frontend      |           |     Admin Management Panel      |
|  - Layout: Bootstrap 3 + Custom |           |  - Layout: Bootstrap 4 Dashboard|
|  - CKEditor WYSIWYG             |           |  - Metrics & Management Tables  |
|  - Session: $_SESSION['user_id']|           |  - Session: $_SESSION['adminname|
+----------------+----------------+           +----------------+----------------+
                 |                                             |
                 +----------------------+----------------------+
                                        |
                                        v
                         +-----------------------------+
                         |      config/config.php      |
                         |   PDO Database Connection   |
                         +--------------+--------------+
                                        |
                                        v
                         +-----------------------------+
                         |     MySQL Database Store    |
                         |  (forum-admin-panel DB)     |
                         |  users, topics, replies,    |
                         |  categories, admins         |
                         +-----------------------------+
```

---

## ✨ Key Features

### Public Forum (Frontend)
- **User Authentication & Profiles**:
  - Secure registration with client & server-side validation and password hashing via `PASSWORD_DEFAULT` (Bcrypt).
  - Secure login with session storage (`user_id`, `username`, `email`, `user_image`).
  - Customizable user profile pages displaying personal bio and post activity statistics.
  - Avatar image uploads saved to persistent storage (`img/`).
- **Discussion Board & Topics**:
  - Dynamic topic feed sorted chronologically with category badges and reply count aggregation.
  - Category-based topic filtering.
  - Rich-text post creation and updates powered by CKEditor.
  - Author-restricted modifications (only thread authors can edit or delete their topics).
  - Cascading topic deletion (deleting a topic automatically clears all associated replies).
- **Interactive Thread & Reply System**:
  - Full discussion thread display with author details and cumulative post counts.
  - Real-time reply authoring with rich text formatting.
  - Reply modification and deletion restricted to the reply author.
- **Dynamic Sidebar Metrics**:
  - Real-time statistics counters for total users, topics, and categories.
  - Dynamic category listing with per-category topic counts.

### Administration Panel (Backend / Portal)
- **Isolated Admin Authentication**: Dedicated login session verification (`$_SESSION['adminname']`) separating administrator capabilities from standard users.
- **Dashboard Analytics**: Overview cards displaying real-time metrics for total topics, categories, administrators, and replies.
- **Administrator Management**: Interface to view and provision new administrator accounts with encrypted credentials and duplicate email prevention.
- **Taxonomy / Category Management**: Full CRUD capabilities to create, view, update, and delete forum categories.
- **Content Moderation**:
  - Centralized topic moderation table with direct deletion capabilities.
  - Centralized reply moderation table with avatar previews, direct thread links, and deletion tools.

---

## 📂 Directory Structure

```text
forum-with-admin-panel-php/
├── 404.php                           # Global 404 error landing page
├── index.php                         # Forum home page (Topic feed & category filter)
├── config/
│   └── config.php                    # PDO Database credentials & connection handler
├── includes/
│   ├── header.php                    # Public forum top navigation bar & asset loader
│   └── footer.php                    # Public forum dynamic sidebar & footer scripts
├── auth/
│   ├── login.php                     # User login processing & form
│   ├── register.php                  # User registration & avatar file upload
│   └── logout.php                    # Session invalidation & logout
├── topics/
│   ├── create.php                    # Topic authoring page with CKEditor
│   ├── topic.php                     # Topic view, reply list & reply submission form
│   ├── update.php                    # Topic edit page for topic owner
│   └── delete.php                    # Topic removal script with cascading reply deletion
├── replies/
│   ├── updateReplies.php             # Reply edit page for reply owner
│   └── delete.php                    # Reply removal script
├── users/
│   ├── profile.php                   # Public user profile & statistics summary
│   └── edit-user.php                 # User profile & bio modification page
├── admin-panel/                      # Administrative Back-Office Portal
│   ├── index.php                     # Admin overview dashboard & metric counters
│   ├── styles/
│   │   └── style.css                 # Admin dashboard layout & navigation styling
│   ├── layouts/
│   │   ├── header.php                # Admin top navbar, side navigation & session guard
│   │   └── footer.php                # Admin layout footer
│   ├── admins/
│   │   ├── admins.php                # View list of administrators
│   │   ├── create-admins.php         # Provision new administrator
│   │   ├── login-admins.php          # Admin login portal
│   │   └── logout-admins.php         # Admin session termination
│   ├── categories-admins/
│   │   ├── show-categories.php       # Category management table
│   │   ├── create-category.php       # Add new discussion category
│   │   ├── update-category.php       # Rename/modify existing category
│   │   └── delete-category.php       # Delete category script
│   ├── topics-admins/
│   │   ├── show-topics.php           # Global topic moderation table
│   │   └── delete-post.php           # Admin topic deletion script
│   └── replies-admins/
│       ├── show-replies.php          # Global reply moderation table
│       └── delete-replies.php        # Admin reply deletion script
├── css/
│   ├── bootstrap.css                 # Bootstrap 3.x framework core
│   └── custom.css                    # Public forum custom styling & theme
├── js/
│   ├── bootstrap.js                  # Bootstrap 3.x JavaScript components
│   └── ckeditor/                     # CKEditor 4 WYSIWYG editor distribution
├── fonts/                            # Glyphicons Halflings web font assets
└── img/                              # Uploaded user avatars & default placeholders
```

---

## 🛠 Tech Stack Breakdown

| Layer | Technologies Used |
| :--- | :--- |
| **Backend Engine** | PHP 7.4 / PHP 8.x (Native Procedural & Object-Oriented PDO) |
| **Database** | MySQL 5.7+ / 8.0+ / MariaDB with PDO Prepared Statements |
| **Authentication** | Native PHP Sessions, `password_hash()`, `password_verify()` (Bcrypt) |
| **Public UI Framework**| Bootstrap 3.3.4, HTML5, CSS3, Glyphicons |
| **Admin UI Framework** | Bootstrap 4.0.0, FontAwesome/Bootsnipp Admin Layout |
| **Client Scripting** | jQuery 1.11.1 |
| **WYSIWYG Editor** | CKEditor 4 Full Build |
| **Environment Server**| Apache HTTP Server (XAMPP / WAMP / LAMP / Linux Nginx+PHP-FPM) |

---

## 🗄 Database Schema & ERD

The database schema consists of **5 relational tables**:

```
+------------------+         +------------------+         +------------------+
|      users       | 1     * |      topics      | 1     * |     replies      |
+------------------+---------+------------------+---------+------------------+
| id (PK)          |         | id (PK)          |         | id (PK)          |
| name             |         | title            |         | reply            |
| email (UQ)       |         | category         |         | user_id (FK)     |
| username (UQ)    |         | body             |         | user_image       |
| password         |         | user_id (FK)     |         | topic_id (FK)    |
| about            |         | username         |         | created_at       |
| avatar           |         | created_at       |         +------------------+
| created_at       |         +------------------+
+------------------+
        |
        | 1
        |
        | *
+------------------+         +------------------+
|    categories    |         |      admins      |
+------------------+         +------------------+
| id (PK)          |         | id (PK)          |
| name             |         | adminname        |
| created_at       |         | email (UQ)       |
+------------------+         | password         |
                             | created_at       |
                             +------------------+
```

### SQL Table Schema Creation Script

```sql
CREATE DATABASE IF NOT EXISTS `forum-admin-panel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `forum-admin-panel`;

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `about` TEXT DEFAULT NULL,
  `avatar` VARCHAR(255) DEFAULT 'gravatar.png',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Admins Table
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `adminname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Categories Table
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Topics Table
CREATE TABLE IF NOT EXISTS `topics` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `body` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`user_id`),
  INDEX (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Replies Table
CREATE TABLE IF NOT EXISTS `replies` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `reply` TEXT NOT NULL,
  `user_id` INT NOT NULL,
  `user_image` VARCHAR(255) DEFAULT 'gravatar.png',
  `topic_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`user_id`),
  INDEX (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Initial Categories
INSERT INTO `categories` (`name`) VALUES
('Design'),
('Development'),
('Business & Marketing'),
('Search Engines'),
('Cloud & Hosting');
```

---

## 🚀 Installation & Getting Started

### Prerequisites
- **Web Server**: [XAMPP](https://www.apachefriends.org/), WAMP, LAMP, or standalone Apache/Nginx.
- **PHP**: PHP 7.4 or PHP 8.0+ with `pdo_mysql`, `mbstring`, and `fileinfo` extensions enabled.
- **Database**: MySQL 5.7+ / 8.0+ or MariaDB 10.3+.
- **Web Browser**: Chrome, Firefox, Safari, or Edge.

---

### Step-by-Step Setup

#### 1. Clone or Move Project to Web Root
Clone the repository into your local web server's document root (e.g., `htdocs` for XAMPP):
```bash
cd C:/xampp/htdocs/
git clone https://github.com/baohuy2209/forum-with-admin-panel-php.git
```

#### 2. Import the Database Schema
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`) or your preferred MySQL client (MySQL Workbench, DBeaver, CLI).
2. Create a new database named `forum-admin-panel`.
3. Import the SQL script provided in the [Database Schema](#sql-table-schema-creation-script) section above.

#### 3. Configure Database Connection
Open `config/config.php` and verify/update your MySQL credentials:
```php
<?php 
    define("HOST", "localhost"); 
    define("DBNAME", "forum-admin-panel");
    define("USER", "root");
    define("PASSWORD", ""); // Enter your MySQL root password here (default in XAMPP is empty)

    try {
        $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8mb4", USER, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
?>
```

#### 4. Configure Application URLs (If Needed)
If you deploy to a custom virtual host or subdirectory, ensure the `APPURL` constants match your environment:
- In `includes/header.php`:
  ```php
  define("APPURL", "http://localhost/forum-with-admin-panel-php");
  ```
- In `admin-panel/layouts/header.php`:
  ```php
  define("APPURL", "http://localhost/forum-with-admin-panel-php/admin-panel");
  ```

#### 5. Set Directory Permissions (Linux / macOS)
Ensure the image upload directory is writable by the web server:
```bash
chmod -R 775 img/
```

#### 6. Access the Application
- **Public Forum**: Open [http://localhost/forum-with-admin-panel-php/index.php](http://localhost/forum-with-admin-panel-php/index.php) in your browser.
- **Admin Panel**: Open [http://localhost/forum-with-admin-panel-php/admin-panel/index.php](http://localhost/forum-with-admin-panel-php/admin-panel/index.php).

---

### Default Credentials (Initial Admin Creation)

You can insert an initial administrator directly via SQL:
```sql
-- Creates an admin with email: admin@forum.local and password: adminpassword
INSERT INTO `admins` (`adminname`, `email`, `password`) VALUES
('SuperAdmin', 'admin@forum.local', '$2y$10$e7K4y5.F74L3/F85e54dRe3Kx04p80n8QZ8cZ7y8g44mP6j4zO8ea');
```
*(Or create your first administrator by registering or through `admin-panel/admins/create-admins.php` once logged in).*

---

## 📖 Application Usage & Workflows

### Public Community Workflow
1. **Sign Up**: Navigate to **Register**, fill in name, username, email, password, bio, and upload an avatar.
2. **Browse Feed**: View topics on the home page or click on any category in the sidebar to filter topics.
3. **Start a Discussion**: Click **Create Topic**, choose a category, enter a title, and use CKEditor to format the topic body.
4. **Participate in Topics**: Open any topic to read replies. Use the reply editor at the bottom to submit your reply.
5. **Manage Your Content**: Edit or delete your own topics/replies directly from the topic view.

### Administrative Workflow
1. **Access Portal**: Visit `/admin-panel/admins/login-admins.php` and sign in.
2. **Dashboard Overview**: Check aggregate counts of active topics, categories, admins, and replies.
3. **Manage Taxonomy**: Create or rename forum categories via **Categories**.
4. **Moderate Discussions**:
   - Review all forum topics via **Topics** and remove non-compliant discussions.
   - Review and moderate user replies via **Replies**.
5. **Staff Provisioning**: Add additional team administrators via **Admins > Create Admins**.

---

## 🔒 Security & Optimization Recommendations

For production environments, the following enhancements are recommended:
1. **Environment Variables**: Move database credentials to a `.env` file using `vlucas/phpdotenv` rather than hardcoding in `config/config.php`.
2. **Prepared Statements Audit**: Ensure all dynamic SQL queries across every file consistently use parameterized PDO prepared statements to guarantee full protection against SQL Injection.
3. **Input Sanitization & XSS Protection**: Escape output rendered from user inputs using `htmlspecialchars($data, ENT_QUOTES, 'UTF-8')`.
4. **CSRF Tokens**: Implement Anti-CSRF tokens (`$_SESSION['csrf_token']`) on all POST forms.
5. **File Upload Hardening**: Validate MIME types using `finfo_file()` and randomize uploaded avatar filenames before saving to disk.

---

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).
