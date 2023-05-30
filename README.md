![Mark Watson](./public/assets/php-oop.webp)
# Full PHP 8 Tutorial by Program with Gio
## Section 2: Review and Exercise Project

### Table of Contents

01. [Project Description](#1-description)
02. [User Story](#2-user-story)
03. [Acceptance Criteria](#3-acceptance-criteria)
04. [Application Features](#4-features)
05. [Installation](#5-installation)
06. [Usage](#6-usage)
07. [Credits](#7-credits)
08. [License](#8-license)
09. [Repository Status](#9-github-repo-status)
10. [Contribute](#10-how-to-contribute)
11. [Tests](#11-tests)
12. [Checklist](#12-checklist)

---
### 1. Description
**What is this project?**
* An exploration into Object Oriented Programming in PHP.

**Why this project?**
* It was an exercise set in the online tutorial provided by [Programming With Gio](https://www.youtube.com/@ProgramWithGio).

**What problem does this project solve?**
* Provides a basis for uploading a file and using the server side to save the data in the file for later processing / retrieval.

**Lessons learnt?**
* PHP is a great programming language, however, like a lot of programming languages, there are a lot of ways to achieve the same outcome, but often there is only the 1 way to do it efficiently.

---
### 2. User Story

```
AS A company executive
I WANT quickly create transaction reports summarising my account activities
SO THAT I can provide the team with a one point access to review the transaction data.
```
---
### 3. Acceptance Criteria

```
GIVEN a landing page with an upload file button
WHEN I select the upload button
THEN I am presented with a file manager dialogue window to navigate and select the file I want to upload
WHEN I finish selecting the file if the file is not .csv file and less than 2Mb
THEN I receive a notification / toast that the request has failed
WHEN I attempt again to select a .csv file less than 2Mb
THEN I am presented with a notification / toast that the file upload was successful
WHEN I select the `Report` button 
THEN I am taken to a new page and provided with a report of all the data I uploaded, including summations of the data.  There is also a persisting notification that there is new data.
WHEN I leave the page and come back at another stage, with out uploading a further report but just selecting `Report`
THEN I am provided again the report with all the data previously uploaded and without the notifcation message at the top of the report that there is new data.
```
---
### 4. Features
- users select .csv files to upload which are then processed with the data saved into a database.
- the app architecture loosely follows the M-V-C structure.
- you can add as many .csv files as needed, when ready, selecting the `Report` button will run the script to save the data to the database and generate the report.
- handy UI notifications / toasts are provided to help users know if their requests have been fulfilled.  A simple timer has been added to the notifications / toasts so that they clear in notification / toast time set.
- there is a file checker to make sure users are only uploading compliant .csv files less than the system's file size restrictions.  

---
### 5. Installation
1. Download / clone the source code from my repository located in: [GitHub](https://github.com/Mark33Mark/php-oop) 
2. If using Docker, which I recommend to test this project initially, then `cd` into the docker directory & run `docker-compose up -d`. 
3. If you are already have a server environment setup and are using something else like XAMPP, make sure you have Web Server (Apache), PHP & MySQL running.
4. **PHP 8** is required for this source code to not error out your console 😖.  If you like hanging onto the past then you will need to adjust the code to make it work for lower PHP versions.
5. Create a `.env` file by copying variables from `.env.example`. Fill in those values in your `.env` file.
6. Make sure that whatever database name you enter actually exists, if not, create that database.
7. I recommend using `mySQL Workbench`, from in Workbench or the mySQL CLI, run this Prepared Statement script - I considered adding this into the code, however it is only needed once to set up the database so decided not to:
```
USE put-your-database-name-here;  
CREATE TABLE transactions (  
id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
transaction_date DATE NOT NULL,  
check_number MEDIUMINT,  
description VARCHAR(50) NOT NULL,  
amount DECIMAL(6,2)  
);  
```
8. Confirm that once you open your `http://localhost:8000` (or whatever local port you've configured) that it loads the home page.
9. Sample transaction files are provided in the required format for you to test uploading: [file 1](docs/transactions_sample1.csv) and [file 2](docs/transactions_sample2.csv)

---
### 6. Usage
The code is available from: [GitHub repository](https://github.com/Mark33Mark/https://github.com/Mark33Mark/php-oop) and includes all assets required for the project.  
Once you've downloaded, you can modify the code as you need.

---
### 7. Credits
This project was done as part of a YouTube PHP tutorial I discovered. It is: [Program With Gio](https://www.youtube.com/@ProgramWithGio)
Amazing tutorials - really well set out and providing logical progression to help those of us wanting to improve their PHP knowledge.  
Course outline available on [Gio's GitHub](https://github.com/ggelashvili/learnphptherightway-outline) 
Nice work Gio, thanks for all the hard work you've done to create these useful tutorials 👍🏼

**Other credits:**  
- [Dave Hollingworth](https://gist.github.com/daveh/6934c8d5cd7cd4b0afa1f15ae4799484)
- [Common MIME types - mdn web docs](https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types)

---
### 8. License
The works in this repository are subject to:

[![GitHub](https://img.shields.io/github/license/Mark33Mark/weather-dashboard)](docs/license_MIT.md)

---
### 9. GitHub repo status

![GitHub top language](https://img.shields.io/github/languages/top/Mark33Mark/php_oop)
![GitHub language count](https://img.shields.io/github/languages/count/Mark33Mark/php_oop)
![GitHub last commit](https://img.shields.io/github/last-commit/Mark33Mark/php_oop)
![GitHub commit checks state](https://img.shields.io/github/checks-status/Mark33Mark/php_oop/d42f780bffa767b997582e1901064f0f8636640c)

---
### 10. How to Contribute
If you would like to contribute, please comply with the Contributor Covenant Code of Conduct:

[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-2.1-4baaaa.svg)](docs/code_of_conduct.md)

---
### 11. Tests
- No tests have been written for this app - will try to add some in the future.

---
### 12. Checklist
All actions not checked are still to be completed:
* [X]  Write your own user stories and acceptance criteria;
* [X]  Create a new route & controller that will let you upload the transactions CSV file;
* [X]  Controller should accept the uploaded file, read it line by line & save the data into the **transactions** table;
* [X]  **transactions** table created with appropriate columns to store the data;
* [X]  Create a model within the **Models** directory to actually process the file & save data into the database;
* [X]  First column in the `report table` is the date of the transaction;
* [X]  Second column is the cheque # which is optional & is not always provided;
* [X]  The third column is transaction description;
* [X]  The fourth column is the amount (negative number indicates it's an expense, positive number indicates it's an income), it's up to you how you want to store it;
* [X]  The date of the transaction is in the format "Jan 4, 2021";
* [X]  Show income amounts in green color & show expense amounts in red;
* [X]  Use good quality coding standards (indentation, scoping, naming, etc);
* [X]  Must not use alerts, confirms or prompts.  We used innerHTML method to write to the webpage any issues.
* [X]  Must be interactive, that is accepts and responds to user input.
* [X]  Application loads with no errors when inspected with Chrome DevTools.
* [X]  Github repository contains our application code [GitHub location](https://github.com/Mark33Mark/php-oop)
* [X]  Repository has a unique name; follows best practice for file structure; and naming conventions.
* [X]  Repository contains multiple descriptive commit messages.
* [X]  Repository contains a README file with description, screenshot and link to deployed application.  

---

- [Back to the top](#full-php-8-tutorial-by-program-with-gio)
