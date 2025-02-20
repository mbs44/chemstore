<?php

namespace App\Ldap;


use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use LdapRecord\Models\OpenLDAP\User;

// This trait provides the implementation for the Authenticatable interface

class LdapUser extends User implements AuthenticatableContract
{
    public static array $objectClasses = [ 'inetOrgPerson'  ];
}
