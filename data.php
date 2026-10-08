<?php 
$data = array(
    'name' => 'Excavator',
    'price' => 2500,
    'available' => true
);
header('Content-type: application/json');
echo json_encode($data); ?>