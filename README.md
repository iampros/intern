Project Overview
This is a fully functional web-based Form Builder and Management System built using PHP, MySQL, HTML, CSS, and JavaScript.
It allows admins to create, edit, duplicate, and delete forms, while users can fill out forms and submit responses. Admins can view, analyze, and export responses in CSV format.
This project is ideal for anyone looking to build dynamic, no-code forms for surveys, feedback, or data collection.

Features
Admin Features
Create fully customizable forms with:
Text fields
textareas
Radio buttons
Checkboxes
Dropdowns
Add multiple fields dynamically with drag-and-drop reordering
Remove unwanted fields instantly
Edit existing forms with prefilled data
Duplicate forms in a single click
Delete forms safely
View all responses for each form
Export responses in CSV format
User Features
Access forms via a clean and responsive interface
Fill out forms with multiple field types
Submit responses seamlessly
Forms are mobile-friendly and accessible
Tech Stack
Frontend: HTML5, CSS3, JavaScript
Backend: PHP 7+
Database: MySQL
Server: XAMPP (Apache + MySQL)
Other: Drag-and-drop JS for field ordering


Installation Instructions
Clone the repository
git clone https://github.com/iampros/form-builder.git

Copy the project folder to XAMPP
C:\xampp\htdocs\form-builder

Import the database
Open phpMyAdmin → Create database: form_builder_db
Import the SQL file: form_builder_db.sql (included in repo)
Start XAMPP
Start Apache and MySQL
Access the project
http://localhost/form-builder/index.php

Usage Instructions
Admin Panel
Create Form: Click “Create New Form” → Add fields dynamically → Save
Edit Form: Click “Edit” → Update fields, labels, or order → Save
Duplicate Form: Click “Duplicate” → New copy is created
Delete Form: Click “Delete” → Confirm → Form removed
View Responses: Click “Responses” → View user submissions → Export CSV
User Interaction
Go to a specific form: view_form.php?id=FORM_ID
Fill out the fields → Submit
Admin will see responses immediately in the dashboard
