<?

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testsome
 *
 * @author Dark
 */
class Testsome extends CI_Controller {
    //put your code here
    
    
    public function index(){
     
        $this->load->view('Hellopage');
  echo ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 $this->load->library('myencrypt');
 $str = 'darkmanmumoonaja@gmail.com';
     $encode = $this->myencrypt->encode($str); 
     //$decode  =  $this->myencrypt->decode($str); 
     
     echo anchor("/testsome/index/$encode", 'Email ได้รับการยืนยันแล้ว คลิกที่นี่เพื่อกลับไปหน้า Homepage', 'title="SignUp"');
    }

    
public function testdropdown(){
$this->load->view('testdropdown');
   
}
    
      public function testdownload(){
          
          $this->load->helper('download');
         
          $data = file_get_contents("./uploads/Koala.jpg"); // Read the file's contents
$name = 'myphoto.jpg';


force_download($name, $data);


      }
    public function testupload(){
        
        
        
        $this->load->view('testupload'); 
        
    }
    public function  testdate(){
    $this->load->helper('date');
     //echo  date("Y-m-d");
    // echo"\n";
     //echo strtotime("2012/07/02");
        
    }
        public function  testDirectory(){
      $this->load->helper('directory');
      $map = directory_map('./');
        echo var_dump($map);
    }
    public function testencrypt(){
        
 $this->load->library('encrypt');
        
        
        $msg = 'darkmanmumoonaja@gmail.com';

$encrypted_string = $this->encrypt->encode($msg);
        echo $encrypted_string;
        
    
        $plaintext_string = $this->encrypt->decode($encrypted_string);


echo anchor('testsome/testverify/'.$encrypted_string, 'My News', array('title' => 'The best news!'));
    }
      public function testDB(){
            $this->load->model('dao/orddao');
            $array=array('email'=>'darkman@hotmail.com','ord_status'=>'waitupload');
        $ordlist = $this->orddao->findbymultifield($array);
        
        var_dump($ordlist);
       // echo $paper;
           //echo $template;
 
    }
     public function testDB2(){
         
         
         $this->load->model('dao/empdao');
          $this->load->model('obj/emp');
       $emp = new Emp();
       $emp->setEmail('bla');
         $emp->setLastname('blabla');
          $emp->setName('mumoo');
            $emp->setPassword('mumoo');
              $emp->setPhone('0000');
              $emp->setPosition('Boss');
       echo var_dump( $this->empdao->insert($emp));
       //  $list = $this->empdao->findall() ;
         echo $this->db->insert_id();
     }
    
    public function testmail2(){
  $config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';  
$config['smtp_user']='darkmanmumoonaja@gmail.com';  
$config['smtp_pass']='15710804';  
$config['charset']='utf-8';  
$config['newline']="\r\n";  
  
        $this->load->library('email',$config);
$this->email->from('phairoj@colourharmony.co.th', 'Name');
$this->email->to('darkmanmumoonaja@gmail.com'); 


$this->email->subject('Email Test');
$this->email->message('Testing the email class'."\r\n");	

$this->email->send();
echo $this->email->print_debugger();
        
        
    }
        public function testmail(){
        
      
$config = array();
$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host']='mail.colourharmony.co.th';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE; 
$config['smtp_user']='phairoj@colourharmony.co.th';
$config['smtp_pass']='p5h1a2i1';
/*$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;*/

$this->load->library('email',$config);
$this->email->from('phairoj@colourharmony.co.th', 'Name');
$this->email->to('darkmanmumoonaja@gmail.com'); 


$this->email->subject('Email Test');
$this->email->message('Testing the email class'."\r\n");	

$this->email->send();

echo $this->email->print_debugger();
        
    }
    
    public function testpagination(){
       
  $stb = $this->load->database('stb',true);
        
        
        $this->load->library('pagination');

$config['base_url'] =site_url("testsome/testpagination");
$config['total_rows'] =  $this->db->count_all("country");
echo $config['total_rows'];
$config['per_page'] = 30; 
$startrow = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

$stb->limit($config['per_page'], $startrow);

$this->pagination->initialize($config); 
        $query = $stb->get("Country");

  foreach ($query->result() as $row) {
      
      echo  $row->country_code."<br>"; 
  }
echo $this->pagination->create_links();
        
        
        
    }
    
      public function viewphpinfo(){
         ini_set('upload_max_filesize', '10M');
echo ini_get('upload_max_filesize'), ", " , ini_get('post_max_size');
          $this->load->view('info');
      }
       public function testftp(){
  $this->load->library('ftp');

$config['hostname'] = 'onlineprinting.colourharmony.co.th';
$config['username'] = 'darkman55';
$config['password'] = 'mumoo';
$config['debug'] = TRUE;

$this->ftp->connect($config);

$list=$this->ftp->list_files('/httpdocs');
print_r($list);
$this->ftp->close();
      }
      
      
      
}

?>
