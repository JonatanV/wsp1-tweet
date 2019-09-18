
<?php
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
$sth = $dbh->prepare('SELECT tweet.* , users.name FROM tweet
            JOIN users
            ON tweet.user_id = users.id
            ORDER BY updated_at DESC');

$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>" . print_r($result,1) . "</pre>";

include 'views/index_layout.php';
?>
 