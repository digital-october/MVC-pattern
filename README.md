# Simple and useful implementation of MVC pattern 
#### PHP-8, PHP-FPM, Nginx, MySQL, Docker, DockerCompose

## Install
You need to have Docker installed on your device to use this installation option.

1. Set environment variables creating a `.env` file based on the `.env.example` file.

2. Build the app image with the following command:

```bash
docker-compose build app
```

3. When the build is finished, you can run the environment in background mode (`-d` flag) with:

```bash
docker-compose up -d
```
4. For go inside PHP application container use run this command:

```bash
docker-compose exec -ti app bash
```
5. Inside the container, you need to update/create composer dependencies with this command:

```bash
composer update
```

6. On your local machine open link in your browser `http://localhost:8000`to access the application

7. To shut down your Docker Compose environment and stop all of its containers, networks, and volumes, run:

```bash
docker-compose down
```
