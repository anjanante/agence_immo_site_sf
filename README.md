A property management application based on symfony 4.4 

# How to launch it with docker
1. Build the image  app with
> docker build . -f ./docker/Dockerfile -t my-agency
2. Add the image id or use tag my-agency:latest created in ***./docker/docker-compose.yml on line 29***
3. Create and launch all container with
> docker-compose up -d

