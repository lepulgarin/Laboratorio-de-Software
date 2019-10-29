<?php

return [
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "from@example.com",
      "name" => "Example"
  ),
  "username" => "13bcdfcdd414e5",
  "password" => "35d2e522abb226",
  "sendmail" => "/usr/sbin/sendmail -bs"
];
