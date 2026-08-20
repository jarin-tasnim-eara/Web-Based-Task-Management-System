# Web-Based Task Management System

A web-based task management system built with PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. The system allows users to securely register, log in, and manage their tasks with status and priority tracking.

## Live Demo

[View Live Website](https://taskmanagementsystembyera.infinityfreeapp.com/)

## Project Overview

Managing daily tasks and deadlines can be difficult for students and professionals. This project provides a simple and user-friendly platform to organize, track, and manage tasks efficiently.

## Features

- User registration and login
- Secure password hashing
- Session-based authentication
- Add new tasks
- Edit existing tasks
- Delete tasks
- Update task status
- Task priority management
- Dashboard with task statistics
- Task categorization
  - Pending
  - In Progress
  - Completed
- Duplicate email prevention
- MySQL database integration
- Responsive user interface
- User-friendly task management dashboard

## Technology Stack

### Frontend

- HTML
- CSS
- JavaScript
- Bootstrap

### Backend

- PHP

### Database

- MySQL

### Development Tools

- Visual Studio Code
- XAMPP
- Google Chrome
- draw.io

## Screenshots

### Login Page

![Login Page](images/login.jpg)

### Registration Page

![Registration Page](images/register.jpg)

### Dashboard

![Dashboard](images/dashboard.jpg)

## Main Modules

### 1. User Authentication

Handles user registration, login, logout, sessions, and password hashing.

### 2. Task Management

Allows users to add, edit, delete, and manage their tasks.

### 3. Task Status Tracking

Tasks can be categorized into three statuses:

- Pending
- In Progress
- Completed

### 4. Task Priority Management

Users can assign priorities to their tasks to help organize and manage important work.

### 5. Dashboard

The dashboard provides an overview of the user's tasks and displays task statistics.

## Database

The project uses MySQL as the database system.

The main database tables are:

- `users`
- `tasks`

The database structure is provided in:

`TaskManager.sql`

## Local Setup

To run the project locally:

1. Install XAMPP.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Clone this repository.
4. Place the project folder inside the XAMPP `htdocs` directory.
5. Create a MySQL database.
6. Import `TaskManager.sql` into the database.
7. Configure the database connection in `config.php`.
8. Open the project through localhost.

## Deployment

The project is deployed using InfinityFree hosting.

GitHub Actions is configured to automatically deploy changes from the `main` branch to the live website.

Any changes pushed to the repository can be deployed automatically through the configured GitHub Actions workflow.

## Project Objectives

- Develop a secure web-based task management system
- Implement user registration and authentication
- Provide CRUD operations for tasks
- Track task progress and status
- Manage task priorities
- Store and manage data using MySQL
- Develop a responsive and user-friendly interface

## System Architecture

The project follows a client-server architecture consisting of:

- Frontend: HTML, CSS, JavaScript, and Bootstrap
- Backend: PHP
- Database: MySQL

## Development Methodology

The system was developed using a modular approach with separate components for:

- User authentication
- Task management
- Database operations
- Dashboard
- User interface

## Future Improvements

- Email notifications
- Task deadlines and reminders
- Task search and filtering
- Admin panel
- User profile management
- Task analytics and reports
- Improved notification system

## Author

**Jarin Tasnim Eara**

GitHub: [@jarin-tasnim-eara](https://github.com/jarin-tasnim-eara)

**Jarin Tasnim Eara**

GitHub: [@jarin-tasnim-eara](https://github.com/jarin-tasnim-eara)
