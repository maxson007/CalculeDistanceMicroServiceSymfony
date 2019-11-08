# Procédure d'installation

Steps

   * Execute : `docker-compose up -d --build`
   * Execute `docker-compose exec php-fpm sh install.sh ` install project dependencies
   
Front Application
---------------------------------
Url: http://localhost:8000/

3rd part API : 
  - https://geo.api.gouv.fr/adresse: ./front/src/ApiProvider/GeolocationApiGouv.php
  - https://geo.ipify.org/ : ./front/src/ApiProvider/IPGeolocation.php

   
Doc Api calculate distance 
---------------------------------- 
URL:  http://localhost:8585/calculate/distance

**Example**: 
  - curl: 

```shell script
      curl -X POST \
       http://localhost:8585/calculate/distance \
       -d '{
        "points":[
           {
              "lat":48.86417880,
              "lng":2.34250440
           },
           {
              "lat":43.6008177,
              "lng":3.8873392
           }
        ]
     }'
```
**Response:** 

```json
           {
                "distance": 597.8327180260186
            }
```
