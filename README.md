# mDAOnmH

I designed the setup as entirely dockerized for lazy people like me who hate setting lots of things
up. I did use Caddy as webserver as opposed to commonly used stack which is either apache or nginx.
Caddy is a new modern production-ready webserver that is very very simple to use with less learning
curve than the latter.

## Important Links:

* [Unsecured README.md - Explaining Issues](src/unsecure)
* [Secured README.md - The fixes](src/secure)
* [Bonus: The laravel way](src/laravel)

## Getting stated

With make:

``` bash
# Builds containers, runs the servers, shows running process, and shows the logs
make build up ps logs
```

Without make:

``` bash
# Builds the images
docker-compose build

# Runs the servers
docker-compose up -d

# Shows docker processes (just relevant to mDAOnmh)
docker-compose ps

# Shows logs (just relevant to mDAOnmh)
docker-compose logs
```
