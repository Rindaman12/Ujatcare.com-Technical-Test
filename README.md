<a name="title"></a>

# About The App

This app was made for the realization of the technical test for UJATCARE.COM.

## Table of Contents

1. [Technologies Involved in the Development Of The App](#technologies)
2. [Requirements For Installation](#requirements)
3. [Installation](#installation)
4. [Starting The Project](#starting)
5. [Authors](#collaboration)

## Technologies Involved in the Development Of The App

<a name="technologies"></a>

A list of; Software, Services, Package managers, Frameworks, Languages, etc. That were used in the development of this app.

-   [Git](https://git-scm.com) - Version Control System
-   [PHP](https://www.php.net) - Programming Language
-   [Javascript](https://www.javascript.com) - Programming Language
-   [Node.JS](https://nodejs.org/en/) - Javascrit Runtime
-   [NPM](https://www.npmjs.com) - Package Manager For The Node JavaScript platform
-   [Composer](https://getcomposer.org) - Package Manager For PHP
-   [Laravel](https://laravel.com) - PHP Framework
-   [Vue.JS](https://v3.vuejs.org) - Javascript Framework
-   [MYSQL](https://www.mysql.com) - Database Service

[Go Back To Title](#title)

## Requirements For Installation

<a name="requirements"></a>

First and foremost, before making the installation and set up of the App, you will need to have installed in your PC, the following techonologies:

-   [Git](https://git-scm.com)
-   [Node.JS](https://nodejs.org/en/)
-   [NPM](https://www.npmjs.com)
-   [Composer](https://getcomposer.org)
-   [Laravel](https://laravel.com)
-   [Vue.JS](https://v3.vuejs.org)
-   [MYSQL](https://www.mysql.com)

Please follow the instructions specified on the official site on how to properly install and configure each technology.

[Go Back To Title](#title)

## Installation

<a name="installation"></a>

1: Clone the project from the repository, you can do it using this command from your terminal:

```
https://github.com/Rindaman12/Ujatcare.com-Technical-Test.git
```

2: Create the database (MYSQL is recommended for the creation and use of the database) to which the application will connect to.

3: Modify the env file with your personal data of the DB and others.

-   **3.1: In the case you are not using MYSQL, you should change the file database.php located in the folder config.**

4: Modified the seeders for the specific number of dummy users. This are located inside the folder database/seeders.

-   **PHP 7.3 and the last versions of npm and composer are required for the installation of the proyect in any enviroment**

[Go Back To Title](#title)

## Starting The Project

<a name="starting"></a>

1: Install all the Composer dependencies that the app needs, you can do this by using this command:

```
composer install
```

or

```
composer update
```

2: Run the migrations of the project, so you can have your database ready for use.

```
php artisan migrate --seed
```

3: Install all the NPM dependecies

```
npm install
```

4: Make use of the next command:

```
npm run dev
```

-   **4.1: In case of having troubles with the display of the changes, use the next commands:**

```
npm cache clear --force && sudo php artisan cache:clear && php artisan config:clear && php artisan config:cache && php artisan route:clear
```

5: The captcha functionality for Login & Register is commented by default, for using it you need to use an virtual host (e.g: ujatcare.test) and create your captcha keys in v3 administration listed in the url below:

```
https://www.google.com/recaptcha/about/
```

And replace the current ones in the Login.vue & Register.vue file

6: To use the sorting function make a click on the column "Created At" in the Home View

7: Every page has 5 pictures, to change it go to Home.vue component and change the value of "pageSize"

[Go Back To Title](#title)

## Authors

<a name="collaboration"></a>

### Authors

-   **Luis Peña** - _Full-Stack Developer_ - Telegram: @Rindaman12, Email: luispena1098@gmail.com Phone Number: 584243408841
