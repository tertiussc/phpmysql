<?php

$data = [
    'id' => 123,
    'name' => 'David',
    'email' => 'dave@example.com',
    'dob' => '1985-05-15'
];

// must use echo to encode the data
echo json_encode($data);
