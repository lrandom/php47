<?php
require_once(PREP_SSO__PLUGIN_DIR . 'prep-user.php');
$prepUser = null;

class PrepSso
{

    public static $prepUser = null;

    public static function plugin_activation()
    {
    }

    /**
     * Removes all connection options
     * @static
     */
    public static function plugin_deactivation()
    {
    }

    public static function logged_in_shortcode($attrs, $innerContent, $name)
    {
        if (!static::$prepUser) {
            $hrepLogin = self::get_sso_auth_login_url();
            $redirectUriQuery = self::get_sso_auth_redirect_uri_query();
            $redirectUri = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            if (!str_contains($hrepLogin, '?')) {
                $hrepLogin = $hrepLogin . "?$redirectUriQuery=$redirectUri";
            } else {
                $hrepLogin = $hrepLogin . "&$redirectUriQuery=$redirectUri";
            }
            $notLoginTitle = $attrs['title'] ?? "<div>Vui lòng <a class='prep-login'>đăng nhập</a> để xem</div>";
            return $notLoginTitle;
        }
        return do_shortcode($innerContent);
    }

    private static function _generateAuthUserProfileUIContentForDesktopNav($prepUser)
    {
        $stringOne = '
           <div class="relative dropdown group z-50">
            <div class="flex items-center gap-2 flex-grow rounded-full w-10 h-10 overflow-hidden">
            <img src="' . $prepUser->avatar . '"
         alt="avatar" class="w-10 h-10 rounded-full border-1 object-cover cursor-pointer"
             >
           </div>
            <div
                class="rounded-2xl shadow-md p-0 m-0 absolute bg-white border-t-2 border-gray-100 w-64 justify-start z-20 text-left dropdown-item hidden group-hover:block md:-right-5 xl:-right-20 right-0"
            >
            <ul class="overflow-hidden" style="min-width: 120px;">
            <li class="m-0 p-3">
        <a href="/profile" class="p-2 text-gray-800 hover:bg-blue-50 flex flex-row items-center rounded-md"
           title="' . $prepUser->email . '"
        >
          <img src="https://storage.googleapis.com/materials-elements/users/avatar/img2021113015414674424800.jpeg"
               alt="avatar" class="rounded-full w-12 h-12 object-cover cursor-pointer"
          >
          <!---->
          <div class="flex flex-col ml-2">
            <div class="font-semibold fw-700 text-md">' . $prepUser->username . '</div>
            <div class="text-xs text-gray-800">' . substr($prepUser->email, 0, strlen($prepUser->email) < 20 ? strlen($prepUser->email) : 20);

        $stringTwo = strlen($prepUser->email) < 20 ? '' : '...';

        $stringThree = '</div>
          </div>
        </a></li>
            <li class="border border-gray-100 mx-3"></li>
              <li class="m-0 p-3"><a href="https://prep.vn/khoa-hoc-cua-toi"
                             class="p-2 block text-gray-800 hover:bg-blue-50 font-semibold rounded-md"
                 ><span class="px-1">Khoá học của tôi</span></a></li>
                    <li class="m-0 px-3"><a href="https://prep.vn/chat/conversation"
                              class="p-2 block text-gray-800 hover:bg-blue-50 font-semibold rounded-md"
      ><span class="px-1"> Trao đổi về bài chấm chữa </span></a></li>
      <li class="m-0 px-3"><a href="https://prep.vn/learning-profile"
                              class="p-2 block text-gray-800 hover:bg-blue-50 font-semibold rounded-md"
      ><span class="px-1"> Hồ sơ học tập </span></a></li>
      <li class="m-0 px-3">
        <a href="https://prep.vn/profile" class="p-2 block text-gray-800 hover:bg-blue-50 font-semibold rounded-md">
          <span class="px-1">Cài đặt</span></a></li>
      <li class="border border-gray-100 mx-3"></li>
      <li class="m-0 p-3"><a class="p-2 block text-gray-800 hover:bg-blue-50 text-red-500 font-semibold rounded-md"
                             href="javascript:void(0)"
      >
        <span class="px-1">Đăng xuất</span></a></li>
    </ul>
  </div>
</div>
     ';
        return $stringOne . $stringTwo . $stringThree;
    }

    private static function _generateAuthUserProfiledUIContentForMobileNav()
    {

    }

