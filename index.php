<?php
require_once __DIR__.'/vendor/autoload.php';
use FacebookAds\Api;
use FacebookAds\Object\AdUser;


Api::init('873017959494532','035d596bde8acd33c022603bad88124b','EAAMaAVVbs4QBANmZCZByhqZBAF5k8WW4bKkhOAJb5uWOykZBuXLWfZAoiIISCLRZC3IUZA0B7isaZCaDYQzFSmuNTTSUTKldsKaJlGxBDh3GqIrhnqXd9UlwwZAZBMk5tKYVxP8q22AGZBZCL6nyT11UkZBXlDkmFchkQa20ZD');


$me = new AdUser('me');
$my_adaccount = $me->getAdAccounts()->current();
print_r($my_adaccount);