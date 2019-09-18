<?php 

$tweetId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  
include 'include/dbinfo.php';
// mysql -u -p
// use database;
try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=' . $database . '',
         $username,
          $password
    );
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
// select * from tweet
$sth = $dbh->prepare('SELECT tweet.*, users.name FROM tweet
            JOIN users
            ON tweet.user_id = users.id
            WHERE tweet.id =' . $tweetId);
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="card" style= width:50rem;>
<div class="container px 5">  
                <div class="card" style= width:50rem;>
                        <div class="card-body">
                            
                            <h5 class="card-title">
                                <img class="rounded_circle" alt="" style= height:40px; width="40px;" ></img>
                                <?= $result['name'] ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?= $result['created_at']?>
                            </h6>
                            
                            <p class="card-text"> 
                                <?= $result['body']?>
                            </p>
                            <a href="tweet.php?id= <?= $result['id']?>" class="card-link">Show Thread</a>
                        
                        </div>
                </div>
                    
            </div>
</html>