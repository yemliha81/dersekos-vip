<?php 
namespace Database\Seeders;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('tr_TR');

        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName;
            $lastName  = $faker->lastName;

            Student::create([
                'name'  => $firstName . ' ' . $lastName,
                'email'      => $this->generateGmail($firstName, $lastName, $i),
                'password'   => bcrypt('password'),
                'grade'      => $faker->randomElement(['1', '2', '3', '4', '9', '10','11', '12','13','13','13','13','13','13','13','13','13','13',]),
                'address'    => '-',
            ]);
        }
    }

    private function generateGmail($firstName, $lastName, $index)
    {
        // Türkçe karakterleri temizle
        $search  = ['ç','ğ','ı','ö','ş','ü','Ç','Ğ','İ','Ö','Ş','Ü'];
        $replace = ['c','g','i','o','s','u','c','g','i','o','s','u'];

        $firstName = str_replace($search, $replace, strtolower($firstName));
        $lastName  = str_replace($search, $replace, strtolower($lastName));

        return $firstName . '.' . $lastName . $index . '@gmail.com';
    }
}
