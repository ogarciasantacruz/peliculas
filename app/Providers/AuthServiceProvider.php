<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateAccess;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateAccess $gate)
    {
        $this->registerPolicies();

        $permissions = $this->getPermissions();

        if (isset($permissions)) {

            foreach($this->getPermissions() as $permission){
 
                $gate->define($permission->name, function($user) use ($permission) {
     
                   return  $user->hasRole($permission->roles);
     
                });
            }
        }        
    }


    /**
    * Get all the permission for the loged in user
    * @var array
    */
    public function getPermissions()
    {

      return Permission::with('roles')->get();
    }
}
