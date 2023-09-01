<?php
require_once '../../controllers/userC.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $temp = $_POST['transfer'];
   
    $userController = new UserController();
    $users=$userController->searchUsers($temp);
    
}

?>
 <table class="table table-hover" id="show">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Date join</th>
                        <th>Role</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($users as $user): ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $user['username'] ?></strong></td>
                        <td><?= $user['date_join'] ?></td>
                        <td><span class="badge <?php echo ($user['role'] === 'admin') ? 'bg-label-danger' : (($user['role'] === 'teacher') ? 'bg-label-warning' : 'bg-label-info'); ?> me-1"><?= $user['role'] ?></span></td>
                        
              
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              
                              <a class="dropdown-item" href="delete_account_request.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this account?')"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>