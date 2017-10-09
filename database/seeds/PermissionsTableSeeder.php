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
        
                'name'         => 'create/delete-companies',
                'display_name' => 'Can create delete company',
                'description'  => 'This User LoggedIn will be able to see All the Reports.',
            ],
            [
           
                'name'         => 'view-company',
                'display_name' => 'Can Create/Update Users',
                'description'  => 'This User LoggedIn will be able to Create new users and Update existing users.',
            ],

            [

                'name'         => 'edit/update-company',
                'display_name' => 'Can edit/update-company',
                'description'  => 'This User LoggedIn will be able to  edit/update-company existing users.',
            ],
            [
 
                'name'         => 'create/show/edit/delete-companySettings',
                'display_name' => 'Can create/show/edit/delete-companySettings',
                'description'  => 'This User LoggedIn will be able to  create/show/edit/delete-companySettings',
            ],
            [
        
                'name'         => 'registerUser',
                'display_name' => 'Can registerUser',
                'description'  => 'This User LoggedIn will be able to  registerUser',
            ],
            [
        
                'name'         => 'create/edit/delete-jobTitle',
                'display_name' => 'Can create/edit/delete-jobTitle',
                'description'  => 'This User LoggedIn will be able to  create/edit/delete-jobTitle',
            ],
            [
     
                'name'         => 'create/edit/delete-holiday',
                'display_name' => 'Can create/edit/delete-holiday',
                'description'  => 'This User LoggedIn will be able to  create/edit/delete-holiday',
            ],
            [
       
                'name'         => 'reportOptions',
                'display_name' => 'Can reportOptions',
                'description'  => 'This User LoggedIn will be able to  reportOptions',
            ],
            [
              
                'name'         => 'showInternalProjectsReport',
                'display_name' => 'Can showInternalProjectReports',
                'description'  => 'This User LoggedIn will be able to  showInternalProjectReports',
            ],
            [
                
                'name'         => 'showClientProjectsReport',
                'display_name' => 'Can showInternalProjectReports',
                'description'  => 'This User LoggedIn will be able to  showInternalProjectReports',
            ],
            [
              
                'name'         => 'showAllProjectsReport',
                'display_name' => 'Can showAllProjectReports',
                'description'  => 'This User LoggedIn will be able to  showAllProjectReports',
            ],

            [
               
                'name'         => 'show-companyProjects',
                'display_name' => 'Can show-companyProjects',
                'description'  => 'This User LoggedIn will be able to  show-companyProjects',
            ],

            [
              
                'name'         => 'create/edit-companyProject',
                'display_name' => 'Can create/edit-companyProjects',
                'description'  => 'This User LoggedIn will be able to  create/edit-companyProjects',
            ],
            [
          
                'name'         => 'view-companyProject',
                'display_name' => 'Can show-companyProjects',
                'description'  => 'This User LoggedIn will be able to  show-companyProjects',
            ],
            [
            
                'name'         => 'delete-companyProject',
                'display_name' => 'Can delete-companyProjects',
                'description'  => 'This User LoggedIn will be able to  delete-companyProjects',
            ],
            [
               
                'name'         => 'show-clientProjects',
                'display_name' => 'Can show-clientProjects',
                'description'  => 'This User LoggedIn will be able to  show-clientProjects',
            ],

            [
    
                'name'         => 'create/edit-clientProject',
                'display_name' => 'Can create/edit-clientProjects',
                'description'  => 'This User LoggedIn will be able to  create/edit-clientProjects',
            ],

            [
  
                'name'         => 'view-clientProject',
                'display_name' => 'Can view-clientProject',
                'description'  => 'This User LoggedIn will be able to  view-clientProject',
            ],
            [

                'name'         => 'delete-clientProject',
                'display_name' => 'Can delete-clientProjects',
                'description'  => 'This User LoggedIn will be able to  delete-clientProjects',
            ],

            [
               
                'name'         => 'create/edit-companyProjectResource',
                'display_name' => 'Can creat/edit-companyProjectResource',
                'description'  => 'This User LoggedIn will be able to  creat/edit-companyProjectResource',
            ],

            [
               
                'name'         => 'delete-companyProjectResource',
                'display_name' => 'Can delete-companyProjectResource',
                'description'  => 'This User LoggedIn will be able to  delete-companyProjectResource',
            ],

            [
               
                'name'         => 'create/edit-clientProjectResource',
                'display_name' => 'Can creat/edit-clientProjectResource',
                'description'  => 'This User LoggedIn will be able to  creat/edit-clientProjectResource',
            ],

            [
                
                'name'         => 'delete-clientProjectResource',
                'display_name' => 'Can delete-clientProjectResource',
                'description'  => 'This User LoggedIn will be able to  delete-clientProjectResource',
            ],
            [
             
                'name'         => 'create/edit/delete-department',
                'display_name' => 'Can create/edit-department',
                'description'  => 'This User LoggedIn will be able to  create/edit-department',
            ],
            [
       
                'name'         => 'show-clients',
                'display_name' => 'Can show-clients',
                'description'  => 'This User LoggedIn will be able to  show-clients',
            ],
            [
  
                'name'         => 'create/edit-client',
                'display_name' => 'Can create/edit-client',
                'description'  => 'This User LoggedIn will be able to  create/edit-client',
            ],
            [

                'name'         => 'view-client',
                'display_name' => 'Can view-client',
                'description'  => 'This User LoggedIn will be able to  view-client',
            ],

            [
               
                'name'         => 'delete-client',
                'display_name' => 'Can delete-client',
                'description'  => 'This User LoggedIn will be able to  delete-client',
            ],
            [
      
                'name'         => 'show-employees',
                'display_name' => 'Can show-employees',
                'description'  => 'This User LoggedIn will be able to show-employees',
            ],

            [
        
                'name'         => 'create/edit-employee',
                'display_name' => 'Can create/edit-employee',
                'description'  => 'This User LoggedIn will be able to  create/edit-employee',
            ],
            [
            
                'name'         => 'view-employee',
                'display_name' => 'Can view-employee',
                'description'  => 'This User LoggedIn will be able to  view-employee',
            ],
            [
                
                'name'         => 'delete-employee',
                'display_name' => 'Can delete-employee',
                'description'  => 'This User LoggedIn will be able to  delete-employee',
            ],

            [
             
                'name'         => 'create/edit-timesheet',
                'display_name' => 'Can create/edit-timesheet',
                'description'  => 'This User LoggedIn will be able to create/edit-timesheet',
            ],

            [
               
                'name'         => 'approve-timesheets',
                'display_name' => 'Can aprrove-timesheets',
                'description'  => 'This User LoggedIn will be able to aprrove-timesheets',
            ],

            [

                'name'         => 'create/edit-timeoff',
                'display_name' => 'Can create/edit-timeoff',
                'description'  => 'This User LoggedIn will be able to create/edit-timeoff',
            ],

            [

                'name'         => 'delete-timeoff',
                'display_name' => 'Can delete-timeoff',
                'description'  => 'This User LoggedIn will be able to delete-timeoff',
            ],
            [

                'name'         => 'approve-timeoffs',
                'display_name' => 'Can aprrove-timeoffs',
                'description'  => 'This User LoggedIn will be able to aprrove-timeoffs',
            ],

        ];
        foreach ($permissions as $key => $permission) {
            Permission::create($permission);
        }
    }
}
