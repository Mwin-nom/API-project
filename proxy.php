<?php
// Get the URL to proxy from the query string parameter
$url = isset($_GET['http://vineyardlodge.uksouth.cloudapp.azure.com/']) ? $_GET['http://vineyardlodge.uksouth.cloudapp.azure.com/'] : '';

// Check if the URL is provided and not empty
if (!empty($url)) {
    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Get the HTTP response code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL session
    curl_close($ch);

    // Set the appropriate Content-Type header based on the response
    header('Content-Type: ' . curl_getinfo($ch, CURLINFO_CONTENT_TYPE));

    // Set the HTTP status code
    http_response_code($httpCode);

    // Output the response
    echo $response;
} else {
    // If URL is not provided, return a 400 Bad Request error
    http_response_code(400);
    echo 'Error: URL parameter is missing';
}
?>
