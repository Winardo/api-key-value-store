<?php

header('Content-type: application/json');

echo json_encode(responseJSON(403, null, 'You have no right access, please do authentication'));

die;

?>