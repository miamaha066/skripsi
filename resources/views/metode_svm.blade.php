<?php

// suhu
$url = "https://backend.thinger.io/v3/users/KelasKilat/devices/KandangAyam_Bantuas/resources/temp";
$headers = [
    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkZXYiOiJLYW5kYW5nQXlhbV9CYW50dWFzIiwiaWF0IjoxNjkyNjgxNTQ5LCJqdGkiOiI2NGU0NDU0ZGE2YTIyNWY3ODAwNzI1YzMiLCJzdnIiOiJhcC1zb3V0aGVhc3QuYXdzLnRoaW5nZXIuaW8iLCJ1c3IiOiJLZWxhc0tpbGF0In0.weXlqGTTwe2PfSYKK-0OBLhQodAmBB9sLiCG1aTvTJc"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$datasuhu = json_decode($response, true);
$suhu = number_format($datasuhu, 1);

// kelembaban
$url = "https://backend.thinger.io/v3/users/KelasKilat/devices/KandangAyam_Bantuas/resources/hum";
$headers = [
    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkZXYiOiJLYW5kYW5nQXlhbV9CYW50dWFzIiwiaWF0IjoxNjkyNjgxNTQ5LCJqdGkiOiI2NGU0NDU0ZGE2YTIyNWY3ODAwNzI1YzMiLCJzdnIiOiJhcC1zb3V0aGVhc3QuYXdzLnRoaW5nZXIuaW8iLCJ1c3IiOiJLZWxhc0tpbGF0In0.weXlqGTTwe2PfSYKK-0OBLhQodAmBB9sLiCG1aTvTJc"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

$datakelembaban = json_decode($response, true);
$kelembaban = number_format($datakelembaban, 0);

// Dataset training
$training_data = [
    ['suhu' => 29, 'kelembaban' => 70, 'label' => 'Normal'],
    ['suhu' => 35, 'kelembaban' => 60, 'label' => 'Normal'],
    ['suhu' => 20, 'kelembaban' => 80, 'label' => 'Buruk'],
    ['suhu' => 38, 'kelembaban' => 50, 'label' => 'Buruk'],
    ['suhu' => 40, 'kelembaban' => 50, 'label' => 'Bahaya'],
];

// Unique class labels
$unique_labels = array_unique(array_column($training_data, 'label'));

// Hyperparameters
$learning_rate = 0.01;
$epochs = 1000;

// Initialize weights, biases, and SVM models for each class
$models = [];

foreach ($unique_labels as $class_label) {
    $weights = [0, 0];
    $bias = 0;
    $models[$class_label] = ['weights' => $weights, 'bias' => $bias];
}

// Training the SVM models
for ($epoch = 1; $epoch <= $epochs; $epoch++) {
    foreach ($training_data as $data) {
        $x = [$data['suhu'], $data['kelembaban']];
        $label = $data['label'];

        foreach ($unique_labels as $class_label) {
            $model = $models[$class_label];
            $weights = $model['weights'];
            $bias = $model['bias'];

            $prediction = 0;
            for ($i = 0; $i < count($x); $i++) {
                $prediction += $weights[$i] * $x[$i];
            }
            $prediction += $bias;

            $loss = max(0, 1 - ($label === $class_label ? 1 : -1) * $prediction);

            // Update weights and bias
            if ($loss > 0) {
                for ($i = 0; $i < count($weights); $i++) {
                    $weights[$i] += $learning_rate * ($label === $class_label ? 1 : -1) * $x[$i];
                }
                $bias += $learning_rate * ($label === $class_label ? 1 : -1);
            }

            // Update model
            $models[$class_label] = ['weights' => $weights, 'bias' => $bias];
        }
    }
}

// Test the SVM models
$test_data = ['suhu' => $suhu, 'kelembaban' => $kelembaban]; //data realtime
$test_x = [$test_data['suhu'], $test_data['kelembaban']];

$best_score = -PHP_INT_MAX;
$predicted_label = null;

foreach ($unique_labels as $class_label) {
    $model = $models[$class_label];
    $weights = $model['weights'];
    $bias = $model['bias'];

    $prediction = 0;
    for ($i = 0; $i < count($test_x); $i++) {
        $prediction += $weights[$i] * $test_x[$i];
    }
    $prediction += $bias;

    if ($prediction > $best_score) {
        $best_score = $prediction;
        $predicted_label = $class_label;
    }
}

echo $predicted_label;

?>