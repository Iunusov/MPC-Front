<?php
if(!$CONFIG = include("config.php")) exit;
require("auth.php");
switch($_GET["c"]){
  case 'crop':case 'random':case 'consume':case 'single':
  case 'next':case 'prev':case 'update':case 'shuffle':case 'play': case 'stop':
  case 'repeat': exec("mpc {$_GET["c"]} {$_GET["v"]}"); break;
  case 'add': exec("mpc add \"{$_GET["v"]}\""); break;
  default: break;
}
exec("mpc status",$status);
exec("mpc playlist",$playlist);
for($i=0;$i<count($playlist);$i++) if($playlist[$i] == $status[0]) $playlist[$i] = "<font style=\"background: grey\">$status[0]</font>";
echo json_encode(array("playlist" => implode ( "<br>", $playlist ), "status" => explode(" ", preg_replace('/\s+/',' ',$status[count($status)-1]))));
?>