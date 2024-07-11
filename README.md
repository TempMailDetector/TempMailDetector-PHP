### Documentation

# Temp Mail Detector PHP API

This repository contains the required code for you to make an API request to the [Temp Mail Detector](https://tempmaildetector.com) service using PHP.

Temporary email addresses can cause issues for services which provide a freemium model or which offer a trial. While we understand that temporary emails are great at preserving privacy, there is a need to control where and when they can be used.

Below you will find an example implementation and JSON response of this library:

### Example response
```json
{
  "domain": "apn7.com",
  "score": 100,
  "meta": {
    "block_list": true,
    "domain_age": 2,
    "website_resolves": false,
    "accepts_all_addresses": false,
    "valid_email_security": true
  }
}
```

### Example usage
```php
<?php
require_once 'tempmaildetector.php';

try {
    $apiKey = "YOUR_API_KEY";
    $client = new Client($apiKey);

    $domain = "devncie.com";
    $response = $client->checkDomain($domain);

    echo "Domain: " . $response['domain'] . "\n";
    echo "Score: " . $response['score'] . "\n";
    echo "Meta:\n";
    foreach ($response['meta'] as $key => $value) {
        echo "  " . ucfirst(str_replace('_', ' ', $key)) . ": " . (is_bool($value) ? ($value ? 'true' : 'false') : $value) . "\n";
    }
} catch (Exception $e) {
    echo 'Error checking domain: ' . $e->getMessage();
}
?>
```