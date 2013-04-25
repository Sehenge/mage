<?php
$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::app('default');
# Create New User
try {    
    $user = Mage::getModel('admin/user')
        ->setData(array(
            'username'  => 'magento',
            'firstname' => 'Alex',
            'lastname'    => 'Moon',
            'email'     => 'sehenge@gmail.com',
            'password'  => 'pass4magento',
            'is_active' => 1
        ))->save();

} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

# Assign New Role
try {
    $user->setRoleIds(array(1))
        ->setRoleUserId($user->getUserId())
        ->saveRelations();

} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
