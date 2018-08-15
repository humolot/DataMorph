# DataMorph
DataMorph is a database management and scaffolding application. It allows users to quickly create database and generate tables with random data. This makes it easy in cases of scaffolding, prototyping and testing where you need to automatically fill your database with data. In addition, DataMorph provides basic function like search, download, table manipulation and more. 
<br><br>
<h3>DATA TYPES</h3>
Int<br>
Boolean<br>
Word<br>
Sentence<br>
Paragraph<br>
Text<br><br>
Title<br>
Name<br>
First Name<br>
Last Name<br>
Phone number<br>
Country<br>
Latitude<br>
Longitude<br>
Postcode<br>
Address<br>
State<br>
Street Address<br>
State Abbreviation<br>
City<br>
City Suffix<br>
Street Name<br>
Secondary Address<br>
City Prefix<br>
Street Suffix<br>
Building Number<br>
Date<br>
Time<br>
Year<br>
Century<br>
Timezone<br>
email<br>
Company email<br>
Username<br>
Password<br>
Domain Name<br><br>
Domain Word<br>
tld<br>
url<br>
slug<br>
IPv4<br>
local IPv4<br>
ipv6<br>
mac Address<br>
userAgent<br>
chrome<br>
firefox<br>
safari<br>
opera<br>
internetExplorer<br>
Credit Card Type<br>
Credit Card Number<br>
credit Card Exp Date<br>
Credit Card Details<br>
SWIFTBIC Number<br>
Hex Color<br><br>
rgb Color<br>
CSS rgb Color<br>
Color Name<br>
Image Url<br>
Image<br>
ean13<br>
ean8<br>
isbn13<br>
isbn10<br>
md5<br>
sha1<br>
sha256<br>
locale<br>
Country Code<br>
language Code<br>
Currency Code<br>
<br><br>
<strong>INCLUDED</strong><br>
Bootstrap v4 – Bootstrap v4 is a brand new framework with new cool features, pronounced colors and more <br>
http://v4-alpha.getbootstrap.com/<br><br>
PHP Faker Faker is a PHP library that generates fake data for you <br>
https://github.com/fzaninotto/Faker<br><br>
Codeigniter CodeIgniter is a powerful PHP framework with a very small footprint <br>
https://www.codeigniter.com/<br><br>

<h3>CONFIGURE THE WEBSERVER:</h3>

	Edit the config file located at application/config/config.php<br>
	Change:<br>
		$config['base_url'] = 'http://localhost/datamorph';<br>
	to:<br>
		$config['base_url'] = 'http://mysite.com';<br><br>

<h3>CONFIGURE WEBSERVER MOD_REWRITE:</h3>

	Edit the .htaccess file located at the root of your installation.<br>
	Change:<br>
		RewriteBase /datamorph<br>
	to:<br>
		if your app is installed in a directory<br>
			RewriteBase /folder-name<br>
		if your app is installed in a sub-directory<br>
			RewriteBase /folder-name/sub-folder-name<br>
		if your app is installed at the root of your server<br>
			RewriteBase /<br>
