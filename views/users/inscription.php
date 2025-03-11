<?php
   require (ROOT.'views/includes/head.php');
?>
 <body>

    <div class="container-fluid">
        
        <div class="col-md-12">
            <?php
            require (ROOT.'views/includes/navigation.php');
            ?>
        </div>
        
        
        <div class="col-md-12 mt-5">
            <div class="row banner banner_image1  pt-3">                         
                                
                <h2 id="cache" class="mt-5 pt-5 gold">Agri-Cult<br /><small class="text-muted">jeu d'agriculture</small></h2>                              
            </div>
        </div>                                       
                      
                           
            </div>
        </div>
        
       
        <div class="row">
            <div class="col-sm-12 col-md-3 my-5 text-center">
                <div class="row">
                    <aside class="col-md-12">
                        <?php
                        require (ROOT.'views/includes/aside.php');
                        ?>  
                    </aside>             
                    
                </div>
            </div>
            <section class="col-sm-12 col-md-9 my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="<?php echo WWW_ROOT;?>users/inscription" method="post">
                            <fieldset>
                            <legend>INSCRIPTION</legend>                            
                          

                            <div class="form-group mt-3">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="firstname" required>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="email">Adresse email </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <?php echo '<p class="invalidFeedback">'.$data['emailError'].'</p>'; ?>
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirmer Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>
                            <?php echo '<p class="invalidFeedback">'.$data['confirmPasswordError'].'</p>'; ?>
                            
                            
                            <input type="submit" class="btn btn-primary" name="inscrire" value="S'inscrire">
                            </fieldset>
                            </form>
                        </div> 
                                      
                        <div class="col-md-6 text-center">
                            <img class="img-fluid w-75 mt-5" src="" alt="tissage">    
                        </div> 
                    </div>  


               
                </div>
            </section>
        </div>


        <?php
        require ROOT . '/views/includes/footer.php';
        ?>
