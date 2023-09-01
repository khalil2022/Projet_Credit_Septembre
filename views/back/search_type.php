<?php
require_once '../../controllers/typeC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp = $_POST['transfer'];
   
    $typeController = new TypeController();
    $types=$typeController->searchTypes($temp);
    
}

?>
     <table class="table table-hover" id="show">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                     
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($types as $type): ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $type['id'] ?></strong></td>
                        <td><?= $type['name'] ?></td>
                       
              
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="update_type.php?id=<?= $type['id'] ?>"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="delete_type_request.php?id=<?= $type['id'] ?>" onclick="return confirm('Are you sure you want to delete this type?')"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>