<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create new Role Admin
         * ======================
         */
        $adminRole = new Role;

        $adminRole->name = "admin";
        $adminRole->display_name = "admin";
        $adminRole->description = "Admin Role";
        $adminRole->save();

        /**
         * Create new Role Member
         * ======================
         */
        $memberRole = new Role;

        $memberRole->name = "member";
        $memberRole->display_name = "member";
        $memberRole->description = "Member Role";
        $memberRole->save();

        /**
         * Create new User Admin
         * ======================
         */
        $adminUser = new User;

        $adminUser->name = "Admin MS";
        $adminUser->email = "admin@ms.com";
        $adminUser->password = bcrypt("rahasiaku");
        $adminUser->gender = 1;
        $adminUser->image = "default-avatar.png";
        $adminUser->save();
        $adminUser->attachRole("admin");

        /**
         * Create new User Member
         * ======================
         */
        $memberUser = new User;

        $memberUser->name = "User MS";
        $memberUser->email = "user@mail.com";
        $memberUser->password = bcrypt("rahasiaku");
        $memberUser->gender = 2;
        $memberUser->image = "default-avatar.png";
        $memberUser->save();
        $memberUser->attachRole('member');
    }
}
