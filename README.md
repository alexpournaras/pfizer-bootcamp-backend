<h1 align="center">
    Pharmaceutical Research Product Management App
</h1>
<div align="center">
    <img src="https://media.licdn.com/dms/image/v2/D5612AQGfmy6NPGnt1w/article-cover_image-shrink_600_2000/article-cover_image-shrink_600_2000/0/1677779939155?e=2147483647&v=beta&t=LZau1M8gEf_gGR3MK0MRlnfm5guRqsVIAnJaR6XDFHA" style="width: 200px;">
</div>
<h3 align="center">
    Phizer bootcamp Project
</h3>

## Dependencies

The following dependencies are required to set up the project:

### Laravel

- **Laravel Framework**: Version specified in `composer.json`.
- **Laravel Sail**: A Docker environment for Laravel, managing PHP, MySQL, and other services.

### Docker & Docker Compose

- **Docker**: A platform for developing, shipping, and running applications in containers.
- **Docker Compose**: A tool for defining and running multi-container Docker applications.

### PHP Dependencies

The main PHP dependencies are specified in the `composer.json` file:

- **php**: `^8.0` or higher (depending on the project requirements).
- **fideloper/proxy**: Required for handling proxy headers in Laravel.
- **fruitcake/laravel-cors**: For handling CORS headers.
- **guzzlehttp/guzzle**: A PHP HTTP client for making requests.
- **laravel/framework**: Laravel's core framework.
- **laravel/tinker**: A REPL (Read-Eval-Print Loop) for interacting with the Laravel application.



<h2>Getting Started</h2>


<p>First, clone this repository, install the dependencies, and set up your <code>.env</code> file:</p>

<pre>
  <code>
    git clone https://github.com/alexpournaras/pfizer-bootcamp-backend
      
    cd pfizer-bootcamp-backend

    composer install

    cp .env.example .env

    ./vendor/bin/sail up -d
  </code>
</pre>

<h2>Database Setup</h2>

<p>Once the environment is up, run the initial migrations and seeders:</p>

<pre>
  <code>
    ./vendor/bin/sail artisan migrate

    ./vendor/bin/sail artisan migrate:fresh --seed

    ./vendor/bin/sail artisan db:seed --class=ProductsSeeder
  </code>
</pre>


<h3>Explanation:</h3>
<ul>
  <li><code>git clone</code>: Clones the repository to your local machine.</li>
  <li><code>composer install</code>: Installs all PHP dependencies for the project.</li>
  <li><code>cp .env.example .env</code>: Copies the example environment configuration file.</li>
  <li><code>./vendor/bin/sail up -d</code>: Starts the development environment using Docker containers.</li>
  <li><code>./vendor/bin/sail artisan migrate</code>: Runs migrations to create necessary database tables.</li>
  <li><code>./vendor/bin/sail artisan migrate:fresh --seed</code>: Resets the database and seeds it with initial data.</li>
  <li><code>./vendor/bin/sail artisan db:seed --class=ProductsSeeder</code>: Seeds the database with product-related data.</li>
</ul>

<h3>Team</h2>
<ul>
  <li>Alex Pournaras</li>
  <li>Chatziantoniou Vangelis</li>
  <li>Gaitsidou Dimitra</li>
  <li>Bouroudis Georgios</li>
</ul>
