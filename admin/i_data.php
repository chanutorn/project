<?php
// Set header for JSON content type
header('Content-Type: application/json');

// Include the database connection file
require_once '../condb.php';

// Prepare the SQL query to fetch data
$sql = "SELECT SUM(total) as income, MONTH(Date) as month, YEAR(Date) as year 
        FROM tbl_order 
        WHERE YEAR(Date) = YEAR(CURDATE()) 
        GROUP BY YEAR(Date), MONTH(Date) 
        ORDER BY YEAR(Date), MONTH(Date);";

// Execute the query
$result = mysqli_query($con, $sql);

// Check if query execution was successful
if ($result) {
    // Initialize an empty array to store fetched data
    $data = array();

    // Fetch data and store it in $data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Close the database connection
    mysqli_close($con);

    // Encode the fetched data to JSON and output it
    echo json_encode($data);
} else {
    // If query execution failed, prepare an error message in JSON format
    $error = array('error' => 'Failed to fetch data');
    echo json_encode($error);
}
