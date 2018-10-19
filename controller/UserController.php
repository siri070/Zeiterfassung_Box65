<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function login(){

        if ($_POST['send']){
            $benutzername = $_POST['benutzername'];
            $passwort = $_POST['passwort'];

            $statement = $pdo->prepare("SELECT * FROM mitarbeiter WHERE benutzername = benutzername");
            $result = $statement->execute(array('benutzername' => $benutzername));
            $mitarbeiter = $statement->fetch();

            if ($mitarbeiter !== false && password_verify($passwort, $mitarbeiter['passwort'])) {
                $_SESSION['mid'] = $mitarbeiter['id'];
                die('Ihre Arbgeitszeit hat gerade begonnen.');
            } else {
                $errorMessage = "Benutzername oder Passwort war ungültig<br>";
            }

        }
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            // $password  = $_POST['password'];
            $password = 'no_password';

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
