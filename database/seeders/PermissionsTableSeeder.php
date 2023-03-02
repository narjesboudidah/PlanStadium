<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 18,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 19,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 20,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 21,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 22,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 23,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 24,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 25,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 26,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 27,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 28,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 29,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 30,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 31,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 32,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 33,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 34,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 35,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 36,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 37,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 38,
                'title' => 'club_create',
            ],
            [
                'id'    => 39,
                'title' => 'club_edit',
            ],
            [
                'id'    => 40,
                'title' => 'club_show',
            ],
            [
                'id'    => 41,
                'title' => 'club_delete',
            ],
            [
                'id'    => 42,
                'title' => 'club_access',
            ],
            [
                'id'    => 43,
                'title' => 'sport_create',
            ],
            [
                'id'    => 44,
                'title' => 'sport_edit',
            ],
            [
                'id'    => 45,
                'title' => 'sport_show',
            ],
            [
                'id'    => 46,
                'title' => 'sport_delete',
            ],
            [
                'id'    => 47,
                'title' => 'sport_access',
            ],
            [
                'id'    => 48,
                'title' => 'competition_create',
            ],
            [
                'id'    => 49,
                'title' => 'competition_edit',
            ],
            [
                'id'    => 50,
                'title' => 'competition_show',
            ],
            [
                'id'    => 51,
                'title' => 'competition_delete',
            ],
            [
                'id'    => 52,
                'title' => 'competition_access',
            ],
            [
                'id'    => 53,
                'title' => 'season_create',
            ],
            [
                'id'    => 54,
                'title' => 'season_edit',
            ],
            [
                'id'    => 55,
                'title' => 'season_show',
            ],
            [
                'id'    => 56,
                'title' => 'season_delete',
            ],
            [
                'id'    => 57,
                'title' => 'season_access',
            ],
            [
                'id'    => 58,
                'title' => 'team_create',
            ],
            [
                'id'    => 59,
                'title' => 'team_edit',
            ],
            [
                'id'    => 60,
                'title' => 'team_show',
            ],
            [
                'id'    => 61,
                'title' => 'team_delete',
            ],
            [
                'id'    => 62,
                'title' => 'team_access',
            ],
            [
                'id'    => 63,
                'title' => 'setting_access',
            ],
            [
                'id'    => 64,
                'title' => 'language_create',
            ],
            [
                'id'    => 65,
                'title' => 'language_edit',
            ],
            [
                'id'    => 66,
                'title' => 'language_show',
            ],
            [
                'id'    => 67,
                'title' => 'language_delete',
            ],
            [
                'id'    => 68,
                'title' => 'language_access',
            ],
            [
                'id'    => 69,
                'title' => 'slider_create',
            ],
            [
                'id'    => 70,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 71,
                'title' => 'slider_show',
            ],
            [
                'id'    => 72,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 73,
                'title' => 'slider_access',
            ],
            [
                'id'    => 74,
                'title' => 'gallery_create',
            ],
            [
                'id'    => 75,
                'title' => 'gallery_edit',
            ],
            [
                'id'    => 76,
                'title' => 'gallery_show',
            ],
            [
                'id'    => 77,
                'title' => 'gallery_delete',
            ],
            [
                'id'    => 78,
                'title' => 'gallery_access',
            ],
            [
                'id'    => 79,
                'title' => 'news_create',
            ],
            [
                'id'    => 80,
                'title' => 'news_edit',
            ],
            [
                'id'    => 81,
                'title' => 'news_show',
            ],
            [
                'id'    => 82,
                'title' => 'news_delete',
            ],
            [
                'id'    => 83,
                'title' => 'news_access',
            ],
            [
                'id'    => 84,
                'title' => 'sponsor_create',
            ],
            [
                'id'    => 85,
                'title' => 'sponsor_edit',
            ],
            [
                'id'    => 86,
                'title' => 'sponsor_show',
            ],
            [
                'id'    => 87,
                'title' => 'sponsor_delete',
            ],
            [
                'id'    => 88,
                'title' => 'sponsor_access',
            ],
            [
                'id'    => 89,
                'title' => 'ad_create',
            ],
            [
                'id'    => 90,
                'title' => 'ad_edit',
            ],
            [
                'id'    => 91,
                'title' => 'ad_show',
            ],
            [
                'id'    => 92,
                'title' => 'ad_delete',
            ],
            [
                'id'    => 93,
                'title' => 'ad_access',
            ],
            [
                'id'    => 94,
                'title' => 'prize_create',
            ],
            [
                'id'    => 95,
                'title' => 'prize_edit',
            ],
            [
                'id'    => 96,
                'title' => 'prize_show',
            ],
            [
                'id'    => 97,
                'title' => 'prize_delete',
            ],
            [
                'id'    => 98,
                'title' => 'prize_access',
            ],
            [
                'id'    => 99,
                'title' => 'workforce_management_access',
            ],
            [
                'id'    => 100,
                'title' => 'club_team_create',
            ],
            [
                'id'    => 101,
                'title' => 'club_team_edit',
            ],
            [
                'id'    => 102,
                'title' => 'club_team_show',
            ],
            [
                'id'    => 103,
                'title' => 'club_team_delete',
            ],
            [
                'id'    => 104,
                'title' => 'club_team_access',
            ],
            [
                'id'    => 105,
                'title' => 'poste_create',
            ],
            [
                'id'    => 106,
                'title' => 'poste_edit',
            ],
            [
                'id'    => 107,
                'title' => 'poste_show',
            ],
            [
                'id'    => 108,
                'title' => 'poste_delete',
            ],
            [
                'id'    => 109,
                'title' => 'poste_access',
            ],
            [
                'id'    => 110,
                'title' => 'match_management_access',
            ],
            [
                'id'    => 111,
                'title' => 'match_create',
            ],
            [
                'id'    => 112,
                'title' => 'match_edit',
            ],
            [
                'id'    => 113,
                'title' => 'match_show',
            ],
            [
                'id'    => 114,
                'title' => 'match_delete',
            ],
            [
                'id'    => 115,
                'title' => 'match_access',
            ],
            [
                'id'    => 116,
                'title' => 'stadium_create',
            ],
            [
                'id'    => 117,
                'title' => 'stadium_edit',
            ],
            [
                'id'    => 118,
                'title' => 'stadium_show',
            ],
            [
                'id'    => 119,
                'title' => 'stadium_delete',
            ],
            [
                'id'    => 120,
                'title' => 'stadium_access',
            ],
            [
                'id'    => 121,
                'title' => 'match_result_create',
            ],
            [
                'id'    => 122,
                'title' => 'match_result_edit',
            ],
            [
                'id'    => 123,
                'title' => 'match_result_show',
            ],
            [
                'id'    => 124,
                'title' => 'match_result_delete',
            ],
            [
                'id'    => 125,
                'title' => 'match_result_access',
            ],
            [
                'id'    => 126,
                'title' => 'classement_create',
            ],
            [
                'id'    => 127,
                'title' => 'classement_edit',
            ],
            [
                'id'    => 128,
                'title' => 'classement_show',
            ],
            [
                'id'    => 129,
                'title' => 'classement_delete',
            ],
            [
                'id'    => 130,
                'title' => 'classement_access',
            ],
            [
                'id'    => 131,
                'title' => 'classement_team_create',
            ],
            [
                'id'    => 132,
                'title' => 'classement_team_edit',
            ],
            [
                'id'    => 133,
                'title' => 'classement_team_show',
            ],
            [
                'id'    => 134,
                'title' => 'classement_team_delete',
            ],
            [
                'id'    => 135,
                'title' => 'classement_team_access',
            ],
            [
                'id'    => 136,
                'title' => 'composition_create',
            ],
            [
                'id'    => 137,
                'title' => 'composition_edit',
            ],
            [
                'id'    => 138,
                'title' => 'composition_show',
            ],
            [
                'id'    => 139,
                'title' => 'composition_delete',
            ],
            [
                'id'    => 140,
                'title' => 'composition_access',
            ],
            [
                'id'    => 141,
                'title' => 'video_configuration_create',
            ],
            [
                'id'    => 142,
                'title' => 'video_configuration_edit',
            ],
            [
                'id'    => 143,
                'title' => 'video_configuration_show',
            ],
            [
                'id'    => 144,
                'title' => 'video_configuration_delete',
            ],
            [
                'id'    => 145,
                'title' => 'video_configuration_access',
            ],
            [
                'id'    => 146,
                'title' => 'president_create',
            ],
            [
                'id'    => 147,
                'title' => 'president_edit',
            ],
            [
                'id'    => 148,
                'title' => 'president_show',
            ],
            [
                'id'    => 149,
                'title' => 'president_delete',
            ],
            [
                'id'    => 150,
                'title' => 'president_access',
            ],
            [
                'id'    => 151,
                'title' => 'clubmanger_access',
            ],
            [
                'id'    => 152,
                'title' => 'notification_access',
            ],
            [
                'id'    => 153,
                'title' => 'push_notification_create',
            ],
            [
                'id'    => 154,
                'title' => 'push_notification_edit',
            ],
            [
                'id'    => 155,
                'title' => 'push_notification_show',
            ],
            [
                'id'    => 156,
                'title' => 'push_notification_delete',
            ],
            [
                'id'    => 157,
                'title' => 'push_notification_access',
            ],
            [
                'id'    => 158,
                'title' => 'notification_setting_create',
            ],
            [
                'id'    => 159,
                'title' => 'notification_setting_edit',
            ],
            [
                'id'    => 160,
                'title' => 'notification_setting_show',
            ],
            [
                'id'    => 161,
                'title' => 'notification_setting_delete',
            ],
            [
                'id'    => 162,
                'title' => 'notification_setting_access',
            ],
            [
                'id'    => 163,
                'title' => 'academymenu_access',
            ],
            [
                'id'    => 164,
                'title' => 'academy_create',
            ],
            [
                'id'    => 165,
                'title' => 'academy_edit',
            ],
            [
                'id'    => 166,
                'title' => 'academy_show',
            ],
            [
                'id'    => 167,
                'title' => 'academy_delete',
            ],
            [
                'id'    => 168,
                'title' => 'academy_access',
            ],
            [
                'id'    => 169,
                'title' => 'activity_create',
            ],
            [
                'id'    => 170,
                'title' => 'activity_edit',
            ],
            [
                'id'    => 171,
                'title' => 'activity_show',
            ],
            [
                'id'    => 172,
                'title' => 'activity_delete',
            ],
            [
                'id'    => 173,
                'title' => 'activity_access',
            ],
            [
                'id'    => 174,
                'title' => 'gamification_access',
            ],
            [
                'id'    => 175,
                'title' => 'badge_create',
            ],
            [
                'id'    => 176,
                'title' => 'badge_edit',
            ],
            [
                'id'    => 177,
                'title' => 'badge_show',
            ],
            [
                'id'    => 178,
                'title' => 'badge_delete',
            ],
            [
                'id'    => 179,
                'title' => 'badge_access',
            ],
            [
                'id'    => 180,
                'title' => 'action_create',
            ],
            [
                'id'    => 181,
                'title' => 'action_edit',
            ],
            [
                'id'    => 182,
                'title' => 'action_show',
            ],
            [
                'id'    => 183,
                'title' => 'action_delete',
            ],
            [
                'id'    => 184,
                'title' => 'action_access',
            ],
            [
                'id'    => 185,
                'title' => 'shop_access',
            ],
            [
                'id'    => 186,
                'title' => 'category_create',
            ],
            [
                'id'    => 187,
                'title' => 'category_edit',
            ],
            [
                'id'    => 188,
                'title' => 'category_show',
            ],
            [
                'id'    => 189,
                'title' => 'category_delete',
            ],
            [
                'id'    => 190,
                'title' => 'category_access',
            ],
            [
                'id'    => 191,
                'title' => 'product_create',
            ],
            [
                'id'    => 192,
                'title' => 'product_edit',
            ],
            [
                'id'    => 193,
                'title' => 'product_show',
            ],
            [
                'id'    => 194,
                'title' => 'product_delete',
            ],
            [
                'id'    => 195,
                'title' => 'product_access',
            ],
            [
                'id'    => 196,
                'title' => 'variant_create',
            ],
            [
                'id'    => 197,
                'title' => 'variant_edit',
            ],
            [
                'id'    => 198,
                'title' => 'variant_show',
            ],
            [
                'id'    => 199,
                'title' => 'variant_delete',
            ],
            [
                'id'    => 200,
                'title' => 'variant_access',
            ],
            [
                'id'    => 201,
                'title' => 'users_history_create',
            ],
            [
                'id'    => 202,
                'title' => 'users_history_edit',
            ],
            [
                'id'    => 203,
                'title' => 'users_history_show',
            ],
            [
                'id'    => 204,
                'title' => 'users_history_delete',
            ],
            [
                'id'    => 205,
                'title' => 'users_history_access',
            ],
            [
                'id'    => 206,
                'title' => 'match_live_create',
            ],
            [
                'id'    => 207,
                'title' => 'match_live_edit',
            ],
            [
                'id'    => 208,
                'title' => 'match_live_show',
            ],
            [
                'id'    => 209,
                'title' => 'match_live_delete',
            ],
            [
                'id'    => 210,
                'title' => 'match_live_access',
            ],
            [
                'id'    => 211,
                'title' => 'videos_menu_access',
            ],
            [
                'id'    => 212,
                'title' => 'video_create',
            ],
            [
                'id'    => 213,
                'title' => 'video_edit',
            ],
            [
                'id'    => 214,
                'title' => 'video_show',
            ],
            [
                'id'    => 215,
                'title' => 'video_delete',
            ],
            [
                'id'    => 216,
                'title' => 'video_access',
            ],
            [
                'id'    => 217,
                'title' => 'theme_option_create',
            ],
            [
                'id'    => 218,
                'title' => 'theme_option_edit',
            ],
            [
                'id'    => 219,
                'title' => 'theme_option_show',
            ],
            [
                'id'    => 220,
                'title' => 'theme_option_delete',
            ],
            [
                'id'    => 221,
                'title' => 'theme_option_access',
            ],
            [
                'id'    => 222,
                'title' => 'page_header_option_create',
            ],
            [
                'id'    => 223,
                'title' => 'page_header_option_edit',
            ],
            [
                'id'    => 224,
                'title' => 'page_header_option_show',
            ],
            [
                'id'    => 225,
                'title' => 'page_header_option_delete',
            ],
            [
                'id'    => 226,
                'title' => 'page_header_option_access',
            ],
            [
                'id'    => 227,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
