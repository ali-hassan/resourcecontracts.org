<?php namespace App\Nrgi\Services\Language;

use Carbon\Carbon;

/**
 * Class LanguageService
 * @package App\Nrgi\Services\Language
 */
class LanguageService
{
    /**
     * @var Carbon
     */
    protected $carbon;

    /**
     * @var string
     */
    protected $key = 'rc_admin_lang';

    /**
     * LanguageService constructor.
     *
     * @param Carbon $carbon
     */
    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    /**
     * Get Available Languages
     *
     * @return object
     */
    public function getAvailableLang()
    {
        return config('lang.list');
    }

    /**
     * Get Default Language
     *
     * @return string
     */
    public function defaultLang()
    {
        $code = $this->browserLang();

        if ($this->isValidLang($code)) {
            return $code;
        }

        return config('lang.default');
    }

    /**
     * Get Language code
     *
     * @param null $lang
     *
     * @return string
     */
    public function getSiteLang($lang = null)
    {
        if (empty($lang)) {
            $lang = isset($_COOKIE[$this->key]) ? $_COOKIE[$this->key] : $this->defaultLang();
        }

        return $lang;
    }

    /**
     * Set Language code
     *
     * @param $lang
     *
     * @return Void
     */
    public function setSiteLang($lang)
    {
        $lang = $this->getValidLang($lang);
        app()->setLocale($lang);
        setcookie($this->key, $lang, $this->carbon->now()->addYear(1)->timestamp, '/');
    }

    /**
     * Get Valid Language Code.
     *
     * @param $lang
     *
     * @return string
     */
    public function getValidLang($lang)
    {
        $lang = trim(strtolower($lang));

        if ($this->isValidLang($lang)) {
            return $lang;
        }

        return $this->defaultLang();
    }

    /**
     * write brief description
     * @return array
     */
    public function current()
    {
        $code = app()->getLocale();

        return (object) $this->getLangInfo($code);
    }

    /**
     * Check for valid Language code
     *
     * @param $lang
     *
     * @return bool
     */
    protected function isValidLang($lang)
    {
        $info = $this->getLangInfo($lang);

        return empty($info) ? false : true;
    }

    /**
     * Get Direction of language
     *
     * @return array
     */
    public function dir()
    {
        $info = $this->current();

        return isset($info->dir) ? $info->dir : 'ltr';
    }

    /**
     * Get Language info
     *
     * @param $code
     *
     * @return array
     */
    public function getLangInfo($code)
    {
        foreach ($this->getAvailableLang() as $lang) {
            if ($lang['code'] == $code) {
                return $lang;
            }
        }

        return [];
    }

    /**
     * Get Browser Language
     *
     * @return string
     */
    protected function browserLang()
    {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
}