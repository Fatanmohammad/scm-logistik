// database/seeders/UserSeeder.php
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin Utama',   'email' => 'admin@scm.com',   'role' => 'admin'],
            ['name' => 'Budi Manager',  'email' => 'manager@scm.com', 'role' => 'manager'],
            ['name' => 'Citra Staf',    'email' => 'staf@scm.com',    'role' => 'staf'],
        ];

        foreach ($users as $user) {
            User::create([...$user, 'password' => bcrypt('password123')]);
        }
    }
}