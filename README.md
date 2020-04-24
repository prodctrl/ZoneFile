# Zone File

A simple PHP library for generating DNS zone files.


## Usage

```php
<?php

require('ZoneFile.php');

$zone_file = new ZoneFile(
	'example.com.',
	180
);

$zone_file->addA('www', '151.101.193.67', 120);
$zone_file->addAAAA('www', '2a04:4e42:400::323', 120);

echo $zone_file->output();

?>
```