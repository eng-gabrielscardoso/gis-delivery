# GIS Delivery

This project is part of a personal initiative to solve some challenges made by companies located in the repository [Backend Challenges](https://github.com/CollabCodeTech/backend-challenges). This challenge, in particular, is proposed by the company Zé Delivery, a Brazilian company in the field of beverage distribution. The challenge can be seen at the link [here](https://github.com/ZXVentures/ze-code-challenges/blob/master/backend.md).

Overall, I hope that with these challenges I can improve my fullstack development skills and also address new perspectives and real challenges in the world of development.

## Technologies

The technologies used in the project were the most recent versions of:

* Laravel Sail - https://laravel.com/docs/10.x/sail
* PHP Pest - https://pestphp.com/
* Docker and Docker Compose - https://www.docker.com/
* MySQl - https://mysql.com
* Visual Studio Code - https://code.visualstudio.com/
* DBeaver - https://dbeaver.io/
* Insomnia - https://insomnia.rest/
* Git - https://git-scm.com/
* Github And Github CLI - https://cli.github.com/
* Plus, I've used the most recent version of [Linux Mint](https://linuxmint.com/) and [GeoJSON IO](http://geojson.io/) to test my [GEOJSONs](https://en.wikipedia.org/wiki/GeoJSON)

Feel free to use any of these technologies or change some for your own preferences.

## Installation

This project requires you have installed in your machine the most recent version of Docker and  Docker Composer installed and running, so make sure that you have them.

First of all, clone the repository in your local environment. Copy the `.env.example` file as `.env` and set the environment variables that were blank such as `DB_USERNAME` and `DB_PASSWORD`. After it you will have a fresh install of project, but not will work before have the vendors installed locally. So, you will need to run `docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs` to install the Sail Deps and then, if everything runs fine, you will be able to up the containers.

After make the first steps run the following command in the root of project:

```shell
./vendor/bin/sail up -d
```

So, your containers were created and running, so you can run the following commands to install deps, run migrations and other important things to make sure that the project will work from top to bottom.

* Install dependencies:

```shell
./vendor/bin/sail composer i
```

* Run migrations:

```shell
./vendor/bin/sail artisan migrate
```

* Seed database:

```shell
./vendor/bin/sail artisan db:seed
```

* Generate your own local API key

```shell
./vendor/bin/sail artisan key:generate
```

* This step is optional, but recommended, to generate your JWT secret

```shell
./vendor/bin/sail artisan jwt:secret
```

If all the commands were run successfully then you run some request to the API.

> Something didn't work properly? Don't worry about it, just take a coffee and open an issue [here](https://github.com/eng-gabrielscardoso/gis-delivery/issues/new)

## Author

By contribution to the project:

* Gabriel Santos Cardoso - eng.gabrielscardoso@gmail.com

## Licence

This project is licensed under the MIT licence. See the Licence file for details [here](LICENSE.md).
