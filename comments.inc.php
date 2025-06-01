<?php

function setComments($conn){    

    if(isset($_POST['commentSubmit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO leavecomment (username, email, date, comment) VALUES ('$username', '$email', '$date', '$comment')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Comment Posted!',
                        text: 'Your comment has been successfully submitted.',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        document.querySelector('.comment-form').reset();
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to submit comment. Please try again.',
                        confirmButtonColor: '#d33'
                    });
                });
            </script>";
        }
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
