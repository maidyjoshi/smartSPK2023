<?php
// Include your database connection file
include("onek.php");

// Check if the "id" parameter is set in the URL
if(isset($_GET['id_kriteria'])) {
    $id = $_GET['id_kriteria'];

    // Perform the SQL DELETE operation
    $sql = "DELETE FROM kriteria WHERE id_kriteria = $id"; // Replace "your_table_name" with your actual table name
    $result = mysqli_query($dbcon, $sql);

    // Check if the delete operation was successful
    if($result) {
        echo "Record deleted successfully";
        header("Location: kriteria.php");
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
