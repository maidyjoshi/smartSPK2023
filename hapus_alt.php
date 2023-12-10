<?php
include("onek.php");

if(isset($_GET['id_alt'])) {
    $id = $_GET['id_alt'];
    $sql = "DELETE FROM alternatif WHERE id_alt = $id";
    $result = mysqli_query($dbcon, $sql);

    if($result) {
        echo "Record deleted successfully";
        header("Location: alternatif.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($dbcon);
    }

    mysqli_close($dbcon);
} else {
    echo "Invalid request";
}

?>
