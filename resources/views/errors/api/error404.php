<?php

header('Content-type: application/json');

echo json_encode(responseJSON(404, null, 'Sorry, the page you are looking for could not be found'));

die;

?>