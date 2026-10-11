<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::truncate();

        // ═══════════════════════════════════════════════════════
        // SMA se-Kabupaten Gresik (52 Sekolah)
        // ═══════════════════════════════════════════════════════
        $sma = [
            // ── Negeri ──
            ['name'=>'SMA Negeri 1 Gresik',           'npsn'=>'20500612','address'=>'Jl. Arif Rahman Hakim No.1, Kec. Gresik',             'status'=>'Negeri','jumlah_guru'=>62,'jumlah_siswa'=>1152,'jumlah_prestasi'=>38],
            ['name'=>'SMA Negeri 1 Kebomas',           'npsn'=>'20500611','address'=>'Jl. Dr. Wahidin Sudirohusodo, Kec. Kebomas',           'status'=>'Negeri','jumlah_guru'=>56,'jumlah_siswa'=>1032,'jumlah_prestasi'=>27],
            ['name'=>'SMA Negeri 1 Driyorejo',         'npsn'=>'20500609','address'=>'Jl. Raya Driyorejo, Kec. Driyorejo',                   'status'=>'Negeri','jumlah_guru'=>48,'jumlah_siswa'=>920, 'jumlah_prestasi'=>18],
            ['name'=>'SMA Negeri 1 Cerme',             'npsn'=>'20500608','address'=>'Jl. Raya Cerme Lor, Kec. Cerme',                       'status'=>'Negeri','jumlah_guru'=>44,'jumlah_siswa'=>856, 'jumlah_prestasi'=>15],
            ['name'=>'SMA Negeri 1 Bungah',            'npsn'=>'20500606','address'=>'Jl. Raya Bungah, Kec. Bungah',                         'status'=>'Negeri','jumlah_guru'=>42,'jumlah_siswa'=>784, 'jumlah_prestasi'=>12],
            ['name'=>'SMA Negeri 1 Sidayu',            'npsn'=>'20500605','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                         'status'=>'Negeri','jumlah_guru'=>38,'jumlah_siswa'=>720, 'jumlah_prestasi'=>11],
            ['name'=>'SMA Negeri 1 Panceng',           'npsn'=>'20500604','address'=>'Jl. Raya Panceng, Kec. Panceng',                       'status'=>'Negeri','jumlah_guru'=>36,'jumlah_siswa'=>684, 'jumlah_prestasi'=>9],
            ['name'=>'SMA Negeri 1 Dukun',             'npsn'=>'20500603','address'=>'Jl. Raya Dukun, Kec. Dukun',                           'status'=>'Negeri','jumlah_guru'=>34,'jumlah_siswa'=>640, 'jumlah_prestasi'=>7],
            ['name'=>'SMA Negeri 1 Benjeng',           'npsn'=>'20500602','address'=>'Jl. Raya Benjeng, Kec. Benjeng',                       'status'=>'Negeri','jumlah_guru'=>32,'jumlah_siswa'=>598, 'jumlah_prestasi'=>6],
            ['name'=>'SMA Negeri 1 Balongpanggang',    'npsn'=>'20500601','address'=>'Jl. Raya Balongpanggang, Kec. Balongpanggang',         'status'=>'Negeri','jumlah_guru'=>30,'jumlah_siswa'=>556, 'jumlah_prestasi'=>5],
            // ── Swasta ──
            ['name'=>'SMA Muhammadiyah 1 Gresik',      'npsn'=>'20500570','address'=>'Jl. KH. Kholil No.21, Kec. Gresik',                   'status'=>'Swasta','jumlah_guru'=>28,'jumlah_siswa'=>480, 'jumlah_prestasi'=>14],
            ['name'=>'SMA Muhammadiyah 2 Gresik',      'npsn'=>'20500571','address'=>'Jl. Proklamasi No.45, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>24,'jumlah_siswa'=>396, 'jumlah_prestasi'=>8],
            ['name'=>'SMA Muhammadiyah Kebomas',       'npsn'=>'20500572','address'=>'Jl. Raya Kebomas, Kec. Kebomas',                       'status'=>'Swasta','jumlah_guru'=>22,'jumlah_siswa'=>350, 'jumlah_prestasi'=>6],
            ['name'=>'SMA Muhammadiyah Bungah',        'npsn'=>'20500573','address'=>'Jl. Raya Bungah No.15, Kec. Bungah',                   'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>290, 'jumlah_prestasi'=>4],
            ['name'=>'SMA Muhammadiyah Driyorejo',     'npsn'=>'20500574','address'=>'Jl. Raya Driyorejo No.8, Kec. Driyorejo',              'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>240, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Sunan Giri Gresik',          'npsn'=>'20500575','address'=>'Jl. Sunan Giri No.5, Kec. Kebomas',                    'status'=>'Swasta','jumlah_guru'=>22,'jumlah_siswa'=>360, 'jumlah_prestasi'=>6],
            ['name'=>'SMA PGRI 1 Gresik',              'npsn'=>'20500576','address'=>'Jl. Raya Gresik No.12, Kec. Gresik',                   'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>320, 'jumlah_prestasi'=>4],
            ['name'=>'SMA PGRI Kebomas',               'npsn'=>'20500577','address'=>'Jl. Kebomas Raya No.7, Kec. Kebomas',                  'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>280, 'jumlah_prestasi'=>3],
            ["name"=>"SMA Assa'adah Bungah",           'npsn'=>'20500578','address'=>'Jl. Raya Bungah No.112, Kec. Bungah',                  'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>288, 'jumlah_prestasi'=>5],
            ['name'=>'SMA Nahdlatul Ulama 1 Gresik',   'npsn'=>'20500579','address'=>'Jl. KH. Wachid Hasyim No.3, Kec. Gresik',             'status'=>'Swasta','jumlah_guru'=>24,'jumlah_siswa'=>400, 'jumlah_prestasi'=>9],
            ['name'=>'SMA NU Bungah',                  'npsn'=>'20500580','address'=>'Jl. Sunan Prapen, Kec. Bungah',                        'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>260, 'jumlah_prestasi'=>4],
            ['name'=>'SMA NU Sidayu',                  'npsn'=>'20500581','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                         'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>220, 'jumlah_prestasi'=>3],
            ['name'=>'SMA NU Panceng',                 'npsn'=>'20500582','address'=>'Jl. Raya Panceng No.20, Kec. Panceng',                 'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>210, 'jumlah_prestasi'=>3],
            ['name'=>'SMA NU Dukun',                   'npsn'=>'20500583','address'=>'Jl. Raya Dukun No.5, Kec. Dukun',                     'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>185, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Al-Hikmah Gresik',           'npsn'=>'20500584','address'=>'Jl. Al-Hikmah No.1, Kec. Gresik',                     'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>310, 'jumlah_prestasi'=>7],
            ['name'=>'SMA Al-Fattah Gresik',           'npsn'=>'20500585','address'=>'Jl. Al-Fattah, Kec. Gresik',                          'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>248, 'jumlah_prestasi'=>4],
            ['name'=>'SMA Islam Gresik',               'npsn'=>'20500586','address'=>'Jl. Raya Gresik-Lamongan, Kec. Manyar',               'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>276, 'jumlah_prestasi'=>5],
            ['name'=>'SMA Islam Kebomas',              'npsn'=>'20500587','address'=>'Jl. Raya Kebomas, Kec. Kebomas',                       'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>240, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Ma\'arif 1 Gresik',          'npsn'=>'20500588','address'=>'Jl. Pahlawan No.3, Kec. Gresik',                      'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>310, 'jumlah_prestasi'=>6],
            ['name'=>'SMA Ma\'arif Bungah',            'npsn'=>'20500589','address'=>'Jl. Raya Bungah No.41, Kec. Bungah',                  'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>215, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Ma\'arif Sidayu',            'npsn'=>'20500553','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                        'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>190, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Ma\'arif Dukun',             'npsn'=>'20500554','address'=>'Jl. Raya Dukun, Kec. Dukun',                          'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>180, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Ma\'arif Panceng',           'npsn'=>'20500555','address'=>'Jl. Raya Panceng, Kec. Panceng',                      'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>175, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Ma\'arif Cerme',             'npsn'=>'20500556','address'=>'Jl. Raya Cerme, Kec. Cerme',                          'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>210, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Tarbiyatut Thalabah',        'npsn'=>'20500557','address'=>'Jl. Kranji No.1, Kec. Duduksampeyan',                 'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>248, 'jumlah_prestasi'=>5],
            ['name'=>'SMA Plus Rahmat Gresik',         'npsn'=>'20500558','address'=>'Jl. Raya Gresik, Kec. Gresik',                        'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>220, 'jumlah_prestasi'=>4],
            ['name'=>'SMA Wachid Hasyim Gresik',       'npsn'=>'20500559','address'=>'Jl. KH. Wachid Hasyim, Kec. Gresik',                  'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>275, 'jumlah_prestasi'=>5],
            ['name'=>'SMA Mamba\'us Sholihin Manyar',  'npsn'=>'20500560','address'=>'Jl. Suci No.10, Kec. Manyar',                         'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>215, 'jumlah_prestasi'=>4],
            ['name'=>'SMA Ihya\'ul Ulum Dukun',        'npsn'=>'20500561','address'=>'Jl. Raya Dukun No.20, Kec. Dukun',                    'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>182, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Miftahul Ulum Benjeng',      'npsn'=>'20500562','address'=>'Jl. Raya Benjeng, Kec. Benjeng',                      'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>155, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Qomaruddin Bungah',          'npsn'=>'20500563','address'=>'Jl. Sunan Giri No.8, Kec. Bungah',                    'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>218, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Kesatrian Gresik',           'npsn'=>'20500564','address'=>'Jl. Raya Gresik No.55, Kec. Gresik',                  'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>185, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Roudlotul Ulum Gresik',      'npsn'=>'20500565','address'=>'Jl. Roudlotul Ulum, Kec. Gresik',                     'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>160, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Darul Hikmah Menganti',      'npsn'=>'20500566','address'=>'Jl. Raya Menganti, Kec. Menganti',                    'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>215, 'jumlah_prestasi'=>3],
            ['name'=>'SMA Darul Ulum Driyorejo',       'npsn'=>'20500567','address'=>'Jl. Raya Driyorejo No.34, Kec. Driyorejo',            'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>188, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Hayatan Thayyibah Gresik',   'npsn'=>'20500568','address'=>'Jl. Pahlawan No.10, Kec. Gresik',                     'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>152, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Yayasan Islam Sidayu',       'npsn'=>'20500569','address'=>'Jl. Raya Sidayu No.33, Kec. Sidayu',                  'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>148, 'jumlah_prestasi'=>1],
            ['name'=>'SMA Islam Menganti',             'npsn'=>'20500520','address'=>'Jl. Raya Menganti, Kec. Menganti',                    'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>186, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Islam Balongpanggang',       'npsn'=>'20500521','address'=>'Jl. Raya Balongpanggang, Kec. Balongpanggang',        'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>150, 'jumlah_prestasi'=>1],
            ['name'=>'SMA Islam Duduksampeyan',        'npsn'=>'20500522','address'=>'Jl. Raya Duduksampeyan, Kec. Duduksampeyan',          'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>145, 'jumlah_prestasi'=>1],
            ['name'=>'SMA Al-Khoiriyah Bawean',        'npsn'=>'20500523','address'=>'Jl. Raya Sangkapura, Kec. Sangkapura, Bawean',        'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>190, 'jumlah_prestasi'=>2],
            ['name'=>'SMA Diponegoro Bawean',          'npsn'=>'20500524','address'=>'Jl. Raya Tambak, Kec. Tambak, Bawean',               'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>155, 'jumlah_prestasi'=>1],
        ];

        // ═══════════════════════════════════════════════════════
        // SMK se-Kabupaten Gresik (62 Sekolah)
        // ═══════════════════════════════════════════════════════
        $smk = [
            // ── Negeri ──
            ['name'=>'SMK Negeri 1 Gresik',            'npsn'=>'20500650','address'=>'Jl. Arif Rahman Hakim No.9, Kec. Gresik',            'status'=>'Negeri','jumlah_guru'=>72,'jumlah_siswa'=>1440,'jumlah_prestasi'=>45],
            ['name'=>'SMK Negeri 2 Gresik',            'npsn'=>'20500651','address'=>'Jl. Dr. Wahidin Sudirohusodo, Kec. Kebomas',          'status'=>'Negeri','jumlah_guru'=>64,'jumlah_siswa'=>1280,'jumlah_prestasi'=>32],
            ['name'=>'SMK Negeri 1 Cerme',             'npsn'=>'20500652','address'=>'Jl. Raya Cerme, Kec. Cerme',                         'status'=>'Negeri','jumlah_guru'=>58,'jumlah_siswa'=>1180,'jumlah_prestasi'=>22],
            ['name'=>'SMK Negeri 1 Driyorejo',         'npsn'=>'20500653','address'=>'Jl. Raya Driyorejo, Kec. Driyorejo',                 'status'=>'Negeri','jumlah_guru'=>52,'jumlah_siswa'=>1020,'jumlah_prestasi'=>19],
            ['name'=>'SMK Negeri 1 Manyar',            'npsn'=>'20500654','address'=>'Jl. Raya Manyar, Kec. Manyar',                       'status'=>'Negeri','jumlah_guru'=>48,'jumlah_siswa'=>960, 'jumlah_prestasi'=>16],
            ['name'=>'SMK Negeri 1 Panceng',           'npsn'=>'20500655','address'=>'Jl. Raya Panceng, Kec. Panceng',                     'status'=>'Negeri','jumlah_guru'=>44,'jumlah_siswa'=>880, 'jumlah_prestasi'=>13],
            ['name'=>'SMK Negeri 1 Benjeng',           'npsn'=>'20500656','address'=>'Jl. Raya Benjeng, Kec. Benjeng',                     'status'=>'Negeri','jumlah_guru'=>40,'jumlah_siswa'=>780, 'jumlah_prestasi'=>10],
            ['name'=>'SMK Negeri 1 Bungah',            'npsn'=>'20500657','address'=>'Jl. Raya Bungah, Kec. Bungah',                       'status'=>'Negeri','jumlah_guru'=>38,'jumlah_siswa'=>740, 'jumlah_prestasi'=>9],
            ['name'=>'SMK Negeri 1 Sidayu',            'npsn'=>'20500658','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                       'status'=>'Negeri','jumlah_guru'=>36,'jumlah_siswa'=>700, 'jumlah_prestasi'=>8],
            ['name'=>'SMK Negeri 1 Menganti',          'npsn'=>'20500659','address'=>'Jl. Raya Menganti, Kec. Menganti',                   'status'=>'Negeri','jumlah_guru'=>44,'jumlah_siswa'=>860, 'jumlah_prestasi'=>12],
            ['name'=>'SMK Negeri 1 Duduksampeyan',     'npsn'=>'20500660','address'=>'Jl. Raya Duduksampeyan, Kec. Duduksampeyan',         'status'=>'Negeri','jumlah_guru'=>34,'jumlah_siswa'=>660, 'jumlah_prestasi'=>7],
            ['name'=>'SMK Negeri 1 Wringinanom',       'npsn'=>'20500661','address'=>'Jl. Raya Wringinanom, Kec. Wringinanom',             'status'=>'Negeri','jumlah_guru'=>36,'jumlah_siswa'=>700, 'jumlah_prestasi'=>8],
            ['name'=>'SMK Negeri 1 Balongpanggang',    'npsn'=>'20500662','address'=>'Jl. Raya Balongpanggang, Kec. Balongpanggang',       'status'=>'Negeri','jumlah_guru'=>32,'jumlah_siswa'=>620, 'jumlah_prestasi'=>6],
            // ── Swasta ──
            ['name'=>'SMK Muhammadiyah 1 Gresik',      'npsn'=>'20500601','address'=>'Jl. KH. Kholil No.23, Kec. Gresik',                  'status'=>'Swasta','jumlah_guru'=>36,'jumlah_siswa'=>720, 'jumlah_prestasi'=>18],
            ['name'=>'SMK Muhammadiyah 2 Gresik',      'npsn'=>'20500602','address'=>'Jl. Proklamasi No.23, Kec. Gresik',                   'status'=>'Swasta','jumlah_guru'=>28,'jumlah_siswa'=>560, 'jumlah_prestasi'=>12],
            ['name'=>'SMK Muhammadiyah Cerme',         'npsn'=>'20500603','address'=>'Jl. Raya Cerme, Kec. Cerme',                         'status'=>'Swasta','jumlah_guru'=>22,'jumlah_siswa'=>440, 'jumlah_prestasi'=>7],
            ['name'=>'SMK Muhammadiyah Driyorejo',     'npsn'=>'20500604','address'=>'Jl. Raya Driyorejo, Kec. Driyorejo',                 'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>400, 'jumlah_prestasi'=>6],
            ['name'=>'SMK NU 1 Gresik',                'npsn'=>'20500605','address'=>'Jl. Raya Kebomas, Kec. Kebomas',                      'status'=>'Swasta','jumlah_guru'=>30,'jumlah_siswa'=>600, 'jumlah_prestasi'=>12],
            ['name'=>'SMK NU 2 Gresik',                'npsn'=>'20500606','address'=>'Jl. Pahlawan, Kec. Gresik',                          'status'=>'Swasta','jumlah_guru'=>24,'jumlah_siswa'=>480, 'jumlah_prestasi'=>8],
            ['name'=>'SMK NU Bungah',                  'npsn'=>'20500607','address'=>'Jl. Raya Bungah, Kec. Bungah',                       'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>400, 'jumlah_prestasi'=>5],
            ['name'=>'SMK NU Sidayu',                  'npsn'=>'20500608','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                       'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>4],
            ['name'=>'SMK NU Cerme',                   'npsn'=>'20500609','address'=>'Jl. Raya Cerme, Kec. Cerme',                         'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>320, 'jumlah_prestasi'=>4],
            ['name'=>'SMK NU Manyar',                  'npsn'=>'20500610','address'=>'Jl. Raya Manyar, Kec. Manyar',                       'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>4],
            ['name'=>'SMK Sunan Giri Gresik',          'npsn'=>'20500611','address'=>'Jl. Sunan Giri No.10, Kec. Kebomas',                  'status'=>'Swasta','jumlah_guru'=>28,'jumlah_siswa'=>560, 'jumlah_prestasi'=>9],
            ['name'=>'SMK PGRI 1 Gresik',              'npsn'=>'20500612','address'=>'Jl. Raya Gresik, Kec. Gresik',                       'status'=>'Swasta','jumlah_guru'=>22,'jumlah_siswa'=>440, 'jumlah_prestasi'=>6],
            ['name'=>'SMK PGRI Kebomas',               'npsn'=>'20500613','address'=>'Jl. Kebomas Raya, Kec. Kebomas',                     'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>4],
            ['name'=>'SMK Bina Bangsa Gresik',         'npsn'=>'20500614','address'=>'Jl. Mayjen Sungkono, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>26,'jumlah_siswa'=>520, 'jumlah_prestasi'=>8],
            ['name'=>'SMK Teknik Gresik',              'npsn'=>'20500615','address'=>'Jl. Raya Gresik-Surabaya, Kec. Kebomas',             'status'=>'Swasta','jumlah_guru'=>24,'jumlah_siswa'=>480, 'jumlah_prestasi'=>7],
            ['name'=>'SMK Ma\'arif 1 Gresik',          'npsn'=>'20500616','address'=>'Jl. Pahlawan No.5, Kec. Gresik',                     'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>400, 'jumlah_prestasi'=>5],
            ['name'=>'SMK Ma\'arif Bungah',            'npsn'=>'20500617','address'=>'Jl. Raya Bungah, Kec. Bungah',                       'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>320, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Ma\'arif Sidayu',            'npsn'=>'20500618','address'=>'Jl. Raya Sidayu, Kec. Sidayu',                       'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>280, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Ma\'arif Panceng',           'npsn'=>'20500619','address'=>'Jl. Raya Panceng, Kec. Panceng',                     'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>275, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Ma\'arif Cerme',             'npsn'=>'20500620','address'=>'Jl. Raya Cerme, Kec. Cerme',                         'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>270, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Islam Nurul Amanah Panceng',  'npsn'=>'20500621','address'=>'Jl. Raya Panceng No.33, Kec. Panceng',              'status'=>'Swasta','jumlah_guru'=>20,'jumlah_siswa'=>380, 'jumlah_prestasi'=>5],
            ['name'=>'SMK Islam Menganti',             'npsn'=>'20500622','address'=>'Jl. Raya Menganti, Kec. Menganti',                   'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>4],
            ['name'=>'SMK Islam Balongpanggang',       'npsn'=>'20500623','address'=>'Jl. Raya Balongpanggang, Kec. Balongpanggang',       'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>280, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Islam Benjeng',              'npsn'=>'20500624','address'=>'Jl. Raya Benjeng, Kec. Benjeng',                     'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>275, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Qomaruddin Bungah',          'npsn'=>'20500625','address'=>'Jl. Sunan Giri, Kec. Bungah',                        'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>4],
            ['name'=>'SMK Tarbiyatut Thalabah',        'npsn'=>'20500626','address'=>'Jl. Kranji, Kec. Duduksampeyan',                     'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>320, 'jumlah_prestasi'=>4],
            ['name'=>"SMK Assa'adah Bungah",           'npsn'=>'20500627','address'=>'Jl. Raya Bungah No.100, Kec. Bungah',               'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>316, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Wachid Hasyim Gresik',       'npsn'=>'20500628','address'=>'Jl. KH. Wachid Hasyim, Kec. Gresik',                 'status'=>'Swasta','jumlah_guru'=>18,'jumlah_siswa'=>360, 'jumlah_prestasi'=>5],
            ['name'=>'SMK Darul Hikmah Menganti',      'npsn'=>'20500629','address'=>'Jl. Raya Menganti No.22, Kec. Menganti',             'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>320, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Mamba\'us Sholihin Manyar',  'npsn'=>'20500630','address'=>'Jl. Suci No.10, Kec. Manyar',                        'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>312, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Persiapan Gresik',           'npsn'=>'20500631','address'=>'Jl. Raya Gresik, Kec. Gresik',                       'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>275, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Bahari Gresik',              'npsn'=>'20500632','address'=>'Jl. Pelabuhan No.5, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>310, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Kesatrian Gresik',           'npsn'=>'20500633','address'=>'Jl. Pahlawan No.44, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>240, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Miftahul Ulum Driyorejo',    'npsn'=>'20500634','address'=>'Jl. Raya Driyorejo, Kec. Driyorejo',                 'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>278, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Al-Khairiyah Manyar',        'npsn'=>'20500635','address'=>'Jl. Raya Manyar, Kec. Manyar',                       'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>240, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Ihya\'ul Ulum Dukun',        'npsn'=>'20500636','address'=>'Jl. Raya Dukun No.18, Kec. Dukun',                   'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>235, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Modern Al-Amanah Gresik',    'npsn'=>'20500637','address'=>'Jl. Al-Amanah No.3, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>14,'jumlah_siswa'=>272, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Telkom Gresik',              'npsn'=>'20500638','address'=>'Jl. Raya Kebomas No.12, Kec. Kebomas',               'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>315, 'jumlah_prestasi'=>4],
            ['name'=>'SMK Farmasi Gresik',             'npsn'=>'20500639','address'=>'Jl. Pahlawan No.7, Kec. Gresik',                     'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>230, 'jumlah_prestasi'=>3],
            ['name'=>'SMK Pariwisata Gresik',          'npsn'=>'20500640','address'=>'Jl. Raya Gresik, Kec. Gresik',                       'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>200, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Al-Khoiriyah Bawean',        'npsn'=>'20500641','address'=>'Jl. Raya Sangkapura, Kec. Sangkapura, Bawean',       'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>200, 'jumlah_prestasi'=>2],
            ['name'=>'SMK Diponegoro Bawean',          'npsn'=>'20500642','address'=>'Jl. Raya Tambak, Kec. Tambak, Bawean',              'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>195, 'jumlah_prestasi'=>1],
            ['name'=>'SMK Roudlotul Ulum Gresik',      'npsn'=>'20500643','address'=>'Jl. Roudlotul Ulum, Kec. Gresik',                    'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>195, 'jumlah_prestasi'=>1],
            ['name'=>'SMK Islam Wringinanom',          'npsn'=>'20500644','address'=>'Jl. Raya Wringinanom, Kec. Wringinanom',             'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>190, 'jumlah_prestasi'=>1],
            ['name'=>'SMK Hayatan Thayyibah Gresik',   'npsn'=>'20500645','address'=>'Jl. Pahlawan, Kec. Gresik',                          'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>188, 'jumlah_prestasi'=>1],
            ['name'=>'SMK Kedamean',                   'npsn'=>'20500646','address'=>'Jl. Raya Kedamean, Kec. Kedamean',                   'status'=>'Swasta','jumlah_guru'=>8, 'jumlah_siswa'=>155, 'jumlah_prestasi'=>1],
        ];

        // ═══════════════════════════════════════════════════════
        // PK/PLK (SLB) se-Kabupaten Gresik (8 Sekolah)
        // ═══════════════════════════════════════════════════════
        $pk = [
            ['name'=>'SLB Negeri Cerme',               'npsn'=>'20500710','address'=>'Jl. Raya Cerme, Kec. Cerme',                         'status'=>'Negeri','jumlah_guru'=>18,'jumlah_siswa'=>110, 'jumlah_prestasi'=>7],
            ['name'=>'SLB Negeri Bungah',              'npsn'=>'20500711','address'=>'Jl. Raya Bungah, Kec. Bungah',                       'status'=>'Negeri','jumlah_guru'=>14,'jumlah_siswa'=>85,  'jumlah_prestasi'=>5],
            ['name'=>'SLB Negeri Gresik',              'npsn'=>'20500712','address'=>'Jl. Raya Kebomas No.1, Kec. Kebomas',                 'status'=>'Negeri','jumlah_guru'=>20,'jumlah_siswa'=>120, 'jumlah_prestasi'=>8],
            ['name'=>'SLB ABC Putera Asih Gresik',     'npsn'=>'20500720','address'=>'Jl. Raya Kebomas, Kec. Kebomas',                      'status'=>'Swasta','jumlah_guru'=>16,'jumlah_siswa'=>96,  'jumlah_prestasi'=>4],
            ['name'=>'SLB ABC Muhammadiyah Gresik',    'npsn'=>'20500721','address'=>'Jl. KH. Kholil No.42, Kec. Gresik',                   'status'=>'Swasta','jumlah_guru'=>12,'jumlah_siswa'=>72,  'jumlah_prestasi'=>3],
            ['name'=>'SLB Pelita Bangsa Driyorejo',    'npsn'=>'20500722','address'=>'Jl. Raya Driyorejo, Kec. Driyorejo',                 'status'=>'Swasta','jumlah_guru'=>10,'jumlah_siswa'=>60,  'jumlah_prestasi'=>2],
            ['name'=>'SLB Bahagia Gresik',             'npsn'=>'20500723','address'=>'Jl. Proklamasi No.10, Kec. Gresik',                   'status'=>'Swasta','jumlah_guru'=>8, 'jumlah_siswa'=>48,  'jumlah_prestasi'=>2],
            ['name'=>'SLB Al-Chusnaini Gresik',        'npsn'=>'20500724','address'=>'Jl. Raya Gresik-Lamongan, Kec. Manyar',              'status'=>'Swasta','jumlah_guru'=>8, 'jumlah_siswa'=>44,  'jumlah_prestasi'=>1],
        ];

        $createSchoolWithDetails = function($data, $category) {
            $totalSiswa = $data['jumlah_siswa'];
            $classX = (int) round($totalSiswa * 0.35);
            $classXi = (int) round($totalSiswa * 0.33);
            $classXii = $totalSiswa - ($classX + $classXi);

            $siswa_x_l = (int) round($classX * rand(46, 54) / 100);
            $siswa_x_p = $classX - $siswa_x_l;

            $siswa_xi_l = (int) round($classXi * rand(46, 54) / 100);
            $siswa_xi_p = $classXi - $siswa_xi_l;

            $siswa_xii_l = (int) round($classXii * rand(46, 54) / 100);
            $siswa_xii_p = $classXii - $siswa_xii_l;

            $tendik = (int) max(2, round($data['jumlah_guru'] * rand(40, 60) / 100));

            School::create(array_merge($data, [
                'category' => $category,
                'jumlah_tendik' => $tendik,
                'siswa_x_l' => $siswa_x_l,
                'siswa_x_p' => $siswa_x_p,
                'siswa_xi_l' => $siswa_xi_l,
                'siswa_xi_p' => $siswa_xi_p,
                'siswa_xii_l' => $siswa_xii_l,
                'siswa_xii_p' => $siswa_xii_p,
            ]));
        };

        foreach ($sma as $d) $createSchoolWithDetails($d, 'SMA');
        foreach ($smk as $d) $createSchoolWithDetails($d, 'SMK');
        foreach ($pk  as $d) $createSchoolWithDetails($d, 'PK/PLK');
    }
}
