<?php

if(isset($_POST['to']) && isset($_POST['message']) && isset($_POST['sender']) && !empty($_POST['to']) && !empty($_POST['message'])&& !isset($_POST['sender']))
{

    $form_recipient_phone = $_POST['to'];
    $form_message = $_POST['message'];
    $form_sender_phone =$_POST['sender'];


    $api_key = "730837dc9cdb4be28572bf2ce82362d5";
    $api_token = "";


    $sender_phone_number = $form_sender_phone;
    $receiver_phone_number = $form_recipient_phone;

    $message = $form_message;

    $receiver_phone_number = [$receiver_phone_number];
    // 17.Get number.mp4  
    $content = [
        'to' => $receiver_phone_number,
        'from'=> $sender_phone_number,
        'body'=> $message
    ];

    $data = json_encode($content);

    $ch = curl_init("https://us.sms.api.sinch.com/xms/v1/($api_key)/batches");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer '. $api_token
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        echo $result;
    }

    curl_close($ch);
}else{
    echo "Please fill in the form";
}
?>