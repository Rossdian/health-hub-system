<?php
// Check if searchTerm is set in $_POST
if(isset($_POST['searchTerm'])) {
    // Include your database connection file here
    include('../Database/config.php');

    // Assuming you're using PDO for database connection
    // Replace 'your_database_table' with the actual table name
    $searchTerm = $_POST['searchTerm'];

    // Perform the search query
    $query = "SELECT * FROM personal_info WHERE fullname LIKE :searchTerm";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the search results as JSON
    echo json_encode($results);
} else {
    // If searchTerm is not set, return an error message
    echo json_encode(array('Search term is not set'));
}
?>
