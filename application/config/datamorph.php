<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: datamorph Config
*
* Author: 	Yesigye Ignatius
* 			ignatiusyesigye@gmail.com


/*
|--------------------------------------------------------------------------
| Field types
|--------------------------------------------------------------------------
| List of database field types: To be used as a dropdown select.
*/
$config['datamorph']['field_types'] = array(
	'Basics' => array(
		'INT'       => 'INT',
		'VARCHAR'   => 'VARCHAR',
		'TEXT'      => 'TEXT',
		'DATE'      => 'DATE'
		),

	'Numeric' => array(
		'TINYINT'   => 'TINYINT',
		'SMALLINT'  => 'SMALLINT',
		'MEDIUMINT' => 'MEDIUMINT',
		'INT'       => 'INT',
		'BIGINT'    => 'BIGINT',
		'DECIMAL'   => 'DECIMAL',
		'FLOAT'     => 'FLOAT',
		'DOUBLE'    => 'DOUBLE',
		'REAL'      => 'REAL',
		'BIT'       => 'BIT',
		'BOOLEAN'   => 'BOOLEAN',
		'SERIAL'    => 'SERIAL'
		),

	'Date and time' => array(
		'DATE'      => 'DATE',
		'DATETIME'  => 'DATETIME',
		'TIMESTAMP' => 'TIMESTAMP',
		'TIME'      => 'TIME',
		'YEAR'      => 'YEAR'
		),

	'String' => array(
		'CHAR'      => 'CHAR',
		'VARCHAR'   => 'VARCHAR',
		'TINYTEXT'  => 'TINYTEXT',
		'TEXT'      => 'TEXT',
		'MEDIUMTEXT'=> 'MEDIUMTEXT',
		'LONGTEXT'  => 'LONGTEXT',
		'BINARY'    => 'BINARY',
		'VARBINARY' => 'VARBINARY',
		'TINYBLOB'  => 'TINYBLOB',
		'MEDIUMBLOB'=> 'MEDIUMBLOB',
		'BLOB'      => 'BLOB',
		'LONGBLOB'  => 'LONGBLOB',
		'ENUM'      => 'ENUM',
		'SET'       => 'SET'
		),

	'Spatial' => array(
		'GEOMETRY'          => 'GEOMETRY',
		'POINT'             => 'POINT',
		'LINESTRING'        => 'LINESTRING',
		'POLYGON'           => 'POLYGON',
		'MULTIPOINT'        => 'MULTIPOINT',
		'MULTILINESTRING'   => 'MULTILINESTRING',
		'MULTIPOLYGON'      => 'MULTIPOLYGON',
		'GEOMETRYCOLLECTION'=> 'GEOMETRYCOLLECTION'
		)
	);

/*
|--------------------------------------------------------------------------
| Data types
|--------------------------------------------------------------------------
| List of data types that can be generated: To be used as a dropdown select.
*/
$config['datamorph']['data_types'] = array(

	'Basics'    => array(
		'randomDigit'   => 'Int',
		'boolean'       => 'Boolean'
		),

	'Text'      => array(
		"word"          => "Word",
		"sentence"      => "Sentence",
		"paragraph"     => "Paragraph",
		"text"          => "Text"
		),

	"Person"    => array(
		"title"         => "Title",
		"name"          => "Name",
		"firstName"     => "First Name",
		"lastName"      => "Last Name",
		"phoneNumber"   => "Phone number"
		),

	"Address"   => array(
		"country"       => "Country",
		"latitude"      => "Latitude",
		"longitude"     => "Longitude",
		"postcode"      => "Postcode",
		"address"       => "Address",
		"state"         => "State",
		"streetAddress" => "Street Address",
		"stateAbbr"     => "State Abbreviation",
		"city"          => "City",
		"citySuffix"    => "City Suffix",
		"streetName"    => "Street Name",
		"secondaryAddress"  => "Secondary Address",
		"cityPrefix"    => "City Prefix",
		"streetSuffix"  => "Street Suffix",
		"buildingNumber"    => "Building Number"
		),

	"DateTime"  => array(
		"date"      => "Date",
		"time"      => "Time",
		"year"      => "Year",
		"century"   => "Century",
		"timezone"  => "Timezone"
		),

	"Internet"  => array(
		"freeEmail"     => "email",
		"companyEmail"  => "Company email",
		"userName"      => "Username",
		"password"      => "Password",
		"domainName"    => "Domain Name",
		"domainWord"    => "Domain Word",
		"tld"           => "tld",
		"url"           => "url",
		"slug"          => "slug",
		"ipv4"          => "IPv4",
		"localIpv4"     => "local IPv4",
		"ipv6"          => "ipv6",
		"macAddress"    => "mac Address"
		),

	"UserAgent" => array(
		"userAgent" => "userAgent",
		"chrome"    => "chrome",
		"firefox"   => "firefox",
		"safari"    => "safari",
		"opera"     => "opera",
		"internetExplorer" => "internetExplorer"
		),

	"Payment"   => array(
		"creditCardType"    => "Credit Card Type",
		"creditCardNumber"  => "Credit Card Number",
		"creditCardExpirationDateString" => "credit Card Exp Date",
		"creditCardDetails" => "Credit Card Details",
		"swiftBicNumber"    => "SWIFTBIC  Number"
		),

	"Color"     => array(
		"hexcolor"      => "Hex Color",
		"rgbcolor"      => "rgb Color",
		"rgbCssColor"   => "CSS rgb Color",
		"safeColorName" => "Color Name"
		),

	"Image"     => array(
		"imageUrl"  =>"Image Url",
		"image"     => "Image"
		),

	"Barcode"   => array(
		"ean13"     => "ean13",
		"ean8"      => "ean8",
		"isbn13"    => "isbn13",
		"isbn10"    => "isbn10"
		),

	"Miscellaneous" => array(
		"md5"    => "md5",
		"sha1"   => "sha1",
		"sha256" => "sha256",
		"locale" => "locale",
		"countryCode"   => "Country Code",
		"languageCode"  => "language Code",
		"currencyCode"  => "Currency Code"
		),
	);