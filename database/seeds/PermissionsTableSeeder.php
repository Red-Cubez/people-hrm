<?php

use Illuminate\Database\Seeder;
use People\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'           => 1,
                'name'         => 'create/delete-companies',
                'display_name' => 'Can create delete company',
                'description'  => 'This User LoggedIn will be able to see All the Reports.',
            ],
            [
                'id'           => 2,
                'name'         => 'view-company',
                'display_name' => 'Can Create/Update Users',
                'description'  => 'This User LoggedIn will be able to Create new users and Update existing users.',
            ],

            [
                'id'           => 3,
                'name'         => 'edit/update-company',
                'display_name' => 'Can edit/update-company',
                'description'  => 'This User LoggedIn will be able to  edit/update-company existing users.',
            ],
            [
                'id'           => 4,
                'name'         => 'create/show/edit/delete-companySettings',
                'display_name' => 'Can create/show/edit/delete-companySettings',
                'description'  => 'This User LoggedIn will be able to  create/show/edit/delete-companySettings',
            ],
            [
                'id'           => 5,
                'name'         => 'registerUser',
                'display_name' => 'Can registerUser',
                'description'  => 'This User LoggedIn will be able to  registerUser',
            ],
            [
                'id'           => 6,
                'name'         => 'create/edit/delete-jobTitle',
                'display_name' => 'Can create/edit/delete-jobTitle',
                'description'  => 'This User LoggedIn will be able to  create/edit/delete-jobTitle',
            ],
            [
                'id'           => 7,
                'name'         => 'create/edit/delete-holiday',
                'display_name' => 'Can create/edit/delete-holiday',
                'description'  => 'This User LoggedIn will be able to  create/edit/delete-holiday',
            ],
            [
                'id'           => 8,
                'name'         => 'reportOptions',
                'display_name' => 'Can reportOptions',
                'description'  => 'This User LoggedIn will be able to  reportOptions',
            ],
            [
                'id'           => 9,
                'name'         => 'showInternalProjectsReport',
                'display_name' => 'Can showInternalProjectReports',
                'description'  => 'This User LoggedIn will be able to  showInternalProjectReports',
            ],
            [
                'id'           => 10,
                'name'         => 'showClientProjectsReport',
                'display_name' => 'Can showInternalProjectReports',
                'description'  => 'This User LoggedIn will be able to  showInternalProjectReports',
            ],
            [
                'id'           => 11,
                'name'         => 'showAllProjectsReport',
                'display_name' => 'Can showAllProjectReports',
                'description'  => 'This User LoggedIn will be able to  showAllProjectReports',
            ],

            [
                'id'           => 12,
                'name'         => 'show-companyProjects',
                'display_name' => 'Can show-companyProjects',
                'description'  => 'This User LoggedIn will be able to  show-companyProjects',
            ],

            [
                'id'           => 13,
                'name'         => 'create/edit-companyProject',
                'display_name' => 'Can create/edit-companyProjects',
                'description'  => 'This User LoggedIn will be able to  create/edit-companyProjects',
            ],
            [
                'id'           => 14,
                'name'         => 'view-companyProject',
                'display_name' => 'Can show-companyProjects',
                'description'  => 'This User LoggedIn will be able to  show-companyProjects',
            ],
            [
                'id'           => 15,
                'name'         => 'delete-companyProject',
                'display_name' => 'Can delete-companyProjects',
                'description'  => 'This User LoggedIn will be able to  delete-companyProjects',
            ],
            [
                'id'           => 16,
                'name'         => 'show-clientProjects',
                'display_name' => 'Can show-clientProjects',
                'description'  => 'This User LoggedIn will be able to  show-clientProjects',
            ],

            [
                'id'           => 17,
                'name'         => 'create/edit-clientProject',
                'display_name' => 'Can create/edit-clientProjects',
                'description'  => 'This User LoggedIn will be able to  create/edit-clientProjects',
            ],

            [
                'id'           => 18,
                'name'         => 'view-clientProject',
                'display_name' => 'Can view-clientProject',
                'description'  => 'This User LoggedIn will be able to  view-clientProject',
            ],
            [
                'id'           => 19,
                'name'         => 'delete-clientProject',
                'display_name' => 'Can delete-clientProjects',
                'description'  => 'This User LoggedIn will be able to  delete-clientProjects',
            ],

            [
                'id'           => 20,
                'name'         => 'create/edit-companyProjectResource',
                'display_name' => 'Can creat/edit-companyProjectResource',
                'description'  => 'This User LoggedIn will be able to  creat/edit-companyProjectResource',
            ],

            [
                'id'           => 21,
                'name'         => 'delete-companyProjectResource',
                'display_name' => 'Can delete-companyProjectResource',
                'description'  => 'This User LoggedIn will be able to  delete-companyProjectResource',
            ],

            [
                'id'           => 22,
                'name'         => 'create/edit-clientProjectResource',
                'display_name' => 'Can creat/edit-clientProjectResource',
                'description'  => 'This User LoggedIn will be able to  creat/edit-clientProjectResource',
            ],

            [
                'id'           => 23,
                'name'         => 'delete-clientProjectResource',
                'display_name' => 'Can delete-clientProjectResource',
                'description'  => 'This User LoggedIn will be able to  delete-clientProjectResource',
            ],
            [
                'id'           => 24,
                'name'         => 'create/edit/delete-department',
                'display_name' => 'Can create/edit-department',
                'description'  => 'This User LoggedIn will be able to  create/edit-department',
            ],
            [
                'id'           => 25,
                'name'         => 'show-clients',
                'display_name' => 'Can show-clients',
                'description'  => 'This User LoggedIn will be able to  show-clients',
            ],
            [
                'id'           => 26,
                'name'         => 'create/edit-client',
                'display_name' => 'Can create/edit-client',
                'description'  => 'This User LoggedIn will be able to  create/edit-client',
            ],
            [
                'id'           => 27,
                'name'         => 'view-client',
                'display_name' => 'Can view-client',
                'description'  => 'This User LoggedIn will be able to  view-client',
            ],

            [
                'id'           => 28,
                'name'         => 'delete-client',
                'display_name' => 'Can delete-client',
                'description'  => 'This User LoggedIn will be able to  delete-client',
            ],
            [
                'id'           => 29,
                'name'         => 'show-employees',
                'display_name' => 'Can show-employees',
                'description'  => 'This User LoggedIn will be able to show-employees',
            ],

            [
                'id'           => 30,
                'name'         => 'create/edit-employee',
                'display_name' => 'Can create/edit-employee',
                'description'  => 'This User LoggedIn will be able to  create/edit-employee',
            ],

            [
                'id'           => 31,
                'name'         => 'view-ownProfile',
                'display_name' => 'Can view-ownProfile',
                'description'  => 'This User LoggedIn will be able to  view-ownProfile',
            ],
            [
                'id'           => 32,
                'name'         => 'view-othersProfile',
                'display_name' => 'Can view-othersProfile',
                'description'  => 'This User LoggedIn will be able to  view-othersProfile',
            ],
            [
                'id'           => 33,
                'name'         => 'delete-employee',
                'display_name' => 'Can delete-employee',
                'description'  => 'This User LoggedIn will be able to  delete-employee',
            ],

            [
                'id'           => 34,
                'name'         => 'create/edit-timesheet',
                'display_name' => 'Can create/edit-timesheet',
                'description'  => 'This User LoggedIn will be able to create/edit-timesheet',
            ],

            [
                'id'           => 35,
                'name'         => 'approve-timesheets',
                'display_name' => 'Can aprrove-timesheets',
                'description'  => 'This User LoggedIn will be able to aprrove-timesheets',
            ],

            [
                'id'           => 36,
                'name'         => 'create/edit-timeoff',
                'display_name' => 'Can create/edit-timeoff',
                'description'  => 'This User LoggedIn will be able to create/edit-timeoff',
            ],

            [
                'id'           => 37,
                'name'         => 'delete-timeoff',
                'display_name' => 'Can delete-timeoff',
                'description'  => 'This User LoggedIn will be able to delete-timeoff',
            ],
            [
                'id'           => 38,
                'name'         => 'approve-timeoffs',
                'display_name' => 'Can aprrove-timeoffs',
                'description'  => 'This User LoggedIn will be able to aprrove-timeoffs',
            ],
            [
                'id'           => 39,
                'name'         => 'crud-role',
                'display_name' => 'Can crud-roles',
                'description'  => 'This User LoggedIn will be able to crud-roles',
            ],
            [
                'id'           => 40,
                'name'         => 'crud-userRole',
                'display_name' => 'Can crud-userRole',
                'description'  => 'This User LoggedIn will be able to crud-userRole',
            ],


        ];
        foreach ($permissions as $key => $permission) {
            Permission::create($permission);
        }
    }
}
