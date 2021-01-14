<?php
require("loadEnv.php");
$token = $_ENV['LINEAPI'];
//$token = $_ENV["TESTAPI"];

$sendInfo = "";
$receive_message ="";
/* LINE_Notify:    認証を行う */
define('Notify_Auth', 'https://notify-api.line.me/api/notify');
/* パラメタを設定 */

if (isset($_POST["suggestion"])) {
    $param = [
        "message" => $_POST["suggestion"]
    ];
    $param = http_build_query($param);

    $header = [
    "Content-Type: application/x-www-form-urlencoded",
    "Authorization: Bearer " . $token,
    "Content-Length: " . strlen($param)
];

    $ch = curl_init(Notify_Auth);
    $options = [
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_POST            => true,
    CURLOPT_HTTPHEADER      => $header,
    CURLOPT_POSTFIELDS      => $param
];

    curl_setopt_array($ch, $options);
    $res = curl_exec($ch);
    $sendInfo = curl_getinfo($ch);
    curl_close($ch);
    $receive_message = ($sendInfo['http_code'] == 200) ?
        "送信しました！" : "送信できませんでした…　[エラーコード:".$sendInfo['CURLINFO_RESPONSE_CODE']."]";
}
