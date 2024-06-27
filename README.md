# Welcome to the Guardians of Dreams Shop!

## Technology Stack

![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

## Project Requirements
The project includes the following components:

- A page to display all products from the database.
- User registration system.
- User authorization system.
- User profile available after registration.
- Ability to add and delete products.

## Project structure

The project is organized as follows:
```
| -- /components
| -- header.php
| -- footer.php
```
This is where the common components of the site interface are located, such as the header and footer. 
```Header.php``` contains the code for the top of the page, including the navigation menu and logo. 
````Footer.php``` contains the code for the bottom of the page.

```
|-- /css
| -- style.css
| -- footer.css
|| -- header.css
```
Cascading Style Sheets (CSS) are stored here, which define the appearance of elements on the page. 
```Style.css``` usually contains common styles for the entire site. 
```Footer.css and Header.css``` are used to style the respective components.

```
|-- /img
| -- logo.png
```
Images used on the site are stored here. 
```` ```Logo.png``` is the logo of the online store.

```
|-- /js
|-- scripts.js
```
This stores JavaScript code that interacts with the user or performs other dynamic tasks on the page. 
``Scripts.js`` can include various scripts such as form processing, image sliders, etc.

```
|-- /sql
| -- users.sql
| -- products.sql
|-- -- store.sql
```
Here are the SQL scripts that are used to create and manage the database. 
```Users.sql``` - contains the user table definitions. 
````Products.sql``` - contains the products table
``` ``Store.sql``` - contains the store table.

```
|-- index.php
```
This is the main page of the site, which is usually the entry point for visitors. This is where product information is presented.

```
|-- cart.php
```
This is the shopping cart page where the user can view the selected products and place an order.

```
|-- login.php
```
This is the login page where the user can enter their credentials to access secure areas of the site.

```
|-- register.php
```
This is the registration page where new users can create an account on the site.

```
|-- profile.php
```
This is the user's profile page where they can manage their data, settings and orders.

```
|-- db_config.php
```
This is the database configuration file which contains the information needed to connect to the database such as hostname, database name, username and password.

```
|-- .htaccess
```
This is an Apache configuration file that is used to configure the server and manage URLs.


## How to get started with the project

To get started with the project, you will need the following:

1. Install OpenServer or another tool to start a local server.
1. Create a database and import SQL scripts from the /sql folder to create tables.
2. Replace the contents of the db_config.php file with the actual data of your database.
3. Open the .htaccess file and customize the URL rewrite rules to suit your needs.
4. Run the project on your local server.

## Support and Feedback

If you have any questions or suggestions for improving the project, please contact me via GitHub. I will be glad to hear your opinion and help you in mastering the project.

Thank you for your interest in the Guardians of Dreams Shop project!