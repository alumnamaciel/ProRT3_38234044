<?php
namespace App\Controllers;
use App\usuario_Model;
use CodeIgniter\Controller;

class usuario_controller extends Controller
{
    public function _construct(){
        helper(['form', 'url']);
    }
    public function create () {
        $dato['titulo']= 'registro';
        echo view('front/head',$dato);
        echo view('front/navbar');
        echo view('back/usuario/registro');
        echo view('front/footer');
    }
    public function formValidation() {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario' => 'required|min_length[3]'
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuario.email]',
            'pass' => 'required|min_length[3]|max_length[10]',
        ],
    );
    $formModel = new usuario_Model ();
    if (!$input) {
        $data['titulo']= 'registro';
        echo view('front/head',$data);
        echo view('front/nav');
        echo view('back/usuario/registro'['validation' => $this->validaton]);
        echo view('front/footer');
    }
    else {
        $formModel->save([
            'nombre' => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'usuario' => $this->request->getVar('usuario'),
            'email' => $this->request->getVar('email'),
            'pass' => password_hash ($this->request->getVar('pass'), PASSWORD_DEFAULT)
        ]),
        session()->setFlasdata('success', 'Usuario registrado con exito');
        return $this->response->redirect('/login');
    }
    }
}