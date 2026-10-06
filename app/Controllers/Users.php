<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $userModel->orderBy('username', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|alpha_numeric_punct|max_length[50]|is_unique[users.username]',
                'full_name' => 'required|max_length[100]',
                'password' => 'required|min_length[8]|max_length[255]',
            ];

            if ($this->validate($rules)) {
                (new UserModel())->insert([
                    'username' => trim((string) $this->request->getPost('username')),
                    'full_name' => trim((string) $this->request->getPost('full_name')),
                    'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                return redirect()->to('/users')->with('message', 'User created successfully.');
            }
        }

        return view('users/form', ['title' => 'New User', 'user' => null]);
    }

    public function edit(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => "required|alpha_numeric_punct|max_length[50]|is_unique[users.username,id,{$id}]",
                'full_name' => 'required|max_length[100]',
                'password' => 'permit_empty|min_length[8]|max_length[255]',
                'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
            ];

            if ($this->validate($rules)) {
                $update = [
                    'username' => trim((string) $this->request->getPost('username')),
                    'full_name' => trim((string) $this->request->getPost('full_name')),
                ];
                $password = (string) $this->request->getPost('password');
                if ($password !== '') {
                    $update['password'] = password_hash($password, PASSWORD_DEFAULT);
                }
                $avatar = $this->request->getFile('avatar');

                if ($avatar !== null && $avatar->isValid() && ! $avatar->hasMoved()) {
                    $uploadPath = FCPATH . 'uploads';
                    if (! is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $filename = $avatar->getRandomName();
                    service('image')->withFile($avatar->getTempName())
                        ->fit(300, 300, 'center')
                        ->save($uploadPath . DIRECTORY_SEPARATOR . $filename);
                    $update['avatar'] = $filename;
                }

                $model->update($id, $update);

                return redirect()->to('/users')->with('message', 'User updated successfully.');
            }
        }

        return view('users/form', ['title' => 'Edit User', 'user' => $user]);
    }
}
