<?php
class Client {
    private $apiKey;
    private const API_URL = "https://api.tempmaildetector.com/check";
    private const CONTENT_TYPE = "application/json";

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function checkDomain($domain) {
        $requestBody = json_encode(["domain" => $domain]);
        $headers = [
            "Content-Type: " . self::CONTENT_TYPE,
            "Authorization: " . $this->apiKey
        ];

        $ch = curl_init(self::API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Request Error: ' . curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception("Received non-200 response: " . $response);
        }

        return json_decode($response, true);
    }
}
?>