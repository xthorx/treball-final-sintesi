<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->database();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        
    }

    // public function loginNO(){
        
    //     if(isset($this->session->user)){
    //         $data['loggedin'] = true;
    //         return redirect(base_url("?session=logged"));
    //     }
        
        
    //     $this->load->helper('form');
    //     $this->load->library('form_validation');

    //     $data['titleMain'] = 'Gestor de notícies';
    //     $data['title'] = 'Login';
    //     $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
    //     $data['missatge'] = '* Tots els camps son obligatoris';
        
    //     $this->form_validation->set_rules('user', 'usuari', 'required');
    //     $this->form_validation->set_rules('pass', 'contrasenya', 'required');


        
    //     if ($this->form_validation->run() === FALSE) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('login/login', $data);
    //         $this->load->view('templates/footer', $data);
    //     } else {
            
    //         $resultConsulta = $this->login_model->login_user();
            


    //         if(isset($resultConsulta['password'])){
                
    //             if(password_verify($this->input->post('pass'), $resultConsulta['password'])){

    //                 $data['missatge'] = 'Contrasenya correcta, sessió iniciada correctament!';
    //                 $this->session->set_userdata('user', $this->input->post('user'));
    //                 return redirect('login');

    //             }else{ $data['missatge'] = 'Contrasenya incorrecta. Torna a provar.'; }
    //         }
    //         else{
    //             $data['missatge'] = 'Inici de sessió erroni. Torna a provar.';
    //         }
                
                
                
    //         $data['login_info'] = $this->login_model->login_user();

            
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('login/login', $data);
    //         $this->load->view('templates/footer', $data);

            
    //     }
    // }


    public function login(){

        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            redirect(base_url());

        }else{
            $data['loggedin'] = false;
        }

        $data['titleMain'] = 'Gestor de notícies';
        $data['title'] = 'Login';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['missatge'] = '* Tots els camps son obligatoris';

        if($this->session->flashdata('message') != NULL){
            $data['messageion']= $this->session->flashdata('message');
        }else{
            $data['messageion']= "";
        }

        $this->form_validation->set_rules('user', 'usuari', 'required');
        $this->form_validation->set_rules('pass', 'contrasenya', 'required');

		if ($this->form_validation->run() === TRUE)
		{

			if ($this->ion_auth->login($this->input->post('user'), $this->input->post('pass')))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', "Has iniciat la sessió correctament.");
				return redirect(base_url());
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', "Error de inici de sessió. " . $this->ion_auth->errors());
				return redirect(base_url("login"));
			}
		}
		else
		{
			$this->load->view('templates/header', $data);
            $this->load->view('login/login', $data);
            $this->load->view('templates/footer', $data);
		}

    }



    public function register(){
        
        if($this->ion_auth->logged_in()){
            $data['loggedin'] = true;
            redirect(base_url());

        }else{
            $data['loggedin'] = false;
        }
        
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['titleMain'] = 'Gestor de notícies';
        $data['title'] = 'Register';
        $data['autor'] = '&copy;2021. Artur Boladeres Fabregat';
        $data['missatge'] = '* Tots els camps son obligatoris';
        
        $this->form_validation->set_rules('user', 'usuari', 'required');
        $this->form_validation->set_rules('pass1', 'contrasenya', 'required');
        $this->form_validation->set_rules('pass2', 'repetir contrasenya', 'required');
        $this->form_validation->set_rules('email', 'correu', 'required');
        $this->form_validation->set_rules('email', 'nom', 'required');
        $this->form_validation->set_rules('email', 'cognoms', 'required');
        $this->form_validation->set_rules('email', 'telf', 'required');


       


        if ($this->form_validation->run() === TRUE){

            $nom = $this->input->post('nom');
            $cognoms = $this->input->post('cognoms');
            $telf = $this->input->post('telf');

            $username = strtolower($this->input->post('user'));
            $password = $this->input->post('pass1');
            $email = strtolower($this->input->post('email'));

            $additional_data = array(
                'first_name' => $nom,
                'last_name' => $cognoms,
                'phone' => $telf
            );
        
            

            if($this->input->post('pass1')==$this->input->post('pass2')){

                if($this->ion_auth->register($username, $password, $email, $additional_data, array('2'))){
                    if ($this->ion_auth->login($username, $password)){
                        //if the login is successful
                        //redirect them back to the home page
                        $this->session->set_flashdata('message', "Registre finalitzat correctament.");
                        return redirect(base_url());
                    }
                }else{
                    $this->session->set_flashdata('message', 'Error de registre.');
                    return redirect(base_url());
                }

            }else{
                $this->session->set_flashdata('errorformulari', "contrasenyes_no_iguals");
                return redirect(base_url("register"));

            }

            


			
		}else{
            $this->load->view('templates/header', $data);
            $this->load->view('login/register', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function tancar_sessio(){

		// log the user out
		$this->ion_auth->logout();

		// redirect them to the login page
		redirect(base_url("login"));

    }
    
    


}

/* End of file Login_controller.php */