    public static function prep_auth_info_shortcode($isDesktop = true)
    {
        global $prepUser;
        if (!$prepUser) {
            return '';
        }
        $url = self::get_sso_auth_account_url();
        if ($isDesktop) {
            return self::_generateAuthUserProfileUIContentForDesktopNav($prepUser);
        }
        return self::_generateAuthUserProfileUIContentForDesktopNav($prepUser);
    }

    public static function init()
    {
        self::loadUser();
        add_action('wp_head', function () {
            $prepUser = json_encode(static::$prepUser);
            $link = static::get_sso_auth_login_iframe_url();
            ?>
            <script>
                const PREP_USER = <?= $prepUser ?>;
                const prepLoginIframeUrl = ' <?= $link ?>';
            </script>
            <?php
        });
        wp_enqueue_style('prep_sso_plugin_style', plugin_dir_url(__FILE__) . '/css/style.css', array(), '1');
        wp_enqueue_script('prep_sso_plugin_script', plugin_dir_url(__FILE__) . '/js/main.js', array(), '1', true);

    }

    public
    static function loadUser()
    {
        $token = self::_getToken();
        if ($token) {
            $api = static::get_sso_auth_check_api();

            $args = [
                'headers' => [
                    "Content-type" => "application/json",
                    "Accept" => 'application/json',
                    "Authorization" => "Bearer $token"
                ]
            ];
            $response = wp_remote_get($api, $args);
            if ($response instanceof WP_Error) {
                return;
            }
            if ($response['response']['code'] != 200) {
                return;
            }
            $body = json_decode($response['body'], true);
            $data = $body['data'];
            $prepUser = new PrepUser();
            $prepUser->id = $data['id'];
            $prepUser->username = $data['username'];
            $prepUser->phone = $data['phone'];
            $prepUser->email = $data['email'];
            $prepUser->name = $data['name'];
            $prepUser->is_first_login = $data['is_first_login'];
            $prepUser->avatar = $data['avatar'] ?? static::get_sso_auth_default_avatar();
            static::$prepUser = $prepUser;

            global $prepUser;
            $prepUser = static::$prepUser;
        }
    }

    public
    static function add_settings_menu()
    {
        add_options_page('Prep SSO', 'Prep SSO', 'manage_options', 'prep-sso-plugin', ['PrepSso', 'prep_sso_render_plugin_settings_page']);
    }

    public
    static function prep_sso_register_settings()
    {
        register_setting('prep_sso_plugin_setting_options', 'prep_sso_plugin_setting_options', 'prep_sso_plugin_setting_options_validate');
        add_settings_section('auth_settings', 'Auth Setting', ['PrepSso', 'prep_sso_plugin_auth_section_text'], 'prep_sso_plugin_setting');

        add_settings_field('prep_sso_plugin_setting_cookie_name', 'Cookie Name', ['PrepSso', 'prep_sso_plugin_setting_cookie_name'], 'prep_sso_plugin_setting', 'auth_settings');
        add_settings_field('prep_sso_setting_auth_check_api', 'Auth Check API (Me API)', ['PrepSso', 'prep_sso_setting_auth_check_api'], 'prep_sso_plugin_setting', 'auth_settings');
        add_settings_field('prep_sso_setting_login_url', 'Login URL', ['PrepSso', 'prep_sso_setting_login_url'], 'prep_sso_plugin_setting', 'auth_settings');
        add_settings_field('prep_sso_setting_login_iframe_url', 'Login Iframe URL', ['PrepSso', 'prep_sso_setting_login_iframe_url'], 'prep_sso_plugin_setting', 'auth_settings');

        add_settings_field('prep_sso_setting_redirect_uri_query', 'Redirect Uri Query', ['PrepSso', 'prep_sso_setting_redirect_uri_query'], 'prep_sso_plugin_setting', 'auth_settings');
        add_settings_field('prep_sso_setting_default_avatar', 'Default avatar link', ['PrepSso', 'prep_sso_setting_default_avatar'], 'prep_sso_plugin_setting', 'auth_settings');
        add_settings_field('prep_sso_setting_account_url', 'Account page Url', ['PrepSso', 'prep_sso_setting_account_url'], 'prep_sso_plugin_setting', 'auth_settings');
    }

