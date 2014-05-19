<?php
return array(
    'superadmin' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'SuperAdmin',
        'bizRule'=>'',
        'data'=>''
    ),
    'manager' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Manager',
        'bizRule'=>'',
        'data'=>''
    ),

    'admin' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Can perform all actions',
        'bizRule'=>'',
        'data'=>''
   ),
    'guest' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'guest user',
        'bizRule'=>'',
        'data'=>''
   ),
);

