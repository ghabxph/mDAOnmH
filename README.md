# mDAOnmH

I designed the setup as entirely dockerized for lazy people like me who hate setting lots of things
up. I did use Caddy as webserver as opposed to commonly used stack which is either apache or nginx.
Caddy is a new modern production-ready webserver that is very very simple to use with less learning
curve than the latter.

**What's behind `mDAOnmH` name??**

Well, nothing. I randomly generated it in my password  manager.  Treat  this  as  a  dummy  exercise
project.

## Links to read:

* [Unsecured README.md - Explaining Issues](src/unsecure) -> 1. Start here
* [Secured README.md - The fixes](src/secure) -> 2. Then here
* [Better README.md - Restructuring things](src/better) -> 3. Then here
* ~~[Bonus: The laravel way](src/laravel)~~

## Requirements

* GNU Make (optional)
* Docker

## Building and running the application (and probably write some code...)

First, clone this project.

``` bash
# Clones the source code.
# Note: Don't change mDAOnmH name. Keep it as is so that the scripts I prepared
# will work as expected.
git clone https://github.com/ghabxph/mDAOnmH
```

## Makefile makes things more convenient.

If you got GNU Make, then you can be more lazy when setting things up. To  get  start,  simply  run:

``` bash
# Builds, runs, and shows the running docker process
make build up ps
```

If you don't have GNU Make installed in your machine, then let's just do things manually.

``` bash
# Builds the images (you can skip this actually...)
docker-compose build

# Runs the freshly built container (if you skip build, then up will build images for you.)
docker-compose up -d

# Shows running process (optional)
docker-compose ps
```

### Showing logs

I lazily put logs as well in the makefile thus you can run `make logs`, but it  is  just  simply  an
alias of `docker-compose logs`.

### Go inside the mariadb instance

I lazily created `make db` for you to conveniently ssh to the development mariadb server. Or like as
usual if you don't have GNU Make, then simply run
`docker exec -it mdaonmh_db_1 mysql -uroot -pcpuSUW49oS9TNIzB exam`

### Running unit tests

Just run `make test` to run all test. Just inspect the makefile to get the right command if you wish
to test specific thing.

## Things to do:

Well, a lot.

* Applying the clean architehcture (with unit tests) in [better](src/better)
  * I'm trying to be superman. I am not using phpunit and I'm doing things barehandedly. But make no
    mistake, I do know how to use phpunit or codeception. I am just doing  it  as  an  exercise.  So
    simply, I'm enjoying doing this nonsense hehe.
* Use composer and phpunit, but no laravel yet (semi-hardcore as the [better](src/better)). Will  do
  the OOP approach as well.
* Implement everthing the "Laravel" way. Endpoints will be kept the same.
* Implement everything the "Laravel" way, but through RESTFul approach.
