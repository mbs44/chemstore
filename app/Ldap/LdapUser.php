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
}
