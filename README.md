<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Descripción

Esta es una prueba técnica solicitada por Una empresa para un puesto Semi Senior

Prueba técnica: [FC  CTR-304_ Coding Assignment.pdf](https://github.com/santiagoInostroza/financiaCapital/files/13242752/FC.CTR-304_.Coding.Assignment.pdf)

Estas instrucciones están realizadas para ser seguidas desde windows, no se ha probado desde Linux ni Mac.

## Requisitos



- Sistema operativo Windows
- Tener Instalado Docker Desktop <a href="https://youtu.be/9AZAVlknsVI">Video como instalar Docker Desktop acá</a>
- Tener Instalado Wsl2  <a href="https://youtu.be/9AZAVlknsVI">Video como instalar Wsl2 acá</a>
- Tener Configurado Docker Desktop  <a href="https://youtu.be/9AZAVlknsVI">Video como configurar Docker Desktop acá</a>
- Tener instalado Git

## Instrucciones en Windows

Abre el terminal wsl2 (Terminal linux en Windows) en la carpeta donde guardarás tu proyecto. Puedes clonar con `SSH` o `HTTPS`

Clonar con SSH
(Si no tienes configuradas tus llaves SSH en GitHub puedes mirar este [tutorial para configurar llaves SSH](https://platzi.com/tutoriales/1557-git-github/4067-configurar-llaves-ssh-en-git-y-github/) )


    git clone git@github.com:santiagoInostroza/Laravel10Vue3.git
    

Si no quieres configurar tus llaves SSH puedes:
Clonar con HTTPS


     https://github.com/santiagoInostroza/Laravel10Vue3.git


Ingresa a la carpeta


    cd Laravel10Vue3 
    
    
Abre vs code

    code .
    
Asegurate que docker este corriendo y de preferencia no hayan contenedores cargados e ingresa el siguiente comando: 

    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

Este comando usa un pequeño contenedor Docker que contiene PHP y Composer para instalar las dependencias de la aplicación

Copia archivo .env


    cp .env.example .env

Reemplaza en el .env recien creado estas variables

    DB_HOST=mysql
    DB_USERNAME=sail
    DB_PASSWORD=password

Si no existe el archivo docker.compose.yml crearlo y pegar este codigo

    services:
        laravel.test:
            build:
                context: ./vendor/laravel/sail/runtimes/8.2
                dockerfile: Dockerfile
                args:
                    WWWGROUP: '${WWWGROUP}'
            image: sail-8.2/app
            extra_hosts:
                - 'host.docker.internal:host-gateway'
            ports:
                - '${APP_PORT:-80}:80'
                - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
            environment:
                WWWUSER: '${WWWUSER}'
                LARAVEL_SAIL: 1
                XDEBUG_MODE: '${SAIL_XDEBUG_MODE:-off}'
                XDEBUG_CONFIG: '${SAIL_XDEBUG_CONFIG:-client_host=host.docker.internal}'
                IGNITION_LOCAL_SITES_PATH: '${PWD}'
            volumes:
                - '.:/var/www/html'
            networks:
                - sail
            depends_on:
                - mysql
                - redis
                - meilisearch
                - mailpit
                - selenium
        mysql:
            image: 'mysql/mysql-server:8.0'
            ports:
                - '${FORWARD_DB_PORT:-3306}:3306'
            environment:
                MYSQL_ROOT_PASSWORD: '${DB_PASSWORD}'
                MYSQL_ROOT_HOST: '%'
                MYSQL_DATABASE: '${DB_DATABASE}'
                MYSQL_USER: '${DB_USERNAME}'
                MYSQL_PASSWORD: '${DB_PASSWORD}'
                MYSQL_ALLOW_EMPTY_PASSWORD: 1
            volumes:
                - 'sail-mysql:/var/lib/mysql'
                - './vendor/laravel/sail/database/mysql/create-testing-database.sh:/docker-entrypoint-initdb.d/10-create-testing-database.sh'
            networks:
                - sail
            healthcheck:
                test:
                    - CMD
                    - mysqladmin
                    - ping
                    - '-p${DB_PASSWORD}'
                retries: 3
                timeout: 5s
        redis:
            image: 'redis:alpine'
            ports:
                - '${FORWARD_REDIS_PORT:-6379}:6379'
            volumes:
                - 'sail-redis:/data'
            networks:
                - sail
            healthcheck:
                test:
                    - CMD
                    - redis-cli
                    - ping
                retries: 3
                timeout: 5s
        meilisearch:
            image: 'getmeili/meilisearch:latest'
            ports:
                - '${FORWARD_MEILISEARCH_PORT:-7700}:7700'
            environment:
                MEILI_NO_ANALYTICS: '${MEILISEARCH_NO_ANALYTICS:-false}'
            volumes:
                - 'sail-meilisearch:/meili_data'
            networks:
                - sail
            healthcheck:
                test:
                    - CMD
                    - wget
                    - '--no-verbose'
                    - '--spider'
                    - 'http://localhost:7700/health'
                retries: 3
                timeout: 5s
        mailpit:
            image: 'axllent/mailpit:latest'
            ports:
                - '${FORWARD_MAILPIT_PORT:-1025}:1025'
                - '${FORWARD_MAILPIT_DASHBOARD_PORT:-8025}:8025'
            networks:
                - sail
        selenium:
            image: selenium/standalone-chrome
            extra_hosts:
                - 'host.docker.internal:host-gateway'
            volumes:
                - '/dev/shm:/dev/shm'
            networks:
                - sail
    networks:
        sail:
            driver: bridge
    volumes:
        sail-mysql:
            driver: local
        sail-redis:
            driver: local
        sail-meilisearch:
            driver: local


Corre Sail

    ./vendor/bin/sail up     
    
Crea llave de la aplicación

    ./vendor/bin/sail artisan key:generate


    
    
Instala Npm

    ./vendor/bin/sail npm install
   
    ./vendor/bin/sail npm run dev

    
Actualizar composer

    ./vendor/bin/sail composer update    

Correr las migraciones en conjunto con los seeders que trae algunos usuarios y propiedades para comenzar a hacer las pruebas.

    ./vendor/bin/sail artisan migrate --seed


Finalmente <a href="http://localhost" >Abre localhost</a>

Usuarios disponibles:

usuario 1 
u1@gmail.com
contraseña 12345678

usuario 2 
u2@gmail.com
contraseña 12345678

usuario 3 
u3@gmail.com
contraseña 12345678

usuario 4 
u4@gmail.com
contraseña 12345678
