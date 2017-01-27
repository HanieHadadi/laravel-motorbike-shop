<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product')->delete();
        
        \DB::table('product')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'دوچرخه ویوا Sammi سایز 16',
                'description' => '- ست دنده  : آلومینیوم
- تایر : Kenda
- سایز : 16',
                'image' => '588b84779c741.jpeg',
                'created_at' => '2017-01-27 17:33:43',
                'updated_at' => '2017-01-27 17:33:43',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'دوچرخه ویوا V12 سایز 12',
                'description' => '- سایز 12
- ست دنده : آلومینیوم
- جنسیت : بچه ‌گانه
- سایز فریم : 12 اینچ
- جنس فریم : آهن
- سیستم تعلیق : Hard Tail
- نوع ترمز: لقمه‌ ای
- دارای رکاب
- جنس کرپی آهن
- جنس پنجه رکاب پلاستیک
- دارای سبد، صندوق و بغل ‌بند ',
                'image' => '588b85e9dd863.jpeg',
                'created_at' => '2017-01-27 17:39:53',
                'updated_at' => '2017-01-27 17:39:53',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'دوچرخه ویوا Alice',
                'description' => ' مدل : ALICE
- نوع آلیاژ بدنه : آلومینیوم
- برای رده سنی 8 تا 12 سال
- تایر : Kenda',
                'image' => '588b87c7e4321.jpg',
                'created_at' => '2017-01-27 17:47:51',
                'updated_at' => '2017-01-27 17:47:51',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'دوچرخه ویوا Vortex',
                'description' => '- نوع آلیاژ بدنه : آلومینیوم
- ست دنده : کلاجدار - Tourny
- تعداد دنده : 21 دنده
- توپ تنه بلبرینگی
- دوشاخه ZOOM
- شانژمان شیمانو ترنی 21SPEED
- دست دنده کلاجدار EF51
- طبق قامه PROWHEEL
- فرمان و کرپی آلومینیوم ZOOM
- تایر KENDA 2.35
- زین ویوا',
                'image' => '588b95f0b4f0f.jpg',
                'created_at' => '2017-01-27 18:48:16',
                'updated_at' => '2017-01-27 18:48:16',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'دوچرخه کودک 103',
                'description' => 'دوچرخه مناسب کودکان زیر 10 سال به همراه چرخ کمکی ',
                'image' => '588b9691b911b.jpg',
                'created_at' => '2017-01-27 18:50:57',
                'updated_at' => '2017-01-27 18:50:57',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'دوچرخه KTM scarp 29 prime ',
                'description' => '- بدنه : کربن
- دو شاخ : Rock shox Rs-129-100
- ترمز : D-Hyder-M8000
- XTR : RD
- 2f = دو طبق = 20 سرعته',
                'image' => '588b97006eb06.jpg',
                'created_at' => '2017-01-27 18:52:48',
                'updated_at' => '2017-01-27 18:52:48',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'دوچرخه KTM life joy 24G HE 2016',
                'description' => '- بدنه : آلومینیوم
- دو شاخ : SR-Suntour SF CR8V-700
- ترمز : V-brake -T837
- Altus : RD',
                'image' => '588b97eb0868b.jpg',
                'created_at' => '2017-01-27 18:56:43',
                'updated_at' => '2017-01-27 18:56:43',
            ),
        ));
        
        
    }
}