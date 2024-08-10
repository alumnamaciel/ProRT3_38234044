<?php
namespace App\Controller;
use CodeIgnite\Controller;
use App\Models\usuario_Model;

class login_controller extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        $dato['titulo']= 'login';
        echo view('front/head',$dato);
        echo view('front/nav');
        echo view('back/usuario/login');
        echo view('front/footer');
    }
    public fuction auth ()
    {
        $session = session();
        $model = new usurio_Model();
        $email = $this->reques->getVar('email');
        $password = $this->resquet->getVar('pass');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['pass'];
            $ba= $date['baja'];
            if ($ba == 'SI'){
                $session->setFlashdata('msg', 'usuario dado de baja');
                retur redirect()->to('/login_controller');
            }

            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                   'nombre' => $data['nombre'],
                    'apellido'=> $data['apellido'],
                    'email'=> $data['email'],
                   'usuario' => $data['usuario'],
                   'perfil_id' => $data['perfil_id'],
                    'logged_in'=> TRUE
                ];
                /* Si verifica el inicio de sesion*/
                $session->($ses_data);
                session()setFlashdata('msg', 'Bienvenido!!');
                return redirect()->to('/panel');
            }else{
                /* Si no verifica la contraseña*/
                $session->($ses_data);
                session()setFlashdata('msg', 'Contraseña incorrecta');
                return redirect()->to('/Login_controller');
            }
            }else{
                session()setFlashdata('msgn', 'No existe el correo o es incorrecto');
                return redirect()->to('/Login_controller');
            }
        }
            public fuction logut()
            {
                $session = session();
                $session->destroy();
                return redirect()->to('/');
            }
        
}