<?php

namespace People\Enums;

use People\Models\Permission;

class StandardPermissions
{
    const createDeleteCompanies               = 1;
    const viewCompany                         = 2;
    const editUpdateCompany                   = 3;
    const createShowEditDeleteCompanySettings = 4;
    const registerUser                        = 5;
    const createEditDeleteJobTitle            = 6;
    const createEditDeleteHoliday             = 7;
    const reportOptions                       = 8;
    const showInternalProjectsReport          = 9;
    const showClientProjectsReport            = 10;
    const showAllProjectsReport               = 11;
    const showCompanyProjects                 = 12;
    const createEditCompanyProject            = 13;
    const viewCompanyProject                  = 14;
    const deleteCompanyProject                = 15;
    const showClientProjects                  = 16;
    const createEditClientProject             = 17;
    const viewClientProject                   = 18;
    const deleteClientProject                 = 19;
    const createEditCompanyProjectResource    = 20;
    const deleteCompanyProjectResource        = 21;
    const createEditClientProjectResource     = 22;
    const deleteClientProjectResource         = 23;
    const createEditDeleteDepartment          = 24;
    const showClients                         = 25;
    const createEditClient                    = 26;
    const viewClient                          = 27;
    const deleteClient                        = 28;
    const showEmployees                       = 29;
    const createEditEmployee                  = 30;
    const viewOwnProfile                      = 31;
    const viewOthersProfile                   = 32;
    const deleteEmployee                      = 33;
    const createEditTimesheet                 = 34;
    const approveTimesheets                   = 35;
    const createEditTimeoff                   = 36;
    const deleteTimeoff                       = 37;
    const approveTimeoffs                     = 38;
    const showRoles                           = 39;
    const viewRole                            = 40;
    const createEditRole                      = 41;
    const deleteRole                          = 42;
    const showUserRoles                       = 43;
    const createEditUserRole                  = 44;
    const deleteUserRole                      = 45;

    public static function getPermissionName($id)
    {
        $permission = Permission::where('id', $id)->pluck('name')->first();

        return $permission;
    }

}
