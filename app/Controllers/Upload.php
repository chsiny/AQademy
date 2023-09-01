<?php
namespace App\Controllers;
class Upload extends BaseController
{
	public function index() {
        $data['errors'] = "";
        echo view('template/header');
        echo view('upload_form', $data);
        echo view('template/footer');
    }

    public function upload_file() {
        $data['errors'] = "";
        $title = $this->request->getPost('title');
        $file = $this->request->getFile('userfile');
        $file->move(WRITEPATH . 'uploads');
        $filename = $file->getName();
        $model = model('App\Models\Upload_model');
        $check = $model->upload($title, $filename);
        if ($check) {
            echo view('template/header');
            echo "upload_success!";
            echo view('template/footer');
        } else {
            $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Upload failed!! </div> ";
            echo view('template/header');
            echo view('upload_form', $data);
            echo view('template/footer');
        }
        
    }

    // public function profile_picture() {

    //     $data['errors'] = "";
    //     $profile_picture = $this->request->getFile('profile_picture');

    //     $session = session();
    //     $title = $session->get('username');
    //     $filename = $title . '_' . time() . '.jpg';
    //     $profile_picture->move(WRITEPATH . 'uploads', $filename);

    //     $model = model('App\Models\Upload_model');
    //     $check = $model->upload($title, $filename);
        
    //     if ($check) {
    //         $model = model('App\Models\User_model');
    //         $model->update_profile_picture($title, $filename);
    //         return redirect()->to(base_url('/user'));
    //     } else {
    //         $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Upload failed!! </div> ";
    //         echo view('template/header');
    //         echo view('upload_form', $data);
    //         echo view('template/footer');
    //     }
        
    // }
    public function profile_picture()
    {
        $rules = [
            'profile_picture' => [
                'uploaded[profile_picture]',
                'max_size[profile_picture,1024]',
                'mime_in[profile_picture,image/png,image/jpg,image/jpeg]',
            ],
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        
        if ($this->validate($rules)) {
            $profile_picture = $this->request->getFile('profile_picture');
            $session = session();
            $title = $session->get('username');
            $filename = $title . '_' . time() . '.jpg';
            $profile_picture->move(WRITEPATH . 'uploads', $filename);

            $model = model('App\Models\Upload_model');
            $check = $model->upload($title, $filename);
        
            if ($check) {
                $model = model('App\Models\User_model');
                $model->update_profile_picture($title, $filename);
                return redirect()->to(base_url('/user'));
            } else {
                $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Upload failed!! </div> ";
                echo view('template/header');
                echo view('upload_form', $data);
                echo view('template/footer');
            }
        } else {
            return redirect()->to(base_url('/user'))->withInput()->with('validation', $this->validator);
            // $data['validation'] = $this->validator;
            // return view('upload_form', $data);
        }
    }
}
