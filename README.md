# voting-app

## Below is a simple working example of a voting website with:

- Home page with 4 political party buttons
- Vote page that saves the vote in a free MySQL database
- Results page to see totals
- Uses PHP + MySQL (works on free hosting like InfinityFree, 000webhost, or Hostinger free plans)

## Structure:
```
/voting
 ├── index.html
 ├── vote.php
 ├── results.php
 ├── db.php
 └── style.css
```

## Database (MySQL)
Create a database and table.
```
CREATE DATABASE voting_db;

USE voting_db;

CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    party VARCHAR(50)
);
```
