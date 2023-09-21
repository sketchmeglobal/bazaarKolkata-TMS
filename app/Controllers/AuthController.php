<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserM;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function login()
    {
        return view('authentication/signin');
    }

    public function do_login()
    {
        //return view('authentication/signin');
        $session = session();
        $userModel = new UserM();
        $validation = \Config\Services::validation();      

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $validation->setRules([
            'email' => 'required',
            'password' => 'required|min_length[8]'
        ]);
        
        $data = [
            'email' => $email,
            'password'   => $password,
        ];
        
        if ($validation->run($data)) {
            $validatedData = $validation->getValidated();
            //print_r($validatedData);
            $user = $userModel->where('email', $email)->check_user();
            print_r($user);
            if (is_null($user)) {
                return redirect()->back()->withInput()->with('error', 'Invalid username.');
            }

            die();
            
        } 
        

        

        

        /*$pwd_verify = password_verify($password, $user['password']);

        if (!$pwd_verify) {
            return redirect()->back()->withInput()->with('error', 'Invalid password.');
        }

        $ses_data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'isLoggedIn' => TRUE
        ];

        $session->set($ses_data);
        return redirect()->to('dashboard/index');*/
    }

    public function auth()
    {
        //return view('authentication/signin');
        $session = session();
        $userModel = new UserM();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if (is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $pwd_verify = password_verify($password, $user['password']);

        if (!$pwd_verify) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $ses_data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'isLoggedIn' => TRUE
        ];

        $session->set($ses_data);
        return redirect()->to('dashboard/index');
    }
}
