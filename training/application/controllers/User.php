
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('encryption');
        $this->load->helper('url');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');      
    }
 
    function index(){
        $this->load->view('frontend/sign_up');   

    }

    function showForm() {
        $this->load->view('frontend/login');
    }

    function signIn() {
        $input_password=$this->input->post('password');
        $email=$this->input->post('email');
        // $verification_code=$this->input->post('verification_code');

        $check_user = $this->db->query("SELECT * FROM users WHERE email = '$email'");
        if (count($check_user->result_array()) > 0) {
            foreach ($check_user->result_array() as $the_user) {
                $encrypted_pass = $the_user['password'];
                $password = $this->encryption->decrypt($encrypted_pass);
            }
        }

        if ($input_password === $password) {
            $this->load->view('frontend/login_success');
        }
        else {
            echo "<script>alert('Incorrect username or password!');</script>";
            $this->load->view('frontend/login');
        }
    }

    public function signUp()
	{

        $email=$this->input->post('email');
        $check_user = $this->db->query("SELECT * FROM users WHERE email = '$email'");
        if (count($check_user->result_array()) > 0) {
            echo "<script>alert('Email or username already taken! Try a different one.');</script>";
            $this->load->view('frontend/sign_up');
        } else {
            $raw_pass = $this->input->post('password');
        $encrypted_pass = $this->encryption->encrypt($raw_pass);

        $data['user_name']=$this->input->post('name');
        $data['email']=$this->input->post('email');
        $data['password']=$encrypted_pass;
        $data['phone_number']=$this->input->post('phone_number');
        $data['verification_code'] = rand(100, 999)."".date('md');

        // Beginning of Send SMS

        if ($this->db->insert('users', $data)) {
            $this->load->view('frontend/success'); // Load next page
            $phone_nb = $data['phone_number'];
            if (strlen($phone_nb) == 12) {
                $phone = $phone_nb;
            } elseif (strlen($phone_nb) == 10) {
                $phone = '25'.$phone_nb;
            } elseif (strlen($phone_nb) == 9) {
                $phone = '250'.$phone_nb;
            }
            $message = "Dear ".$data['user_name']."!"."\r\n"."Thank you for registering with YourFreelanceWeb. Please use the following code to verify your account: ".$data['verification_code']."\r\n"."\r\n"."Regards,"."\r\n"."YourFreelanceWeb team";
        
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.mista.io/sms",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array('action' => 'send-sms','to' => $phone,'from' => 'YourFreelanceWeb','sms' => $message,'unicode' => '1'),
                CURLOPT_HTTPHEADER => array(
                "x-api-key: dmlBPXZGRmRPYk1qc3B6cEZ2enQ="
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }    
            // Send SMS -- end

        // Sending email
        $from_email = "samwel@vonsung.co.rw";
        $to_email   = $this->input->post('email').",samomanyi97@gmail.com";
            
        $this->load->library('email');
        $this->load->helper('form');
    
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.vonsung.co.rw';
        $config['smtp_user'] = 'samwel@vonsung.co.rw';
        $config['smtp_pass'] = 'Facesambook#7991.';
        $config['smtp_port'] = 587;
            
        $config['smtp_timeout'] = 5;
        $config['wordwrap'] = true;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = false;
        $config['priority'] = 3;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;

        $this->email->initialize($config);
            
        $this->email->set_mailtype("html");
        $this->load->library('encryption');
            
        $this->email->from($from_email, 'YourFreelanceWeb');
        $this->email->to($to_email);
        $this->email->subject('Welcome to YourFreelanceWeb');
        
        $body = $this->load->view('frontend/email_body.php', $data, true);
        $this->email->message($body);
        
        
        $this->email->send();
        echo $this->email->print_debugger();

        // End of sending html email
        }
    }
    
}
