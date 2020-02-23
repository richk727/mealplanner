<?

use App\Difficulty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DifficultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('difficulties')->delete();
        Difficulty::create([
            'title' => 'None',
            'level' => 0
        ]);
        Difficulty::create([
            'title' => 'Easy as pie',
            'level' => 1
        ]);
        Difficulty::create([
            'title' => 'Moderately',
            'level' => 2
        ]);
        Difficulty::create([
            'title' => 'Hard as a coconut',
            'level' => 3
        ]);
        Difficulty::create([
            'title' => 'Harder than your grans fruitcake',
            'level' => 4
        ]);
    }
}
