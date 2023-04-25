<?php
/* $conn is a global variable to etablish the server 
   connexion using the below function 'connect()' */
$conn;
$bootstrap_css = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';


/* 1 the connexion function : */
function connect()
{
    global $conn;
    $conn = mysqli_connect('localhost', 'root', '', 'projetphp');
    if (!$conn) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
}

/* 2 the selection function : */
function select_query($table, $columns, $condition)
{
    connect();
    global $conn;
    if ($condition == 0) {
        $sql = "select $columns from $table";
    } else {

        $sql = "select $columns from $table where $condition";
    }
    $result = mysqli_query($conn, $sql);

    /* close the server connexion globally !! */
    mysqli_close($conn);
    return $result;
}

/* 3 the insertion function : */
function insert_query($table, $columns, $values)
{
    connect();
    global $conn;
    $sql = "INSERT INTO $table ($columns) values ($values)";
    $result = mysqli_query($conn, $sql);
    /* close the server connexion globally !! */
    mysqli_close($conn);
    return $result;
}

/* 4 the update function */
function update_query($table, $columns_with_values, $condition)
{
    connect();
    global $conn;
    if ($condition == 0) {
        $sql = "UPDATE $table SET $columns_with_values";
    } else {
        $sql = "UPDATE $table SET $columns_with_values where $condition";
    }
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    /*     
exemple : "email='$email',password='$password',ni=$ni" */
    return $result;
}

/* 5 the delete function */
function delete($table, $condition)
{
    connect();
    global $conn;
    $sql = "delete from $table where $condition";
    mysqli_query($conn, $sql);
    /* close the server connexion globally !! */
    mysqli_close($conn);
}

/* 6 the upload function */
function upload($f, $allowed)
{
    /*  $_FILES['photo'] = $f ; // for example */
    $fileName = $f['name'];
    $fileTmpName = $f['tmp_name'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    if (in_array($fileActualExt, $allowed)) {
        $fileNewName = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = 'uploads/' . $fileNewName;
        move_uploaded_file($fileTmpName, $fileDestination);
        return $fileDestination;
    }
    return false;
}
/* 7 the re-upload function */
function upload_mdf($f, $allowed)
{
    /*  $_FILES['photo'] = $f ; // for example */
    $fileName = $f['name'];
    $fileTmpName = $f['tmp_name'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    if (in_array($fileActualExt, $allowed)) {
        $fileNewName = uniqid('', true) . "." . $fileActualExt;
        $fileDestination = '../uploads/' . $fileNewName;
        move_uploaded_file($fileTmpName, $fileDestination);
        $fileDestination = 'uploads/' . $fileNewName;
        return $fileDestination;
    }
    return false;
}
?>
<script>
    //prevent the form from resubmition*******
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>