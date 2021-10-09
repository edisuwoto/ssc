<?php

namespace SpondonIt\SchoolService\Repositories;

use App\SmGeneralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\RolePermission\Entities\InfixRole;
use Modules\RolePermission\Entities\InfixPermissionAssign;

class InitRepository {

    public function init() {
		config([
            'app.item' => '23876323',
            'spondonit.module_manager_model' => \App\InfixModuleManager::class,
            'spondonit.module_manager_table' => 'infix_module_managers',

            'spondonit.settings_model' => SmGeneralSettings::class,
            'spondonit.module_model' => \Nwidart\Modules\Facades\Module::class,

            'spondonit.user_model' => \App\User::class,
            'spondonit.settings_table' => 'sm_general_settings',
            'spondonit.database_file' => 'infix_5_3.sql',
        ]);
    }

    public function config()
	{

        app()->singleton('dashboard_bg', function () {
            $dashboard_background = DB::table('sm_background_settings')->where([['is_default', 1], ['title', 'Dashboard Background']])->first();
            return $dashboard_background;
        });

        app()->singleton('school_info', function () {
            $school_info = Auth::check() ? SmGeneralSettings::where('school_id', Auth::user()->school_id)->first() :
                DB::table('sm_general_settings')->where('school_id', 1)->first();
            return $school_info;
        });

       
        app()->singleton('permission', function () {
            $infixRole = InfixRole::find(Auth::user()->role_id);

            $module_links = [];
            if ($infixRole->is_saas == 1) {
                $permissions = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->get(['id', 'module_id']);
            }
            if ($infixRole->is_saas == 0) {
                $permissions = InfixPermissionAssign::where('role_id', Auth::user()->role_id)->where('school_id', Auth::user()->school_id)->get(['id', 'module_id']);
            }
            foreach ($permissions as $permission) {
                $module_links[] = $permission->module_id;
            }
            //All user permission module id save in session
            $permission = $module_links;
            return $permission;
        });

	}

}
