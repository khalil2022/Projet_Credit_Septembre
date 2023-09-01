<?php
require_once '../../controllers/formationC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp = $_POST['transfer'];
   
    $formationController = new FormationController();
    $formations=$formationController->searchFormations($temp);
    
}

?>

<table class="table table-hover"  id="show">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Type</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($formations as $formation): ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $formation['title'] ?></strong></td>
                        <td><?= $formation['description'] ?></td>
                        <td><?= $formation['startDate'] ?></td>
                        <td><?= $formation['endDate'] ?></td>
                        <td><span class="badge rounded-pill bg-label-primary"><?= $formation['name'] ?></span></td>
                       
              
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="update_formation.php?id=<?= $formation['id'] ?>"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="delete_formation_request.php?id=<?= $formation['id'] ?>" onclick="return confirm('Are you sure you want to delete this formation?')"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>