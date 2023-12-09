<?php
// Include your database connection file
include("onek.php");

// Check if the "id_alt" parameter is set in the URL
if(isset($_GET['id_alt'])) {
    $id = $_GET['id_alt'];

    // Perform the SQL DELETE operation
    $sql = "DELETE FROM alternatif WHERE id_alt = $id"; // Replace "your_table_name" with your actual table name
    $result = mysqli_query($dbcon, $sql);

    // Check if the delete operation was successful
    if($result) {
        echo "Record deleted successfully";
        header("Location: alternatif.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($dbcon);
    }

    // Close the database connection
    mysqli_close($dbcon);
} else {
    echo "Invalid request";
}
?>
