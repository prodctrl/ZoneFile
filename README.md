# Zone File

A simple PHP library for generating DNS zone files.


## Features

- Supports A, AAAA, CNAME, TXT, MX, and NS records
- Compatible with:
	- [AWS Route 53](https://aws.amazon.com/route53/)
	- [DNS Made Easy](https://dnsmadeeasy.com/)
- Shell script to deploy to Route 53


## Limitations

- Not necessarily fully [RFC 1035](https://tools.ietf.org/html/rfc1035)/[RFC 1034](https://tools.ietf.org/html/rfc1034) compliant


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



## API Reference

#### ZoneFile(str `domain`[, int `ttl`])
- `domain` - the domain the zone file is being generated for.  This must be a fully qualified domain name that ends with a period (i.e. `example.com.`)
- `ttl` (optional) - the time to live (TTL), in seconds, that will be used for records where a TTL is not specified.  The default value is `60`


##### Example
```php
<?php

require('ZoneFile.php');

$zone_file = new ZoneFile('example.com.', 240);

?>
```