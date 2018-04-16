<?php

    session_start();

    $prenom     = $_POST['prenom'];
    $nom        = $_POST['nom'];
    $email      = $_POST['email'];
    $mdp        = $_POST['mdp1'];
    $mdpConfirm = $_POST['mdp2'];

    function userExist($mail)
    {
        $result = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findOneBy([
                'mail' => $mail,
            ]);

        return $result;
    }

    if(!userExist($email))
    {
        $entityManager = $this->getDoctrine()->getmanager();

        $user = new User();
        //TODO param the new user
        $entityManager->persist($user);
        $entityManager->flush();

        header('Location:');
    }
    else
    {
        $_SESSION['pseudoAlreadyTaken'] = 1;
        //TODO
        header('Location:');
    }

?>