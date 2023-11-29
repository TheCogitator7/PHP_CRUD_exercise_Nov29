<?php 
    $link=mysqli_connect('localhost', 'port12345', 'ca11com1!');
    if(!$link){
        echo "Not connected".mysqli_error($link);
    }

    $selected_DB=mysqli_select_db($link, 'port12345');
    if(!$selected_DB){
        echo "Not selected the DB".mysqli_error($selected_DB);
    }

    $sql="SELECT * FROM topic";
    $list='';
    $result=mysqli_query($link, $sql);
    while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $filtered_title=htmlspecialchars($row['title']);
        $list=$list."<li><a href='index.php?id={$row['id']}'>{$filtered_title}</a></li>";
    }
    
    $article['title']="Welcome";
    $article['description']="Hello, PHP";
    $article['date']="2023-11-28";

    $update_link='';
    $delete_link='';

    if(isset($_GET['id'])){
        $filtered_id=mysqli_real_escape_string($link, $_GET['id']);
        $sql="SELECT * FROM topic LEFT JOIN author ON topic.author_id=author.id WHERE topic.id={$filtered_id}";
        $result=mysqli_query($link, $sql);
        $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        $article['title']=htmlspecialchars($row['title']);
        $article['description']=htmlspecialchars($row['description']);
        $article['name']=htmlspecialchars($row['name']);
        $article['date']=htmlspecialchars($row['date']);

        $update_link='<a href="update.php?id='.$_GET['id'].'">Update</a>';
        $delete_link='<form action="process_delete.php" method="post">
            <input type="hidden" name="id" value="'.$_GET['id'].'">
            <input type="submit" value="Delete">
        </form>';
    }
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="widht=device-width, initial-scale=1.0">
        <title>WEB</title>
    </head>
    <body>
        <h1><a href="index.php">WEB</a></h1>
        <h2><a href="author.php">Author</a></h2>
        <ol>
            <?=$list ?>
        </ol>
        <a href="create.php">Create</a>
        <?=$update_link ?>
        <?=$delete_link ?>
        <h2><?=$article['title'] ?></h2>
        <p><?=$article['description'] ?></p>
        <p>by <?=$article['name'] ?></p>
        <p><?=$article['date'] ?></p>
    </body>
</html>