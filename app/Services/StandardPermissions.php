<?php

namespace People\Services;

use People\Models\Permission;

class StandardPermissions
{
    const createDeleteCompanies               = 'create/delete-companies';
    const viewCompany                         = 'view-company';
    const editUpdateCompany                   = 'edit/update-company';
    const createShowEditDeleteCompanySettings = 'create/show/edit/delete-companySettings';
    const registerUser                        = 'registerUser';
    const createEditDeleteJobTitle            = 'create/edit/delete-jobTitle';
    const createEditDeleteHoliday             = 'create/edit/delete-holiday';
    const reportOptions                       = 'reportOptions';
    const showInternalProjectsReport          = 'showInternalProjectsReport';
    const showClientProjectsReport            = 'showClientProjectsReport';
    const showAllProjectsReport               = 'showAllProjectsReport';
    const showCompanyProjects                 = 'show-companyProjects';
    const createEditCompanyProject            = 'create/edit-companyProject';
    const viewCompanyProject                  = 'view-companyProject';
    const deleteCompanyProject                = 'delete-companyProject';
    const showClientProjects                  = 'show-clientProjects';
    const createEditClientProject             = 'create/edit-clientProject';
    const viewClientProject                   = 'view-clientProject';
    const deleteClientProject                 = 'delete-clientProject';
    const createEditCompanyProjectResource    = 'create/edit-companyProjectResource';
    const deleteCompanyProjectResource        = 'delete-companyProjectResource';
    const createEditClientProjectResource     = 'create/edit-clientProjectResource';
    const deleteClientProjectResource         = 'delete-clientProjectResource';
    const createEditDeleteDepartment          = 'create/edit/delete-department';
    const showClients                         = 'show-clients';
    const createEditClient                    = 'create/edit-client';
    const viewClient                          = 'view-client';
    const deleteClient                        = 'delete-client';
    const showEmployees                       = 'show-employees';
    const createEditEmployee                  = 'create/edit-employee';
    const viewOwnProfile                      = 'view-ownProfile';
    const viewOthersProfile                   = 'view-othersProfile';
    const deleteEmployee                      = 'delete-employee';
    const createEditTimesheet                 = 'create/edit-timesheet';
    const approveTimesheets                   = 'approve-timesheets';
    const createEditTimeoff                   = 'create/edit-timeoff';
    const deleteTimeoff                       = 'delete-timeoff';
    const approveTimeoffs                     = 'approve-timeoffs';
    const crudRole                            = 'crud-role';
    const crudUserRole                        = 'crud-userRole';

    public static function getPermissionName($id)
    {
        $permission = Permission::where('id', $id)->pluck('name')->first();

        return $permission;
    }

}
