<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
        public function __construct() {
            parent::__construct();
      
        $this->load->model('obj/orderline');
     
    
        }

        public function index()
	{
            //session_start();

		$this->load->view(lang('hompage'));
                
                
	}
        public function opencartdialog(){
            $data=array();
            $data['opencart']="<script> window.showcart();  </script>";
            
            
            $this->load->view(lang('hompage'),$data);
            
        }
         public function addtocart() {

        // session_start();
        //log_message('error', 'Some variable Some construct');

        $ordline = $_SESSION['tmp_ordline'];
        // echo var_dump($ordline);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        array_push($_SESSION['cart'], $ordline);
        unset($_SESSION['tmp_ordline']);

        // redirect('home', 'refresh');
        redirect('home/opencartdialog');
    }
         public function loginframe(){
             
             $this->load->view(lang('loginframe'));
             
         }
         public function showcart() {
        $this->load->model('dao/templatedao');
        $this->load->model('dao/paperdao');
        $this->load->model('dao/optiondao');


        $data = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        } else {

            $data['templatelist'] = $this->templatedao->findall();
            $data['paperlist'] = $this->paperdao->findall();
            $data['optionlist'] = $this->optiondao->findall();
        }

        $data['Ncart']=  count($_SESSION['cart']);
        
        $this->load->view(lang('showcartframe'), $data);
    }

    public function removeCartItem($index) {


        unset($_SESSION['cart'][$index]);
        $this->showcart();
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */