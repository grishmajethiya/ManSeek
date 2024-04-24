<?php
include 'db_connection.php';
$link = connectToDB();

// Check if postId and comment parameters are set
if (isset($_POST['postId']) && isset($_POST['comment'])) {
    // Sanitize input and prevent SQL injection
    $postId = mysqli_real_escape_string($link, $_POST['postId']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    
    // Prepare and execute the insert query
    $sql = "INSERT INTO comments (post_id, body) VALUES ('$postId', '$comment')";
    if (!mysqli_query($link, $sql)) {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}

// Check if currentId parameter is set
if (isset($_POST['currentId'])) {
    // Sanitize input and prevent SQL injection
    $currentId = mysqli_real_escape_string($link, $_POST['currentId']);
    
    // Prepare and execute the select query
    $sqlQuery = "SELECT * FROM comments WHERE post_id='$currentId' ORDER BY comment_id DESC";
    $result = mysqli_query($link, $sqlQuery);
    $total_count = mysqli_num_rows($result);

    // Check if there are any comments
    if ($total_count == 0) {
        echo "No comments yet.";
    } else {
        // Output comments
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class=\"post-item\" id=\"";
            echo $row['comment_id']; 
            echo "\"> <h4 class=\"date\">"; 
            echo date('g:i a m-d-Y', strtotime($row['created_at']));
            echo "</h4> <p>";
            echo $row['body'];
            echo "</p> </div>";
        }
    }
}
?>
