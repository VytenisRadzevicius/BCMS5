<? if(!$user->isLoggedIn() || !$user->hasPrivilege('1')) redirect(); ?>
<div class="accordion accordion-flush" id="accordion">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button<? if($b != 'pages') echo ' collapsed'; ?> btn-warning fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Pages
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse<? if($b == 'pages') echo ' show'; ?>" aria-labelledby="flush-headingOne" data-parent="#accordion">
      <div class="accordion-body p-0">
        <table class="table table-sm table-dark table-striped table-hover m-0">
          <thead>
            <tr>
              <th scope="col"><? if($user->hasPrivilege('4')) { echo '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-page-modal">&plus; Add Page</button>'; } ?></th>
              <th scope="col">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Access</th>
              <th scope="col">Posted</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?
            $pages = $page->getPage();
            $access = ['Everyone', 'Users', 'Privileged'];
                    foreach ($pages as $pg) {
                        echo '<tr>
                                <td>#' . $pg['page_id'] . '</td>
                                <td>' . $pg['title'] . '</td>
                                <td>' . $user->getUser($pg['author'])[0]['username'] . '</td>
                                <td>' . $access[$pg['access']] . '</td>
                                <td>' . $pg['timestamp'] . '</td>
                                <td>';
                                if($user->hasPrivilege('5')) { echo '<a href="#" class="p-1" data-id="' . $pg['page_id'] . '" data-delete="Page" data-toggle="tooltip" title="Delete">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                  </a>'; }
                               echo '</td>
                              </tr>';
                    }
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button<? if($b != 'users') echo ' collapsed'; ?> btn-warning fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        Users
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse<? if($b == 'users') echo ' show'; ?>" aria-labelledby="flush-headingTwo" data-parent="#accordion">
      <div class="accordion-body p-0">
        <table class="table table-sm table-dark table-striped table-hover m-0">
          <thead>
            <tr>
              <th scope="col"><? if($user->hasPrivilege('2')) { echo '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#register-modal">&plus; Add User</button>'; } ?></th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Joined</th>
              <th scope="col">Last Login</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <? $users = $user->getUser();
                    foreach ($users as $usr) {
                        echo '<tr>
                                <td>#' . $usr['user_id'] . '</td>
                                <td>' . $usr['username'] . '</td>
                                <td>' . $usr['email'] . '</td>
                                <td data-toggle="tooltip" title="' . $role->getRole($usr['role'])[0]['description'] . '">' . $role->getRole($usr['role'])[0]['name'] . '</td>
                                <td>' . $usr['joined'] . '</td>
                                <td>' . $usr['login'] . '</td>';
                                if($role->getRole($usr['role'])[0]['role_id'] != '1') {
                                  echo '<td>';
                                  if($user->hasPrivilege('8')) { echo '<a data-toggle="modal" data-target="#change-role-modal" class="p-1 text-decoration-none" data-selected="' . $usr['user_id'] . '">
                                  <svg data-change="Role" data-toggle="tooltip" title="Change Role" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-badge text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 0 1 4.5 0h7A2.5 2.5 0 0 1 14 2.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2.5zM4.5 1A1.5 1.5 0 0 0 3 2.5v10.795a4.2 4.2 0 0 1 .776-.492C4.608 12.387 5.937 12 8 12s3.392.387 4.224.803a4.2 4.2 0 0 1 .776.492V2.5A1.5 1.5 0 0 0 11.5 1h-7z"/>
                                    <path fill-rule="evenodd" d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM6 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5z"/>
                                  </svg>
                                  </a>'; }
                                  if($user->hasPrivilege('3')) { echo '<a data-toggle="tooltip" title="Delete" class="p-1" data-id="' . $usr['user_id'] . '" data-delete="User">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                  </a>'; }
                                echo '</td>';
                                } else { echo '<td data-toggle="tooltip" title="Locked">
                                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                  </svg></td>'; }
                        echo '</tr>';
                    }
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button<? if($b != 'roles') echo ' collapsed'; ?> btn-warning fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Roles
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse<? if($b == 'roles') echo ' show'; ?>" aria-labelledby="flush-headingThree" data-parent="#accordion">
      <div class="accordion-body p-0">
        <table class="table table-sm table-dark table-striped table-hover m-0">
          <thead>
            <tr>
              <th scope="col"><? if($user->hasPrivilege('6')) { echo '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-role-modal">&plus; Add Role</button>'; } ?></th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Privileges</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?
            $roles = $role->getRole();
                    foreach ($roles as $rl) {
                        echo '<tr>
                                <td>#' . $rl['role_id'] . '</td>
                                <td>' . $rl['name'] . '</td>
                                <td>' . $rl['description'] . '</td>
                                <td class="w-50">' . $role->getPrivileges($rl['role_id'])[0]['privileges'] . '</td>';
                                if($rl['removable']) {
                                  echo '<td>';
                                  if($user->hasPrivilege('12')) { echo '<a data-toggle="modal" data-selected="' . $rl['role_id'] . '" data-target="#remove-assignment-modal" class="p-1 text-decoration-none" data-id="' . $rl['role_id'] . '" data-remove="Privilege">
                                  <svg data-toggle="tooltip" title="Remove Privilege" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-minus text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm-1 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                  </svg>
                                  </a>'; }
                                  if($user->hasPrivilege('11')) { echo '<a data-toggle="modal" data-selected="' . $rl['role_id'] . '" data-target="#add-assignment-modal" class="p-1 text-decoration-none" data-id="' . $rl['role_id'] . '">
                                  <svg data-add="Privilege" data-toggle="tooltip" title="Assign Privilege" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard-plus text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                  </svg>
                                  </a>'; }
                                  if($user->hasPrivilege('7')) { echo '<a href="#" class="p-1" data-toggle="tooltip" title="Delete" data-id="' . $rl['role_id'] . '" data-delete="Role">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                  </a>'; }
                                echo '</td>';
                                } else { echo '<td data-toggle="tooltip" title="Locked"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                </svg></td>'; }
                        echo '</tr>';
                    }
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button<? if($b != 'privileges') echo ' collapsed'; ?> btn-warning fw-bold" type="button" data-toggle="collapse" data-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
        Privileges
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse<? if($b == 'privileges') echo ' show'; ?>" aria-labelledby="flush-headingFour" data-parent="#accordion">
      <div class="accordion-body p-0">
        <table class="table table-sm table-dark table-striped table-hover m-0">
          <thead>
            <tr>
              <th scope="col"><? if($user->hasPrivilege('9')) { echo '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-privilege-modal">&plus; Add Privilege</button>'; } ?></th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Roles</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?
            $privileges = $privilege->getPrivilege();
                    foreach ($privileges as $pv) {
                        echo '<tr>
                                <td>#' . $pv['privilege_id'] . '</td>
                                <td>' . $pv['name'] . '</td>
                                <td>' . $pv['description'] . '</td>
                                <td class="w-50">' . $privilege->getRoles($pv['privilege_id'])[0]['roles'] . '</td>';
                                if($pv['removable']) {
                                  echo '<td>';
                                  if($user->hasPrivilege('10')) { echo '<a data-toggle="tooltip" title="Delete" class="p-1" data-id="' . $pv['privilege_id'] . '" data-delete="Privilege">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                  </a>'; }
                                echo '</td>';
                                } else { echo '<td data-toggle="tooltip" title="Locked"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                              </svg></td>'; }
                        echo '</tr>';
                      }
                ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Modals -->
<div class="modal fade" id="change-role-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Role</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="change-role-form">
          <div class="mb-3">
            <label for="change-user" class="form-label">User</label>
            <select class="form-select" id="change-user" disabled>
              <? foreach ($users as $usr) {
                if($usr['role'] != '1') echo '<option value="' . $usr['user_id'] . '">' . $usr['username'] . '</option>';
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="change-role" class="form-label">Role</label>
            <select class="form-select" id="change-role">
              <? foreach ($roles as $rl) {
                if($rl['role_id'] != '1') echo '<option value="' . $rl['role_id'] . '">' . $rl['name'] . ' - ' . $rl['description'] . '</option>';
              } ?>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Change Role</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-role-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Role</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-role-form">
          <div class="mb-3">
            <label for="role-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="role-name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="role-description" class="form-label">Description</label>
            <input type="text" class="form-control" id="role-description">
            <div class="invalid-feedback"></div>
          </div>
          <button type="submit" class="btn btn-success">Add Role</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-privilege-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Privilege</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-privilege-form">
          <div class="mb-3">
            <label for="privilege-name" class="form-label">Name</label>
            <input type="text" class="form-control" id="privilege-name">
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="privilege-description" class="form-label">Description</label>
            <input type="text" class="form-control" id="privilege-description">
            <div class="invalid-feedback"></div>
          </div>
          <button type="submit" class="btn btn-success">Add Privilege</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-assignment-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Privilege To A Role</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="add-assignment-form">
          <div class="mb-3">
            <label for="add-assignment-role" class="form-label">Role</label>
            <select class="form-select" id="add-assignment-role" disabled>
              <? foreach ($roles as $rl) {
                if($rl['removable']) echo '<option value="' . $rl['role_id'] . '">' . $rl['name'] . '</option>';
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="add-assignment-privilege" class="form-label">Privilege</label>
            <select class="form-select" id="add-assignment-privilege">
            </select>
          </div>
          <button type="submit" class="btn btn-success">Add Privilege</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="remove-assignment-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remove Privilege From A Role</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="remove-assignment-form">
          <div class="mb-3">
            <label for="remove-assignment-role" class="form-label">Role</label>
            <select class="form-select" id="remove-assignment-role" disabled>
              <? foreach ($roles as $rl) {
                if($rl['removable']) echo '<option value="' . $rl['role_id'] . '">' . $rl['name'] . '</option>';
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="remove-assignment-privilege" class="form-label">Privilege</label>
            <select class="form-select" id="remove-assignment-privilege">
            </select>
          </div>
          <button type="submit" class="btn btn-success">Remove Privilege</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-page-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Page</h5>
        <button type="button" class="btn-close" id="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success fade collapse" id="postPage" role="alert">
          Page added successfuly!
        </div>
        <form id="add-page-form">
          <div class="container">
            <div class="row mb-2">
              <div class="col">
                <label for="title" class="form-label">Page Title</label>
                <input type="text" name="title" class="form-control form-control-sm" id="title">
                <div class="invalid-feedback"></div>
              </div>
              <div class="col">
                <label for="range" class="form-label">Visible For: <span id="rangefor">Everyone</span></label><br>
                <input type="range" name="range" class="range w-100" value="0" min="0" max="2" id="range">
              </div>
            </div>
            <div class="mb-1">
              <textarea id="textarea" name="textarea"></textarea>
              <div class="invalid-feedback"></div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function populate(data, select) {
    let x = document.getElementById(select);
    x.options.length = 0;

    if (data.length == 0) {
      x.disabled = true;
    } else {
      x.disabled = false;
      data.forEach(entry => {
        let option = document.createElement('option');
        option.text = entry.name + ' - ' + entry.description;
        option.value = entry.privilege_id;
        x.add(option);
      });
    }
  }

  let del = document.querySelectorAll('[data-delete]');
  del.forEach(d => {
    d.addEventListener('click', function(e) {
      e.preventDefault();
      ajax({
        action: 'delete' + d.dataset.delete,
        id: d.dataset.id
      });
    });
  });

  var assignment = document.getElementById('add-assignment-modal');
  assignment.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget;
    let role = button.getAttribute('data-selected');
    document.getElementById('add-assignment-role').value = role;

    ajax({
      action: 'getPrivilegesToAdd',
      id: role
    });
  });

  var assignment3 = document.getElementById('change-role-modal');
  assignment3.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget;
    let user = button.getAttribute('data-selected');
    document.getElementById('change-user').value = user;
  });

  var assignment2 = document.getElementById('remove-assignment-modal');
  assignment2.addEventListener('show.bs.modal', function(event) {
    let button = event.relatedTarget;
    let role = button.getAttribute('data-selected');
    document.getElementById('remove-assignment-role').value = role;

    ajax({
      action: 'getPrivilegesToRemove',
      id: role
    });
  });

  var editor = SUNEDITOR.create((document.getElementById('textarea') || 'textarea'), {
    lang: SUNEDITOR_LANG['en'],
    mode: "classic",
    rtl: false,
    katex: "window.katex",
    height: "400px",
    charCounter: true,
    charCounterType: "char",
    charCounterLabel: "Characters",
    font: [
      "Arial",
      "tahoma",
      "Courier New,Courier"
    ],
    fontSize: [
      8,
      10,
      14,
      18,
      24,
      36
    ],
    formats: [
      "p",
      "blockquote",
      "h1",
      "h2",
      "h3"
    ],
    colorList: [
      [
        "#ff0000",
        "#ff5e00",
        "#ffe400",
        "#abf200"
      ],
      [
        "#00d8ff",
        "#0055ff",
        "#6600ff",
        "#ff00dd"
      ]
    ],
    imageRotation: true,
    videoFileInput: false,
    audioUrlInput: false,
    tabDisable: false,
    lineHeights: [{
        text: "Single",
        value: 1
      },
      {
        text: "Double",
        value: 2
      }
    ],
    paragraphStyles: [
      "spaced",
      {
        name: "Box",
        class: "__se__customClass"
      }
    ],
    textStyles: [
      "translucent",
      {
        "name": "Emphasis",
        "style": "-webkit-text-emphasis: filled;",
        "tag": "span"
      }
    ],
    icons: {
      "paragraph_style": "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z\"/></svg>"
    },
    buttonList: [
      [
        "undo",
        "redo",
        "font",
        "fontSize",
        "formatBlock",
        "blockquote",
        "bold",
        "underline",
        "italic",
        "strike",
        "subscript",
        "superscript",
        "fontColor",
        "hiliteColor",
        "removeFormat",
        "outdent",
        "indent",
        "align",
        "horizontalRule",
        "list",
        "lineHeight",
        "table",
        "link",
        "image",
        "video",
        "audio",
        "fullScreen",
        "showBlocks",
        "codeView"
      ]
    ]
  });
  let pageForm = document.querySelector('#add-page-form');
  let roleForm = document.querySelector('#add-role-form');
  let privilegeForm = document.querySelector('#add-privilege-form');
  let addAssignmentForm = document.querySelector('#add-assignment-form');
  let removeAssignmentForm = document.querySelector('#remove-assignment-form');
  let changeRoleForm = document.querySelector('#change-role-form');

  document.querySelector('#range').oninput = function() {
    let visible = ["Everyone", "Registered Users And Privileged Users", "Privileged Users Only"];
    document.querySelector('#rangefor').innerHTML = visible[document.querySelector('#range').value];
  };

  if (pageForm) {
    pageForm.addEventListener('submit', function(e) {
      e.preventDefault();
      editor.save();
      let title = document.querySelector('#title').value;
      let range = document.querySelector('#range').value;
      let textarea = document.querySelector('#textarea').value;
      ajax({
        action: 'postPage',
        title: title,
        range: range,
        textarea: textarea
      });
    });
  }

  if (changeRoleForm) {
    changeRoleForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let user = document.querySelector('#change-user').value;
      let role = document.querySelector('#change-role').value;
      ajax({
        action: 'changeRole',
        user: user,
        role: role
      });
    });
  }

  if (roleForm) {
    roleForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let name = document.querySelector('#role-name').value;
      let description = document.querySelector('#role-description').value;
      ajax({
        action: 'addRole',
        name: name,
        description: description
      });
    });
  }

  if (addAssignmentForm) {
    addAssignmentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let role = document.querySelector('#add-assignment-role').value;
      let privilege = document.querySelector('#add-assignment-privilege').value;
      ajax({
        action: 'addAssignment',
        role: role,
        privilege: privilege
      });
    });
  }

  if (removeAssignmentForm) {
    removeAssignmentForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let role = document.querySelector('#remove-assignment-role').value;
      let privilege = document.querySelector('#remove-assignment-privilege').value;
      ajax({
        action: 'removeAssignment',
        role: role,
        privilege: privilege
      });
    });
  }

  if (privilegeForm) {
    privilegeForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let name = document.querySelector('#privilege-name').value;
      let description = document.querySelector('#privilege-description').value;
      ajax({
        action: 'addPrivilege',
        name: name,
        description: description
      });
    });
  }
</script>