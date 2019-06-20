#Simple Symfony4 Application to manage movie data.
----

##Questions tackled:

1. Full Stack MVC Framework. ✔
2. Get the Stack up and running on local environment. ✔
3. Create a DB table with simple schema. Include some joins/relationships. ✔
4. Generate CRUD Controllers from the Entities. ✔
5. Add a unique controller to demonstrate non-reliance on CRUD default functions. ✔
         A unique controller to write a review for the movie from any movie_show page. 
6. Consume an existing API load the DB with movies. [Partly done.]

###note:
*To make demonstration simpler, I've focused most of the features on the movie_show page. This page demonstrates most parts of the homework.*

### Things I'm tackling at the moment.

* Keep geting 404 error to existing route through AJAX. Route->*movie_ajax_add*


### Quickest Way to test this app.
**I'm going to add just windows instructions since that's what I worked on. Linux, macOS instructions will be similar except for Composer installation part.


* Install Composer
[download composer](https://getcomposer.org/doc/00-intro.md#installation-windows)

* Install XAMPP
[download xampp](https://www.apachefriends.org/download.html)

* Install Git or download the code directly from [here](https://github.com/arpanadhikari/mc_sp/archive/master.zip)

* Open Command Prompt and goto the project folder.
````    composer require all
````
While it's updating packages, open the .env file and enter the local database details. Be sure to launch mysql server from XAMPP-Control Panel.

* Once composer is done installing packages, run:
````
    php bin/console server:run
````
from the project folder.