<?php

class View
{
	private $_controller;
	private $_js;

	public function __construct(Request $peticion) {
		$this->_controller = $peticion->getControlador();
		$this->_js = array();
		$this->_css = array();
	}


    /**
     * @param $view
     * @param bool $partial
     * @throws Exception
     */
	public function render($view, $partial = false)
	{

        $js = array();

		if(count($this->_js)){
			$js = $this->_js;
		}

		$_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'js' => $js
		);

		$rutaView = ROOT . 'views' . DS . $this->_controller . DS . $view . '.phtml';

        if(is_readable($rutaView)){
			if (!$partial) {
				include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.phtml';
				include_once $rutaView;
				include_once ROOT . 'views'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.phtml';
			}
			else
			include_once $rutaView;
		}
		else {
			throw new Exception('Error view');
		}
	}

    /**
     * @param array $js
     * @throws Exception
     */
	public function setJs(array $js)
	{
		if(is_array($js) && count($js)){
			for($i=0; $i < count($js); $i++){
				$this->_js[] = BASE_URL . 'public/js/' . $js[$i] . '.js';
			}
		} else {
			throw new Exception('Error de js');
		}
	}

    /**
     * @param array $css
     * @throws Exception
     */
	public function setCss(array $css)
	{
		if(is_array($css) && count($css)){
			for($i=0; $i < count($css); $i++){
				$this->_css[] = BASE_URL . 'public/css/' . $css[$i] . '.css';
			}
		} else {
			throw new Exception('Error de css');
		}
	}

}

?>
