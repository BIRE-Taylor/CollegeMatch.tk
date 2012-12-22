<?php
class View {

	private $pageVars = array();
	private $view;
	private $template;

	//Arg 1 view name
	//Arg 2 
	//	Default: True = Default Template
	//	False = No Template
	//	Anything else = Template Name
	public function __construct($view, $template = true)
	{
		global $config;
		$this->view = APP_DIR .'views/'. $view .'.php';
		if(is_bool($template)&&$template == true && isset($config['default_template']))
		{
			$this->template = $config['default_template'];
		}
		else
		{
			echo "template";
			$this->template = $template;
		}	
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVars);

		ob_start();
		if($this->template!=false)
		{
			require(APP_DIR . 'templates/'.$this->template.'-header.php');
		}
		require($this->view);
		if($this->template!=false)
		{
			require(APP_DIR . 'templates/'.$this->template.'-footer.php');
			}
		echo ob_get_clean();
	}
    
}

?>
