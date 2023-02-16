<?php
use App\Models\Notification;
function image_exist($img='')
{
    if (file_exists('assets/images/'.$img) && $img != '') {
        return url('assets/images/'.$img);
    }else{
        return url('admin_new/images/user5-128x128.jpg');
    }
}


function send_notifaction($FcmToken,$title,$body,$user_id=0,$job_id=0,$company_id=0)
{

    $url = 'https://fcm.googleapis.com/fcm/send';

    // $FcmToken = $data_fc_token->device_token;

    $serverKey = 'AAAAiNxCUWo:APA91bGNVdxKndLcqLle4g_XEXEc3mybRTRDTlQl2WR5FnsQqR8XngLu-CRjN3jCiM9Ox-MjJCObXhiCUYcxdChoYQkV01DQgPaR7w7h9DNT5mxmVs_u7r4LgaXdh-YcTC9AX-xzGQx0'; // ADD SERVER KEY HERE PROVIDED BY FCM

    $data = [
        "registration_ids" => $FcmToken,
        "notification" => [
            "title" => $title,
            "body" => $body,
        ]
    ];
    $encodedData = json_encode($data);

    $headers = [
        'Authorization:key=' . $serverKey,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    // Close connection
    curl_close($ch);

    // $data=new NotifyHistory();
    // $data->title=$title;
    // $data->user_id=$user_id;
    // $data->delivery_man_id=$delivery_man_id;
    // $data->save();

    $noti=new Notification();
    $noti->user_id=$user_id;
    $noti->job_id=$job_id;
    $noti->company_id=$company_id;
    $noti->notes=$body;
    $noti->save();

}