<?php

use App\Models\Role;
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
    $admin = new Role();
    $admin->name = 'Admin';
    $admin->display_name = 'Amministratore';
    $admin->description = 'Utente amministratore del sistema';
    $admin->save();

    $editor = new Role();
    $editor->name = 'Editor';
    $editor->display_name = 'Editor';
    $editor->description = 'Utente utilizzatore del back-office';
    $editor->save();

  }
}
