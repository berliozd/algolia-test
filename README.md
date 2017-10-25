# Local Installation 

* Run docker container : 

```
$ docker-compose up
```

* Get container id using :
```
$ docker container ls  
```

* Launch sh inside container
```
$ docker exec -it <use container id retrieve from previous command> sh
```

* Run composer inside container to install vendors :
```
$ composer install
```

* Test :

Go to : http://localhost:8080

# Online Demo

Online demo is available here : https://murmuring-bastion-63000.herokuapp.com/