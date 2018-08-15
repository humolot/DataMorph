<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Datamorph
*
* Author: Ignatius Yesigye
*		  ignatiusyesigye@gmail.com
*/

class Datamorph
{
	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	/**
	 * info - Return database info
	 *
	 * @access	public
	 * @return array
	 **/
	public function info()
	{
		$this->load->model('datamorph_model');
		return $this->datamorph_model->info();
	}

	/**
	 * databases - Return available databases
	 *
	 * @access	public
	 * @return object
	 **/
	public function databases()
	{
		$this->load->model('datamorph_model');
		return $this->datamorph_model->databases();
	}

	/**
	 * field_types - Return array of database field types
	 *
	 * @access	public
	 * @return array
	 **/
	public function field_types()
	{
		$this->load->config('datamorph');
		$config = $this->config->item('datamorph');

		return $config['field_types'];
	}

	/**
	 * data_types - List of data types that can be generated.
	 *
	 * @access	public
	 * @return array
	 **/
	public function data_types()
	{
		$this->load->config('datamorph');
		$config = $this->config->item('datamorph');

		return $config['data_types'];
	}
}

/* End of file Datamorph.php */
/* Location: ./application/libraries/Datamorph.php */