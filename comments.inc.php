<?php

function setComments($conn){    

    if(isset($_POST['commentSubmit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO leavecomment (username, email, date, comment) VALUES ('$username', '$email', '$date', '$comment')";
        $result = $conn->query($sql);
    }
}

function getComments($conn){
    $sql = "SELECT * FROM leavecomment";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        echo "<div class='comment-box'>";
            echo $row ['username']. "<br>";
            echo $row ['email']. "<br>";
            echo $row ['date']. "<br><br>";
            echo $row ['comment'];
        echo "</div>";
    }
}
