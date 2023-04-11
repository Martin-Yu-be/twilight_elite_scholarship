<?php

namespace Database\Seeders;

use App\Models\Instruction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Instruction
        Instruction::insert(
            [
                'id' => 1,
                'name' => '青澀芷蘭公立高中清寒學生教育補助計畫',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Districts & Schools
        $this->call(
            [
                DistrictSeeder::class,
                SchoolSeeder::class,
            ]
        );

        // Users
        $userAdmin = User::factory()->create(
            [
                'name' => 'Admin',
                'district_id' => '1',
                'school_id' => '1',
                'email' => 'admin@example.com',
                'is_activated' => true,
            ]
        );

        $userStudent1 = User::factory()->create(
            [
                'name' => '王小明',
                'district_id' => '2',
                'school_id' => '2',
                'email' => 'student1@example.com',
                'is_activated' => true,
            ]
        );

        $userStudent2 = User::factory()->create(
            [
                'name' => '王小華',
                'district_id' => '2',
                'school_id' => '2',
                'email' => 'student2@example.com',
                'is_activated' => true,
            ]
        );

        $userStudent3 = User::factory()->create(
            [
                'name' => '王小涵',
                'district_id' => '2',
                'school_id' => '3',
                'email' => 'student3@example.com',
                'is_activated' => true,
            ]
        );

        $userStudent4 = User::factory()->create(
            [
                'name' => '王小桃',
                'district_id' => '3',
                'school_id' => '5',
                'email' => 'student4@example.com',
                'is_activated' => true,
            ]
        );

        $userTeacher1 = User::factory()->create(
            [
                'name' => '吳美麗',
                'district_id' => '2',
                'school_id' => '2',
                'email' => 'teacher1@example.com',
                'is_activated' => true,
            ]
        );

        $userVolunteer1 = User::factory()->create(
            [
                'name' => '鄭克爽',
                'district_id' => '2',
                'school_id' => '2',
                'email' => 'volunteer1@example.com',
                'is_activated' => true,
            ]
        );

        $userVolunteer2 = User::factory()->create(
            [
                'name' => '鄭經',
                'district_id' => '2',
                'school_id' => '36',
                'email' => 'volunteer2@example.com',
                'is_activated' => true,
            ]
        );

        $userVolunteer3 = User::factory()->create(
            [
                'name' => '鄭成功',
                'district_id' => '1',
                'school_id' => '1',
                'email' => 'volunteer3@example.com',
                'is_activated' => true,
            ]
        );

        // Roles
        $roleAdmin = Role::create(['name' => '管理員']);
        $roleStudent = Role::create(['name' => '學生']);
        $roleSchool = Role::create(['name' => '校方']);
        $roleVolunteer = Role::create(['name' => '輔導幹部']);
        $roleCommittee = Role::create(['name' => '決策委員']);

        // Permissions for applications
        $permissionCreateForm = Permission::create(['name' => '新增表單']);
        $permissionViewForm = Permission::create(['name' => '刪除表單']);
        $permissionEditForm = Permission::create(['name' => '編輯表單']);
        $permissionDeleteForm = Permission::create(['name' => '閱讀表單']);

        // Permissions for reviews
        $permissionEditReview = Permission::create(['name' => '編輯晤談']);
        $permissionViewReview = Permission::create(['name' => '閱讀晤談']);

        // 管理員 permissions
        $roleAdmin->givePermissionTo($permissionCreateForm);
        $roleAdmin->givePermissionTo($permissionEditForm);
        $roleAdmin->givePermissionTo($permissionViewForm);
        $roleAdmin->givePermissionTo($permissionDeleteForm);
        $roleAdmin->givePermissionTo($permissionEditReview);
        $roleAdmin->givePermissionTo($permissionViewReview);

        // 學生 permissions
        $roleStudent->givePermissionTo($permissionCreateForm);
        $roleStudent->givePermissionTo($permissionEditForm);

        // 校方 permissions
        $roleSchool->givePermissionTo($permissionViewForm);

        // 輔導幹部 permissions
        $roleVolunteer->givePermissionTo($permissionViewForm);
        $roleVolunteer->givePermissionTo($permissionEditForm);
        $roleAdmin->givePermissionTo($permissionEditReview);
        $roleAdmin->givePermissionTo($permissionViewReview);

        // 決策委員 permissions
        $roleCommittee->givePermissionTo($permissionViewForm);
        $roleCommittee->givePermissionTo($permissionEditForm);
        $roleAdmin->givePermissionTo($permissionEditReview);
        $roleAdmin->givePermissionTo($permissionViewReview);

        // Assign roles to users
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
