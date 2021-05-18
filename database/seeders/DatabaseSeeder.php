<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DatabaseSeeder extends Seeder
{
    use HasFactory;
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role_writer = Role::create(['name' => 'writer']);
        $role_writer->givePermissionTo('edit articles');


        //* Si può scrivere anche come statement separati o come array:
        // $role_writer = Role::create(['name' => 'writer']);
        // $role_writer->givePermissionTo('edit articles', 'delete articles','publish articles');
        // Oppure:
        // $role_writer->givePermissionTo(['edit articles', 'delete articles','publish articles']);

        $role_editor = Role::create(['name' => 'editor']);
        $role_editor->givePermissionTo('edit articles');
        $role_editor->givePermissionTo('publish articles');
        $role_editor->givePermissionTo('unpublish articles');

        $role_s_admin = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider



        //* create demo users
        // $user = User::factory()->create(); // factory default password is 'password' if needed
        // $user->assignRole($role_writer);
        // $article = Article::factory()->create([
        //     'user_id' => $user->id
        // ]);


        // $user = User::factory()->create();
        // $article = Article::factory()->create([
        //     'user_id' => $user->id
        // ]);
        // $user->assignRole($role_editor);

        // $user = User::factory()->create();
        // $article = Article::factory()->create([
        //     'user_id' => $user->id
        // ]);
        // $user->assignRole($role_admin);


        $user = User::factory()
            ->count(5)
            ->has(Article::factory()->count(3))
            ->hasAttached($role_writer)
            ->create();

        $user = User::factory()
            ->count(3)
            ->has(Article::factory()->count(2))
            ->hasAttached($role_editor)
            ->create();
    }
}
