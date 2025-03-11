<?php

class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('user');
    }

//Fonction qui permet à l’usager de se connecter
    public function connexion() {
        $data = [
            'title' => 'page de connexion',
            'emailError' => ''
        ];

        function valid_data($data){
            $data = trim($data);/*enlève les espaces en début et fin de chaîne*/
            $data = stripslashes($data);/*enlève les slashs dans les textes*/
            $data = htmlspecialchars($data);/*enlève les balises html comme ""<>...*/
            return $data;
        }

        //validation des post
        if(isset($_POST['submit'])) {
            
                /*on récupère la valeur email du formulaire et on y applique
                 les filtres de la fonction valid_data*/
                $email = valid_data($_POST["email"]);
                $password = $_POST["password"];
 
                $loggedInUser = $this->userModel->connexion($email, $password);
               
                if ($loggedInUser == false ) {
                    $data['emailError']= 'Le mot de passe ou l\'email sont incorrects ou vous n\'êtes pas encore inscrit.' ;
                    $this->view('users/connexion', $data);              
                }else{
                    //ouvre une session si le user est bien dans la table user (email, pass)
                    $this->createUserSession($loggedInUser);
                } 

        } else {
            $data = ['emailError' => ''];
        $this->view('users/connexion', $data);
        }
    }

//Fonction qui enregistre un nouvel utilisateur
    public function inscription() {
        $data = [
            'firstname' => '',
            'lastname' =>'',
            'email'=> '',
            'emailError'=> '',
            'password' => '',
            'confirmPassword' => '',
            'confirmPasswordError' => '',
            'is_admin'=> '',
            'date_registre'=>''          
            ];


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscrire'])){

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, [
                'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'email' => FILTER_VALIDATE_EMAIL,
                'password' => FILTER_DEFAULT,
                'confirmPassword' => FILTER_DEFAULT
            ]);


            $data = [
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),            
                'email'=> trim($_POST['email']),
                'emailError'=>'',
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'confirmPasswordError' => '',
                'is_admin' =>'0',
                'date_registre'=> date('Y-m-d')
               
            ];

            $email=$_POST['email'];

            if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Les passwords ne correspondent pas.';
            }elseif($this->userModel->findUserByEmail($email)) {
                        $data['emailError'] = 'Cet email est déja utilisé.';
                }


            // error vide
            if (empty($data['confirmPasswordError']) && empty($data['emailError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //enregistre utilisateur
                if ($this->userModel->inscription($data)) {
                    //Redirect page connexion
                    header('location: ' . WWW_ROOT . 'users/connexion');
                } else {
                    die('Erreur systéme.');
                }
            }
        }

        $this->view('users/inscription', $data);
    }


    //Fonction qui permet à l’usager de modifier ses informations.
    public function profil() {
    

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])){

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, [
                'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'lastname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'email' => FILTER_VALIDATE_EMAIL,
                'password' => FILTER_DEFAULT,
                'confirmPassword' => FILTER_DEFAULT
            ]);

            $data = [
                'id_user' => $_SESSION['id_user'],
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),                
                'email'=> $_POST['email'],
                'emailError'=>'',
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'confirmPasswordError' => '',
                'date_registre' => $_POST['date_registre']  

            ];



            if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Les passwords ne correspondent pas.';
            }elseif
                ($_SESSION['email']!= $data['email'] && $this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Cet email est déja utilisé.';
            }
            // error vide
            if (empty($data['confirmPasswordError']) && empty($data['emailError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //enregistre utilisateur
                if ($this->userModel->profil($data)) {
                    //Redirect page connexion
                    header('location: ' . WWW_ROOT . 'users/logout');
                } else {
                    die('Erreur système.');
                }
            }else{
                $this->view('users/profil', $data);
            }  
        
        }else{
            
            $id = $_SESSION['id_user'];
            $user = $this->userModel->view($id);
            $data = [
            'user' => $user,
            'id_user'=> '',
            'firstname' => '',
            'lastname' =>'',            
            'email'=> '',
            'emailError'=> '',
            'password' => '',
            'confirmPassword' => '',
            'confirmPasswordError' => '',
            'date_registre' => '' 
            ] ;
            $this->view('users/profil', $data);
        }
    }

//Fonction qui crée une session 
    public function createUserSession($user) {
      
        $_SESSION['id_user'] = $user->id_user;
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['email'] = $user->email;

         if ($user->is_admin == 1){
           $_SESSION['is_admin'] = 1;
           header('location:' . WWW_ROOT . 'pages/index');
       }else{
            $_SESSION['is_admin'] = 0;
           //vérifie s’il n’existe pas déjà une commande avec statut en attente dans la table commande
           
           header('location:' . WWW_ROOT . 'pages/index');
       }        
        
    }

    public function logout() {
       
        unset($_SESSION['id_user']);
        unset($_SESSION['firstname']);
        unset($_SESSION['email']);
        unset($_SESSION['is_admin']);
       
        header('location:' . WWW_ROOT . 'users/connexion');
    }

         

}