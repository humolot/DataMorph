<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-07-07 18:43:01 --> Severity: Notice --> Undefined variable: title C:\UwAmp\www\frisk\application\views\login_view.php 4
ERROR - 2017-07-07 18:45:46 --> Severity: Notice --> Undefined variable: title C:\UwAmp\www\frisk\application\views\login_view.php 4
ERROR - 2017-07-07 18:46:40 --> Severity: Notice --> Undefined variable: title C:\UwAmp\www\frisk\application\views\login_view.php 4
ERROR - 2017-07-07 18:47:34 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 207
ERROR - 2017-07-07 18:49:11 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 207
ERROR - 2017-07-07 18:49:35 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 207
ERROR - 2017-07-07 18:54:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\application\controllers\Website.php 256
ERROR - 2017-07-07 18:54:36 --> Severity: Notice --> Undefined property: Website::$datamorph_model C:\UwAmp\www\frisk\application\controllers\Website.php 280
ERROR - 2017-07-07 18:54:36 --> Severity: Error --> Call to a member function update_session_table() on null C:\UwAmp\www\frisk\application\controllers\Website.php 280
ERROR - 2017-07-07 19:25:31 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 207
ERROR - 2017-07-07 19:27:46 --> Severity: Parsing Error --> syntax error, unexpected 'array' (T_ARRAY), expecting ',' or ';' C:\UwAmp\www\frisk\application\views\create\create_edit_table_view.php 167
ERROR - 2017-07-07 19:28:19 --> Severity: Parsing Error --> syntax error, unexpected ')', expecting ',' or ';' C:\UwAmp\www\frisk\application\views\create\create_edit_table_view.php 167
ERROR - 2017-07-07 19:47:34 --> Severity: Parsing Error --> syntax error, unexpected 'as' (T_AS) C:\UwAmp\www\frisk\application\models\Datamorph_model.php 808
ERROR - 2017-07-07 19:53:07 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 299
ERROR - 2017-07-07 20:38:11 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 299
ERROR - 2017-07-07 21:24:22 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 300
ERROR - 2017-07-07 21:24:53 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 300
ERROR - 2017-07-07 21:25:26 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 300
ERROR - 2017-07-07 21:28:13 --> Severity: Notice --> Trying to get property of non-object C:\UwAmp\www\frisk\application\controllers\Website.php 300
ERROR - 2017-07-07 21:29:16 --> 404 Page Not Found: Create/save
ERROR - 2017-07-07 21:29:44 --> Severity: Notice --> Undefined offset: 1 C:\UwAmp\www\frisk\application\models\Datamorph_model.php 617
ERROR - 2017-07-07 21:29:44 --> Severity: Notice --> Undefined index: on_delete C:\UwAmp\www\frisk\application\models\Datamorph_model.php 619
ERROR - 2017-07-07 21:29:44 --> Severity: Notice --> Undefined index: on_update C:\UwAmp\www\frisk\application\models\Datamorph_model.php 619
ERROR - 2017-07-07 21:30:37 --> 404 Page Not Found: Database/view
ERROR - 2017-07-07 21:31:12 --> Severity: Notice --> Undefined offset: 1 C:\UwAmp\www\frisk\application\models\Datamorph_model.php 618
ERROR - 2017-07-07 21:31:12 --> Severity: Notice --> Undefined index: on_delete C:\UwAmp\www\frisk\application\models\Datamorph_model.php 620
ERROR - 2017-07-07 21:31:12 --> Severity: Notice --> Undefined index: on_update C:\UwAmp\www\frisk\application\models\Datamorph_model.php 620
ERROR - 2017-07-07 21:35:24 --> Query error: Invalid default value for 'id' - Invalid query: CREATE TABLE `category` (
	`id` INT(40) NOT NULL DEFAULT 0 AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL DEFAULT 0,
	CONSTRAINT `pk_category` PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci
ERROR - 2017-07-07 21:35:24 --> Query error: Invalid default value for 'id' - Invalid query: CREATE TABLE `sub_category` (
	CONSTRAINT `fk_sub_category_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
	`id` INT(40) NOT NULL DEFAULT 0 AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL DEFAULT 0,
	`cat_id` INT(40) NOT NULL DEFAULT 0,
	CONSTRAINT `pk_sub_category` PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci
ERROR - 2017-07-07 21:35:24 --> Unable to load the requested class: Faker
ERROR - 2017-07-07 21:35:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 21:36:15 --> Query error: Invalid default value for 'id' - Invalid query: CREATE TABLE `category` (
	`id` INT(40) NOT NULL DEFAULT 0 AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL DEFAULT 0,
	CONSTRAINT `pk_category` PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci
ERROR - 2017-07-07 21:36:15 --> Query error: Invalid default value for 'id' - Invalid query: CREATE TABLE `sub_category` (
	CONSTRAINT `fk_sub_category_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
	`id` INT(40) NOT NULL DEFAULT 0 AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL DEFAULT 0,
	`cat_id` INT(40) NOT NULL DEFAULT 0,
	CONSTRAINT `pk_sub_category` PRIMARY KEY(`id`)
) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci
ERROR - 2017-07-07 21:36:15 --> Unable to load the requested class: Faker
ERROR - 2017-07-07 21:36:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 21:38:16 --> Unable to load the requested class: Faker
ERROR - 2017-07-07 21:38:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 21:45:21 --> Unable to load the requested class: Faker
ERROR - 2017-07-07 21:45:21 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 21:46:20 --> Unable to load the requested class: Faker
ERROR - 2017-07-07 21:46:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 21:49:42 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) C:\UwAmp\www\frisk\application\models\Datamorph_model.php 732
ERROR - 2017-07-07 21:51:00 --> Severity: Parsing Error --> syntax error, unexpected 'public' (T_PUBLIC) C:\UwAmp\www\frisk\application\models\Datamorph_model.php 735
ERROR - 2017-07-07 22:06:38 --> Severity: Notice --> Undefined variable: newTable C:\UwAmp\www\frisk\application\models\Datamorph_model.php 680
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1547
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> sort() expects parameter 1 to be array, null given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1548
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> ksort() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> ksort() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1576
ERROR - 2017-07-07 22:06:38 --> Severity: Notice --> Undefined variable: newTable C:\UwAmp\www\frisk\application\models\Datamorph_model.php 682
ERROR - 2017-07-07 22:06:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT COUNT(*) AS `numrows` FROM 
ERROR - 2017-07-07 22:06:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\UwAmp\www\frisk\application\controllers\Website.php:366) C:\UwAmp\www\frisk\system\core\Common.php 573
ERROR - 2017-07-07 22:06:38 --> Severity: Error --> Call to a member function num_rows() on boolean C:\UwAmp\www\frisk\system\database\DB_driver.php 1222
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1547
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> sort() expects parameter 1 to be array, null given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1548
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> ksort() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> ksort() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1576
ERROR - 2017-07-07 22:08:03 --> Query error: Field 'name' doesn't have a default value - Invalid query: INSERT INTO `category` () VALUES (), ()
ERROR - 2017-07-07 22:08:03 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 685
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1547
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> sort() expects parameter 1 to be array, null given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1548
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> ksort() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> ksort() expects parameter 1 to be array, integer given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_keys() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> array_diff(): Argument #1 is not an array C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1553
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> ksort() expects parameter 1 to be array, string given C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1560
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1565
ERROR - 2017-07-07 22:08:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1576
ERROR - 2017-07-07 22:08:03 --> Query error: Field 'name' doesn't have a default value - Invalid query: INSERT INTO `sub_category` () VALUES (), (), ()
ERROR - 2017-07-07 22:08:03 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 685
ERROR - 2017-07-07 22:10:22 --> Severity: Notice --> Array to string conversion C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1523
ERROR - 2017-07-07 22:10:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Array' at line 1 - Invalid query: INSERT INTO `category` () VALUES (1), Array
ERROR - 2017-07-07 22:10:22 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 688
ERROR - 2017-07-07 22:10:22 --> Severity: Notice --> Array to string conversion C:\UwAmp\www\frisk\system\database\DB_query_builder.php 1523
ERROR - 2017-07-07 22:10:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Array' at line 1 - Invalid query: INSERT INTO `sub_category` () VALUES (1), Array
ERROR - 2017-07-07 22:10:22 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 688
ERROR - 2017-07-07 22:11:18 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 688
ERROR - 2017-07-07 22:11:19 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`sample`.`sub_category`, CONSTRAINT `fk_sub_category_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION) - Invalid query: INSERT INTO `sub_category` (`cat_id`, `id`, `name`) VALUES (4,1,'aspernatur'), (8,2,'dolorum'), (2,3,'quibusdam'), (0,4,'nobis'), (7,5,'non'), (7,6,'ut'), (2,7,'officia'), (0,8,'ipsum'), (1,9,'doloribus'), (2,10,'quae')
ERROR - 2017-07-07 22:11:19 --> Severity: Notice --> Undefined variable: rowNumber C:\UwAmp\www\frisk\application\models\Datamorph_model.php 688
ERROR - 2017-07-07 22:12:37 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`sample`.`sub_category`, CONSTRAINT `fk_sub_category_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION) - Invalid query: INSERT INTO `sub_category` (`cat_id`, `id`, `name`) VALUES (8,1,'repellendus'), (0,2,'nisi'), (4,3,'minus'), (2,4,'magni'), (4,5,'distinctio'), (8,6,'ab'), (9,7,'ea'), (0,8,'et'), (7,9,'voluptatem'), (6,10,'iusto')
ERROR - 2017-07-07 22:18:41 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`sample`.`sub_category`, CONSTRAINT `fk_sub_category_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION) - Invalid query: INSERT INTO `sub_category` (`cat_id`, `id`, `name`) VALUES (7,1,'totam'), (2,2,'ab'), (5,3,'iste'), (7,4,'amet'), (3,5,'sunt'), (2,6,'accusamus'), (1,7,'velit'), (3,8,'aut'), (3,9,'molestias'), (7,10,'quis')
ERROR - 2017-07-07 22:36:48 --> 404 Page Not Found: Database/demo
