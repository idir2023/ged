<?php

return [
    "supplier" => [
        "supplier"                  => "دابینکەر",
        "supplier_list"             => "لیستی دابینکەران",
        "add_supplier"              => "زیادکردنی دابینکەر",
        'edit_supplier'             => 'دەستکاری دابینکەر',

        //fields
        "name"                      => "ناو",
        "company_name"              => "ناونیشانی کۆمپانیا",
        "address"                  => "شوێن",
        "phone"                     => "ژمارەی تەلەفۆن",
        "phone_alt"                 => "بەدیل ژمارەی تەلەفۆن",
    ],

    "category" => [
        "category"                  => "پۆڵ",
        "category_list"             => "لیستی پۆلەکان",
        "add_category"              => "زیادکردنی پۆڵ",
        'edit_category'             => 'دەستکاری پۆڵ',

        //fields
        "name"                      => "ناو",
    ],

    "brand" => [
        "brand"                     => "براند",
        "brand_list"                => "لیستی بڕاندەکان",
        "add_brand"                 => "زیادکردنی بڕاند",
        'edit_brand'                => 'دەستکاری بڕاند',

        //fields
        "name"                      => "ناو",
    ],

    "client" => [
        "client"                     => "کڕیار",
        "client_list"                => "لیستی کڕیارەکان",
        "client_map"                 => "کڕیار لەسەر نەخشتە",
        "add_client"                 => "زیادکردنی كڕیار",
        'edit_client'                => 'دەستکاری کڕیار',

        //fields
        "category"                   => "پۆڵ",
        "zone"                       => "زۆن",
        "name"                       => "ناو",
        "phone"                      => "ژمارەی تەلەفۆن",
        "phone_alt"                  => "بەدیل ژمارەی تەلەفۆن",
        "address"                    => "ناونیشان",
        "loan_limit"                 => "سنووری قەرز",
        "loan_count"                 => "ژمارەی قەرزەکان",
        "address_on_map"             => "ناونیشانی لەسەر نەخشتە",
        "client_map_pick"            => "شوێنی کڕیار لەسەر نەخشتە",
        "client_orders"              => "ئۆردەرەکانی کڕیار",
        "no_orders"                  => "ژمارەی ئۆردەرەکان",
    ],

    "client_category" => [
        "client_category"            => "پۆڵی کڕیار",
        "client_category_list"       => "لیستی پۆڵی کڕیارەکان",
        "add_client_category"        => "زیادکردنی پۆڵی کڕیار",
        'edit_client_category'       => 'دەستکاری پۆڵی کڕیار',

        //fields
        "name"                      => "ناو",
    ],

    "contact" => [
        "contact"                     => "پەیوەندیەکان",
        "contact_list"                => "لیستی پەیوەندیەکان",
        "contact_info"                => "زانیاری پەیوەندی",
        "add_contact"                 => "زیادکردنی پەیوەندی",
        'edit_contact'                => 'دەستکاری پەیوەندی',

        //fields
        "subject"                     => "سەردێڕ",
        "note"                        => "تێبینی",
        "added_by"                    => "زیادکراوە لەلایەن",
    ],

    "tracking" => [
        "tracking"                    => "بەدواداچوون",
        "tracking_live"               => "بەدواداچوون بە شێوەی ڕاستەوخۆ",
        "tracking_history"            => "مێژووی بەدواداچوون",

        //fields
        "date"                        => "ڕێکەوت",
        "user"                        => "بەکارهێنەر",
        "movement_speed"              => "خێرایی جوڵە",
        "view_movment"                => "بینینی خێرایی",
    ],

    "visit" => [
        "visit"                     => "سەردانیکردنەکان",
        "visit_list"                => "لیستی سەردانیکردنەکان",
        "visit_info"                => "زانیاری سەردانیکردن",


        //fields
        "user"                      => "بەکارهێنەر",
        "client"                    => "کڕیار",
        "desicrption"               => "وەسف",
        "address_on_map"            => "ناونیشان لەسەر نەخشتە",
        "distance"                  => "دووری"
    ],

    "visit_description" => [
        "visit_description"         => "وەسفی سەردانیکردن",
        "visit_description_list"    => "لیستی وەسفی سەردانیکردن",
        "visit_info"                => "زانیاری سەردانیکردن",
        "add_visit_description"     => "زیادکردنی وەسفی سەردانیکردن",

        //fields
        "title"                     => "ناو",
    ],

    "expense_tag" => [
        "expense_tag"               => "تاگی مەسروف",
        "expense_tag_list"          => "لیستی تاگی مەسروف",
        "add_expense_tag"           => "زیادکردنی تاگی مەسروف",
        "edit_expense_tag"          => "دەستکاری تاگی مەسروف",

        //fields
        "name"                      => "ناو",
    ],

    "expense" => [
        "expense"                   => "مەسروفاتەکان",
        "expense_list"              => "لیستی مەسروفاتەکان",
        "add_expense"               => "زیادکردنی مەسروف",
        "edit_expense"              => "دەستکاری مەسروف",
        "expense_info"              => "زانیاری مەسروف",

        //fields
        "title"                   => "ناو",
        "description"             => "وەسف",
        "price"                   => "نرخ",
        "user"                    => "بەکارهێنەر",
        "image"                   => "وێنە",
        "tag"                     => "تاگ",
    ],

    "new_order" => [
        "new_order"         => "داواکاری نوێ",
        "new_order_list"    => "لیستی داواکاریە نوێکان",
        "new_order_info"    => "زانیاری داواکاری نوێ",

        //fields
        "order"                   => "ناو",
        "description"             => "وەسف",
        "paid_status"             => "دۆخی پارەدان",
        "accept_by"               => "قبووڵ کراوە لەلایەن",
        "arrive_at"               => "کاتی گەیشتن",
        "assign_driver"           => "شۆفێرێک دیاری بکە",
        "driver"                  => "شۆفێر",
        "write_cancel_note"       => "تێبینی هەڵوەشاندنەوە بنووسە",
        "cancel_note"             => "تێبینی هەڵوەشاندنەوە",
    ],

    "role" => [
        "role"                     => "ڕۆڵ",
        "role_list"                => "لیستی ڕۆڵەکان",
        "add_role"                 => "زیادکردنی ڕۆڵ",
        'edit_role'                => 'دەستکاری ڕۆڵ',

        //fields
        "name"                     => "ناو",
        "permissions"              => "دەسەڵاتەکان",
    ],

    "user" => [
        "user"                     => "بەکارهێنەر",
        "user_list"                => "لیستی بەکارهێنەرەکان",
        "user_info"                => "زانیاری بەکارهێنەر",
        "user_map"                 => "بەکارهێنەر لەسەر نەخشتە",
        "add_user"                 => "زیادکردنی بەکارهێنەر",
        'edit_user'                => 'دەستکاری بەکارهێنەر',

        //fields
        "name"                       => "ناو",
        "phone"                      => "ژمارەی تەلەفۆن",
        "email"                      => "ئیمەیل",
        "password"                   => "وشەی تێپەر",
        "role"                       => "ڕۆڵ",
        "phone_alt"                  => "بەدیل ژمارەی تەلەفۆن",
        "address"                    => "ناونیشان",
        "is_working"                 => "ئایا لە کاردایە",
        "role"                       => "Role",
    ],

    "usd_rate" => [
        "usd_rate"                  => "ڕێژەی دۆلار",
        "add_usd_rate"              => "زیادکردنی ڕێژەی دۆلار",

        //fields
        "usd"                       => "USD",
        "iqd"                       => "IQD",
    ],

    "safe_transaction" => [
        "safe_transaction"           => "مامەڵەی قاسە",
        "safe_transactions_list"     => "لیستی مامەڵەی قاسەکان",

        //fields
        "type"                       => "جۆر",
        "deposit"                    => "پارە دانان",
        "withdraw"                   => "ڕاکێشانی پارە",
        "address"                    => "ناونیشان",
        "transaction_by"             => "مامەڵە لەلایەن",
        "action_by"                  => "کردنی لەلایەن",
        "is_active"                  => "دۆخی چالاک",
        "amount"                     => "بڕ",
        "note"                       => "تێبینی",
        "safe_name"                  => "ناوی قاسە",
        "date"                       => "ڕێکەوت",
    ],

    "safe" => [
        "safe"                      => "مێژووی قاسە",
        "safe_list"                 => "لیستی قاسەکان",
        "add_safe"                  => "زایدکردنی قاسە",

        //fields
        "name"                       => "ناو",
        "address"                    => "ناونیشان",
        "created_by"                 => "زایدکردنی لەلایەن",
        "is_active"                  => "دۆخی چالاک",
        "available_money"            => "پارەی بەردەست",
    ],

    "exchange_history" => [
        "exchange_history"           => "مێژووی ئاڵوگۆڕکردن",
        "exchange_history_list"      => "لیستی مێژووی ئاڵوگۆڕکردن",
        "add_setting"                => "زیادکردنی ڕێکخستن",

        //fields
        "usd"                        => "USD",
        "iqd"                        => "IQD",
        "date"                       => "ڕێکەوت",
        "action_by"                  => "کردار لەلایەن",
    ],


    "setting" => [
        "setting"                  => "ڕێکخستن",
        "setting_list"             => "لیستی ڕێکخستنەکان",
        "add_setting"              => "زیادکردنی ڕێکخستن",
        'edit_setting'             => 'دەستکاری ڕێکخستن',

        //fields
        "key"                      => "ناو",
        "value"                    => "زانیاری",
    ],

    "car" => [
        "car"                     => "سەیارە",
        "car_list"                => "لیستی سەیارەکان",
        "car_info"                => "زانیاری سەیارە",
        "add_car"                 => "زیادکردنی سەیارە",
        'edit_car'                => 'دەستکاری سەیارە',
        "driver_name"             => "Driver Name",
        "car_model"               => "Car Model",

        //fields
        "model"                   => "مۆدێل",
        "id"                      => "Cat ID",
        "plate_number"            => "ژمارەی ڕەقەم",
        "driver_name"             => "ناوی شوفێر",
        "image"                   => "وێنە",
    ],

    "car_expense" => [
        "car_expense"             => "مەسرەی سەیارە",
        "car_expense_list"        => "لیستی مەسرووفی سەیارەکان",
        "car_expense_info"        => "زانیاری مەسرووفی سەیارە",
        "add_car_expense"         => "زیادکردنی مەسرووفی سەیارە",
        'edit_car_expense'        => 'دەستکاری مەسرووفی سەیارە',

        //fields
        "car"                     => "سەیارە",
        "title"                   => "ناو",
        "description"             => "وەسف",
        "price"                   => "نرخ",
        "user"                    => "بەکارهێنەر",
        "image"                   => "وێنە",
    ],

    "coupon" => [
        "coupon"                  => "کوپۆن",
        "coupon_list"             => "لیستی کوپۆنەکان",
        "coupon_info"             => "زانیاری کوپۆن",
        "add_coupon"              => "زیادکردنی کوپۆن",
        'edit_coupon'             => 'دەستکاری کوپۆن',

        //fields
        "type"                     => "جۆر",
        "code"                     => "کۆد",
        "discount"                 => "داشکاندن",
        "discount_type"            => "جۆری داشکاندن",
        "start_date"               => "کاتی دەستپێکردن",
        "end_date"                 => "کاتی کۆتایی",
    ],

    "work_time" => [
        "work_time"                => "کاتی کارکردن",
        "work_time_list"           => "لیستی کاتی کارکردن",
        "work_time_info"           => "زانیاری کاتی کارکردن",
        "add_work_time"            => "زیادکردنی کاتی کارکردن",
        'edit_work_time'           => 'دەستکاری کاتی کارکردن',
        'user_report'              => 'ڕاپۆرتی بەکارهێنەر',

        //fields
        "name"                     => "ناو",
        "date"                     => "کات",
        "start_time"               => "کاتی دەستپێکردن",
        "end_time"                 => "کاتی کۆتایی",
        "total"                    => "کۆی گشتی کاتی کارکردن",
    ],

    "order" => [
        "order"                    => "داواکاریەکان",
        "order_list"               => "لیستی داواکاریەکان",
        "order_info"               => "زانیاری داواکاری",
        "order_detail"             => "زانیاری داواکاری",
        "sub_total"                => "ژێر کۆی گشتی",
        "order_timeline"         => "Order Timeline",

        //fields
        "client_name"              => "ناوی کڕیار",
        "order_by"                 => "داواکاری لایەن",
        "total"                    => "کۆی گشتی",
        "total_weight"             => "کێشی گشتی",
        "discount"                 => "داشکاندن",
        "order_status"             => "باری داواکاری",
        "delivery_date"            => "ڕێکەوتی گەیاندن",
        "status"                   => "بار",
        "note"                     => "تێبینی",
        "payment_status"           => "دۆخی پارەدان",
        "order_location"           => "ناونیشانی داواکاری",
        "client_location"          => "ناونیشانی کڕیار",
        "payment_history"          => "مێژووی پارەدان",
        "meters_away"              => "دووری بە مەتر",
        "item"                     => "کەلوپەل",
        "price"                    => "نرخ",
        "quantity"                 => "ژمارە",
        "order_date"               => "کاتی داواکاری",
        "billed_to"                => "داواکاری بۆ",
        "accept/cancel"            => "قبوڵکردن/هەڵوەشاندنەوە",
        "change_status"            => "دۆخی داواکارییەکە بگۆڕە",
        "profit"                   => "قازانج",
        "type"                     => "جۆر",
        "free_quantity"            => "عددی خۆرایی",

        // status 
        "ordered"                 => "Ordered",
        "accepted"                => "Accepted",
        "cancelled"               => "Cancelled",
        'assigned'                => 'Assigned',
        "pickedup"                => "Pickedup",
        'delivered'               => 'Delivered',
        "order_at"                => "Order At",
        "cancelled_at"            => "Cancelled At",
        "cancelled_by"            => "Cancelled By",
        "accepted_at"             => "Accepted At",
        "accepted_by"             => "Accepted By",
        'assigned_to'             => 'Assigned To',
        'assigned_at'             => 'Assigned At',
        'assigned_by'             => 'Assigned By',
        "pickedup_at"             => "Pickedup At",
        "pickedup_by"             => "Pickedup By",
        "delivered_at"            => "Delivered At",
    ],

    "product" => [
        "product"                  => "کاڵاکان",
        "product_list"             => "لیستی کاڵاکان",
        "add_product"              => "زیادکردنی کاڵا",
        "edit_product"             => "دەستکاری کاڵا",
        "product_info"             => "زانیاری کاڵا",

        //fields
        "name"                      => "ناو",
        "description"               => "وەسف",
        "product_name"              => "ناوی کاڵا",
        "product_image"             => "وێنەی کاڵا",
        "image"                     => "وێنە",
        "added_by"                  => "زیادکراوە لەلایەن",
        "price"                     => "نرخ",
        "supplier"                  => "دابینکار",
        "category"                  => "پۆل",
        "barcode"                   => "باڕکۆد",
        "quantity"                  => "ژمارە",
        "purchase_price"            => "نرخی کڕین",
        "sell_price"                => "نرخی فرۆشتن",
        "min_sell_price"            => "کەمترین نرخی فرۆشتن",
        "num_of_sales"              => "ژمارەی فرۆشتنەکان",
        "low_stock_quantity"        => "ئاگادارکردنەوە لە بڕی کەمی کۆگا",
        "box_low_stock_quantity"    => "بۆکس ئاگادارکردنەوە لە بڕی کەمی کۆگا",
        "expire_at"                 => "بەسەردەچێ لە",
        "box_quantity"              => "عددی بۆکس",
        "piece_price"               => "نرخی پارچە",
        "box_price"                 => "نرخی بۆکس",
        "pcs_per_box"               => "ژمارەی پارچەکان لەبۆکس",
        "expire_remain"             => "بەرواری بەسەرچوون",
        "has_box"                   => "؟ئایا کاڵا بۆکسی هەیە",
        "is_box"                    => "بۆکسی هەیە",
        "expire_day_remain"         => "ڕۆژی ماوە بۆ بەسەرچوون",
        "expired_day"               => "رۆژە بەسەرچووە",
    ],


    "payment" => [
        "payment"                  => "Payment",
        "payment_list"             => "Payment List",
        "payment_info"             => "Payment Details",

        //fields
        "order"                   => "Order",
        "client"                  => "Client",
        "paid"                    => "Paid",
        "due"                     => "Due",
        "is_paid"                 => "Paid Status",
        "is_lost"                 => "Lost Status",
        "lost_note"               => "Lost Note",
    ],

    "payment_history" => [
        "payment_history"         => "پارەدان",
        "payment_history_list"    => "لیستی پارەدان",
        "payments_received"       => "پارەی نوێی وەرگیراو",
        //fields
        "user"                    => "بەکارهێنەر",
        "client"                  => "کڕیار",
        "amount_paid"             => "بڕی پارەی دراو",
        "date"                    => "ڕێکەوت",
        "safe_id"                 => "قاسە",
        "usd_rate"                => "نرخی USD",
        "exchange_type"           => "نوعی گۆڕانکاری",
        "is_money_returned"       => "دۆخی گەڕانەوەی پارە",
        "money_accepted_by"       => "پارە وەرگیراوە لەلایەن",
        "transfer"                => "گواستنەوە"
    ],

    "return_product" => [
        "return_product"          => "کاڵا گەڕاوەکان",
        "return_product_list"     => "لیستی کاڵا گەڕاوەکان",
        "add_return_product"      => "زیادکردنی کاڵای گەڕاوە",
        "edit_return_product"     => "دەستکاری کاڵای گەڕاوە",
        "return_product_info"     => "زانیاری کاڵای گەڕاوە",

        //fields
        "product_name"            => "ناوی کاڵا",
        "client_name"             => "کڕیار",
        "user_name"               => "گەڕاوەتەوە لە لایەن",
        "type"                    => "جۆر",
        "quantity"                => "عدد",
        "reason"                  => "هۆکار",
        "return_date"             => "ڕێکەوتی گەڕانەوە",
        "estimate_price"          => "پارەی گەڕاوە بە نزیکەیی",
        "return_price"            => "پارەی گەڕاوە",
    ],

    "zone" => [
        "zone"                     => "زۆن",
        "zone_list"                => "لیستی زۆنەکان",
        "add_zone"                 => "زیادکردنی زۆن",
        'edit_zone'                => 'دەستکاری زۆن',

        //fields
        "name"                     => "ناو",
    ],

    "dashboard" => [
        "sale_representvie"           => "مەندوب",
        "driver"                      => "شۆفێر",
        "system_admin"                => "بەڕێوبەری سیستەم",
        "warehouse_manager"           => "بەڕێوبەری مەخزەن",
        "total_orders"                => "کۆی داواکاریەکان",
        "canceled_orders"             => "داواکارە هەڵوەشاوەکان",
        "in_progress_orders"          => "داواکاریە دەرکراوەکان",
        'delivered_orders'            => 'داواکاریە گەیەندراوەکان',
        "last_5_orders"               => "کۆتا پێنج داواکاری",
        "most_saled_products"         => "زۆرترین کاڵای فرۆشراو",
        "most_saled_products_chart"   => "هێڵکاری زۆرترین کاڵای فرۆشراو",
        "orders_status_chart"         => "هێلکاری دۆخی داواکاریەکان",
        "orders_payment_status_chart" => "هێلکاری دۆخی پارەی داواکاریەکان",
        "monthly_car_expenses"        => "مەسرووفی مانگانەی سەیارە",
        "monthly_expenses"            => "مەسرووفی مانگانە",
        "syetem_users_chart"          => "هێلکاری بەکارهێنەری سیستەم",


        //fields
        "order_id"                    => "ئایدی داواکاری",
        "status"                      => "دۆخی داواکاری",
        "client_name"                 => "ناوی کڕیار",
        "view_details"                => "بینینی زانیاری",
        "created_at"                  => "رێکەوتی داواکاری",
        "order_by"                    => "داواکاری لەلایەن",
        "payment_status"              => "دۆخی پارە",
        "total_price"                 => "پارەی گشتی",
    ],

    //common words
    'actions'                       => 'کردارەکان',
    'created_at'                    => 'دروستکراوە لە',
    'created_by'                    => 'دروستکراوە لەلایەن',
    'added_by'                      => 'زیادکراوە لەلایەن',
    'updated_at'                    => 'نوێکراوەتەوە لە',
    'deleted_at'                    => 'سڕاوەتەوە لە',
    'file'                          => 'پەڕگە',
    'file_upload'                   => 'داگرتنی پەڕگە',
    "colvisBtn"                     => 'بینینی ستوون',
    "lat"                           => "پانی",
    "lng"                           => "درێژایی",
    "date_range"                    => "مەودای بەروار",
    "none"                          => "هیچیان",
    "drop_here"                     => "لێرە فایلەکان دابنێ یان کلیک بکە بۆ بارکردن.",
    "box"                           => "بۆک",
    "pc"                            => "پارچە",
    "paid"                          => "پارەی دا",
    "due"                           => "قەرز",
    "edit_resource"                 => "دەستکاری :Resource",
    "delete_resource"               => "ڕەشکردنەوەی :Resource",
    "resource_id"                   => ":Resource ئادی",
    "resource_report"               => ":Resource ڕاپۆرت",
    "yes"                           => "بەڵێ",
    "no"                            => "نەخێر",
    "no_data"                       => 'هیچ زانیاریەک بەردەست نییە',
    "accept"                        => "پەسەندکردن",
    "cancel"                        => "ڕەتکردنەوە",


    //datatable texts
    "colvisBtn"                     => 'بینینی ستوون',
    "search"                        => 'گەڕان:',
    "lengthMenu1"                   => 'پیشاندانی',
    "lengthMenu2"                   => 'لە داتاکان',
    "processing"                    => 'پرۆسێسکردن......',
    "infoShowing"                   => 'پشاندانی',
    "infoTo"                        => 'بۆ',
    "infoOf"                        => 'لە',
    "infoEntries"                   => 'داتا',
    "emptyTable"                    => 'هیچ زانیارییەک لە خشتەکەدا بەردەست نییە',
    "paginateFirst"                 => 'یەکەم',
    "paginateLast"                  => 'دوایین',
    "paginateNext"                  => 'دواتر',
    "paginatePrevious"              => 'پێشووتر',


    // theme sidebar (don't remove yet)
    "Default" => "Default",
    "Saas" => "Saas",
    "Crypto" => "Crypto",
    "Blog" => "Blog",
    "Layouts" => "Layouts",
    "Vertical" => "Vertical",
    "Light_Sidebar" => "Light Sidebar",
    "Compact_Sidebar" => "Compact Sidebar",
    "Icon_Sidebar" => "Icon Sidebar",
    "Boxed_Width" => "Boxed Width",
    "Preloader" => "Preloader",
    "Colored_Sidebar" => "Colored Sidebar",
    "Scrollable" => "Scrollable",
    "Horizontal" => "Horizontal",
    "Topbar_Light" => "Topbar Light",
    "Boxed_Width" => "Boxed Width",
    "Preloader" => "Preloader",
    "Colored_Header" => "Colored Header",
    "Scrollable" => "Scrollable",
    "Apps" => "Apps",
    "Calendars" => "Calendars",
    "TUI_Calendar" => "TUI Calendar",
    "Full_Calendar" => "Full Calendar",
    "Chat" => "Chat",
    "New" => "New",
    "File_Manager" => "File Manager",
    "Ecommerce" => "Ecommerce",
    "Products" => "Products",
    "Product_Detail" => "Product Detail",
    "Orders" => "Orders",
    "Customers" => "Customers",
    "Cart" => "Cart",
    "Checkout" => "Checkout",
    "Shops" => "Shops",
    "Add_Product" => "Add Product",
    "Crypto" => "Crypto",
    "Wallet" => "Wallet",
    "Buy_Sell" => "Buy/Sell",
    "Exchange" => "Exchange",
    "Lending" => "Lending",
    "Orders" => "Orders",
    "KYC_Application" => "KYC Application",
    "ICO_Landing" => "ICO Landing",
    "Email" => "Email",
    "Inbox" => "Inbox",
    "Read_Email" => "Read Email",
    "Templates" => "Templates",
    "Basic_Action" => "Basic Action",
    "Alert_Email" => "Alert Email",
    "Billing_Email" => "Billing Email",
    "Invoices" => "Invoices",
    "Invoice_List" => "Invoice List",
    "Invoice_Detail" => "Invoice Detail",
    "Projects" => "Projects",
    "Projects_Grid" => "Projects Grid",
    "Projects_List" => "Projects List",
    "Project_Overview" => "Project Overview",
    "Create_New" => "Create New",
    "Tasks" => "Tasks",
    "Task_List" => "Task List",
    "Kanban_Board" => "Kanban Board",
    "Create_Task" => "Create Task",
    "contact" => "contact",
    "User_Grid" => "User Grid",
    "User_List" => "User List",
    "Profile" => "Profile",
    "Blog" => "Blog",
    "Blog_List" => "Blog List",
    "Blog_Grid" => "Blog Grid",
    "Blog_Details" => "Blog Details",
    "Pages" => "Pages",
    "Authentication" => "Authentication",
    "Login" => "Login",
    "Register" => "Register",
    "Recover_Password" => "Recover Password",
    "Lock_Screen" => "Lock Screen",
    "Confirm_Mail" => "Confirm Mail",
    "Email_verification" => "Email verification",
    "Two_step_verification" => "Two step verification",
    "Utility" => "Utility",
    "Starter_Page" => "Starter Page",
    "Maintenance" => "Maintenance",
    "Coming_Soon" => "Coming Soon",
    "Timeline" => "Timeline",
    "FAQs" => "FAQs",
    "Pricing" => "Pricing",
    "Error_404" => "Error 404",
    "Error_500" => "Error 500",
    "Components" => "Components",
    "UI_Elements" => "UI Elements",
    "Alerts" => "Alerts",
    "Buttons" => "Buttons",
    "Cards" => "Cards",
    "Carousel" => "Carousel",
    "Dropdowns" => "Dropdowns",
    "Grid" => "Grid",
    "Images" => "Images",
    "Lightbox" => "Lightbox",
    "Modals" => "Modals",
    "Offcanvas" => "Off Canvas",
    "Range_Slider" => "Range Slider",
    "Session_Timeout" => "Session Timeout",
    "Progress_Bars" => "Progress Bars",
    "Sweet_Alert" => "Sweet-Alert",
    "Tabs_&_Accordions" => "Tabs & Accordions",
    "Typography" => "Typography",
    "Video" => "Video",
    "General" => "General",
    "Colors" => "Colors",
    "Rating" => "Rating",
    "Notifications" => "Notifications",
    "Forms" => "Forms",
    "Form_Elements" => "Form Elements",
    "Form_Layouts" => "Form Layouts",
    "Form_Validation" => "Form Validation",
    "Form_Advanced" => "Form Advanced",
    "Form_Editors" => "Form Editors",
    "Form_File_Upload" => "Form File Upload",
    "Form_Xeditable" => "Form Xeditable",
    "Form_Repeater" => "Form Repeater",
    "Form_Wizard" => "Form Wizard",
    "Form_Mask" => "Form Mask",
    "Tables" => "Tables",
    "Basic_Tables" => "Basic Tables",
    "Data_Tables" => "Data Tables",
    "Responsive_Table" => "Responsive Table",
    "Editable_Table" => "Editable Table",
    "Charts" => "Charts",
    "Apex_Charts" => "Apex Charts",
    "E_Charts" => "E Charts",
    "Chartjs_Charts" => "Chartjs Charts",
    "Flot_Charts" => "Flot Charts",
    "Toast_UI_Charts" => "Toast UI Charts",
    "Jquery_Knob_Charts" => "Jquery Knob Charts",
    "Sparkline_Charts" => "Sparkline Charts",
    "Icons" => "Icons",
    "Boxicons" => "Boxicons",
    "Material_Design" => "Material Design",
    "Dripicons" => "Dripicons",
    "Font_awesome" => "Font awesome",
    "Maps" => "Maps",
    "Google_Maps" => "Google Maps",
    "Vector_Maps" => "Vector Maps",
    "Leaflet_Maps" => "Leaflet Maps",
    "Multi_Level" => "Multi Level",
    "Level_1.1" => "Level 1.1",
    "Level_1.2" => "Level 1.2",
    "Level_2.1" => "Level 2.1",
    "Level_2.2" => "Level 2.2",
    "Search" => "Search...",
    "Mega_Menu" => "Mega Menu",
    "UI_Components" => "UI Components",
    "Applications" => "Applications",
    "Extra_Pages" => "Extra Pages",
    "Horizontal_layout" => "Horizontal layout",
    "View_All" => "View All",
    "Your_order_is_placed" => "Your order is placed",
    "If_several_languages_coalesce_the_grammar" => "If several languages coalesce the grammar",
    "3_min_ago" => "3 min ago",
    "James_Lemire" => "James Lemire",
    "It_will_seem_like_simplified_English" => "It will seem like simplified English.",
    "1_hours_ago" => "1 hours ago",
    "Your_item_is_shipped" => "Your item is shipped",
    "Salena_Layfield" => "Salena Layfield",
    "As_a_skeptical_Cambridge_friend_of_mine_occidental" => "As a skeptical Cambridge friend of mine occidental.",
    "View_More" => "View More..",
    "Profile" => "Profile",
    "My_Wallet" => "My Wallet",
    "Settings" => "Settings",
    "Lock_screen" => "Lock screen",
    "Logout" => "Logout",
    "Edit_Details" => "Edit Details",
    "Placeholders" => "Placeholders",
    "Toasts" => "Toasts",
];