    public
    static function prep_sso_render_plugin_settings_page()
    {
        ?>
        <h2>Prep SSO Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('prep_sso_plugin_setting_options');
            do_settings_sections('prep_sso_plugin_setting'); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>"/>
        </form>
        <?php
    }

    public
    static function prep_sso_plugin_setting_options_validate($input)
    {
        return $input;
    }

    public
    static function prep_sso_plugin_auth_section_text()
    {
        $shortCode = PREP_AUTH_CONTENT;
        $shortCodeAuth = PREP_AUTH_INFO;
        echo "<p>Setting for Auth</p>
        <p>Short code: [$shortCode]your-content[/$shortCode]</p>
        <p>Short code: [$shortCodeAuth]</p>
        ";
    }

    public
    static function getPrepSsoSettingOptions()
    {
        return get_option('prep_sso_plugin_setting_options') ?? [];
    }


    public
    static function prep_sso_plugin_setting_cookie_name()
    {
        $options = static::getPrepSsoSettingOptions();
        echo "<input id='prep_sso_plugin_setting_cookie_name' name='prep_sso_plugin_setting_options[cookie_name]' type='text' value='" . esc_attr(self::get_sso_cookie_name()) . "' />";
    }

    public
    static function get_sso_auth_check_api()
    {
        return self::getPrepSsoSettingOptions()['auth_check_api'] ?? PREP_SSO_DEFAULT_AUTH_CHECK_API;
    }

    public
    static function get_sso_auth_logout_api()
    {
        return self::getPrepSsoSettingOptions()['auth_logout_api'] ?? PREP_SSO_DEFAULT_LOGOUT_API;
    }

    public
    static function get_sso_auth_login_url()
    {
        return self::getPrepSsoSettingOptions()['login_url'] ?? '';
    }

    public
    static function get_sso_auth_login_iframe_url()
    {
        return self::getPrepSsoSettingOptions()['login_iframe_url'] ?? '';
    }

    public
    static function get_sso_auth_redirect_uri_query()
    {
        return self::getPrepSsoSettingOptions()['redirect_uri_query'] ?? 'redirect_uri';
    }

    public
    static function get_sso_cookie_name()
    {
        return self::getPrepSsoSettingOptions()['cookie_name'] ?? PREP_SSO_DEFAULT_COOKIE_NAME;
    }

    public
    static function get_sso_auth_account_url()
    {
        return self::getPrepSsoSettingOptions()['account_url'] ?? '#';
    }

    public
    static function get_sso_auth_default_avatar()
    {
        return self::getPrepSsoSettingOptions()['default_avatar'] ?? '';
    }

    public
    static function prep_sso_setting_auth_check_api()
    {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[auth_check_api]' type='text' value='" . esc_attr(self::get_sso_auth_check_api()) . "' />";
    }

    public
    static function prep_sso_setting_login_url()
    {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[login_url]' type='text' value='" . esc_attr(self::get_sso_auth_login_url()) . "' />";
    }

    public
    static function prep_sso_setting_login_iframe_url()
    {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[login_iframe_url]' type='text' value='" . esc_attr(self::get_sso_auth_login_iframe_url()) . "' />";
    }

    public
    static function prep_sso_setting_redirect_uri_query()
    {
        echo "<input name='prep_sso_plugin_setting_options[redirect_uri_query]' type='text' value='" . esc_attr(self::get_sso_auth_redirect_uri_query()) . "' />";
    }

    public
    static function prep_sso_setting_default_avatar()
    {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[default_avatar]' type='text' value='" . esc_attr(self::get_sso_auth_default_avatar()) . "' />";
    }

    public
    static function prep_sso_setting_account_url()
    {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[account_url]' type='text' value='" . esc_attr(self::get_sso_auth_account_url()) . "' />";
    }

    /**
     * @return mixed|null
     */
    private
    static function _getToken()
    {
        $tokenName = static::get_sso_cookie_name();
        $tokenGet = $_GET['auth_token'] ?? null;
        $token = $tokenGet ?? ($_COOKIE[$tokenName] ?? null);
        if ($tokenGet) {
            $els = explode('.', $_SERVER['SERVER_NAME']);
            $domain = '.' . $els[count($els) - 2] . '.' . $els[count($els) - 1];
            setcookie($tokenName, $token, time() + (86400 * 90), "/", $domain);
        }
        return $token;
    }
}

