#### To run an application 
- Install docker
- `docker-compose up`
- `docker-compose exec app php artisan migrate --seed`
- `docker-compose exec app php artisan serve`

#### Steps followed for creating and dockerizing project <https://medium.com/@shakyShane/laravel-docker-part-1-setup-for-development-e3daaefaf3c>
- composer create-project --prefer-dist laravel/laravel ~/Desktop/laravel-project-basic
- cd laravel-project-basic
- docker run --rm -v $(pwd):/app composer install
- Following for [4 files] has been created.
  * web.dockerfile
  * app.dockerfile
  * docker-compose.yml
  * vhosts.conf
- docker-compose up
- docker-compose exec app php artisan key:generate
- Make `database` and `mail` changes in `.env`

Some correction made in above steps as suggested by [Mark Padilla] 

#### To fetch twitter
- composer require thujohn/twitter
- http://itsolutionstuff.com/post/laravel-5-twitter-api-using-thujohn-twitter-composer-package-tutorialexample.html
- https://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1


[4 files]: https://gist.github.com/anonymous/a13cf604981726c8e8b0bb05a35664e2
[Mark Padilla]: https://medium.com/@phillipmarkpadilla/laravel-5-6-in-docker-with-php-7-2-nginx-1-10-and-mysql-5-7-cdb6c054379c