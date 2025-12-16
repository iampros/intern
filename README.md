Project Overview
This is a fully functional web-based Form Builder and Management System built using PHP, MySQL, HTML, CSS, and JavaScript.
It allows admins to create, edit, duplicate, and delete forms, while users can fill out forms and submit responses. Admins can view, analyze, and export responses in CSV format.
This project is ideal for anyone looking to build dynamic, no-code forms for surveys, feedback, or data collection.

Folder structure
form-builder/
│
├── db.php                # Database connection
├── index.php             # List all forms
├── create_form.php       # Create new form
├── edit_form.php         # Edit existing form
├── delete_form.php       # Delete form
├── view_form.php         # User form view & submission
├── save_form.php         # Save new or edited forms
├── save_response.php     # Save user responses
├── view_responses.php    # Admin view responses
├── export_csv.php        # Export responses as CSV
├── form_builder_db.sql   # Database structure
└── assets/
     ├── style.css        # CSS for responsive layout
     └── script.js        # JS for dynamic fields & drag-drop

Step 1: Start XAMPP
Open XAMPP Control Panel.
Start Apache (web server) and MySQL (database).
Make sure both are running (green indicator).

Step 2: Place the Project in XAMPP
Go to your XAMPP installation folder (usually C:\xampp\htdocs on Windows).
Copy your project folder (form_builder) into htdocs:
C:\xampp\htdocs\form_builder

Step 3: Import the Database
Open your web browser and go to:
http://localhost/phpmyadmin/

Create a new database:
Click New on the left panel
Name it: form_builder_db
Collation: utf8_general_ci
Click Create
Import the SQL file:
Click on the database form_builder_db in phpMyAdmin
Go to the Import tab
Click Choose File and select form_builder_db.sql (provided in your project)
Click Go
You should see a message: Import has been successfully finished

Step 4: Configure Database Connection
Open db.php in your project folder.
Make sure the credentials match XAMPP defaults:
$servername = "localhost";
$username = "root";
$password = ""; // leave empty for XAMPP
$dbname = "form_builder_db";
✅ Default XAMPP MySQL username is root with no password.

Step 5: Run the Project
Open your browser and go to:
http://localhost/form_builder/index.php
You should see the Form Management Dashboard.
From here, you can:
Create new form
Edit / Duplicate / Delete forms
View responses
To test as a user:

Usage Instructions
Admin Panel
Create Form: Click “Create New Form” → Add fields dynamically → Save
Edit Form: Click “Edit” → Update fields, labels, or order → Save
Duplicate Form: Click “Duplicate” → New copy is created



