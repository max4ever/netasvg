# netasvg

1. Build docker image
    ```bash
    docker-compose up
    ```

2.  Enter docker container with
    ```bash
    docker-compose exec php-fpm bash
    ```

3. Inside docker container run:
    ```bash
    composer install
    
    php bin/console -vvv server:run 0.0.0.0:8000
    ```
    
Install [Postman](https://www.getpostman.com/) and import [postman_request](./postman_neta_svg.json) to test the api.

Make a "POST" request with a JSON to the url **http://some.ip:8000/api/draw/**

![alt text](./demo.png)


# To run tests
```bash
docker-compose exec php-fpm php bin/phpunit
```