<?php

$url = "https://backend.thinger.io/v3/users/KelasKilat/devices/KandangAyam_Bantuas/resources/hum";
$headers = [
    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkZXYiOiJLYW5kYW5nQXlhbV9CYW50dWFzIiwiaWF0IjoxNjkyNjgxNTQ5LCJqdGkiOiI2NGU0NDU0ZGE2YTIyNWY3ODAwNzI1YzMiLCJzdnIiOiJhcC1zb3V0aGVhc3QuYXdzLnRoaW5nZXIuaW8iLCJ1c3IiOiJLZWxhc0tpbGF0In0.weXlqGTTwe2PfSYKK-0OBLhQodAmBB9sLiCG1aTvTJc"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$kelembaban = number_format($data, 0);
echo $kelembaban;
?>