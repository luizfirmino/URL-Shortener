# URL-Shortener

## About the project
The task is to build a website that functions as a URL Shortener:
  - A user should be able to load the index page of your site and be presented with an input field where they can enter a URL.
  - Upon entering the URL, a "shortened" version of that url is created and shown to the user.
  - When visiting that "shortened" version of the URL, the user is redirected to the original URL.
  - Additionally, if a URL has already been shortened by the system, and it is entered a second time, the first shortened URL should be given back to the user.

For example, if I enter http://google.com/ into the input field, and I'm running the app locally on port 8000, I'd expect to be given back a URL that looked something like http://localhost:8000/1. Then when I visit http://localhost:8000/1, I am redirected to http://google.com/.

### Expectations:
- PHP & Laravel is preferred. You can use any php framework/micro-framework as well. If you can't do it in PHP, you may use JavaScript & Node, but must explain your tech stack choices
- Submit the project as a Git repo/archive
- A small README should be added with instructions on how to compile/launch your application. Maybe even add details as to your approach?
- Unit tests is a big plus
- You may want to use external dependencies e.g. database. Please tell us more about your choices
- CSS styling is optional, functionality should be highest priority

## My Approach
I decided to use MySQL to store the data, stored procedure and function to keep the logic and  business rules in the same place; PHP & Laravel to host and provide an API; and VueJS & Quasar for the front-end.

This approach makes the whole application service oriented. With layers well-defined to take care of each task (data, business rules, processing and presentation). The maintenance or update of any of the layers is transparent to the rest of the system. That means less time spent with coding and integration issues.

There's also a PHP & Laravel front-end available as a palliative solution in case the VueJs front-end is off-line.

### This package includes:

short-urls-api - PHP/Laravel API and PHP/Laravel Frontend

short-urls-client - VueJS/quasar framework Frontend


### Built With

* [MySQL](https://www.mysql.com/downloads/)
* [Laravel](https://laravel.com)
* [Quasar](https://quasar.dev/quasar-cli/installation)

## How to compile/launch the applications

1. MySQL Dump
```
database_dump.sql
``` 
_Why not migration? The database contains objects which are not compatible with the migration process._

2. Update the database credentials at `\short-urls\.ENV`
```ENV
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=urlshortsdb
DB_USERNAME=root
DB_PASSWORD=root
```

3. Start the Laravel application with artisan
```
composer php artisan serve
```

4. Update the API_URL with the Laravel application server at `short-urls-client\src\router\index.js`
```JS
Vue.prototype.$API_URL = 'http://127.0.0.1:8000'
```

5. Start the client application short-urls-client
```
npm quasar dev
```

## Contact

Luiz Firmino - [@Linkedin](https://www.linkedin.com/in/luiz-firmino/) - luiz.firmino@gmail.com

