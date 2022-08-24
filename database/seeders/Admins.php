<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		\App\Models\Admin::create([
			'name' => 'admin',
			'email' => 'A7med@me.com',
			'group_id' => 1,
			'password' => bcrypt('A7med@123'),
		]);

        \App\Models\Admin::create([
			'name' => 'Ragda',
			'email' => 'Ragda@me.com',
			'group_id' => 1,
			'password' => bcrypt('Ragda@123'),
		]);


		if (class_exists(\App\Models\AdminGroupRole::class)) {
			if (class_exists(\App\Models\AdminGroup::class)) {
				if (\App\Models\AdminGroup::where('id', 1)->count() == 0) {
					\App\Models\AdminGroup::UpdateOrCreate([
						'admin_id' => 1,
						'group_name' => 'Full Permission - Admin',
					]);
				}

				// admingroups Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'admingroups',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
				// admins Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'admins',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
				// Settings Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'settings',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

                \App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'locations',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

                \App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'videos',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

                \App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'images',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);


                \App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'categories',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

                \App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'productscontrollrt',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

            
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'colors',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'services',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'favorites',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'contacts',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'sizes',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);

				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'image',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
			}

		}


        	if (class_exists(\App\Models\AdminGroupRole::class)) {
			if (class_exists(\App\Models\AdminGroup::class)) {
				if (\App\Models\AdminGroup::where('id', 1)->count() == 0) {
					\App\Models\AdminGroup::UpdateOrCreate([
						'admin_id' => 1,
						'group_name' => 'Full Permission - Admin',
					]);
				}

				// admingroups Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'admingroups',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
				// admins Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'admins',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
				// Settings Role
				\App\Models\AdminGroupRole::UpdateOrCreate([
					'name' => 'settings',
					'admin_groups_id' => 1,
					'show' => 'yes',
					'add' => 'yes',
					'edit' => 'yes',
					'delete' => 'yes',
				]);
			}

		}
	}
}
