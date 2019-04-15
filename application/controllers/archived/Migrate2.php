<?php
class Migrate2 extends CI_Controller
{
	public function index()
	{
		if ($this->migration->latest() === FALSE)
		{
			show_error($this->migration->error_string());
		}
		else
			echo "helllo";
	}
}