<?php

return [

    "statistics" => [
        "balance" => "Denge",
        "total_amount_spend" => "Toplam harcama tutarı",
        "total_orders" => "Toplam siparişler",
        "total_tickets" => "Toplam Ticket",
        "total_users_balance" => "Toplam Kullanıcı dengesi",
        "total_providers_balance" => "Toplam Satıcı Dengesi",
        "total_profit_30_days" => "Toplam 30 günlük kar",
        "total_profit_today" => "Bugün için toplam kar",
        "completed" => "Tamamlandı",
        "processing" => "İşleme",
        "in_progress" => "Devam ediyor",
        "pending" => "Beklemede",
        "partial" => "Kısmen",
        "canceled" => "İptal et",
        "refunded" => "İade et",
        "recent_orders" => "Son Siparişler",
        "services" => [
            "services" => "Hizmetler",
            "id" => "ID",
            "name" => "Ad",
            "rate_per_1000" => "1000 dolarlık teklif",
            "min_max_order" => "Mini/Maks Siparişlerin",
            "description" => "Açıklama",
            "details" => "Ayrıntılar",
        ],

        "your_balance" => "Bakiyeniz",
        "lists_of_tickets" => "Ticket listeleri",
        "chat" => "Sohbet",
        "message" => "Mesaj",
        "send" => "Göndermek",

        "top_bestsellers" => [
            "top_bestsellers" => "En çok satanlar",
            "id" => "ID",
            "name" => "Ad",
            "total_orders" => "Toplam siparişler",
            "type" => "Tür",
            "apı_provider" => "Sağlayıcı Apı'sı",
            "apı_servıce_ıd" => "Apı Hizmet Kimliği",
            "rate_per_1000" => "1000 ($) için bahis",
            "min_max_order" => "Mini/Maks Siparişlerin",
            "status" => "Durum",
            "details" => "Ayrıntılar",
        ],

        "last_5_newest_users" => [
            "last_5_newest_users" => "Son 5 yeni kullanıcı",
            "id" => "ID",
            "name" => "Adı",
            "email" => "E-Mail",
            "type" => "Tip",
            "funds" => "Fonlar",
            "last_ip_address" => "Son IP adresi",
            "created" => "Oluştur",
            "status" => "Durum",
            "admin" => "Yönetici",
            "regular_user" => "Kalıcı kullanıcı",
        ],

        "last_5_orders" => [
            "last_5_orders" => "Son 5 sipariş",
            "order_id" => "Sipariş Kimliği",
            "user" => "Kullanıcı",
            "name" => "Adı",
            "type" => "Tip",
            "link" => "Link",
            "quantity" => "Miktar",
            "amount" => "Tutar",
            "created" => "Oluştur",
            "status" => "Durum",
        ]
    ],
    "new_order" => [
        "new_order" => "Yeni sipariş",
        "single_order" => "Tek seferlik sipariş",
        "mass_order" => "Toplu sipariş",
        "single_from" => [
            "add_new" => "Yeni ekle",
            "category" => "Kategori",
            "choose_category" => "Kategoriyi seç",
            "order_service" => "Hizmet siparişi",
            "select_the_category_first" => "Önce kategoriyi seç",
            "link" => "Link",
            "quantity" => "Miktar",
            "order_resume" => "Sipariş özeti",
            "service_name" => "Hizmet adı",
            "minimum_amount" => "Minimum tutar",
            "maximum_amount" => "Maksimum tutar",
            "prıce_per_1000" => "1000'in bedeli",
            "description" => "Açıklama",
            "total_charge" => "Toplam ücret:",
            "confirmed_the_order" => "Evet, siparişi onaylıyorum!",
            "place_order" => "Sipariş ver",
        ],
        "mass_form" => [
            "one_order_per_line_in_format" => "Format başına satır başına bir sipariş",
            "note" => "Not:",
            "message_first" => "Burada siparişlerinizi kolayca yerleştirebilirsiniz! Sipariş vermeden önce tüm fiyatları ve teslimat sürelerini kontrol ettiğinizden emin olun!",
            "message_second" => "Sipariş verildikten sonra iptal edilemez.",
            "confirmed_the_order" => "Evet, siparişi onaylıyorum!",
            "place_order" => "Sipariş ver",
        ],
        "choose_a_service" => "Hizmet seçimi"
    ],
    "order_log" => [
        "form" => [
            "edit_order" => "Siparişi düzenle",
            "order_id" => "Sipariş Kimliği",
            "apı_order_ıd" => "API Sipariş Kimliği",
            "type" => "Tip",
            "user" => "Kullanıcı",
            "service" => "Hizmet",
            "quantity" => "Miktar",
            "amount" => "Tutar",
            "start_counter" => "Başlangıç sayacı",
            "remains" => "Kalanlar",
            "status" => "Durum",
            "link" => "Link",
            "submit" => "Gönder",
            "cancel" => "İptal",
        ],
        "order_logs" => [
            "order_logs" => "Sipariş günlükleri",
            "filter" => [
                "order_id" => "Sipariş Kimliği",
                "apı_order_ıd" => "API Sipariş Kimliği",
                "order_link" => "Sipariş bağlantısı",
                "user_email" => "Kullanıcının E-postası",
                "search" => "Ara",
            ],
            "all" => "Tüm",
            "status" => [
                "all"           => "Herşey",
                "completed"     => "Tamamlandı",
                "processing"    => "Işleme",
                "inprogress"    => "Devam etmekte",
                "pending"       => "Bekliyor",
                "partial"       => "Kısmi",
                "canceled"      => "Iptal edildi",
                "refunded"      => "Iade edildi",
                "awaiting"      => "Bekliyor",
                "error"         => "Hata",
                "active"        => "Active",
            ],
            "table" => [
                "id" => "ID",
                "apı_order" => "Sipariş API'sı",
                "user" => "Kullanıcı",
                "order_basic_details" => "Siparişin temel ayrıntıları",
                "created" => "Oluştur",
                "status" => "Durum",
                "action" => "Eylem",
                "instagram_followers" => "Instagram Takipçileri",
                "type" => "Tür:",
                "link" => "Link:",
                "quantity" => "Miktar:",
                "charge" => "Toplama:",
                "start_counter" => "Başlangıç sayacı:",
                "remains" => "Kalanlar:",
            ],
        ],
    ],
    "drip_feed" => [
        "form" => [
            "edit_order" => "Siparişi düzenle",
            "order_id" => "Sipariş Kimliği",
            "apı_order_ıd" => "API Sipariş Kimliği",
            "type" => "Tip",
            "user" => "Kullanıcı",
            "service" => "Hizmet",
            "quantity" => "Miktar",
            "amount" => "Tutar",
            "start_counter" => "Başlangıç sayacı",
            "remains" => "Kalanlar",
            "status" => "Durum",
            "link" => "Link",
            "submit" => "Gönder",
            "cancel" => "İptal et",
        ],
        "drip_feed" => [
            "drip_feed" => "Kademeli besleme",
            "filter" => [
                "order_id" => "Sipariş Kimliği",
                "apı_order_ıd" => "API Sipariş Kimliği",
                "order_link" => "Sipariş bağlantısı",
                "user_email" => "Kullanıcının E-postası",
                "search" => "Ara",
            ],
            "all" => "Tüm",
            "table" => [
                "id" => "ID",
                "apı_order" => "Sipariş API'sı",
                "user" => "Kullanıcı",
                "order_basic_details" => "Siparişin temel ayrıntıları",
                "created" => "Oluştur",
                "status" => "Durum",
                "action" => "Eylem",
                "instagram_followers" => "Instagram Takipçileri",
                "type" => "Tür:",
                "link" => "Link:",
                "quantity" => "Miktar:",
                "charge" => "Toplama:",
                "start_counter" => "Başlangıç sayacı:",
                "remains" => "Kalanlar:",
            ],
        ],
    ],
    "subscription" => [
        "form" => [
            "send_user_a_mail" => "Kullanıcıya e-posta gönder",
            "message_text" => "Mesaj metni",
            "send" => "Gönder",
            "cancel" => "İptal et",
        ],
        "list" => "Liste",
        "table" => [
            "no" => "№",
            "email" => "Email",
            "created" => "Oluştur",
            "delete" => "Sil",
            "send_mail" => "E-posta gönder",
        ],
    ],
    "service" => [
        "form" => [
            "edit_service" => "Hizmeti düzenle",
            "add_service" => "Hizmet ekle",
            "edit_category" => "Kategoriyi düzenle",
            "package_name" => "Paket adı",
            "choose_a_category" => "Kategoriyi seç",
            "api" => "API",
            "manual" => "Manual",
            "apı_provider_name" => "Sağlayıcı Adı API'sı",
            "choose_an_apı_provider" => "sağlayıcı API'sine göre seç",
            "list_of_api_services" => "API Hizmetleri listesi",
            "original_price" => "Orijinal fiyat",
            "service_type" => [
                "service_type" => "Hizmet türü",
                "default" => "Varsayılan",
                "subscriptions" => "Abonelikler",
                "custom_comments" => "Kullanıcı Yorumları",
                "custom_comments_package" => "Özel yorum paketi",
                "mentions_with_hashtags" => "Hashtag'lerle ilgili referanslar",
                "mentions_custom_lists" => "Özel listelerden bahsedenler",
                "mentions_hashtag" => "Hashtag'den bahsedenler",
                "mentions_user_followers" => "Kullanıcı takipçilerinden bahsedenler",
                "mentions_media_killers" => "Medya satıcılarından bahseder",
                "package" => "paket",
                "comment_like" => "Yorumu beğen",
            ],
            "drıp_feed" => "Kademeli besleme",
            "deactive" => "Etkin değil",
            "active" => "Aktif",
            "minimum_amount" => "Minimum tutar",
            "maximum_amount" => "maksimum tutar",
            "rate_per_1000" => "1000'e bahis",
            "status" => "Durum",
            "description" => "Açıklama",
            "add_new_servıce_vıa_apı" => "API aracılığıyla yeni bir hizmet ekleme",
            "submit" => "Gönder",
            "cancel" => "İptal et",
        ],
        "user_table" => [
            "id" => "ID",
            "name" => "Ad",
            "rate_per_1000" => "1000 $ 'lık bahis",
            "min_max_order" => "Min/Maks Sipariş",
            "description" => "Açıklama",
            "details" => "Ayrıntılar",
        ],
        "list" => "Liste",
        "add_new" => "yeni Ekle",
        "action" => [
            "action" => "Eylem",
            "delete" => "Sil",
            "all_deactivated_categories" => "Tüm etkin olmayan kategoriler",
            "deactive" => "Etkin değil",
            "active" => "Etkin",
        ],
        "table" => [
            "no" => "№",
            "name" => "Ad",
            "description" => "Açıklama",
            "sort" => "Sırala",
            "status" => "Durum",
            "action" => "Eylem",
            "edit" => "Düzenle",
            "delete" => "Sil",
        ],
    ],
    "category" => [
        "form" => [
            "add_category" => "kategori ekle",
            "edit_category" => "Kategoriyi düzenle",
            "name" => "Ad",
            "default_sorting_number" => "Varsayılan sıralama numarası",
            "status" => "Durum",
            "active" => "Etkin",
            "deactive" => "Etkin değil",
            "description" => "Açıklama",
            "submit" => "Gönder",
            "cancel" => "Sil",
        ],
        "list" => "Liste",
        "add_new" => "yeni Ekle",
        "action" => [
            "action" => "Eylem",
            "delete" => "Sil",
            "all_deactivated_categories" => "Tüm etkin olmayan kategoriler",
            "deactive" => "Etkin değil",
            "active" => "Etkin",
        ],
        "table" => [
            "no" => "№",
            "name" => "Ad",
            "description" => "Açıklama",
            "sort" => "Sırala",
            "status" => "Durum",
            "action" => "Eylem",
            "edit" => "Düzenle",
            "delete" => "Sil",
        ],
    ],
    "api" => [
        "apı_documentation" => "API belgeleri",
        "note" => "Not: API talimatlarını dikkatlice okuyun. Bu, apı'mızla eklediğiniz şeyler için kişisel sorumluluğunuzdadır.",
        "button" => "PHP Kod örneklerini indir",
    ],
    "ticket" => [
        "add_new_ticket" => "Yeni Ticket ekle",
        "form" => [
            "subject" => "Konu",
            "request" => "İstek",
            "payment" => "Ödeme",
            "order_id" => "Sipariş Kimliği",
            "transaction_id" => "işlem kimliği",
            "description" => "Açıklama",
            "support" => "Destek",
            "time_left" => "kalan süre",
            "offline" => "çevrimdışı",
            "online" => "çevrimiçi",
            "submit" => "Gönder",
        ],
        "lists" => "Listeler",
        "lists_of_tickets" => "Ticket listeleri",
        "chat" => "Sohbet",
        "message" => "Message",
        "send" => "Gönder",

    ],
    "faq" => [
        "form" => [
            "Edit QA" => "Düzeltme QA"
        ],
    ],

    "header" => [
    "order" => [
        "new" => "Yeni sipariş",
        "all" => "Tüm siparişler",
    ],
        "hi" => "Merhaba",
        "balance" => "Denge",
    ],
    "nav_bar" => [
    "statistics" => "İstatistik",
    "new_order" => "Yeni sipariş",
    "order" => "Sipariş",
    "order_logs" =>"Sipariş günlükleri",
    "drip_feed" => "Bükümlü siparişler",
    "subscriptions" => "Abonelikler",
    "services" => "Hizmetler",
    "category" => "Kategori",
    "api" => "API",
    "support" => "Destek",
    "tickets" =>"Biletler",
    "faqs" => "Sıkça Sorulan Sorular",
    "add_funds" => "Para ekle",
    "transaction_log" =>"İşlem günlüğü",
    "user_manager" =>"Kullanıcı yöneticisi",
    "system_settings" => "Sistem Ayarları",
    "general_setting" =>"Genel Ayar",
    "support_status" =>"Destek durumu",
    "website_setting" => "WebSite Ayarı",
    "translation_setting" =>"Çeviri Ayarı",
    "languages"  =>"Diller",
    "website_logo" => "WebSitesi Logosu",
    "cookie_policy" =>"Çerez Politikası",
    "terms_policy_page" => "Şartlar ve Politika sayfası",
    "default_setting" =>  "Varsayılan Ayar",
    "currency_setting" =>"Para Birimi Ayarı",
    "currencies_list" =>  "Para Birimleri Listesi",
    "captcha_setting" => "Captcha ayarı",
    "other" => "Diğer",
    "email" =>  "E-posta",
    "email_settings" =>  "E-posta Ayarları",
    "email_template" => "E-posta Şablonu",
    "integrations" => "Entegrasyonlar",
    "payment" =>"Ödeme",
    "payment_bonuses" => "Ödeme Bonusları",
    "hi" => "Merhaba",
    "balance" =>"Bakiye",
    "log_out" => "Oturumu kapat",
    "maintenance_mode" => "Bakım modu",
],
    "register" => [
    "sign_up" => "Kaydolun",
    "email" => "E-posta",
    "first_name" => "Ad",
    "last_name" =>"Soyadı",
    "password" =>"Şifre",
    "confirm_password" => "Şifreyi Onayla",
    "select_timezone" =>"Saat Dilimi Seç",
    "agree" => "Kabul ediyorum",
    "terms_policy" =>"Şartlar ve Politika",
    "have_account" => "Zaten hesabınız var mı?",
        "login" =>  "Giriş"
    ],
    "add_funds" => [
        "add_funds" => "Para Ekle",
        "choose_method" => "Ödeme yöntemini seçin",
        "select" => "Ödemeyi Seç",
        "amount" =>"Tutar",
        "note" => "Not:",
        "minimal" =>"Minimum ödeme",
        "maximal" => "Maksimum ödeme",
        "clicking" => "Tıklama",
        "return" => "Mağazaya Geri Dön (Tüccar)",
        "completed" =>"ödeme başarıyla tamamlandıktan sonra",
        "understand" => "Evet, fonları ekledikten sonra hileli anlaşmazlık veya ters ibraz talebinde bulunmayacağımı anlıyorum!",
        "pay" => "Öde",
    ],


    "Apps & Pages" => "Uygulamalar ve Sayfalar",
    "User İnterface" => "Kullanıcı Arabirimi",
    "Dashboards" => "Kontrol Paneli",
    "Analytics" => "Analytics",
    "eCommerce" => "E-ticaret",
    "Apps" => "Uygulamalar",
    "Forms & Tables" => "Formlar ve Tablolar",
    "Pages" => "Sayfalar",
    "Charts & Maps" => "Grafikler ve Haritalar",
    "Others" => "Diğer",
    "Email" => "Email",
    "Chat" => "Sohbet",
    "Todo" => "Görev",
    "Calendar" => "Takvim",
    "Ecommerce" => "E-ticaret",
    "Shop" => "Mağaza",
    "Wishlist" => "İstek listesi",
    "Checkout" => "Ödeme",
    "Starter kit" => "Başlangıç paketi",
    "1 column" => "1 sütun",
    "2 columns" => "2 sütun",
    "Sabit navbar" => "Sabit gezinme çubuğu",
    "Floating navbar" => "Açılır Gezinme çubuğu",
    "Sabit düzen" => "Sabit düzen",
    "Static layout" => "Statik düzen",
    "Dark layout" => "Karanlık düzen",
    "Light layout" => "Aydınlatma düzen",
    "Data List" => "Veri Listesi",
    "List View" => "Listeyi görüntüle",
    "Thumb View" => "Parmağınızı çevir",
    "Content" => "İçerik",
    "Grid" => "Ağ",
    "Typography" => "Tipografi",
    "Text Utilities" => "Metin Programları",
    "Syntax Highlighter" => "Sözdizimi vurgulama",
    "Helper Classes" => "Destekleyici Sınıflar",
    "Colors" => "Renkler",
    "İcons" => "Simgeler",
    "Feather" => "Kalem",
    "Font Awesome" => "Uygun yazı tipi",
    "Card" => "Kart",
    "Basic" => "Temel",
    "Advance" => "Avans",
    "Advanced" => "Gelişmiş",
    "Statistics" => "İstatistikler",
    "Card Actions" => "Kart Eylemleri",
    "Table" => "Tablo",
    "Datatable" => "Tablo verileri",
    "Components" => "Bileşenler",
    "Alerts" => "Uyarılar",
    "Buttons" => "Düğmeler",
    "Breadcrumbs" => "Seyir zinciri",
    "Carousel" => "Atlıkarınca Slayt Gösterisi",
    "Collapse" => "Çöküşü",
    "Dropdowns" => "Açılır pencereler",
    "List Group" => "Grup Listesi",
    "Modals" => "Modaller",
    "Modal Examples" => "Modal Örnekler",
    "Pagination" => "Numaralandırma",
    "Navs Component" => "Navigasyon Elemanı",
    "Navbar" => "Gezinme Çubuğu",
    "Tabs Component" => "Sekme Öğesi",
    "Haplar Bileşeni" => "Elemanın kapsülü",
    "Tooltips" => "Araç ipuçları",
    "Popovers" => "arabirim bileşeni",
    "Badges" => "Rozetler",
    "Hap Rozetleri" => "Kapsül rozetleri",
    "Progress" => "İlerleme",
    "Spinner" => "Spinner",
    "Toasts" => "Küçük Bilgi Penceresi",
    "Extra Components" => "Ek Bileşenler",
    "Avatar" => "Avatar",
    "Cips" => "cips",
    "Divider" => "Dağıtıcı",
    "Form Elements" => "Form Elemanları",
    "Select" => "Seçim",
    "Switch" => "Switch",
    "Checkbox" => "Onay kutusu",
    "Radio" => "Radyo",
    "İnput" => "Giriş",
    "İnput Groups" => "Giriş Grupları",
    "Number İnput" => "Giriş Numarası",
    "Textarea" => "Metin alanı",
    "Date & Time Picker" => "Tarih ve Saat Seçici",
    "Form Layout" => "Form Düzeni",
    "Form Wizard" => "Form Oluşturma Sihirbazı",
    "Form Validation" => "Form Validasyonu",
    "Authentication" => "Kimlik doğrulama",
    "Login" => "Oturum aç",
    "Login" => "Oturum aç",
    "Register" => "Kaydol",
    "Register" => "Kaydol",
    "Forgot Password" => "Şifreyi unuttum",
    "Forgot Password" => "Şifreyi unuttum",
    "Reset Password" => "Şifreyi Sıfırla",
    "Reset Password" => "Şifreyi Sıfırla",
    "Coming Soon" => "Yakında gelecek",
    "Error" => "Hata",
    "404" => "404",
    "500" => "500",
    "Not Authorized" => "Yetkili değil",
    "Maintenance" => "Bakım",
    "Profile" => "Profil",
    "FAQ" => "FAQ",
    "Bilgi Bankası" => "Bilgi Bankası",
    "Search" => "Ara",
    "Fatura" => "Fatura",
    "Charts" => "Grafikler",
    "Apex" => "Zirve",
    "Chartjs" => "Grafikler",
    "Echarts" => "Elektronik Grafikler",
    "Google Haritalar" => "Google Haritalar",
    "Sweet Alert" => "Sweet Alert",
    "Toastr" => "Açılır mesajlar",
    "Sliders" => "Kaydırıcılar",
    "File Uploader" => "Dosya Yükleme",
    "Quill Editor" => "Quill Editor",
    "Drag & Drop" => "Drag & Drop",
    "Tour" => "Tur",
    "Pano" => "Pano",
    "Context Menu" => "Bağlam Menüsü",
    "l18n" => "l18n",
    "Menu Levels" => "Menü Seviyeleri",
    "Second Level 2.1" => "İkinci Seviye 2.1",
    "Second Level 2.2" => "İkinci Seviye 2.2",
    "Third Level 3.1" => "Üçüncü Seviye 3.1",
    "Third Level 3.2" => "Üçüncü Seviye 3.2",
    "Disabled Menu" => "Disabled Menu",
    "Documentation" => "Belgeler",
    "Raise Support" => "Destek seviyesini yükseltin",
    "Miscellaneous" => "Çeşitli",
    "Extensions" => "Uzantılar",
    "Media Player" => "Media Player",
    "User Settings" => "Kullanıcı Ayarları",
    "User" => "Kullanıcı",
    "List" => "Liste",
    "View" => "Görüntüle",
    "Edit" => "Düzenle",
    "Account Settings" => "Hesap Ayarları",
    "Error 404" => "Hata 404",
    "Error 405" => "Hata 405",
    "Details" => "Ayrıntılar",
    "Swiper" => "Swiper",
    "I18n" => "I18n",
    "Access Control" => "Erişim Kontrolü",
    "File Manager" => "Dosya Yöneticisi",
    "Pricing" => "Fiyatlandırma",
    "Kanban" => "Kanban",
    "Preview" => "Önizleme",
    "Add" => "Ekle",
    "Blog" => "Blog",
    "Detail" => "Detay",
    "Mail Template" => "Mail Template",
    "Welcome" => "Hoş geldiniz",
    "Forgot" => "Unut",
    "Verify" => "Doğrula",
    "Deactivate" => "Devre dışı bırak",
    "Order" => "Sipariş",
    "Page Layouts" => "Sayfa Düzenleri",
    "Collapsed Menu" => "Genişletilmiş Menü",
    "Layout Full" => "Tam Düzen",
    "Without Menu" => "Menü olmadan",
    "Layout Empty" => "Boş düzen",
    "Layout Blank" => "Düzen Boşluğu",
    "Form Tekrarlayıcı" => "Form Tekrarlayıcı",
    "Leaflet Maps" => "Broşür Haritaları",
    "Mısc" => "Çeşitli",
    "Giriş Maskesi" => "Giriş Maskesi",
    "Timeline" => "Zaman çizelgesi",
    "BlockUI" => "BlockUI",
    "Tree" => "Ağaç",
    "Ratings" => "Göstergeler",
    "Locale" => "Eylem yeri",
    "Reset Password" => "Şifreyi Sıfırla",
    "E-Postayı Doğrula" => "E-Postayı Doğrula",
    "Deactivate Account" => "Hesabı devre dışı bırak",
    "Promotional" => "Reklamlar",
    'Accordion' => 'Uygun olarak',
    "Offcanvas" => "Offcanvas",
    "Custom Options" => "Özel Ayarlar",
    "License" => "Lisans",
    "API Key" => "API Anahtarı",
    "Two Steps" => "İki aşamalı",
    "E-Postayı Doğrula" => "E-Postayı Doğrula",
    "Multi-Steps" => "Multi-Steps",
    "Account" => "Hesap",
    "Security" => "Güvenlik",
    "Billings & Plans" => "Faturalar ve Planlar yapmak",
    "Notifications" => "Bildirimler",
    "Connections" => "Bağlantılar",
    "Roles & Permission" => "Roller ve İzinler",
    "Roles" => "Roller",
    "Permission" => "İzinler",
    "Cover" => "Kapak",
    "message" => "İleti."
];