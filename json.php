<?php

    include 'config.php';

    $user_data = "SELECT picture FROM pictures";
    $query = mysqli_query($conn, $user_data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }

    $json_data = json_encode($rows, JSON_PRETTY_PRINT);
    file_put_contents('app.json', $json_data);

    // EOF
