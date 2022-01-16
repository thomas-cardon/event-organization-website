<?php 
    header('Content-Type: application/json');

    $res = array();
    $res['status'] = 'success';
    $res['message'] = 'OK';
    $res['data'] = array(
        'points_max_per_donor' => 5000,
    );

    echo json_encode($res);