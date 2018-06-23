<?php
/*
 *
        Validation routines used to automatically verify user input ( required fields, input length and type)
 *
*/

/*
 * Rules examples: required|min_length[8]|max_length[8]|exact_length[8]|
 * alpha|alpha_numeric|valid_email|matches[password_field]|valid_ip[ipv4]
 */
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

$config = array(
  'add_department_form' => array(
    array(
      'field' => 'name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'edit_department_form' => array(
    array(
      'field' => 'name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[1]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'add_observation_record_form' => array(
    array(
      'field' => 'date_open',
      'label' => 'Data Deschidere Fisa',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    )
  ),
  'edit_observation_record_form' => array(
    array(
      'field' => 'date_open',
      'label' => 'Data Deschidere Fisa',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    )
  ),
  'add_patient_form' => array(
    array(
      'field' => 'first_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'last_name',
      'label' => 'Prenume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'phone',
      'label' => 'Telefon',
      'rules' => 'max_length[15]|min_length[10]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'cnp',
      'label' => 'CNP',
      'rules' => 'required|max_length[30]|min_length[12]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'edit_patient_form' => array(
    array(
      'field' => 'first_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'last_name',
      'label' => 'Prenume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'phone',
      'label' => 'Telefon',
      'rules' => 'max_length[15]|min_length[10]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'cnp',
      'label' => 'CNP',
      'rules' => 'required|max_length[30]|min_length[12]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'add_salon_form' => array(
    array(
      'field' => 'name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'department_id',
      'label' => 'Sectie',
      'rules' => 'required|max_length[30]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'capacity',
      'label' => 'Capacitate',
      'rules' => 'required|max_length[10]|min_length[1]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'edit_salon_form' => array(
    array(
      'field' => 'name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'department_id',
      'label' => 'Sectie',
      'rules' => 'required|max_length[30]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'capacity',
      'label' => 'Capacitate',
      'rules' => 'required|max_length[10]|min_length[1]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'add_role_form' => array(
    array(
      'field' => 'role_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[2]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'edit_role_form' => array(
    array(
      'field' => 'role_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[1]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    )
  ),
  'add_user_form' => array(
    array(
      'field' => 'username',
      'label' => 'Username',
      'rules' => 'required|max_length[20]|min_length[3]|my_alpha_numeric_username',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_username' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'password',
      'label' => 'Parola',
      'rules' => 'required|max_length[20]|min_length[8]',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
    array(
      'field' => 'confirm_password',
      'label' => 'Confirma Parola',
      'rules' => 'required|max_length[20]|min_length[8]|matches[password]',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
    array(
      'field' => 'first_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'last_name',
      'label' => 'Prenume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'phone',
      'label' => 'Telefon',
      'rules' => 'required|max_length[20]|min_length[6]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|max_length[30]|min_length[5]|valid_email',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
  ),
  'edit_user_form' => array(
    array(
      'field' => 'username',
      'label' => 'Username',
      'rules' => 'required|max_length[20]|min_length[3]|my_alpha_numeric_username',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_username' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'first_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'last_name',
      'label' => 'Prenume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'phone',
      'label' => 'Telefon',
      'rules' => 'required|max_length[20]|min_length[6]|numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|max_length[30]|min_length[5]|valid_email',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
  ),
  'account_settings_form' => array(
    array(
      'field' => 'city',
      'label' => 'Oras',
      'rules' => 'max_length[40]|my_alpha_numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'first_name',
      'label' => 'Nume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'last_name',
      'label' => 'Prenume',
      'rules' => 'required|max_length[30]|min_length[3]|my_alpha_numeric_light',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_light' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'country',
      'label' => 'Tara',
      'rules' => 'max_length[40]|my_alpha_numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'required|max_length[30]|min_length[5]|valid_email',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
    array(
      'field' => 'address',
      'label' => 'Adresa',
      'rules' => 'max_length[250]|my_alpha_numeric',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric' => 'Caractere invalide in campul %s.'
      )
    ),
  ),
  'security_settings_form' => array(
    array(
      'field' => 'username',
      'label' => 'Username',
      'rules' => 'required|max_length[20]|min_length[3]|my_alpha_numeric_username',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.',
        'my_alpha_numeric_username' => 'Caractere invalide in campul %s.'
      )
    ),
    array(
      'field' => 'old_password',
      'label' => 'Parola',
      'rules' => 'required|max_length[20]',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
    array(
      'field' => 'new_password',
      'label' => 'Parola Noua',
      'rules' => 'required|max_length[20]|min_length[8]',
      'errors' => array(
        'required' => 'Trebuie sa completati campul %s.'
      )
    ),
  ),
);
