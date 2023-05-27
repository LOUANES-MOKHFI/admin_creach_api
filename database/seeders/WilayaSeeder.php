<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayas = array(
            array('id' => '1','code_postal' => '1','name' => 'أدرار'),
            array('id' => '2','code_postal' => '2','name' => 'الشلف'),
            array('id' => '3','code_postal' => '3','name' => 'الأغواط'),
            array('id' => '4','code_postal' => '4','name' => 'أم البواقي'),
            array('id' => '5','code_postal' => '5','name' => 'باتنة'),
            array('id' => '6','code_postal' => '6','name' => 'بجاية'),
            array('id' => '7','code_postal' => '7','name' => 'بسكرة'),
            array('id' => '8','code_postal' => '8','name' => 'بشار'),
            array('id' => '9','code_postal' => '9','name' => 'البليدة'),
            array('id' => '10','code_postal' => '10','name' => 'البويرة'),
            array('id' => '11','code_postal' => '11','name' => 'تمنراست'),
            array('id' => '12','code_postal' => '12','name' => 'تبسة'),
            array('id' => '13','code_postal' => '13','name' => 'تلمسان'),
            array('id' => '14','code_postal' => '14','name' => 'تيارت'),
            array('id' => '15','code_postal' => '15','name' => 'تيزي وزو'),
            array('id' => '16','code_postal' => '16','name' => 'الجزائر'),
            array('id' => '17','code_postal' => '17','name' => 'الجلفة'),
            array('id' => '18','code_postal' => '18','name' => 'جيجل'),
            array('id' => '19','code_postal' => '19','name' => 'سطيف'),
            array('id' => '20','code_postal' => '20','name' => 'سعيدة'),
            array('id' => '21','code_postal' => '21','name' => 'سكيكدة'),
            array('id' => '22','code_postal' => '22','name' => 'سيدي بلعباس'),
            array('id' => '23','code_postal' => '23','name' => 'عنابة'),
            array('id' => '24','code_postal' => '24','name' => 'قالمة'),
            array('id' => '25','code_postal' => '25','name' => 'قسنطينة'),
            array('id' => '26','code_postal' => '26','name' => 'المدية'),
            array('id' => '27','code_postal' => '27','name' => 'مستغانم'),
            array('id' => '28','code_postal' => '28','name' => 'المسيلة'),
            array('id' => '29','code_postal' => '29','name' => 'معسكر'),
            array('id' => '30','code_postal' => '30','name' => 'ورقلة'),
            array('id' => '31','code_postal' => '31','name' => 'وهران'),
            array('id' => '32','code_postal' => '32','name' => 'البيض'),
            array('id' => '33','code_postal' => '33','name' => 'إليزي'),
            array('id' => '34','code_postal' => '34','name' => 'برج بوعريريج'),
            array('id' => '35','code_postal' => '35','name' => 'بومرداس'),
            array('id' => '36','code_postal' => '36','name' => 'الطارف'),
            array('id' => '37','code_postal' => '37','name' => 'تندوف'),
            array('id' => '38','code_postal' => '38','name' => 'تيسمسيلت'),
            array('id' => '39','code_postal' => '39','name' => 'الوادي'),
            array('id' => '40','code_postal' => '40','name' => 'خنشلة'),
            array('id' => '41','code_postal' => '41','name' => 'سوق أهراس'),
            array('id' => '42','code_postal' => '42','name' => 'تيبازة'),
            array('id' => '43','code_postal' => '43','name' => 'ميلة'),
            array('id' => '44','code_postal' => '44','name' => 'عين الدفلى'),
            array('id' => '45','code_postal' => '45','name' => 'النعامة'),
            array('id' => '46','code_postal' => '46','name' => 'عين تموشنت'),
            array('id' => '47','code_postal' => '47','name' => 'غرداية'),
            array('id' => '48','code_postal' => '48','name' => 'غليزان'),
            array('id' => '49','code_postal' => '49','name' => 'المغير'),
            array('id' => '50','code_postal' => '50','name' => 'المنيعة'),
            array('id' => '51','code_postal' => '51','name' => 'أولاد جلال'),
            array('id' => '52','code_postal' => '52','name' => 'برج باجي مختار'),
            array('id' => '53','code_postal' => '53','name' => 'بني عباس'),
            array('id' => '54','code_postal' => '54','name' => 'تيميمون'),
            array('id' => '55','code_postal' => '55','name' => 'تقرت'),
            array('id' => '56','code_postal' => '56','name' => 'جانت'),
            array('id' => '57','code_postal' => '57','name' => 'عين صالح'),
            array('id' => '58','code_postal' => '58','name' => 'عين قزام'),
          );
          DB::table('wilayas')->insert($wilayas);
    }
}
