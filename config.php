<?php
include_once("fbsdk/autoload.php");
$appId = '';//Enter FB App ID here
$appSecret = '';//Enter FB App secret here
$homeurl = '';//Enter FB callback URL here
$fbPermissions = 'email';
$fb = new Facebook\Facebook([
  'app_id' => '',//Enter FB App ID here
  'app_secret' => '',//Enter FB App secret here
  'default_graph_version' => 'v2.2',
  ]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
?>