<h1 align="center">Laravel social test app</h1>
<h4 align="center">Test assignment for Timewave</h4>

## Install the project.

##### Docker should be installed to use Laravel sail:
https://laravel.com/docs/9.x/sail

##### Project requires PHP V8.1^

- Clone the repo https://github.com/elias-chalhoub/social-test-app
- Copy .env.example to .env and update values to meet your needs.
- Run composer install
- Use node version 16^ maybe with nvm use 16
- Run yarn install
- The project uses sail so creating alias will make life easier:
	- Run alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
- Run sail up -d
- Run sail artisan key:generate --ansi
- Run yarn run dev

## About

Based on company needs and tech stack I decided to build the frontend using Vue, so the test can show as much as possible of what can be done with different scenarios and methods.
Project is estimated to be done within 4 hours, but to do it as it should be it took around 16 hours (5H backend, 11 Frontend).

## TODO
* Add more inline docs.
* Implementation of backend and frontend tests.

### Note
This app has no admin panel, just register as a new user, navigate to users and start following some of them.
