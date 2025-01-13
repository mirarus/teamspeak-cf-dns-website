# TEAMSPEAK CLOUDFLARE DNS WEBSITE

    Demo ->

        Url: https://mirarus.com.tr
        Mail: admin@site.com
        Şifre: 12345
.

    -> Kurulum
        

        1 -> Projeyi İndirelim

            gitclone https://github.com/mirarus/teamspeak-cf-dns-website.git


        2 -> Composer Paket Yükleyici ile Paketleri Kuralım

            composer install


        3 -> SQL Dosyasını Veritabanına aktaralım
        

        4 -> .env.example dosyamızı .env dosyasına çevirelim


        5 -> .env yapılandırmasını yapalım

            ENVIRONMENT=development veya production  / development: hata ayıklama
                
            dbname=XXXXX kısmına veritabanı adımını girelim
            DB_USER ve DB_PASS kısmına ise veritabanı kıllanıcı bilgilerini girelim

            DB_DSN=mysql:host=localhost;dbname=XXXXX;charset=utf8
            DB_USER=root
            DB_PASS=root