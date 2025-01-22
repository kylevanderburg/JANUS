<?php

/*function verify_email_via_smtp($email) {
    list($user, $domain) = explode('@', $email);
    //echo $domain;
    // Check if the domain has MX records
    if (!checkdnsrr($domain, "MX")) {
        return "Invalid domain or no MX records found<br />.";
    }

    $dn = getmxrr($domain, $mx_records, $mx_weight);
    // var_dump($mx_records);
    echo $mx_records[0]."<br />";

    // Connect to the mail server
    $connection = @fsockopen($mx_records[0], 25, $errno, $errstr, 10);
    if (!$connection) {
        return "Could not connect to mail server.<br />";
    }

    // SMTP handshake
    fwrite($connection, "HELO vanderburg.app\r\n");
    fgets($connection, 1024);

    fwrite($connection, "MAIL FROM: <kyle@vanderburg.app>\r\n");
    fgets($connection, 1024);

    fwrite($connection, "RCPT TO: <$email>\r\n");
    // $response = fgets($connection, 1024);

    // fwrite($connection, "VRFY $email\r\n");
    $response = fgets($connection, 1024);

    fclose($connection);
    echo $response."<br />";

    if (strpos($response, "250") !== false) {
        return "Email is valid.<br />";
    } else {
        return "Email is invalid.<br />";
    }
}

// Usage
// $email = "example@example.com";


$email = "kyle@noteforge.com";
list($user, $domain) = explode('@', $email);

if (checkdnsrr($domain, "MX")) {
    echo "The domain has MX records.<br />";
    echo verify_email_via_smtp($email);
} else {
    echo "Invalid domain or no MX records found.";
}
*/

function verify_email_with_clearout($email) {
    // Initialize cURL
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.clearout.io/v2/email_verify/instant',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{"email": "'.$email.'"}',
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "Authorization: 068b00737cf5e1280d582add456b70bb:8ced2dd870cc7790fa9bd00e5e2280e06483a82d199cc5620fc67bb52b8b42f0"
        ),
      ));

    // Execute the request
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    $response = json_decode($response, true);
    echo "Email address: " . $response['data']['email_address'] . "\n";
    echo "Status: " . $response['data']['status'] . "\n";
    }
}

// Usage example
$email = "catch_all@example.com";
verify_email_with_clearout($email);


?>
