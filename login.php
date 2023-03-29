<?php 
  session_start();

  $_SESSION['app_baseURL'] = 'http://192.168.88.227:8080';
  //onrecupere le token
  $token = $_GET['token'];

  //requette curl
  $req = curl_init($_SESSION['app_baseURL'].'/messagerie/login');

  // curl_setopt($req, CURLOPT_URL, 'http://192.168.88.227:8080/messagerie/login');
  // curl_setopt($req, CURLOPT_HEADER, true); // Pour retourner les entetes ou non
  curl_setopt($req, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$token,
    // "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBvc3RtYW51c2VyQG1haWwuY29tIiwicHJvZmlsIjoiSUExMCIsImRhdGEiOnsiZW1haWwiOiJwb3N0bWFudXNlckBtYWlsLmNvbSIsInByb2ZpbCI6IklBMTAifSwiaWF0IjoxNjgwMDI0NzE4LCJleHAiOjE2ODAxMTExMTh9.0A7yXRSsZIp2eWZciyLQImGg8mw2SyUaP9474eflCrM",
    "Cache-control: no-cache",
    "Content-Type: application/json; charset=UTF-8"
  ));
  curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($req, CURLOPT_RETURNTRANSFER, true);

  // $result = curl_exec($req);
  $data = curl_exec($req);

  if ($data === false) {
    var_dump(curl_error($req));
  }

  $data   = json_decode($data, true);
  $_SESSION['unique_id'] = $data['unique_id'];

  curl_close($req);
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>
