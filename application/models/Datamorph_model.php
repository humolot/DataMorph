<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// This script may take longer that the default 30 60 to finish
// ini_set("max_execution_time", 60 );

// execute with no limit
set_time_limit(0);

class Datamorph_model extends CI_Model {

	public $database;

 	/**
	 * Load database class.
	 */
	public function __construct()
    {
    	parent::__construct();

	    $config['hostname'] = $this->session->userdata('host');
		$config['username'] = $this->session->userdata('user');
		$config['password'] = $this->session->userdata('pass');
		$config['database'] = '';
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		//$config['autoinit'] = TRUE; // default
        $config['autoinit'] = FALSE;
		
		$this->database = $this->load->database($config);
    }

 	/**
	 * connect_to_db
	 * Load database class connected to a database.
	 */
	private function connect_to_db($db)
	{
		$config['hostname'] = $this->session->userdata('host');
		$config['username'] = $this->session->userdata('user');
		$config['password'] = $this->session->userdata('pass');
		$config['database'] = $db;
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = FALSE;
		$config['db_debug'] = FALSE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		// $config['autoinit'] = TRUE; // default
        $config['autoinit'] = FALSE;

        return $this->load->database($config, TRUE);
	}

	/**
	 * get_session_tables
	 * Returns database in create database session.
	*/
	public function get_session_database()
	{
		
		// Get current create session.
		$sessDB  = $this->session->userdata('new_database');

		// Check that the create session database name exists.
		if (isset($sessDB['name']))
		{
			return $sessDB['name'];
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_session_tables
	 * Returns tables in create database session.
	*/
	public function get_session_tables()
	{
		
		// Get current create session.
		$sessDB  = $this->session->userdata('new_database');

		// Check that the create session database name exists.
		if (isset($sessDB['name']))
		{
			// Check that the create session database tables exists.
			if (isset($sessDB['tables']))
			{
				return $sessDB['tables'];
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * get_session_table
	 * Returns table in create database session.
	*/
	public function get_session_table($ref)
	{
		// Get current create session.
		$sessDB = $this->session->userdata('new_database');
		
		// Check that tables exist.
		if (isset($sessDB['tables']))
		{
			// Delete the target table.
			if (isset($sessDB['tables'][$ref]))
			{
				return $sessDB['tables'][$ref];
			}
		}
				
		return NULL;
	}

	/**
	 * get_foreign_keys
	 * Returns array of possible foreign keys in session database.
	*/
	public function get_foreign_keys($database)
	{
		$key_list = array('0' => 'NONE');
		
		// Get current create session.
		$sessDB = $this->session->userdata('new_database');

		// Check that the create session database name exists.
		if (isset($sessDB['name']))
		{
			// Check that the create session database tables exists.
			if (isset($sessDB['tables']))
			{
				foreach ($sessDB['tables'] as $key => $table)
				{
					$key_list[$table['name']] = array();

					foreach ($table['fields'] as $field)
					{
						$key_list[$table['name']][$table['name'].'.'.$field['name']] = $table['name'].'.'.$field['name'];
					}
				}
			}
		}

		return $key_list;
	}

	/**
	 * info
	 * Returns general information about the server.
	 */
	public function info()
	{
		$info = new StdClass();
		$info->server 	= $this->session->userdata('host');
		$info->platform = $this->db->platform();
		$info->version 	= $this->db->version();
		return $info;
	}
	
	/**
	 * info
	 * Returns list of databases excluding mysql databases.
	 */
    public function databases()
	{
		// Array of database not to show.
		$exclude   = array(
			'mysql',
			'information_schema',
			'performance_schema'
		);

		$results   = array();

		$dbUtility = $this->load->dbutil($this->database, TRUE);

		// get all databases in the server
		$databases = $dbUtility->list_databases();

		if ($databases)
		{
			foreach ($databases as $db)
			{
				if ( ! in_array($db, $exclude))
				{
					array_push($results, $db);
				}
				
			}
		}
		return $results;
	}

	/**
	 * databases_info
	 * Returns list of databases and number of tables excluding mysql databases.
	 */
    public function databases_info()
	{
		// Array of database not to show.
		$exclude   = array(
			'mysql',
			'information_schema',
			'performance_schema'
		);

		$results   = array();

		$dbUtility = $this->load->dbutil($this->database, TRUE);

		// get all databases in the server
		$databases = $dbUtility->list_databases();

		if ($databases)
		{
			foreach ($databases as $db)
			{
				if ( ! in_array($db, $exclude))
				{
					// initiate an object to hold database meta data 
					$database 	= new StdClass();

					// get all tables in the database
					$connection = $this->connect_to_db($db);
					$tables 	= $connection->list_tables();

					// add to database meta data
					$database->name   = $db;
					$database->tables = count($connection->list_tables());
					array_push($results, $database);
				}
				
			}
		}
		return $results;
	}

	/**
	 * tables
	 * Returns tables in a database.
	 */
    public function tables($db)
	{
		$results = new StdClass();
		
		$dbUtility = $this->load->dbutil($this->database, TRUE);

		// check that the provided database exists
		if (!$dbUtility->database_exists($db))
		{
			return false;
		}
		else
		{
			// get all tables in the database
			$connection = $this->connect_to_db($db);
			$tables 	= $connection->list_tables();

			// get number of rows for each row
			if ($tables)
			{
				$tablesCount = 0;

				foreach ($tables as $table)
				{
					// initiate an object to hold table meta data 
					$results->$table = new StdClass();

					if ($connection->table_exists($table))
					{
						if (is_object($connection->get($table)))
						{
							// count tables
							$tablesCount = $tablesCount + 1;

							// add to tables meta data
							$results->$table->name 	 = $table;
							$results->$table->fields = $connection->list_fields($table);
							$results->$table->rows 	 = $connection->count_all($table);
						}
					}
				}
				$results->number = $tablesCount;
			}
		}
		return $results;
	}

	/**
	 * table
	 * Returns object of table data.
	 */
    public function table($db, $table, $start, $limit)
	{
		$results = new StdClass();
		
		$dbUtility = $this->load->dbutil($this->database, TRUE);

		// check that the provided database exists
		if ($dbUtility->database_exists($db))
		{
			// get all tables in the database
			$connection = $this->connect_to_db($db);

			if ($connection->table_exists($table))
			{
				if (is_object($connection->get($table)))
				{
					$connection->limit($limit, $start);
					$rows 	= $connection->get($table)->result();
					$fields = $connection->list_fields($table);

					$insert_fail = array(); // Foreign key constraint prevents data generation
					$fields_array = array();
					
					foreach ($fields as $field)
					{
						$connection->select('REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME');
						$connection->where('TABLE_SCHEMA', $db);
						$connection->where('TABLE_NAME', $table);
						$connection->where('COLUMN_NAME', $field);
						$connection->where('REFERENCED_TABLE_NAME !=', ' ');
						$ref = $connection->get('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')->result();

						$connection->select('CONSTRAINT_NAME');
						$connection->where('TABLE_SCHEMA', $db);
						$connection->where('TABLE_NAME', $table);
						$connection->where('COLUMN_NAME', $field);
						$connection->where('CONSTRAINT_NAME', 'PRIMARY');
						$key = $connection->get('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')->result();

						array_push($fields_array, 
							array(
								'name' => $field,
								'primary' => ($key) ? TRUE : FALSE,
								'reference' => ($ref) ? $ref[0]->REFERENCED_TABLE_NAME.'.'.$ref[0]->REFERENCED_COLUMN_NAME : NULL
							)
						);

						if ($ref)
						{
							// Check if the referenced table has data.
							if (! $connection->count_all($ref[0]->REFERENCED_TABLE_NAME))
							{
								array_push($insert_fail, $ref ? $ref[0]->REFERENCED_TABLE_NAME : NULL);
							}
						}
					}

					$results->table = new StdClass();

					// add to tables meta data
					$results->error 		 = FALSE;
					$results->table->name 	 = $table;
					$results->table->fields = $fields_array;
					$results->table->rows 	 = $rows;
					$results->table->insert_fail = $insert_fail;

					return $results;
				}
			}
			else
			{
				$results->error 	= TRUE;
				$results->message 	= 'table "'.$table.'" does not exist in database "'.$db.'"';
				return $results;
			}
		}
		else
		{
			$results->error 	= TRUE;
			$results->message 	= 'database "'.$db.'" does not exist';
			return $results;
		}
		return $results;
	}

	/**
	 * table
	 * Returns object of table data.
	 */
    public function table_count_rows($db, $table)
	{
		$dbUtility = $this->load->dbutil($this->database, TRUE);

		// check that the provided database exists
		if ($dbUtility->database_exists($db))
		{
			// get all tables in the database
			$connection = $this->connect_to_db($db);

			if ($connection->table_exists($table))
			{
				if (is_object($connection->get($table)))
				{
					return $connection->count_all_results($table);
				}
			}
		}
	}
	
	/**
	 * utility_class
	 * Returns dbutil class object.
	 */
	public function utility_class($name)
	{
		return $this->load->dbutil($this->connect_to_db($name), TRUE);
	}

	public function create_session_database($database)
	{
		// Check that there is no database already.
		if ($this->is_session_database($database))
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Database "'.$database.'" has already been set.'
				)
			);
		}

		// Get current database session.
		$sessDB  = $this->session->userdata('new_database');

		// Set the new session database name.
		$sessDB['name'] = $database;
		
		// Save the session database.
		$this->session->set_userdata('new_database', $sessDB);

		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Database "'.$database.'" has been set.'
			)
		);
	}

