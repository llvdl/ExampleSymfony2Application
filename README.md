An example application build with Symfony2
==========================================

This example application consists of a simple controller that uses a service 
from a separate bundle. It is created for a Symfony2 introduction workshop.

Installation
------------
Run `php composer.phar install` to install the dependencies.

Set up the database
-------------------
Create a database and set the correct databasename, username and password in
`app/config/parameters.yml`.

Initialize the tables with `php app/console doctrine:schema:create`


Run
---
Start the application using the built-in PHP webserver: `php app/console server:run`