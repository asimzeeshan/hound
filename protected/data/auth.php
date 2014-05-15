<?php 
return array (
  'superadmin' => 
  array (
    'type' => 2,
    'description' => 'SuperAdmin',
    'bizRule' => '',
    'data' => '',
    'assignments' => 
    array (
      10 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'aduser' => 
  array (
    'type' => 2,
    'description' => 'AdUser',
    'bizRule' => '',
    'data' => '',
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => 'Can perform all actions',
    'bizRule' => '',
    'data' => '',
    'children' => 
    array (
      0 => 'usersAdmin',
    ),
    'assignments' => 
    array (
      24 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'usersAdmin' => 
  array (
    'type' => 0,
    'description' => 'read a post',
    'bizRule' => NULL,
    'data' => NULL,
  ),
);