	public function rename_session_database($new_name)
	{
		// Get current database session.
		$sessDB  = $this->session->userdata('new_database');

		$old_name = $sessDB['name'];

		// Set the new session database name.
		$sessDB['name'] = $new_name;
		
		// Save the session database.
		$this->session->set_userdata('new_database', $sessDB);

		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Database "'.$old_name.'" has been renamed to "'.$new_name.'".'
			)
		);
	}

	public function create_session_table()
	{
		// Get the post data;
		$table_data = array(
			'name'	=> $this->input->post('table_name'),
			'fields' => $this->input->post('insert'),
			'rows' => $this->input->post('rows')
		);

		// Get current create session.
		$sessDB  = $this->session->userdata('new_database');

		// Create a tables array if it doesn't exist.
		if ( ! isset($sessDB['tables']))
		{
			$sessDB['tables'] = array();
		}

		// Remove table if it already exists.
		if (is_int($ref = $this->is_session_table($this->input->post('old_name'))))
		{
			unset($sessDB['tables'][$ref]);
		}

		// Add table to the session
		array_push($sessDB['tables'], $table_data);

		// Re-set a current creation session to add new data.
		$this->session->set_userdata('new_database', $sessDB);

		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Table "'.$table_data['name'].'" has been set.'
			)
		);
	}

	public function update_session_table($ref)
	{
		// Get the post data;
		$table_data = array(
			'name'	=> $this->input->post('table_name'),
			'fields' => $this->input->post('update'),
			'rows' => $this->input->post('rows')
		);

		// Get current create session.
		$sessDB  = $this->session->userdata('new_database');

		// Define table to the session
		$sessDB['tables'][$ref] = $table_data;

		// Re-set a current creation session to add new data.
		$this->session->set_userdata('new_database', $sessDB);

		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Table "'.$table_data['name'].'" has been altered.'
			)
		);
	}

	/**
	 * generate
	 * Generate data for database in session.
	 */
	public function generate()
	{
		// Generate as you flush data
		if (ob_get_level() == 0) ob_start();

		// Hold results.
		$results = new StdClass();

		// Get current database session.
		$sessDB  = $this->session->userdata('new_database');

		if ( ! isset($sessDB['name']))
		{
			// No database in session.
			// Update user.
			$message = 'Create a database first.';
			echo "<script>
			$('.code-editor').append('<div class=\"text-danger\"> > ".$message." </div>')
			$('.panel').removeClass('panel-primary'); $('.panel').addClass('panel-danger'); $('.panel-heading').html('<i class=\"glyphicon glyphicon-exclamation-sign\" style=\"margin-right:5px\"></i> Generator has finished. With errors!')
			</script>";
			ob_flush();
			flush();
			return FALSE;
		}

		// Update user.
		$message = 'Creating database "'.$sessDB['name'].'"';
		echo "<script> $('.code-editor').append('<div class=\"text-muted\"> > ".$message." </div>') </script>";
		ob_flush();
		flush();
		
		// Load database utility class
		$this->load->dbutil();

		if ($this->dbutil->database_exists($sessDB['name']))
		{

			// database exists
			$results->error 	= TRUE;
			$results->message 	= 'database "'.$sessDB['name'].'" already exists';

			echo "
			<script>
			$('.code-editor').append('<div class=\"text-danger\"> > ".$results->message." </div>')
			$('.panel').removeClass('panel-primary'); $('.panel').addClass('panel-danger'); $('.panel-heading').html('<i class=\"glyphicon glyphicon-exclamation-sign\" style=\"margin-right:5px\"></i> Generator has finished. With errors!')
			</script>";
			ob_flush();
			flush();
			
			ob_end_flush();
			return $results;
		}
		else
		{

			// Load database forge class
			$this->load->dbforge();

			if ($this->dbforge->create_database($sessDB['name']))
			{
				// Database create, Update user.
				$message = 'Database "'.$sessDB['name'].'" was created successfully';
				echo "<script> $('.code-editor').append('<div class=\"text-success\"> > ".$message." </div>') </script>";
				ob_flush();
				flush();
			}
			else
			{
				$dbError = $this->db->error();

				if ($dbError['code'] !== 0)
				{
					$results->message = $dbError['message'];
				}
				else
				{
					$results->message = 'database "'.$sessDB['name'].'" could not be created';
				}
				// database exists
				$results->error = TRUE;

				echo "<script>
				$('.code-editor').append('<div class=\"text-danger\"> > ".$message." </div>')
				$('.panel').removeClass('panel-primary'); $('.panel').addClass('panel-danger'); $('.panel-heading').html('<i class=\"glyphicon glyphicon-exclamation-sign\" style=\"margin-right:5px\"></i> Generator has finished. With errors!')
				</script>";
				ob_flush();
				flush();
				
				ob_end_flush();
				return $results;
			}
		}
		
		// Connect to new database
		$connection = $this->connect_to_db($sessDB['name']);

		// To create tables, load db_forge.
		$this->load->dbforge($connection);

		foreach ($sessDB['tables'] as $key => $table)
		{
			$tableName = $table['name'];

			// Update user on progress.
			$message = 'Creating table "'.$tableName.'"';
			echo "<script>
			$('.code-editor').append('<div class=\"text-muted\"> > ".$message." </div>');
			</script>";
			ob_flush();
			flush();

			foreach ($table['fields'] as $key => $field)
			{
				// Initialize field parameters.
				$fields[$field['name']] = array();
				
				// Define the field parameters.
				$fields[$field['name']]['type'] = $field['type'];
				if ($field['default']) $fields[$field['name']]['default'] = $field['default'];
				$fields[$field['name']]['constraint'] = $field['length'] ? $field['length'] : FALSE;
				$fields[$field['name']]['auto_increment'] = isset($field['auto']) ? TRUE : FALSE;
				$fields[$field['name']]['null'] = isset($field['null']) ? TRUE : FALSE;
				$fields[$field['name']]['unique'] = isset($field['unique']) ? TRUE : FALSE;
				
				// Assign primary keys.
				if ($field['index'] === 'primary') $this->dbforge->add_key($field['name'], TRUE);

				// Assign foreign keys.
				if (isset($field['foreign_key']))
				{
					if ($field['foreign_key'] !== '0')
					{
						$segments = explode('.', $field['foreign_key']);
						// Get foreign table name.
						$referenced_table_name = $segments[0];
						$referenced_table_field = $segments[1];
						// Assign foreign keys.
						$this->dbforge->add_field('CONSTRAINT `fk_'.$tableName.'_'.$referenced_table_name.'` FOREIGN KEY (`'.$field['name'].'`) REFERENCES `'.$referenced_table_name.'` (`'.$referenced_table_field.'`) ON DELETE '.$field['on_delete'].' ON UPDATE '.$field['on_update']);
					}
				}
			}

			// Add fields.
			$this->dbforge->add_field($fields);
			// Create table.
			$this->dbforge->create_table($tableName);

			if ($connection->table_exists($tableName))
			{
				// Table was created.
				$message = 'Table "'.$tableName.'" was created successfully';
				echo "<script>
				$('.code-editor').append('<div class=\"text-success\"> > ".$message." </div>');
				</script>";
				ob_flush();
				flush();
			}
			else
			{
				// Table doesn't exist.
				// Update user on progress.
				$message = 'Table "'.$tableName.'" could not be created';
				echo "<script>
				$('.code-editor').append('<div class=\"text-danger\"> > ".$message." </div>');
				</script>";
				ob_flush();
				flush();
			}
		}


		// Load the Faker to populate the table when created.
		$this->load->library('faker');
		$faker = Faker\Factory::create();
		
		foreach ($sessDB['tables'] as $key => $table)
		{
			$tableName = $table['name'];
			
			$message = 'Generating data for "'.$tableName.'"';
			echo "<script>
			$('.code-editor').append('<div class=\"text-muted\"> > ".$message." </div>');
			</script>";
			ob_flush();
			flush();

			$insert_batch_data = array();

			for ($i=1; $i < intval($table['rows'])+1; $i++)
			{
				$insert_data = array();

				foreach ($table['fields'] as $key => $field)
				{
					// Let faker generate a random value
					$insert_data[$field['name']] = isset($field['auto']) ? $i : $faker->$field['data'];
					
					// if this is a foreign key
					if (isset($field['foreign_key']))
					{
						if ($field['foreign_key'] !== '0')
						{
							$segments = explode('.', $field['foreign_key']);
							// Get foreign table name.
							$referenced_table_name = $segments[0];
							$referenced_table_field = $segments[1];

							$connection->limit(1);
							$connection->select($referenced_table_field);
							$connection->order_by($referenced_table_field, 'RANDOM');
							$query = $connection->get($referenced_table_name)->result();

							if (!empty($query)) $insert_data[$field['name']] = $query[0]->$referenced_table_field;
						}
					}
				}
				array_push($insert_batch_data, $insert_data);
			}
			
			$connection->insert_batch($tableName, $insert_batch_data);

			$rowNumber = $connection->count_all($tableName);

			if ( $rowNumber > 0)
			{
				// Data has been generated.
				$message = $rowNumber.' Rows generated for "'.$tableName.'"';
				echo "<script>$('.code-editor').append('<div class=\"text-success\"> > ".$message." </div>');</script>";
				ob_flush();
				flush();
			}
			else
			{
				// Data wasn't generated.
				$message = 'Data could not be generated for "'.$tableName.'"';
				echo "<script>$('.code-editor').append('<div class=\"text-danger\"> > ".$message." </div>');</script>";
				ob_flush();
				flush();
			}
		}
		
		// Phew! Done. Remove database session.
		$this->delete_session_database();

		// Update user on progress.
		echo "<script>
		$('.panel').removeClass('panel-primary'); $('.panel').addClass('panel-success'); $('.panel-heading').html('<span class=\"pull-left\"><i class=\"glyphicon glyphicon-ok-sign\" style=\"margin-right:5px\"></i> Generator has finished.</span> <a href=\"".site_url('database/'.$sessDB['name'])."\" class=\"btn btn-sm btn-primary pull-right\">View Database</a> <div class=\"clearfix\"></div>')
		</script>";
		ob_flush();
		flush();

		ob_end_flush();
	}

	/**
	 * table_generate
	 * Generate data for a specific table.
	 */
	public function table_generate($database, $table)
	{
		// Load database utility class
		$this->load->dbutil();
		// Connect to new database
		$connection = $this->connect_to_db($database);

		if ( ! $connection->table_exists($table))
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$table.'" does not exist.'
				)
			);
		}

		// Count total rows before we begin.
		$beforeCount = $connection->count_all($table);

		// Load the Faker to populate the table when created.
		$this->load->library('faker');
		$faker = Faker\Factory::create();

		$insert_batch_data = array();

		for ($i=1; $i < $this->input->post('rows')+1; $i++)
		{
			$insert_data = array();

			foreach ($this->input->post('insert') as $column_name => $field)
			{

				if (isset($field['ref']))
				{
					// Split the reference string.
					$segments = explode('.', $field['ref']);
					// Get foreign table name.
					$referenced_table_name = $segments[0];
					$referenced_table_field = $segments[1];

					// To generated field data for a foreign key we shall,
					// Get a value from the referenced table's column at random
					$connection->limit(1);
					$connection->select($referenced_table_field);
					$connection->order_by($referenced_table_field, 'RANDOM');
					$referenced_query = $connection->get($referenced_table_name)->result();

					// Use this value as generated field data
					if (!empty($referenced_query)) $insert_data[$column_name] = $referenced_query[0]->$referenced_table_field;
				}
				else
				{
					// Check if this field is set to auto increment.
					$connection->select('COLUMN_NAME');
					$connection->where('TABLE_SCHEMA', $database);
					$connection->where('TABLE_NAME', $table);
					$connection->where('COLUMN_NAME', $column_name);
					$connection->like('EXTRA', 'auto_increment');
					$auto_increment_query = $connection->get('INFORMATION_SCHEMA.COLUMNS')->result();

					// Generate field data if field doesn't auto increment
					if (empty($auto_increment_query)) $insert_data[$column_name] = $faker->$field['data'];
				}
			}
			array_push($insert_batch_data, $insert_data);
		}
		
		// Insert batch data.
		$connection->insert_batch($table, $insert_batch_data);
		// Count total rows after inserting data.
		$afterCount = $connection->count_all($table);

		if ($afterCount > $beforeCount)
		{
			return array(
				'error' => FALSE,
				'alert' => array(
					'type' 	  => 'success',
					'message' => ($afterCount-$beforeCount).' rows have been generated for table "'.$table.'"'
				)
			);
		}
		else
		{
			// Data wasn't generated.
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Data could not be generated for table "'.$table.'"'
				)
			);
		}
	}

	/**
	 * insert_table
	 * Insert a new table.
	 */
	public function insert_table($database, $table)
	{
		// Load database utility class
		$this->load->dbutil();
		// Connect to new database
		$connection = $this->connect_to_db($database);
		// To create tables, load db_forge.
		$this->load->dbforge($connection);

		if ($connection->table_exists($table))
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$table.'" already exist.'
				)
			);
		}

		foreach ($this->input->post('insert') as $key => $field)
		{
			// Initialize field parameters.
			$fields[$field['name']] = array();
			
			// Define the field parameters.
			$fields[$field['name']]['type'] = $field['type'];
			if ($field['default']) $fields[$field['name']]['default'] = $field['default'];
			$fields[$field['name']]['constraint'] = $field['length'] ? $field['length'] : FALSE;
			$fields[$field['name']]['auto_increment'] = isset($field['auto']) ? TRUE : FALSE;
			$fields[$field['name']]['null'] = isset($field['null']) ? TRUE : FALSE;
			$fields[$field['name']]['unique'] = isset($field['unique']) ? TRUE : FALSE;
			
			// Assign primary keys.
			if ($field['index'] === 'primary') $this->dbforge->add_key($field['name'], TRUE);

			// Assign foreign keys.
			if (isset($field['foreign_key']))
			{
				if ($field['foreign_key'] !== '0')
				{
					$segments = explode('.', $field['foreign_key']);
					// Get foreign table name.
					$referenced_table_name = $segments[0];
					$referenced_table_field = $segments[1];
					// Assign foreign keys.
					$this->dbforge->add_field('CONSTRAINT `fk_'.$tableName.'_'.$referenced_table_name.'` FOREIGN KEY (`'.$field['name'].'`) REFERENCES `'.$referenced_table_name.'` (`'.$referenced_table_field.'`) ON DELETE '.$field['on_delete'].' ON UPDATE '.$field['on_update']);
				}
			}
		}

		// Add fields.
		$this->dbforge->add_field($fields);
		// Create table.
		$this->dbforge->create_table($table);

		if ( ! $connection->table_exists($table))
		{
			// Table wasn't created.
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$table.'" could not be created'
				)
			);
		}

		// Load the Faker to populate the table when created.
		$this->load->library('faker');
		$faker = Faker\Factory::create();

		$insert_batch_data = array();

		for ($i=1; $i < intval($this->input->post('rows'))+1; $i++)
		{
			$insert_data = array();

			foreach ($this->input->post('insert') as $key => $field)
			{
				// Let faker generate a random value
				$insert_data[$field['name']] = isset($field['auto']) ? $i : $faker->$field['data'];
				
				// if this is a foreign key
				if (isset($field['foreign_key']))
				{
					if ($field['foreign_key'] !== '0')
					{
						$segments = explode('.', $field['foreign_key']);
						// Get foreign table name.
						$referenced_table_name = $segments[0];
						$referenced_table_field = $segments[1];

						$connection->limit(1);
						$connection->select($referenced_table_field);
						$connection->order_by($referenced_table_field, 'RANDOM');
						$query = $connection->get($referenced_table_name)->result();

						if (!empty($query)) $insert_data[$field['name']] = $query[0]->$referenced_table_field;
					}
				}
			}
			array_push($insert_batch_data, $insert_data);
		}
		
		$connection->insert_batch($table, $insert_batch_data);

		$rowNumber = $connection->count_all($table);

		if ( $rowNumber > 0)
		{
			return array(
				'error' => FALSE,
				'alert' => array(
					'type' 	  => 'success',
					'message' => 'Table "'.$table.'" has been created with '.$rowNumber.' rows'
				)
			);
		}
		else
		{
			// Data wasn't generated.
			return array(
				'error' => FALSE,
				'alert' => array(
					'type' 	  => 'success',
					'message' => 'Table "'.$table.'" has been created with no rows'
				)
			);
		}
	}


 	/**
	 * rename_table
	 * Rename an existing table.
	 */
	public function rename_table($database, $oldName, $newName)
	{
		$results = new StdClass();

		// Check for table
		if ( ! $this->is_table($database, $newName))
		{
			// Connect to new database
			$forger = $this->load->dbforge($this->connect_to_db($database), TRUE);			
			$forger->rename_table($oldName, $newName);

			return array(
				'error' => FALSE,
				'alert' => array(
					'type' 	  => 'success',
					'message' => 'Table was rename from "'.$oldName.'" to "'.$newName.'"'
				)
			);
		}
		else
		{
			return array(
				'error' => FALSE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$newName.'" already exists'
				)
			);
		}
	}

 	/**
	 * empty_table
	 * Empty an existing table.
	 */
	public function empty_table($database, $table)
	{
		// Check for table
		if ($this->is_table($database, $table))
		{
			// Connect to database
			$connection = $this->connect_to_db($database);

			$connection->truncate($table);
			
			// Check for table
			if ($connection->count_all($table) > 0)
			{
				return array(
					'error' => TRUE,
					'alert' => array(
						'type' 	  => 'danger',
						'message' => 'Table "'.$table.'" could not be emptied'
					)
				);
			}
			else
			{
				return array(
					'error' => FALSE,
					'alert' => array(
						'type' 	  => 'success',
						'message' => 'Table "'.$table.'" has been emptied'
					)
				);
			}
		}
		else
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$table.'" does not exist'
				)
			);
		}
	}

	/**
	 * delete_table
	 * Delete an existing table.
	 */
	public function delete_table($database, $table)
	{
		// Load CI forger driver.
		$forger = $this->load->dbforge($this->connect_to_db($database), TRUE);
		$forger->drop_table($table);

		// Connect to database
		$connection = $this->connect_to_db($database);

		if ($connection->table_exists($table))
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Table "'.$table.'" could not be deleted'
				)
			);
		}
		
		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Table "'.$table.'" has been deleted'
			)
		);
	}

	/**
	 * delete_database
	 * Delete an existing database.
	 */
	public function delete_database($database)
	{
		// Load CI forger driver.
		$forger = $this->load->dbforge($this->connect_to_db($database), TRUE);

		if ($forger->drop_database($database))
		{
			return array(
				'error' => TRUE,
				'alert' => array(
					'type' 	  => 'danger',
					'message' => 'Database "'.$database.'" could not be deleted'
				)
			);
		}
		
		return array(
			'error' => FALSE,
			'alert' => array(
				'type' 	  => 'success',
				'message' => 'Database "'.$database.'" has been deleted'
			)
		);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Delete Functions
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	public function delete_session_database()
	{
		$this->session->unset_userdata('new_database');
	}

	public function delete_session_table($ref)
	{
		// Get current create session.
		$sessDB = $this->session->userdata('new_database');
		
		// Check that tables exist.
		if (isset($sessDB['tables']))
		{
			if (isset($sessDB['tables'][$ref]))
			{
				// Get the table name.
				$table_name = $sessDB['tables'][$ref]['name'];
				// Remove the table.
				unset($sessDB['tables'][$ref]);
				// Save the changes.
				$this->session->set_userdata('new_database', $sessDB);
				
				return array(
					'error' => FALSE,
					'alert' => array(
						'type' 	  => 'success',
						'message' => 'Table "'.$table_name.'" has been removed.'
					)
				);
			}
		}
				
		return array(
			'error' => TRUE,
			'alert' => array(
				'type' 	  => 'danger',
				'message' => 'Table could not be removed.'
			)
		);
	}

	public function delete_session_table_fields($ref)
	{
		// Get current create session.
		$sessDB = $this->session->userdata('new_database');
		
		// Check that tables exist.
		if (isset($sessDB['tables']))
		{
			if (isset($sessDB['tables'][$ref]))
			{
				foreach ($this->input->post('selected') as $key => $id)
				{
					if (isset($sessDB['tables'][$ref]))
					{ 
						unset($sessDB['tables'][$ref]['fields'][$id]);
						// Save the changes.
						$this->session->set_userdata('new_database', $sessDB);
						
						return array(
							'error' => FALSE,
							'alert' => array(
								'type' 	  => 'success',
								'message' => 'Table fields have been removed.'
							)
						);
					}
				}
			}
		}

		return array(
			'error' => TRUE,
			'alert' => array(
				'type' 	  => 'danger',
				'message' => 'Table fields could not be removed.'
			)
		);
	}



	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Validation Functions
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * is_session_database
	 * Check if a database exists in the session.
	*/
	public function is_session_database($database)
	{
		
		// Get current create session.
		$sessDB  = $this->session->userdata('new_database');

		// Check that the create session database name doesn't exists.
		if (isset($sessDB['name']))
		{
			// Does session database name match
			if ($database !== $sessDB['name'])
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	
	/**
	 * is_session_table
	 * Check if a table exists in the session database.
	*/
	public function is_session_table($value)
	{

		$array = $this->session->userdata('new_database');

		if (isset($array['tables']))
		{
			foreach($array['tables'] as $key => $table)
			{
				if ( $table['name'] === $value ) return $key;
			}
		}

		return false;
	}
	
	/**
	 * is_database
	 * Check if a table exists in the database.
	*/
	public function is_database($database)
	{
		// Load the CI database utility class
		$dbUtility = $this->load->dbutil($this->database, TRUE);
		
		// Check for database
		if ($dbUtility->database_exists($database))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * is_table
	 * Check if a table exists in the database.
	*/
	public function is_table($database, $name)
	{
		// Connect to new database
		$connection = $this->connect_to_db($database);
		
		// Check for table
		if ($connection->table_exists($name))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}