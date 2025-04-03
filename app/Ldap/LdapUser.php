<?php

namespace App\Ldap;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use LdapRecord\Models\OpenLDAP\User;
//use LdapRecord\Models\ActiveDirectory\User;
use Spatie\Permission\Traits\HasRoles;

// This trait provides the implementation for the Authenticatable interface

class LdapUser extends User implements AuthenticatableContract {
    use HasRoles;

    public static array $objectClasses = [ 'inetOrgPerson'  ];

    const authPasswordAttribute = 'password';
    const authLoginAttribute = 'uid';

    //const authLoginAttribute = 'username';

    public function getUserName() : string
    {
        return $this->uid[0];  // for OpenLDAP
        // return $this->sAMAccountName[0]; // for MS ADs
    }
}
