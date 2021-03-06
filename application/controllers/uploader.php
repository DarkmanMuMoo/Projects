<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploader
 *
 * @author Dark
 */
class Uploader extends CI_Controller {

    //put your code here


    public function testDirectory() {
        $this->load->helper('directory');
        $map = directory_map('./uploads');
        echo var_dump(is_dir('./uploads'));
        echo var_dump($map);
    }

    public function do_upload() {
        $config = array();
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '51200';


        $this->load->library('upload');
        $this->upload->initialize($config);
        $message = '';
        if (!$this->upload->do_upload('myfile')) {
            $message = $this->upload->display_errors();
        } else {
            $message = 'complete';
        }

        echo $message;
    }

    public function uploadfile() {
        $this->load->model('dao/orddao');
        $this->load->model('dao/orderlinedao');

        $orderlineno = $this->input->post('orderlineno');
        $orderline = $this->orderlinedao->findbyid($orderlineno);

        $config = array();
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'pdf|ai';
        $config['max_size'] = '51200';

        $filepath = $orderline->getFilepath();

        $user = $_SESSION['user'];
        
        $filename = date("Y-m-d_H-i-s");
        $config['file_name'] = $filename;

        $mesg = $this->upload($config);
      
        
        if ($mesg == 'complete') {
              $extension=$this->upload->data();
             $orderline->setFilepath("/".$filename.$extension['file_ext'] );
           $result= $this->orderlinedao->update($orderline);
              error_log(var_export('update filepath' . $result, true));
            
            if (!empty($filepath)&&$result) {
                $re = unlink('./uploads' . $filepath);

                error_log(var_export('delete file' . $re, true));
            }
           
        }
        echo $mesg;
        
        
    }

    private function upload($config, $name = 'myfile') {
        $this->load->library('upload');
        $this->upload->initialize($config);
        $message = 'error';
        if (!$this->upload->do_upload($name)) {
            $message = $this->upload->display_errors();
        } else {
            $message = 'complete';
        }

        return $message;
    }

}

?>
