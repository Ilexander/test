<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public const DEFAULT_LANGUAGE = 'English';

    public const GENERAL_SETTINGS = 'general_settings';
    public const LOGO_SETTINGS = 'logo_settings';
    public const COOKIE_POLICY_SETTINGS = 'cookie_policy_settings';
    public const TERMS_POLICY_PAGE_SETTINGS = 'terms_policy_page_settings';
    public const DEFAULT_SETTINGS = 'default_settings';
    public const CURRENCY_SETTINGS = 'currency_settings';
    public const OTHER_SETTINGS = 'other_settings';
    public const MAIL_TEMPLATE = 'mail_template';
    public const MAIL_SETTINGS = 'mail_settings';
    public const SUPPORT_SETTINGS = 'support_settings';
    public const RECAPTCHA_SETTINGS = 'recaptcha_settings';
    public const TRANSLATION_SETTINGS = 'translation_settings';
    public const PAYPAL_SETTINGS = 'paypal_settings';

    public const SETTING_PAGE_ARRAY = [
        self::GENERAL_SETTINGS,
        self::LOGO_SETTINGS,
        self::COOKIE_POLICY_SETTINGS,
        self::TERMS_POLICY_PAGE_SETTINGS,
        self::DEFAULT_SETTINGS,
        self::CURRENCY_SETTINGS,
        self::OTHER_SETTINGS,
        self::MAIL_TEMPLATE,
        self::MAIL_SETTINGS,
        self::SUPPORT_SETTINGS,
        self::RECAPTCHA_SETTINGS,
        self::TRANSLATION_SETTINGS,
        self::PAYPAL_SETTINGS,
    ];

    protected $fillable = [
        'page_name',
        'field_name',
        'field_value',
    ];
}
