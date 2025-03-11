  <footer>
                <div class="container pt-1">
                <div class="col-md-12 mt-2">
                    
                                                 
                                       
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                 
                        <ul class="navbar-nav ml-5 ">
                            <li class="nav-item ml-5">
                            <h4 class="gold ml-5">NOUS SUIVRE:</h4>   
                            </li>                        
                            <li class="nav-item">
                            <i class="fab fa-facebook-square fa-lg"></i>
                            </li>
                            <li class="nav-item">
                            <i class="fab fa-twitter fa-lg"></i>
                            </li>                                   
                        </ul>
                        </nav>
                  
                </div> 
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                                <h5 class="ml-3" >INFORMATIONS</h5>
                               
                            </div>
                            <div class="col-md-4">
                                <h5 class="ml-3" >MON COMPTE</h5>
                                <ul class="list-group list-group-flush">                                 
                                    
                                    <li class="list-group-item"><a class="nav-link" href="<?php if(isset($_SESSION['id_user'])){echo WWW_ROOT.'users/profil';} ?>">Mes informations</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 border-left">
                        
                        <h5>INFORMATIONS SUR PANAMAHATS.COM</h5>
                        <p>panamahats.com , 42 avenue des Champs Elysées 75000 Paris France</p>
                        <br />
                        <h5>APPELEZ-NOUS AU :</h5>
                        <h2 class="gold">0123-456-789</h2>
                        <br />
                        <p>Email: panamahats@panamahats.com</p>
                        <br />
                        <p>Copyrights 2021, panamahats.com</p>
                    
                    </div>       
                </div>
                
            </footer>
        </div>
  <!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>