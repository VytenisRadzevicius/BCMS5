<?php

$response = [];

// Get the request action
$request = json_decode(file_get_contents('php://input'));
if($request->action) $action = htmlspecialchars($request->action); else $action = null;

include 'engine.php';

// AJAX request actions
switch ($action) {
  case 'loginUser':
    $response = $user->loginUser($request->username, $request->password);
    empty($response) ? $response['action'] = 'redirect' : $response['action'] = 'error';
    break;

  case 'registerUser':
    $response = $user->registerUser($request->username, $request->email, $request->password1, $request->password2);
    if(empty($response)) {
      if($user->isLoggedIn()) {
        $response['action'] = 'redirect';
        $response['location'] = 'index.php?p=admin&b=users';
      } else {
        $user->loginUser($request->username, $request->password1);
        usleep( 100000 );
        $response['action'] = 'redirect';
      }} else { $response['action'] = 'error'; }
    break;

  case 'deleteUser':
    $response = $user->deleteUser($request->id);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=users';
    break;

  case 'postPage':
    $response = $page->postPage($request->title, $request->range, $request->textarea);
    if(empty($response)) {
       $response['action'] = 'redirect';
       $response['location'] = 'index.php?p=admin&b=pages';
     } else { $response['action'] = 'error'; }
    break;

  case 'deletePage':
    $response = $page->deletePage($request->id);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=pages';
    break;

  case 'addRole':
    $response = $role->addRole($request->name, $request->description);
    if(empty($response)) {
       $response['action'] = 'redirect';
       $response['location'] = 'index.php?p=admin&b=roles';
     } else { $response['action'] = 'error'; }
    break;

  case 'deleteRole':
    $response = $role->deleteRole($request->id);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=roles';
    break;

  case 'addPrivilege':
    $response = $privilege->addPrivilege($request->name, $request->description);
    if(empty($response)) {
       $response['action'] = 'redirect';
       $response['location'] = 'index.php?p=admin&b=privileges';
     } else { $response['action'] = 'error'; }
    break;

  case 'deletePrivilege':
    $response = $privilege->deletePrivilege($request->id);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=privileges';
    break;

  case 'getPrivilegesToAdd':
    $response['data'] = $role->getPrivilegesToAdd($request->id);
    $response['action'] = 'populate-add-select';
    break;

  case 'getPrivilegesToRemove':
    $response['data'] = $role->getPrivilegesToRemove($request->id);
    $response['action'] = 'populate-remove-select';
    break;

  case 'addAssignment':
    $response = $role->addAssignment($request->role, $request->privilege);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=roles';
    break;

  case 'removeAssignment':
    $response = $role->removeAssignment($request->role, $request->privilege);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=roles';
    break;

  case 'changeRole':
    $response = $role->changeRole($request->user, $request->role);
    $response['action'] = 'redirect';
    $response['location'] = 'index.php?p=admin&b=users';
    break;

  default: // Die if action is not recognised
    die(json_encode(array('status' => 400, 'message' => 'Unrecognised AJAX request!')));
}

// Response
if(!empty($response)) echo json_encode($response); 