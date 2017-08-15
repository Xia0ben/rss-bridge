<?php
//////////
// POST http://http-bridge/session/<session-id>/claim
// Content-Type: application/json
//
// {
//   "requestToken": "<claim-token>",
//   "requiredPermissions": [<permissions>]
// }
//
//
// ///////////
//

$q=$_GET["q"];

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}

echo("$q\n");

$session_id = $_SERVER['X-Sandstorm-Session-Id'];
echo("$session_id\n");
$url .= "http://http-bridge/session/" . $session_id . "/claim";
echo("$url\n");

$q=$_GET["q"];
$data = array('requestToken' => $q, 'requiredPermissions' => '[]');
$data_string = json_encode($data);
echo("$data_string\n");

$ch = curl_init('http://api.local/rest/users');   // where to post
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);
echo($result);

// $content .= json_encode("{'requestToken': '" . $q . "', 'requiredPermissions': []}");
// echo("$content\n");
//
// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_HEADER, false);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPHEADER,
//         array("Content-type: application/json"));
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
//
// $json_response = curl_exec($curl);
// echo($json_response);
//
// $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//
// if ( $status != 201 ) {
//     die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
// }
//
// curl_close($curl);
//
// $response = json_decode($json_response, true);
// echo()$response);
?>
