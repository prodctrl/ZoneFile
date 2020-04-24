# Zone File

A simple PHP library for generating DNS zone files.


## Features

- Supports A, AAAA, CNAME, TXT, MX, and NS records
- Compatible with:
	- [AWS Route 53](https://aws.amazon.com/route53/)
	- [DNS Made Easy](https://dnsmadeeasy.com/)
- Shell script to deploy to Route 53


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

#### Output

```
$ORIGIN example.com.
$TTL 180
;example.com.
www		120		IN		A		151.101.193.67
www		120		IN		AAAA		2a04:4e42:400::323
```