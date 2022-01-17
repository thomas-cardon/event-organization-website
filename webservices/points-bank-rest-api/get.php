<?php 
    header('Content-Type: application/json');

    $res = array();
    $res['status'] = 'success';
    $res['message'] = 'OK';
    $res['data'] = array(
        'points_to_share' => '1000000'
    );

    echo json_encode($res);