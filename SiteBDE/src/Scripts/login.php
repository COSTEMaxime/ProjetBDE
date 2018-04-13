<?php

    session_start();

    $mail   = $_POST['login'];
    $mdp    = $_POST['password'];

    //TODO
    function isLoginCorrect($mail, $mdp)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->findOneBy([
                'mail' => $mail,
                'password' => $mdp
            ]);
        return $result;
    }

    if(isLoginCorrect($mail, $mdp))
    {
        //TODO redirect and log the user
        header('Location:');
    }
    else
    {
        $_SESSION['wrongLogin'] = 1;
         //TODO error message
        header('Location:');
    }
?>