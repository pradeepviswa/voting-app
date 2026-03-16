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

