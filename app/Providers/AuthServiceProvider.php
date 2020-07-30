<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateAccess;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

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

        $result = collect([]);

        try {
            
            $result = Permission::with('roles')->get();

        }

        // If an exception occurs when attempting to run a query, we'll format the error
        // message to include the bindings with SQL, which will make this exception a
        // lot more helpful to the developer instead of just the database's errors.
        catch (\Illuminate\Database\QueryException $ex) {
            
            return collect([]);
        }
        
        return $result;
    }
}
