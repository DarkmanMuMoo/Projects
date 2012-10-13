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



    public function index() {

      $this->output
    ->set_content_type('pdf') // You could also use ".jpeg" which will have the full stop removed before looking in config/mimes.php
    ->set_output(file_get_contents(base_url('uploads/Piyakarn_2012-09-06_06-26-40.ai')));
      

     
        /* $first= load_class('emailutil', 'libraries','');
          var_dump($first);
          var_dump($this); */
        /* var_export(true,true);
          echo var_export(false,true); */

    }

    public function testmd5() {

        $userlist = $this->cusdao->findall();
        foreach ($userlist as $user) {

            echo $user->getPassword() . " " . md5($user->getPassword()) . "<br/>";
        }
    }

    public function iscachning() {

        $this->load->driver('cache', array('adapter' => 'file'));
        echo var_dump($this->cache->cache_info(), true);
        echo 'apc : ' . var_export($this->cache->apc->is_supported(), true) . '<br>';
        echo 'file : ' . var_export($this->cache->file->is_supported(), true) . '<br>';
        echo 'memcached : ' . var_export($this->cache->memcached->is_supported(), true) . '<br>';
        echo 'add';
        $this->cache->file->save('plateL', '2000', 0);
        $this->cache->file->save('plateS', '1500', 0);
        $this->cache->file->save('print', '2000', 0);
        $this->cache->file->save('misc', '1000', 0);
    }

    private function test() {
        $updateuser = $_SESSION['user'];
        $updateuser->setName('abc');
        var_dump($updateuser);
        var_dump($_SESSION['user']);
    }

    public function viewsession() {
        //$this->session->set_flashdata('item', 'value');
        var_dump($_SESSION);
        echo session_save_path();
        echo APPPATH;
        // echo var_export($this->session->flashdata('item'));
        //echo var_export($this->session->flashdata('message'));
    }

    public function testCIsession() {

        $cus = $this->cusdao->findbyemail('darkman@hotmail.com');
        // $this->session->set_userdata('val','b');
        // echo var_export($this->session->userdata('a'), true) ;
        var_dump($this->session->userdata('a'));
        var_dump($this->session->userdata('b'));
        var_dump($this->session->userdata('c'));
        var_dump($this->session->userdata('d'));

        //  echo var_export($this->session->userdata('a'), true) ;
    }

    public function testtableclass() {
        $this->load->library('tablegen');

        $this->load->model('dao/paperdao');

        $ordpaylist = $this->paperdao->findall();


        echo $this->tablegen->genfromobjarray($ordpaylist, array('1', '2', '3'), array('id' => 'tt', 'class' => 'table table-bordered'));
    }

    public function testdownload() {

        $this->load->helper('download');

        $data = file_get_contents("./uploads/Koala.jpg"); // Read the file's contents
        $name = 'myphoto.jpg';


        force_download($name, $data);
    }

    public function testupload() {



        $this->load->view('testupload');
    }

    public function testdate() {
        // $this->load->helper('date');
        //  echo  date("Ymd-H:i:s");
        // echo"\n";
        //echo strtotime("2012/07/02");

        /* for($i=0 ;$i<=23; $i++){

          echo str_pad($i, 2, "0", STR_PAD_LEFT);
          echo'<br>';
          } */

        $date = '2008-01-01';
        $hour = '22';
        $min = '13';
        $sec = '05';

        $time = implode(':', array($hour, $min, $sec));
        $timestamp = $date . ' ' . $time;
        echo $timestamp;
    }

    public function testutil() {

        $this->load->library('smsutil');
        $result = $this->smsutil->sentsms('0867693988', 'finaltest');
        var_dump($result);
        echo $this->smsutil->getDebumsg();
        /* $this->load->library('captchautil');

          $array=$this->captchautil->captcha();
          $_SESSION['word']=$array['word'];
          $image=$array['img'];
          header("Content-type:image/png");	//กำหนดชนิดของภาพตอนแสดงผลผ่าน browser
          imagepng($image); //แสดงผลภาพที่สร้าง
          imagedestroy($image); */

        /*  $this->load->library('emailutil');

          $config=$this->emailutil->getSmtpconfig();
          var_dump($this->emailutil); */
        // $this->emailutil->sendemail($config,$form,$to,$subject,$message);
    }

    public function testDirectory() {
        $this->load->helper('directory');
        $map = directory_map('./');
        echo var_dump($map);
    }

    public function testencrypt() {

        $this->load->library('encrypt');


        $msg = 'darkmanmumoonaja@gmail.com';

        $encrypted_string = $this->encrypt->encode($msg);
        echo $encrypted_string;


        $plaintext_string = $this->encrypt->decode($encrypted_string);


        echo anchor('testsome/testverify/' . $encrypted_string, 'My News', array('title' => 'The best news!'));
    }

    public function testDB() {
        /* $this->load->model('dao/workdao');

          $worklist = $this->workdao->findsharedwork('',3,0);

          var_dump($worklist); */


        $this->db->from('work');
        $this->db->join('work_emp', 'work.empno = work_emp.empno', 'left');
        $this->db->where('work.empno', 8);
        //$this->db->where('work_empno is not',' null',false); 
        $query = $this->db->count_all_results();
        echo $query;
        echo $this->db->last_query();
        // echo $paper;
        //echo $template;
    }

    public function testDB2() {


        $this->load->model('dao/empdao');
        $this->load->model('obj/emp');

        echo var_dump($this->empdao->findall());
        //$this->db->close();
        //  $list = $this->empdao->findall() ;
        // echo $this->db->insert_id();
    }

    public function testmail2() {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'darkmanmumoonaja@gmail.com';
        $config['smtp_pass'] = '15710804';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";

        $this->load->library('email', $config);
        $this->email->from('phairoj@colourharmony.co.th', 'Name');
        $this->email->to('darkmanmumoonaja@gmail.com');


        $this->email->subject('Email Test');
        $this->email->message('Testing the email class' . "\r\n");

        $this->email->send();
        echo $this->email->print_debugger();
    }

    public function testmail() {


        $config = array();
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'mail.colourharmony.co.th';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['smtp_user'] = 'phairoj@colourharmony.co.th';
        $config['smtp_pass'] = 'p5h1a2i1';
        /* $config['protocol'] = 'sendmail';
          $config['mailpath'] = '/usr/sbin/sendmail';
          $config['charset'] = 'iso-8859-1';
          $config['wordwrap'] = TRUE; */

        $this->load->library('email', $config);
        $this->email->from('phairoj@colourharmony.co.th', 'Name');
        $this->email->to('darkmanmumoonaja@gmail.com');


        $this->email->subject('Email Test');
        $this->email->message('Testing the email class' . "\r\n");

        $this->email->send();

        echo $this->email->print_debugger();
    }

    public function testpagination() {

        $this->load->model('dao/pricedao');


        $this->load->library('pagination');

        $config['base_url'] = site_url("testsome/testpagination");
        $config['total_rows'] = $this->db->count_all("price");
        echo $config['total_rows'] . "<br>";
        $config['per_page'] = 10;
        $startrow = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->db->limit($config['per_page'], $startrow);

        $this->pagination->initialize($config);

        $pricelist = $this->pricedao->findall();

        foreach ($pricelist as $price) {

            echo $price->getPriceno() . "<br>";
        }
        echo $this->pagination->create_links();
    }

    public function testxml() {
        $xml = '<SMS>
	<QUEUE>
		<Msisdn>0849731746</Msisdn>
		<Status>1</Status>
		<Transaction>b4b7cd3bd4b947348a196baeda1f5a16</Transaction>
		<UsedCredit>1</UsedCredit>
		<RemainCredit>775</RemainCredit>
	</QUEUE>
<!-- 0.011434078216553 -->
</SMS>
';
        $faildxml = '<sms>
<status>0</status>
<detail>Unable Authentication, Ref #2</detail>
</sms>';
        $xmlDoc = new DOMDocument();

        $xmlDoc->loadXML($xml);
        $que = $xmlDoc->getElementsByTagName('QUEUE');
        if ($que->length == 0) {
            $status = $xmlDoc->getElementsByTagName('DETAIL')->item(0)->textContent;
            echo $status;
        } else {

            $msisdn = $que->item(0)->getElementsByTagName('Msisdn')->item(0);
            echo $msisdn->textContent;
        }
        //var_dump(empty($que));
    }

    public function testcurl() {
        $url = "http://www.thaibulksms.com/sms_api.php";

        $username = '0804402390';
        $password = '670256';
        $msisdn = '0849731746';
        $message = 'ภาษาไทย';
        $sender = 'SMS';
        $ScheduledDelivery = date('ymdhm');
        $SMStype = 'standard';

        $data_string = "username=$username&password=$password&msisdn=$msisdn&message=$message";
        $data_string.="&sender=$sender&ScheduledDelivery=$ScheduledDelivery&force=$SMStype";
        $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }

    public function viewphpinfo() {

        $this->load->view('info');
    }

    public function testftp() {
        $this->load->library('ftp');

        $config['hostname'] = 'onlineprinting.colourharmony.co.th';
        $config['username'] = 'darkman55';
        $config['password'] = 'mumoo';
        $config['debug'] = TRUE;

        $this->ftp->connect($config);

        $list = $this->ftp->list_files('/httpdocs');
        print_r($list);
        $this->ftp->close();
    }

}

?>
