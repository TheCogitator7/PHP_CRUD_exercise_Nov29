<?php 
    $link=mysqli_connect('localhost', 'port12345', 'ca11com1!');
    if(!$link){
        echo "Not connected".mysqli_error($link);
    }

    $selected_DB=mysqli_select_db($link, 'port12345');
    if(!$selected_DB){
        echo "Not selected the DB".mysqli_error($selected_DB);
    }

    $filtered=array(
        'title'=>mysqli_real_escape_string($link, $_POST['title']),
        'description'=>mysqli_real_escape_string($link, $_POST['description']),
        'author_id'=>mysqli_real_escape_string($link, $_POST['author_id'])
    );

    $sql="INSERT INTO topic(title, description, date, author_id) VALUES('{$filtered['title']}', '{$filtered['description']}', NOW(), '{$filtered['author_id']}')";
    $result=mysqli_query($link, $sql);
    if(!$result){
        echo "관리자에게 문의하세요";
        mysqli_log(mysqli_error($result));
    }else{
        echo "정상 처리되었습니다. <a href='index.php'>처음으로</a>";
    }
?>