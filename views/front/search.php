<?php
require_once '../../controllers/formationC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
   
    $formationController = new FormationController();
    $formations=$formationController->getFormationsByTitle($title);
    
}

?>


     
      <div class="container" id="formations">
        
        <div class="row intro-tables" id="show">
          
        <?php foreach ($formations as $formation): ?>
          <div class="col-md-4">
            <div class="intro-table intro-table-hover">
              <h5 class="white heading hide-hover"><?= $formation['title'] ?></h5>
              <div class="bottom">
                <h4 class="white heading small-heading no-margin regular">
                <?= $formation['description'] ?>
                </h4>
                <h4 class="white heading small-heading no-margin regular">
                <?= $formation['startDate'] ?> - <?= $formation['endDate'] ?>
                </h4>
                <h4 class="white heading small-pt">Type: <?= $formation['name'] ?></h4>
                <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($formationsController->isParticipating($_SESSION['user_id'],$formation['id'])) : ?>
                <a href="participate_request.php?formation_id=<?=$formation['id'] ?>&action=unparticipe" class="btn btn-red-fill expand" >Left</a>
                <?php else : ?>
                <a href="participate_request.php?formation_id=<?=$formation['id'] ?>&action=participe" class="btn btn-white-fill expand">Join</a>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($formationsController->isFavoris($_SESSION['user_id'],$formation['id'])) : ?>
                <a href="favoris_request.php?formation_id=<?=$formation['id'] ?>&action=unfavoris" class="btn  expand" style="color:red" ><i class="fa fa-heart"></i></a></a>
                <?php else : ?>
                <a href="favoris_request.php?formation_id=<?=$formation['id'] ?>&action=favoris" class="btn  expand"><i class="fa fa-heart"></i></a></a>
                <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
  