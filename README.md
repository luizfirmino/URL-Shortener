# URL-Shortener

## About the project
The task is to build a website that functions as a URL Shortener:
  - A user should be able to load the index page of your site and be presented with an input field where they can enter a URL.
  - Upon entering the URL, a "shortened" version of that url is created and shown to the user.
  - When visiting that "shortened" version of the URL, the user is redirected to the original URL.
  - Additionally, if a URL has already been shortened by the system, and it is entered a second time, the first shortened URL should be given back to the user.

For example, if I enter http://google.com/ into the input field, and I'm running the app locally on port 8000, I'd expect to be given back a URL that looked something like http://localhost:8000/1. Then when I visit http://localhost:8000/1, I am redirected to http://google.com/.

## My Approach
I decided to use MongoDB to store the data, PHP & Laravel to host and provide an API; and VueJS & Quasar for the front-end.

This approach makes the whole application service oriented. With layers well-defined to take care of each task (data, business rules, processing and presentation). The maintenance or update of any of the layers is transparent to the rest of the system. That means less time spent with coding and integration issues.

There's also a PHP & Laravel front-end available as a palliative solution in case the VueJs front-end is off-line.

### This package includes:

short-urls-api - PHP/Laravel API and PHP/Laravel Frontend

short-urls-client - VueJS/quasar framework Frontend


### Built With

* [MongoDB](https://cloud.mongodb.com)
* [Laravel](https://laravel.com)
* [Quasar](https://quasar.dev/quasar-cli/installation)

## How to compile/launch the applications

1. Start the Laravel application with artisan
```
composer php artisan serve
```

2. Update the API_URL with the Laravel application server at `short-urls-client\src\router\index.js`
```JS
Vue.prototype.$API_URL = 'http://127.0.0.1:8000'
```

3. Start the client application short-urls-client
```
npm quasar dev
```

## Contact

Luiz Firmino - [@Linkedin](https://www.linkedin.com/in/luiz-firmino/) - luiz.firmino@gmail.com

