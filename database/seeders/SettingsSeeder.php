<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

        $categories_blogs = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إنشاء الروضة'),'name' => 'إنشاء الروضة','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إدارة الروضة'),'name' => 'إدارة الروضة','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب البيداغوجي للروضة'),'name' => 'الجانب البيداغوجي للروضة','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب التربوي'),'name' => 'الجانب التربوي','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب النفسي واللغوي'),'name' => 'الجانب النفسي واللغوي','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('العناية الصحية والغذائية'),'name' => 'العناية الصحية والغذائية','type' => 'blog','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أوراق إدارية'),'name' => 'أوراق إدارية','type' => 'blog','admin_id' => '1'),

        );
        DB::table('categories')->insert($categories_blogs);

        $categories_products = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 1'),'name' => 'القسم 1','type' => 'product','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 2'),'name' => '2 القسم','type' => 'product','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 3'),'name' => '3 القسم','type' => 'product','admin_id' => '1'),
        );
        DB::table('categories')->insert($categories_products);

        $categories_faqs = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إنشاء وتأسيس روضة'),'name' => 'إنشاء وتأسيس روضة','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إدارة وتسيير الروضة'),'name' => 'إدارة وتسيير الروضة','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('التسويق والإشهار'),'name' => 'التسويق والإشهار','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إدارة فريق العمل'),'name' => 'إدارة فريق العمل','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب البيداغوجي والتربوي'),'name' => 'الجانب البيداغوجي والتربوي','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب النفسي والأرطوفوني للطفل'),'name' => 'الجانب النفسي والأرطوفوني للطفل','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مشاكل وحلول مع الأولياء'),'name' => 'مشاكل وحلول مع الأولياء','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('فضاء استفسارات أولياء أطفال الروضة'),'name' => 'فضاء استفسارات أولياء أطفال الروضة','type' => 'faq','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('فضاء المربية'),'name' => 'فضاء المربية','type' => 'faq','admin_id' => '1'),
        );
        DB::table('categories')->insert($categories_faqs);
      
        
        $domaines_conseils = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إنشاء وتأسيس روضة'),'name' => 'إنشاء وتأسيس روضة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إدارة وتسيير الروضة'),'name' => 'إدارة وتسيير الروضة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('التسويق والإشهار'),'name' => 'التسويق والإشهار','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('إدارة فريق العمل'),'name' => 'إدارة فريق العمل','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب البيداغوجي والتربوي'),'name' => 'الجانب البيداغوجي والتربوي','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الجانب النفسي والأرطوفوني للطفل'),'name' => 'الجانب النفسي والأرطوفوني للطفل','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مشاكل وحلول مع الأولياء'),'name' => 'مشاكل وحلول مع الأولياء','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('فضاء استفسارات أولياء أطفال الروضة'),'name' => 'فضاء استفسارات أولياء أطفال الروضة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('فضاء المربية'),'name' => 'فضاء المربية','admin_id' => '1'),
        );
        DB::table('domaines_conseils')->insert($domaines_conseils);

        $domaine_vendeurs = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 1'),'name' => 'القسم 1','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 2'),'name' => '2 القسم','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القسم 3'),'name' => '3 القسم','admin_id' => '1'),
        );
        DB::table('domaine_vendeurs')->insert($domaine_vendeurs);

        $niveau_books = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('كتب التحضيري'),'name' => 'كتب التحضيري','age' => '5 – 6 سنوات'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('كتب التمهيدي'),'name' => 'كتب التمهيدي','age' => '4 – 5 سنوات'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('كتب ما قبل التمهيدي'),'name' => 'كتب ما قبل التمهيدي','age' => '3 – 4 سنوات'),
        );
        DB::table('niveau_books')->insert($niveau_books);

        $emplois = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مدير(ة) للروضة'),'name' => 'مدير(ة) للروضة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مساعد (ة) إداري'),'name' => 'مساعد (ة) إداري','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مربية روضة'),'name' => 'مربية روضة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مربية مساعدة'),'name' => 'مربية مساعدة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مربية منتيسوري'),'name' => 'مربية منتيسوري','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مربية منتيسوري'),'name' => 'مربية منتيسوري','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('معلمة فرنسية'),'name' => 'معلمة فرنسية','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('معلمة انجليزية'),'name' => 'معلمة انجليزية','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('معلمة أمازيغية'),'name' => 'معلمة أمازيغية','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('سكرتيرة'),'name' => 'سكرتيرة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('طباخة'),'name' => 'طباخة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('عاملة النظافة'),'name' => 'عاملة النظافة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مساعد (ة) متعدد الخدمات'),'name' => 'مساعد (ة) متعدد الخدمات','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('طبيب (ة) متعاقد'),'name' => 'طبيب (ة) متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('طبيب (ة) أسنان متعاقد'),'name' => 'طبيب (ة) أسنان متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أخصائي (ة) نفساني (موظف)'),'name' => 'أخصائي (ة) نفساني (موظف)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أخصائي (ة) نفساني (متعاقد)'),'name' => 'أخصائي (ة) نفساني (متعاقد)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أخصائي (ة) أرطوفوني (موظف)'),'name' => 'أخصائي (ة) أرطوفوني (موظف)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أخصائي (ة) أرطوفوني (متعاقد)'),'name' => 'أخصائي (ة) أرطوفوني (متعاقد)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مهرج (ة)'),'name' => 'مهرج (ة)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('منشّط (ة)'),'name' => 'منشّط (ة)','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('محاسب(ة) متعاقد'),'name' => 'محاسب(ة) متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('محامي(ة) متعاقد'),'name' => 'محامي(ة) متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('سائق بدون حافلة'),'name' => 'سائق بدون حافلة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('سائق بالحافلة'),'name' => 'سائق بالحافلة','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('عون أمن بالنهار'),'name' => 'عون أمن بالنهار','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('حارس ليلي'),'name' => 'حارس ليلي','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مصوّر متعاقد'),'name' => 'مصوّر متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مسوّق رقمي متعاقد'),'name' => 'مسوّق رقمي متعاقد','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مصمم إعلانات'),'name' => 'مصمم إعلانات','admin_id' => '1'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('وظيفة أخرى (أذكرها).'),'name' => 'وظيفة أخرى (أذكرها).','admin_id' => '1'),

        );
        DB::table('emplois')->insert($emplois);
        
        $programmes_creches = array(
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('برنامجي الخاص'),'name' => 'برنامجي الخاص'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('برنامج المرشد'),'name' => 'برنامج المرشد'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('الميثاق '),'name' => 'الميثاق '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مداد '),'name' => 'مداد '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مستقبلي '),'name' => 'مستقبلي '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('خطواتي الأولى '),'name' => 'خطواتي الأولى '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('النهار '),'name' => 'النهار '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('دار أسامة '),'name' => 'دار أسامة '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('منتسوري '),'name' => 'منتسوري '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('القارئ الصغير'),'name' => 'القارئ الصغير'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('Jelis '),'name' => 'Jelis '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('welcome '),'name' => 'welcome '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('برنامج آخر '),'name' => 'برنامج آخر '),
        );
        DB::table('programmes_creches')->insert($programmes_creches);


        $types_users = array(

            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مدير(ة) روضة '),'name' => 'مدير(ة) روضة '),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مربية روضة'),'name' => 'مربية روضة'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أعمل في روضة'),'name' => 'أعمل في روضة'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('أريد فتح روضة'),'name' => 'أريد فتح روضة'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('ولي طفل بالروضة'),'name' => 'ولي طفل بالروضة'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('مهتم بالمجال'),'name' => 'مهتم بالمجال'),
            array('uuid' => (string) Uuid::uuid4(),'slug' => Str::slug('آخر'),'name' => 'آخر'),

        );
        DB::table('types_users')->insert($types_users);
      
        
    }
}
