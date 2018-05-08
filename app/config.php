<?php

// You can set this to your own time zone.
date_default_timezone_set('America/Los_Angeles');

/*
 * You don't need to edit below here. It is set up to work inside your Docker
 * container.
 */

require __DIR__.'/autoload.php';

// Nymph's configuration.
$nymphConfig = [
  'driver' => 'PostgreSQL',
  'PostgreSQL' => [
    'host' => getenv('POSTGRES_HOST'),
    'port' => getenv('POSTGRES_PORT'),
    'database' => getenv('POSTGRES_DATABASE'),
    'user' => getenv('POSTGRES_USER'),
    'password' => trim(file_get_contents(getenv('POSTGRES_PASSWORD_FILE')))
  ]
];

\Nymph\Nymph::configure($nymphConfig);

// Nymph PubSub's configuration.
\Nymph\PubSub\Server::configure(
    ['entries' => ['ws://'.getenv('PUBSUB_HOST').'/']]
);

// uMailPHP's configuration.
\uMailPHP\Mail::configure([
  'site_name' => 'Nymph App Template',
  'site_link' => 'http://localhost:8080/',
  'master_address' => 'noreply@example.com',
  'testing_mode' => true,
  'testing_email' => 'hperrin@localhost', // TODO(hperrin): what should this be?
]);


// Tilmeld's configuration.
\Tilmeld\Tilmeld::configure([
  'app_url' => 'http://localhost:8080/',
  'setup_url' => 'http://localhost:8080/user/',
  'email_usernames' => true,
  'verify_redirect' => 'http://localhost:8080/',
  'jwt_secret' => base64_decode(
      file_get_contents(getenv('TILMELD_SECRET_FILE'))
  )
]);
