## Patient Monitor

Link to the project: http://patient-monitor.codebot.pro/

Demo credentials: http://patient-monitor.codebot.pro/demo-credentials.pdf

### About

A simple dashboard designed for both doctors and patients to share and review medical records.    
    
Developed for Twilio Dev.to Hackathon

## Features
- Medical records are encrypted in the database.
- Doctor adds patients to his patient list by their phone number.
- Once patient accepted the request - he's assigned to doctor and has an ability to submit records.
- Doctor has an ability to review patient records (datatables).  
- Doctor has an ability to review data represented in charts.
- There are 2 charts. First chart draws body temperature changes, and the second one - symptoms frequency.
- Patient can report his body temperature and mention any symptom he has - cough, hard breath, sore throat, diarrhea, tiredness.

## Requirements

- PHP 7.4
- NPM/Node
- MySQL/MariaDB
- Twuilio account

## Frameworks used
- Laravel 7
- Vue.js 2
- Bootstrap 4

### Local development

- Clone the project
- If you want to use docker - build containers and create a database inside the mysql container. Also add `patient-monitor.local` host to your hosts file.
- Copy and rename the `.env.example` to `.env`,  make sure to update database configs, and Twilio account credentials.
- Run `composer install` to install Laravel dependencies.
- Run `npm install` to install front-end dependencies.
- Run `php artisan key:generate` to generate the APP_KEY environment variable.
- Create the database if you've not created.
- Run `php artisan migrate` to get the database migrated.
- You can seed users and records if you want - run the `php artisan db:seed` command. It will seed data stored in csv files located in `database/located/csv` folder.
