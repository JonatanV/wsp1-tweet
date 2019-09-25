<?php 

$tweetId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  
include 'include/dbinfo.php';
// mysql -u -p
// use database;
try {
    $dbh = new PDO(
        'mysql:host=localhost;charset=utf8mb4;dbname=' . $database . '',
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
$row = $sth->fetch(PDO::FETCH_ASSOC);

include "views/tweet_layout.php";

?>