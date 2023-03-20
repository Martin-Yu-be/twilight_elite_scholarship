<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

       $userAdmin = User::factory()->create([
        'name' => 'Admin',
        'district' => '不分區',
        'school' => '不分校',
        'email' => 'admin@example.com'
       ]);

       $userStudent1 = User::factory()->create([
        'name' => '王基一',
        'district' => '基隆區',
        'school' => '基隆高中',
        'email' => 'student1@example.com'
       ]);

       $userStudent2 = User::factory()->create([
        'name' => '王基二',
        'district' => '基隆區',
        'school' => '基隆高中',
        'email' => 'student2@example.com'
       ]);

       $userStudent3 = User::factory()->create([
        'name' => '王女基',
        'district' => '基隆區',
        'school' => '基隆女中',
        'email' => 'student3@example.com'
       ]);

       $userStudent4 = User::factory()->create([
        'name' => '王苗一',
        'district' => '苗栗區',
        'school' => '苗栗高中',
        'email' => 'student4@example.com'
       ]);

       $userTeacher1 = User::factory()->create([
        'name' => '吳美麗',
        'district' => '基隆區',
        'school' => '基隆高中',
        'email' => 'teacher1@example.com'
       ]);

       $userVolunteer1 = User::factory()->create([
        'name' => '鄭克爽',
        'district' => '基隆區',
        'school' => '基隆高中',
        'email' => 'volunteer1@example.com'
       ]);

       $userVolunteer2 = User::factory()->create([
        'name' => '鄭經',
        'district' => '基隆區',
        'school' => '不分校',
        'email' => 'volunteer2@example.com'
       ]);

       $userVolunteer3 = User::factory()->create([
        'name' => '鄭成功',
        'district' => '不分區',
        'school' => '不分校',
        'email' => 'volunteer3@example.com'
       ]);

       // Roles
       $roleAdmin = Role::create(['name' => 'Admin']);
       $roleStudent = Role::create(['name' => '學生']);
       $roleSchool = Role::create(['name' => '校方']);
       $roleVolunteer = Role::create(['name' => '輔導幹部']);
       $roleCommittee = Role::create(['name' => '決策委員']);

       // Permissions
       $permissionCreate = Permission::create(['name' => 'create form']);
       $permissionView = Permission::create(['name' => 'view form']);
       $permissionEdit = Permission::create(['name' => 'edit form']);
       $permissionDelete = Permission::create(['name' => 'delete form']);

       // Admin permissions
       $roleAdmin->givePermissionTo($permissionCreate);
       $roleAdmin->givePermissionTo($permissionEdit);
       $roleAdmin->givePermissionTo($permissionView);
       $roleAdmin->givePermissionTo($permissionDelete);

       // 學生 permissions
       $roleStudent->givePermissionTo($permissionCreate);
       $roleStudent->givePermissionTo($permissionEdit);

       // 校方 permissions
       $roleSchool->givePermissionTo($permissionView);

       // 輔導幹部 permissions
       $roleVolunteer->givePermissionTo($permissionView);
       $roleVolunteer->givePermissionTo($permissionEdit);

       // 決策委員 permissions
       $roleCommittee->givePermissionTo($permissionView);
       $roleCommittee->givePermissionTo($permissionEdit);

       $userAdmin->assignRole($roleAdmin);
       $userStudent1->assignRole($roleStudent);
       $userStudent2->assignRole($roleStudent);
       $userStudent3->assignRole($roleStudent);
       $userStudent4->assignRole($roleStudent);
       $userTeacher1->assignRole($roleSchool);
       $userVolunteer1->assignRole($roleVolunteer);
       $userVolunteer2->assignRole($roleVolunteer);
       $userVolunteer3->assignRole($roleVolunteer);

    }
}
