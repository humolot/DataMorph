<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		

		// Ensure that the user is logged in
		if($this->session->userdata('logged_in'))
		{
			// Initialize variables to be consumed by views.
			$this->data = array();
			// Load required libraries.
			$this->load->library(array('datamorph'));
		}
		else
		{
			// User is not requesting login page.
			if($this->uri->segment(1) !== 'login')
			{
				redirect('login');
			}
		}
	}

	public function index()
	{
		$this->load->model('datamorph_model');
		$this->data['databases'] = $this->datamorph_model->databases_info();
		$this->load->view('home_view', $this->data);
	}

	/**
	 * login
	 * Login page used to log into the database server.
	*/
	public function login()
	{
		if ($this->input->post('login'))
		{
			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

			$this->form_validation->set_rules('hostname', 'Hostname', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run())
			{
				$config['hostname'] = $this->input->post('hostname');
				$config['username'] = $this->input->post('username');
				$config['password'] = $this->input->post('password');
				$config['database'] = '';
				$config['dbdriver'] = 'mysqli';
				$config['dbprefix'] = '';
				$config['pconnect'] = FALSE;
				$config['db_debug'] = FALSE;
				$config['cache_on'] = FALSE;
				$config['cachedir'] = '';
				$config['char_set'] = 'utf8';
				$config['dbcollat'] = 'utf8_general_ci';
				//$config['autoinit'] = TRUE; // default
		        $config['autoinit'] = FALSE;
				
				$database = $this->load->database($config);
				$db_error = $this->db->error();

				if ($db_error['code'] !== 0)
				{
					$this->session->set_flashdata('message', array(
						'type' => 'danger',
						'content' => $db_error['message']
					));

					redirect('login');
				}
				else
				{
					$this->session->set_userdata(array(
						'host' => $this->input->post('hostname'),
						'user' => $this->input->post('username'),
						'pass' => $this->input->post('password'),
						'logged_in' => TRUE
					));
					$this->session->set_flashdata('message', array(
						'type' => 'success',
						'content' => 'You logged in successfully'
					));

					redirect('');
				}
			}
		}

		$this->load->view('login_view');
	}

	/**
	 * logout
	 * Logout used to log out of the database server.
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	/**
	 * database
	 * View database details.
	*/
	public function database($database)
	{
		$this->load->model('datamorph_model');

		$this->data['database'] = $database;
		$this->data['tables']   = $this->datamorph_model->tables($database);

		$this->load->helper('text');
		$this->load->view('database/view_tables', $this->data);
	}

	/**
	 * table
	 * View table details.
	*/
	public function table($database)
	{
		$this->load->model('datamorph_model');

		$table = $this->uri->segment(3);
		$page_limit = 20;
		$result_total = $this->datamorph_model->table_count_rows($database, $table);

		// User post a rename request.
		if ($this->input->post('table_rename'))
		{
			// Validate submitted form.
			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
			$this->form_validation->set_rules('new_name', 'New Name', 'trim|required|differs[old_name]');

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->rename_table($this->input->post('database'), $this->input->post('old_name'), $this->input->post('new_name'));
				// set feedback alert
				$this->session->set_flashdata('alert', $result['alert']);
				
				if ($result['error']) redirect(current_url());

				redirect('database/'.$this->input->post('database').'/'.$this->input->post('new_name'));
			}
		}

		// User post a generate request.
		if ($this->input->post('generate'))
		{
			// Validate submitted form.
			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
			$this->form_validation->set_rules('rows', 'Row No.', 'trim|required');

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->table_generate($database, $table);
				// Set feedback.
				$this->session->set_flashdata('alert', $result['alert']);
				redirect(current_url());
			}
		}

		// CI Pagination
		if ($page_num = $this->input->get('per_page'))
		{
			$start_point = ($page_num*$page_limit) - $page_limit;
		}
		else
		{
			$start_point = 0;
		}

		$config['base_url'] = current_url();
		$config['page_query_string'] = TRUE;
		$config['per_page'] = $page_limit;
		$config['total_rows'] = $result_total;
		$config['num_links']  = 4;
		$config['use_page_numbers']  = TRUE;
		$config['full_tag_open']  = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open']   = '<li>';
		$config['num_tag_close']  = '</li>';
		$config['cur_tag_open']   = '<li class="active"><a>';
		$config['cur_tag_close']  = '</a></li>';
		$config['prev_tag_open']  = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['prev_link'] 	  = 'prev';
		$config['next_link'] 	  = 'next';
		$config['next_tag_open']  = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['first_tag_open']  = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open']  = '<li class="last">';
		$config['last_tag_close'] = '</li>';

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		// Display the table.
		$this->load->helper('text');
		
		$this->data['table'] = $table;
		$this->data['data']  = $this->datamorph_model->table($database, $table, $start_point, $page_limit);
		$this->data['database'] = $database;

		$this->load->view('database/view_table_data', $this->data);
	}

	/**
	 * empty_table
	 * Empty/Trucante database table.
	*/
	public function empty_table($database, $table = NULL)
	{
		$this->load->model('datamorph_model');

		$result = $this->datamorph_model->empty_table($database, $table);
		// set feedback alert
		$this->session->set_flashdata('alert', $result['alert']);
		// back to page.
		redirect('database/'.$database.'/'.$table);
	}

	/**
	 * delete_database
	 * Delete database.
	*/
	public function delete_database($database)
	{
		$this->load->model('datamorph_model');

		$result = $this->datamorph_model->delete_database($database);
		// set feedback alert
		$this->session->set_flashdata('alert', $result['alert']);
		
		if ($result['error']) redirect(current_url());

		redirect(site_url());
	}

	/**
	 * delete_table
	 * Delete database table.
	*/
	public function delete_table($database, $table = NULL)
	{
		$this->load->model('datamorph_model');

		$result = $this->datamorph_model->delete_table($database, $table);
		// set feedback alert
		$this->session->set_flashdata('alert', $result['alert']);
		
		if ($result['error']) redirect(current_url());

		redirect('database/'.$database);
	}

	/**
	 * download
	 * download database.
	*/
	public function download($database, $table = NULL)
	{
		$this->load->model('datamorph_model');

		// Ensure that the user is logged in
		if( ! $this->session->userdata('logged_in'))
		{
			// Redirect user to login
			redirect('login');
		}
		else
		{
			if ($table)
			{
				if ($database)
				{
					// download table from database
					$fileName 	= $table.".sql"; // add sql extensions

					// Load the DB utility class
					$util = $this->datamorph_model->utility_class($database);		

					// Backup your entire database and assign it to a variable
					$prefs = array(
						'tables'      => array($table),
						'format'      => 'txt', // gzip, zip, txt
						'filename'    => $fileName  // File name - NEEDED ONLY WITH ZIP FILES
					);
					$backup = $util->backup($prefs);

					// Load the download helper and send the file to your desktop
					$this->load->helper('download');
					force_download($fileName, $backup);
				}
				else
				{
					show_404();
				}
			}
			else
			{
				if ($database)
				{
					// download the database
					$fileName 	= $database.".sql"; // add sql extensions

					// Load the DB utility class
					$util = $this->datamorph_model->utility_class($database);		

					// Backup your entire database and assign it to a variable
					$prefs = array(
						'format'      => 'txt', // gzip, zip, txt
						'filename'    => $fileName  // File name - NEEDED ONLY WITH ZIP FILES
					);
					$backup = $util->backup($prefs);

					// Load the download helper and send the file to your desktop
					$this->load->helper('download');
					force_download($fileName, $backup);	
				}
			}
		}	
	}


	/**
	 * create_new_table
	 * Create new database tables in the session.
	*/
	public function insert_table($database)
	{
		$this->load->model('datamorph_model');

		if ($this->input->post('new_table'))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

			// Set validation rules.
			$row_id = 0;
			$row_ids = array();
			foreach($this->input->post('insert') as $id => $row)
			{
				$row_id++; // Identify rows using standard counting starting from 1 rather than 0.
				$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
				$this->form_validation->set_rules('table_name', 'Table Name', 'required|callback_session_table_unique');
				// $this->form_validation->set_rules('insert['.$id.'][field_name]', 'Row #'.$row_id.' Field Name', 'required');
				$this->form_validation->set_rules('insert['.$id.'][name]', 'Field Name', 'required');
				$this->form_validation->set_rules('insert['.$id.'][type]', 'Field Type', 'required');

				// The following fields are not validated, however must be included or their data will not be repopulated by CI.
				$this->form_validation->set_rules('insert['.$id.'][length]');
				$this->form_validation->set_rules('insert['.$id.'][data]');
				$this->form_validation->set_rules('insert['.$id.'][default]');
				$this->form_validation->set_rules('insert['.$id.'][null]');
				$this->form_validation->set_rules('insert['.$id.'][auto]');
				$this->form_validation->set_rules('insert['.$id.'][default]');
				$this->form_validation->set_rules('insert['.$id.'][index]');
				$this->form_validation->set_rules('insert['.$id.'][foreign_key]');
				$this->form_validation->set_rules('insert['.$id.'][on_update]');
				$this->form_validation->set_rules('insert['.$id.'][on_delete]');
			}

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->insert_table($database, $this->input->post('table_name'));

				if($result->error)
				{
					// Errors occured while creating table.
					redirect(current_url());
				}

				$this->session->set_flashdata('alert', $result['alert']);
				// back to database tables view.
				redirect('database/'.$database);

			}
			else
			{
				// Define position where validation errors occured.
				$this->data['validation_row_ids'] = $row_ids;
			}
		}

		$this->data['database'] = $database;
		$this->data['fields'] = 5;
		$this->data['tables'] = $this->datamorph_model->get_session_tables($database);
		$this->data['foreign_keys'] = $this->datamorph_model->get_foreign_keys($database);

		// Display the create page to show errors.
		$this->load->view('create/create_new_table_view', $this->data);
	}

	/**
	 * create
	 * create databases and tables.
	*/
	public function create()
	{
		$this->load->model('datamorph_model');

		if ($this->input->post('rename_database'))
		{
			$result = $this->datamorph_model->rename_session_database($this->input->post('name'));
			$this->session->set_flashdata('alert', $result['alert']);
			redirect('create');
		}

		// Create new database post.
		if ($this->input->post('new_database'))
		{
			$this->form_validation->set_rules('new_database', 'Name', 'trim|required');

			if ($this->form_validation->run())
			{
				$database = $this->input->post('new_database');
				$result = $this->datamorph_model->create_session_database($this->input->post('new_database'));
				$this->session->set_flashdata('alert', $result['alert']);
				redirect('create');
			}
		}
		
		// Check if there is a database already being created
		$database = $this->datamorph_model->get_session_database();

		if ($database)
		{
			$this->data['database'] = $database;
			$this->data['fields'] = 5;
			$this->data['tables'] = $this->datamorph_model->get_session_tables($database);

			// Display the create page to show errors.
			$this->load->view('create/create_tables_view', $this->data);
		}
		else
		{	
			$this->load->view('create/database_form', $this->data);
		}
	}


	/**
	 * create_new_table
	 * Create new database tables in the session.
	*/
	public function create_new_table()
	{
		$this->load->model('datamorph_model');
		

		if ($this->input->post('new_table'))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

			// Set validation rules.
			$row_id = 0;
			$row_ids = array();
			foreach($this->input->post('insert') as $id => $row)
			{
				$row_id++; // Identify rows using standard counting starting from 1 rather than 0.
				$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
				$this->form_validation->set_rules('table_name', 'Table Name', 'required|callback_session_table_unique');
				// $this->form_validation->set_rules('insert['.$id.'][field_name]', 'Row #'.$row_id.' Field Name', 'required');
				$this->form_validation->set_rules('insert['.$id.'][name]', 'Field Name', 'required');
				$this->form_validation->set_rules('insert['.$id.'][type]', 'Field Type', 'required');

				// The following fields are not validated, however must be included or their data will not be repopulated by CI.
				$this->form_validation->set_rules('insert['.$id.'][length]');
				$this->form_validation->set_rules('insert['.$id.'][data]');
				$this->form_validation->set_rules('insert['.$id.'][default]');
				$this->form_validation->set_rules('insert['.$id.'][null]');
				$this->form_validation->set_rules('insert['.$id.'][auto]');
				$this->form_validation->set_rules('insert['.$id.'][default]');
				$this->form_validation->set_rules('insert['.$id.'][index]');
				$this->form_validation->set_rules('insert['.$id.'][foreign_key]');
				$this->form_validation->set_rules('insert['.$id.'][on_update]');
				$this->form_validation->set_rules('insert['.$id.'][on_delete]');
			}

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->create_session_table();

				if($result->error)
				{
					// Errors occured while creating table.
					redirect(current_url());
				}

				$this->session->set_flashdata('alert', $result['alert']);
				// back to creation center.
				redirect('create');

			}
			else
			{
				// Define position where validation errors occured.
				$this->data['validation_row_ids'] = $row_ids;
			}
		}

		$database = $this->datamorph_model->get_session_database();

		if (!$database)
		{
			redirect('create');
		}

		$this->data['database'] = $database;
		$this->data['fields'] = 5;
		$this->data['tables'] = $this->datamorph_model->get_session_tables($database);
		$this->data['foreign_keys'] = $this->datamorph_model->get_foreign_keys($database);

		// Display the create page to show errors.
		$this->load->view('create/create_new_table_view', $this->data);
	}

	/**
	 * edit_memory_table
	 * Edit a table in the session.
	*/
	public function edit_memory_table($key)
	{
		$this->load->model('datamorph_model');

		if ($this->input->post('delete_selected'))
		{
			$this->load->library('form_validation');
			// Set validation rules.
			$this->form_validation->set_rules('selected[]', 'above', 'required');
			$this->form_validation->set_message('required', 'You did not select any fields.');

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->delete_session_table_fields($key);
				$this->session->set_flashdata('alert', $result['alert']);
				redirect(current_url());
			}
		}
		
		if ($this->input->post('edit_table'))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

			// Set validation rules.
			$row_id = 0;
			$row_ids = array();
			foreach($this->input->post('update') as $id => $row)
			{
				$row_id++; // Identify rows using standard counting starting from 1 rather than 0.
				$row_ids[] = $id; // Save row indexes incase validation fails and the form needs to be repopulated.
				$this->form_validation->set_rules('table_name', 'Table Name', 'required');
				// $this->form_validation->set_rules('update['.$id.'][field_name]', 'Row #'.$row_id.' Field Name', 'required');
				$this->form_validation->set_rules('update['.$id.'][name]', 'Field Name', 'required');
				$this->form_validation->set_rules('update['.$id.'][type]', 'Field Type', 'required');

				// The following fields are not validated, however must be included or their data will not be repopulated by CI.
				$this->form_validation->set_rules('update['.$id.'][length]');
				$this->form_validation->set_rules('update['.$id.'][data]');
				$this->form_validation->set_rules('update['.$id.'][default]');
				$this->form_validation->set_rules('update['.$id.'][null]');
				$this->form_validation->set_rules('update['.$id.'][auto]');
				$this->form_validation->set_rules('update['.$id.'][default]');
				$this->form_validation->set_rules('update['.$id.'][index]');
				$this->form_validation->set_rules('update['.$id.'][foreign_key]');
				$this->form_validation->set_rules('update['.$id.'][on_update]');
				$this->form_validation->set_rules('update['.$id.'][on_delete]');
			}

			if ($this->form_validation->run())
			{
				$result = $this->datamorph_model->update_session_table($key);

				if($result->error)
				{
					// Errors occured while creating table.
					redirect(current_url());
				}

				$this->session->set_flashdata('alert', $result['alert']);
				// back to creation center.
				redirect('create');

			}
			else
			{
				// Define position where validation errors occured.
				$this->data['validation_row_ids'] = $row_ids;
			}
		}

		$database = $this->datamorph_model->get_session_database();

		if (!$database)
		{
			redirect('create');
		}

		$this->data['database'] = $database;
		$this->data['foreign_keys'] = $this->datamorph_model->get_foreign_keys($database);
		$this->data['table'] = $this->datamorph_model->get_session_table($key);

		// Display the create page to show errors.
		$this->load->view('create/create_edit_table_view', $this->data);
	}

	/**
	 * delete_memory_table
	 * Delete a table in the session.
	*/
	public function delete_memory_table($key)
	{

		$this->load->model('datamorph_model');
		
		$result = $this->datamorph_model->delete_session_table($key);
		$this->session->set_flashdata('alert', $result['alert']);
		// back to creation center.
		redirect('create');
	}

	/**
	 * save
	 * Write database from memory to server.
	*/
	public function save()
	{
		$this->load->model('datamorph_model');

		$database = $this->datamorph_model->get_session_database();

		// Display the create page to show errors.
		$page = $this->load->view('create/generate_view', array(
			'title' 	=> 'DataMorph | Generating '.$database,
			'database' 	=> $database,
			'flusher' 	=> TRUE
		), TRUE);
		
		// Load the page first.
		echo $page;

		$this->datamorph_model->generate();
	}

	/**
	 * cancel
	 * Cancel database creation process.
	*/
	public function cancel()
	{
		$this->load->model('datamorph_model');
		
		$this->datamorph_model->delete_session_database();
		// back to creation center.
		redirect('create');
	}

	/**
	 * session_table_unique
	 * Custom validation for existing table in memory
	 */
	function session_table_unique($str)
	{
		$this->load->model('datamorph_model');

		if (!$this->datamorph_model->is_session_table($str))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('session_table_unique', 'The {field} already exists');
			return FALSE;
		}
	}
}
