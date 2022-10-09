<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
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
				'name' => 'dashboard',
				'display_name' => 'Dashboard'
			],

			[
				'name' => 'admin',
				'display_name' => 'Admin'
			],

			[
				'name' => 'seller',
				'display_name' => 'Seller'
			],

			[
				'name' => 'delivery_boy',
				'display_name' => 'Delivery Boy'
			],

			[
				'name' => 'banner',
				'display_name' => 'Banner'
			],

			[
				'name' => 'city',
				'display_name' => 'City'
			],

			[
				'name' => 'area',
				'display_name' => 'Area'
			],

			[
				'name' => 'area_banner',
				'display_name' => 'Area Banner'
			],

			[
				'name' => 'main_category',
				'display_name' => 'Main Category'
			],

			[
				'name' => 'category',
				'display_name' => 'Category'
			],

			[
				'name' => 'sub_category',
				'display_name' => 'Sub Category'
			],

			[
				'name' => 'sub_sub_sategory',
				'display_name' => 'Sub Sub Category'
			],

			[
				'name' => 'products',
				'display_name' => 'Products'
			],

			[
				'name' => 'brand',
				'display_name' => 'Brand'
			],

			[
				'name' => 'membership_plan',
				'display_name' => 'Membership Plan'
			],

			[
				'name' => 'pages',
				'display_name' => 'Pages'
			],

			[
				'name' => 'faq',
				'display_name' => 'Faq'
			],

			[
				'name' => 'contact_us',
				'display_name' => 'Contact Us'
			],

			[
				'name' => 'coupons',
				'display_name' => 'Coupons'
			],

			[
				'name' => 'store_settings',
				'display_name' => 'Store Settings'
			],

			[
				'name' => 'measurement',
				'display_name' => 'Measurement'
			],

			[
				'name' => 'customers',
				'display_name' => 'Customers'
			],

			[
				'name' => 'reviews',
				'display_name' => 'Reviews'
			],

			[
				'name' => 'orders',
				'display_name' => 'Orders'
			],

			[
				'name' => 'notifications',
				'display_name' => 'Notifications'
			],

			[
				'name' => 'seller_tags',
				'display_name' => 'Seller Tags'
			],

        ];


        foreach ($permissions as $permission_id => $permsion) {
			$permission = Permission::firstOrNew([
				'id' => $permission_id,
			]);
			$permission->fill($permsion);
			$permission->save();
		}
    }
}
