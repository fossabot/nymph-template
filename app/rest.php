<?php

error_reporting(E_ALL);

/*
 * You don't need to edit below here. It is set up to work inside your Docker
 * container.
 */

require __DIR__.'/config.php';

$NymphREST = new \Nymph\REST();

try {
  if (in_array($_SERVER['REQUEST_METHOD'], ['PUT', 'PATCH', 'DELETE'])) {
    parse_str(file_get_contents("php://input"), $args);
    $NymphREST->run($_SERVER['REQUEST_METHOD'], $args['action'], $args['data']);
  } else {
    $NymphREST->run(
      $_SERVER['REQUEST_METHOD'],
      $_REQUEST['action'],
      $_REQUEST['data']
    );
  }
} catch (\Nymph\Exceptions\QueryFailedException $e) {
  echo $e->getMessage()."\n\n".$e->getQuery();
}
