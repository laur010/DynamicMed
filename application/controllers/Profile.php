<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    $user_id = $this->session->userdata('user')['user_id'];
    $data['user'] = $this->users_model->get_where_single_array(array('user_id' => $user_id));
    $data['active_image'] = $this->profile_images_model->get_where_single_array(array('profile_image_id' => $data['user']['profile_image_id']));
    $data['profile_images'] = $this->profile_images_model->get_where(array('user_id' => $user_id));
    $data['user_notifications'] = $this->notifications_model->get_where(array('user_id' => $user_id));
    write_view('profile__index','profile/profile_view', $data);

  }

  public function process_request() {

    $operation = $this->input->post('operation');

    switch ($operation) {
      case 'account_settings':
        $this->_do_account_settings();
        break;
      case 'security_settings':
        $this->_do_security_settings();
        break;
      case 'add_profile_img':
        $this->add_profile_img();
        break;
      case 'change_profile_picture':
        $this->change_profile_picture();
        break;
      case 'delete_profile_picture':
        $this->delete_profile_picture();
        break;
      case 'other':
        break;
      default:
        break;
    }
  }

  function change_profile_picture(){

    $image_id = $this->input->post('image_id');
    $user_id = $this->session->userdata('user')['user_id'];
    $data = array(
      'profile_image_id' => $image_id
    );

    $this->users_model->update($user_id, $data);

    echo json_encode(array('code'=>'1','msg'=>'Profile image changed successful.'));
    return;

  }
  function delete_profile_picture(){

    $image_id = $this->input->post('image_id');
    $image = $this->profile_images_model->get_where_single_array(array('profile_image_id' => $image_id));
    $this->profile_images_model->delete($image_id);
    unlink(__DIR__.'/../../upload/profile_images/'. $image['name']);

    echo json_encode(array('code'=>'1','msg'=>'Profile image deleted successful.'));
    return;

  }

  function add_profile_img(){


    $data = array(
      'user_id' => $this->session->userdata('user')['user_id'],
      'name' => $_FILES["file"]['name'],
      'path' => __DIR__.'/../../upload/profile_images/'
    );
    $this->profile_images_model->insert($data);
    move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'/../../upload/profile_images/'. $_FILES["file"]['name']);
    redirect('profile');

  }

  function _do_account_settings() {

    $user_id = $this->input->post('user_id');

    if ($this->form_validation->run('account_settings_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $city = $this->input->post('city');
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $country = $this->input->post('country');
    $address = $this->input->post('address');
    $email = $this->input->post('email');

    $user_data = array(
      'city' => $city,
      'first_name' => $first_name,
      'last_name' => $last_name,
      'country' => $country,
      'address' => $address,
      'email' => $email
    );

    $this->users_model->update($user_id, $user_data);

    set_action('profile_edit', $user_data);
    echo json_encode(array('code'=>'1','msg'=>'Successful account settings changes.'));
    return;

  }

  function _do_security_settings() {

    $user_id = $this->input->post('user_id');

    if ($this->form_validation->run('security_settings_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $username = $this->input->post('username');
    $old_password = $this->input->post('old_password');
    $new_password = $this->input->post('new_password');

    if ($old_password == $new_password) {
      echo json_encode(array('code'=>'0','msg'=>'You have to chose a different new password.'));
      return;
    }

    if (!$this->users_model->check_user_existence($username)) {
      echo json_encode(array('code'=>'0','msg'=>'Username or password wrong.'));
      redirect('account/logout');
      return;
    }

    if (md5($old_password) != $this->session->userdata('user')['password']) {
      echo json_encode(array('code'=>'0','msg'=>'Username or password wrong.'));
      return;
    }


    $user_data = array(
      'username' => $username,
      'password' => md5($new_password),
    );

    $this->users_model->update($user_id, $user_data);
    $this->session->set_userdata('password', md5($new_password));

    set_action('profile_edit', $user_data);
    echo json_encode(array('code'=>'1','msg'=>'User '.$username.' was edited successful.'));
    return;

  }
}
