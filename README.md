A property management application based on symfony 4.4 

# How to launch it with docker
1. Build the image  app with
> docker build . -f ./docker/Dockerfile -t agence-immo-site-sf
2. Add the image id or use tag agence-immo-site-sf:latest created in ***./docker/docker-compose.yml on line 29***
3. Create and launch all container with
> docker-compose up -d

# Color sources
bg : #343a40
link: #537699
text-primary : #dc3545


