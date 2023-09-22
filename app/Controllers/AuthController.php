<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthM;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }


    public function login()
    {
        if ($this->request->getVar('submit')) {
            $session = session();
            $authModel = new AuthM();
            // Validation
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $data = $authModel->password_verify($email, $password);

                if ($data == 'wrong') {
                    $session->setFlashdata('msg', 'Wrong Input');
                    return redirect()->to('/login');
                } else {
                    echo 'here';
                    $ses_data = [
                        'id'           => $data[0]->id,
                        'password'     => $data[0]->password,
                        'email'        => $data[0]->email,
                        'logged_in'    => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to(base_url('admin/dashboard'));
                }
            } else {
                $data['validation'] = $this->validator->getErrors();
                // echo '<pre>';
                // print_r($data);
                // die;
                return view('authentication/signin', $data);
            }
        } else {
            return view('authentication/signin');
        }
    }
}
