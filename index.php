<?php
    $index = true;
    include_once './header.php';
    require('./Database/docteur_db.php');


    
    
    if (isset($_GET['envoyer'])) {
        $service_name = $_GET['nom_service'];

        if (!empty($_GET['nom_service'])) {
            $service = Recherche($service_name);
        } else {
            $errorMessage = "Veuillez saisir un service valide !";
        }
    }


 
?>


<main class="flex-shrink-0">
    <div class="container">
        <h1 class="mt-5">Dalal Ak Diam</h1>

        <?php
        if (isset($errorMessage)) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $errorMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <form class="d-flex" role="search">
            <input class="form-control me-2" name="nom_service" type="search" placeholder="Rechercher un service" aria-label="Search">
            <button class="btn btn-success" name="envoyer" type="submit">Rechercher</button>
            
        </form>
       

        <br><br>
        
        <?php if (isset($service)): ?>
           
            <div class="row">
                <?php while ($docteur = $service->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $docteur['nom'] ?> <?= $docteur['prenom'] ?></h5>
                                <p class="card-text">Service: <?= $docteur['service_libelle'] ?></p>
                                
                              
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $docteur['id'] ?>">
                                    Voir Détails
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $docteur['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Détails du Docteur</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nom: <?= $docteur['nom'] ?></p>
                                                <p>Prénom: <?= $docteur['prenom'] ?></p>
                                                <p>Tél: <?= $docteur['tel'] ?></p>
                                                <p>Email: <?= $docteur['email'] ?></p>
                                                <p>Adresse: <?= $docteur['adresse'] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
    include_once './footer.php';
?>
