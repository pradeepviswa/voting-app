# voting-app

## Below is a simple working example of a voting website with:

- Home page with 4 political party buttons
- Vote page that saves the vote in a free MySQL database
- Results page to see totals
- Uses PHP + MySQL (works on free hosting like InfinityFree, 000webhost, or Hostinger free plans)

## Structure:
```
voting-app/
├── Dockerfile
├── index.php
├── vote.php
├── results.php
└── db.php
```

## Dockerfile
```
FROM php:8.2-apache
RUN apt update -y
RUN apt install git -y
RUN git clone https://github.com/pradeepviswa/voting-app.git /var/www/html
RUN ls /var/www/html
RUN docker-php-ext-install mysqli
#check mysqli
RUN php -i | grep mysqli

```
## Build Docker Image
```
docker build -t voting-image .
```
# without swarm way of doing it
## Create Docker Network
```
docker network create voting-network
```

## Start MySQL Container
```
docker run -d \
--name voting-mysql \
--network voting-network \
-e MYSQL_ROOT_PASSWORD=root \
-e MYSQL_DATABASE=voting_db \
mysql:8
```

## Start Web Container
```
docker run -d \
--name voting-web \
--network voting-network \
-p 8080:80 \
voting-image
```


## Database (MySQL) - Create Table
### Enter MySQL container:
```
docker exec -it voting-mysql mysql -u root -p
# password is root
```
### Create a database and table.
```
USE voting_db;

CREATE TABLE votes (
id INT AUTO_INCREMENT PRIMARY KEY,
party VARCHAR(50)
);
```

## Page Description
- Database Connection (db.php)
- Home Page (index.html)
- Vote Processing Page (vote.php)
- Results Page (results.php)
- Basic Styling (style.css)

## Process Flow
1. User opens index.html
2. Clicks a party button
3. Form sends vote to vote.php
4. vote.php saves vote in MySQL
5. results.php counts votes

# swarm way of doing it
## Initialize Swarm
```
docker swarm init
```
## Check
```
docker node ls
```

## Create Overlay Network
```
docker network create \
--driver overlay \
voting-network
```

## Create MySQL Service
```
docker service create \
--name voting-mysql \
--network voting-network \
-e MYSQL_ROOT_PASSWORD=root \
-e MYSQL_DATABASE=voting_db \
mysql:8
```
### Check service:
```
docker service ls
```

## Create Web Service
```
docker service create \
--name voting-web \
--network voting-network \
-p 8080:80 \
voting-image
```

## Now your site will be available at:
```
http://localhost:8080
```
## Database Connection (important)
Your db.php must use the service name as hostname:
```
$host = "voting-mysql";
```
Swarm DNS automatically resolves the service.

## Check
```
docker service ls
docker ps
docker service logs voting-web
```

## Enter MySQL Service to Create Table
### First get container ID:
```
docker ps
```
Then:
```
docker exec -it <mysql_container_id> mysql -u root -p
```
Create table:
```
USE voting_db;

CREATE TABLE votes (
id INT AUTO_INCREMENT PRIMARY KEY,
party VARCHAR(50)
);
```
## Scale the Web Service (Swarm advantage)
```
docker service scale voting-web=3
```
## Remove Services
```
docker service rm voting-web
docker service rm voting-mysql
```


