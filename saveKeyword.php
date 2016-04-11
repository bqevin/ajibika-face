<?php

//Error display set to 1 for debugging. NB:  Remember to disable
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'core/init.php';

//var_dump(Token::check(Input::get('token')));

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        //echo "I have been run <br>";
        //echo Input::get('username');
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            //NB:Fiels matches field names in DB
            'hateword' => array(
                'required' => true,
                'min' => 3,
                'max' => 20,
                //table name to check if value already exists
                'unique' => 'users'
                ),
            'meaning' => array(
                'required' => true,
                'min' => 6
                ),
            'degree' => array(
                'required' => true,
                'min' => 2
                )
            ));
        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);// Db is 32 length
            // die();
            try{
                //DB names
                $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'group' => 1
                    ));
                Session::flash('home', 'You have been registered and can now log in');
               Redirect::to('index');
            }catch(Exception $e){
                die($e->getMessage());
                //Alternative is rediect user to a failure page
            }
            //echo "Passed!";
            // Session::flash('success', 'You  have registered succefully!');

        }else{
            //State Errors
            foreach($validation->errors() as $error){
                echo $error, '<br>';
                //echo Input::get('username');
            };
        }
    }
}
?>