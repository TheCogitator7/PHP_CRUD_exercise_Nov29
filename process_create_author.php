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
        'name'=>mysqli_real_escape_string($link, $_POST['name']),
        'profile'=>mysqli_real_escape_string($link, $_POST['profile'])
    );

    $sql="INSERT INTO author(name, profile) VALUES('{$filtered['name']}', '{$filtered['profile']}')";
    $result=mysqli_query($link, $sql);
    if(!$result){
        echo "관리자에게 문의하세요";
        mysqli_log(mysqli_error($result));
    }else{
        header("location:author.php");
    }
?>