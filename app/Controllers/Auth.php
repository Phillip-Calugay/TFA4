<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/customers');
        }

        if ($this->request->getMethod() === 'POST') {
            $username = trim((string) $this->request->getPost('username'));
            $password = (string) $this->request->getPost('password');
            $user = (new UserModel())->where('username', $username)->first();

            if ($user !== null && password_verify($password, $user['password'])) {
                session()->regenerate(true);
                session()->set([
                    'isLoggedIn' => true,
                    'userId' => $user['id'],
                    'username' => $user['username'],
                    'fullName' => $user['full_name'],
                ]);

                return redirect()->to('/customers')->with('message', 'Welcome back, ' . $user['full_name'] . '.');
            }

            return view('auth/login', [
                'title' => 'Staff Login',
                'error' => 'The username or password is incorrect.',
            ]);
        }

        return view('auth/login', ['title' => 'Staff Login', 'error' => null]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('message', 'You have been logged out.');
    }
}
