<?php
require_once( PREP_SSO__PLUGIN_DIR . 'prep-user.php');
$prepUser = null;
class PrepSso {

    public static $prepUser = null;
    public static function plugin_activation() {
    }

    /**
     * Removes all connection options
     * @static
     */
    public static function plugin_deactivation( ) {
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

    public static function prep_auth_info_shortcode()
    {
        global $prepUser;
        if (!$prepUser) {
            return '';
        }
        $url = self::get_sso_auth_account_url();
        return "
            <a class='prep-profile' href='$url'>
                <div class='prep-avatar'>
                    <img src='$prepUser->avatar' alt='avatar'>
                </div>
            </a>";
    }

    public static function init()
    {
        self::loadUser();
        add_action('wp_head', function() {
            $prepUser = json_encode(static::$prepUser);
            $link = static::get_sso_auth_login_iframe_url();
            ?>
            <script>
                const PREP_USER = <?= $prepUser ?>;
                const prepLoginIframeUrl = '<?= $link ?>';
            </script>
            <?php
        });
        wp_enqueue_style( 'prep_sso_plugin_style', plugin_dir_url( __FILE__ ) . '/css/style.css', array(), '1' );
        wp_enqueue_script( 'prep_sso_plugin_script', plugin_dir_url( __FILE__ ) . '/js/main.js', array(), '1' , true);

    }

    public static function loadUser()
    {
        $tokenName = static::get_sso_cookie_name();
        $tokenGet = $_GET['auth_token'] ?? null;
        $token = $tokenGet ?? ($_COOKIE[$tokenName] ?? null);
        if ($tokenGet) {
            $els = explode('.', $_SERVER['SERVER_NAME']);
            $domain = '.' . $els[count($els)-2] . '.' . $els[count($els)-1];
            setcookie($tokenName, $token, time() + (86400 * 90), "/", $domain);
        }
        if ($token) {
            $api = static::get_sso_auth_check_api();

            $args = [
                'headers' => [
                    "Content-type" => "application/json",
                    "Accept" => 'application/json',
                    "Authorization" => "Bearer $token"
                ]
            ];
            $response = wp_remote_get( $api, $args );
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

    public static function add_settings_menu() {
        add_options_page( 'Prep SSO', 'Prep SSO', 'manage_options', 'prep-sso-plugin', ['PrepSso' , 'prep_sso_render_plugin_settings_page'] );
    }

    public static function prep_sso_register_settings() {
        register_setting( 'prep_sso_plugin_setting_options', 'prep_sso_plugin_setting_options', 'prep_sso_plugin_setting_options_validate' );
        add_settings_section( 'auth_settings', 'Auth Setting', ['PrepSso','prep_sso_plugin_auth_section_text'], 'prep_sso_plugin_setting' );

        add_settings_field( 'prep_sso_plugin_setting_cookie_name', 'Cookie Name', ['PrepSso', 'prep_sso_plugin_setting_cookie_name'], 'prep_sso_plugin_setting', 'auth_settings' );
        add_settings_field( 'prep_sso_setting_auth_check_api', 'Auth Check API (Me API)', ['PrepSso', 'prep_sso_setting_auth_check_api'], 'prep_sso_plugin_setting', 'auth_settings' );
        add_settings_field( 'prep_sso_setting_login_url', 'Login URL', ['PrepSso', 'prep_sso_setting_login_url'], 'prep_sso_plugin_setting', 'auth_settings' );
        add_settings_field( 'prep_sso_setting_login_iframe_url', 'Login Iframe URL', ['PrepSso', 'prep_sso_setting_login_iframe_url'], 'prep_sso_plugin_setting', 'auth_settings' );

        add_settings_field( 'prep_sso_setting_redirect_uri_query', 'Redirect Uri Query', ['PrepSso', 'prep_sso_setting_redirect_uri_query'], 'prep_sso_plugin_setting', 'auth_settings' );
        add_settings_field( 'prep_sso_setting_default_avatar', 'Default avatar link', ['PrepSso', 'prep_sso_setting_default_avatar'], 'prep_sso_plugin_setting', 'auth_settings' );
        add_settings_field( 'prep_sso_setting_account_url', 'Account page Url', ['PrepSso', 'prep_sso_setting_account_url'], 'prep_sso_plugin_setting', 'auth_settings' );
    }

    public static function prep_sso_render_plugin_settings_page() {
        ?>
        <h2>Prep SSO Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'prep_sso_plugin_setting_options' );
            do_settings_sections( 'prep_sso_plugin_setting' ); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
        </form>
        <?php
    }

    public static function prep_sso_plugin_setting_options_validate( $input ) {
        return $input;
    }

    public static function prep_sso_plugin_auth_section_text() {
        $shortCode = PREP_AUTH_CONTENT;
        $shortCodeAuth = PREP_AUTH_INFO;
        echo "<p>Setting for Auth</p>
        <p>Short code: [$shortCode]your-content[/$shortCode]</p>
        <p>Short code: [$shortCodeAuth]</p>
        ";
    }

    public static function getPrepSsoSettingOptions()
    {
        return get_option( 'prep_sso_plugin_setting_options' ) ?? [];
    }


    public static function prep_sso_plugin_setting_cookie_name() {
        $options = static::getPrepSsoSettingOptions();
        echo "<input id='prep_sso_plugin_setting_cookie_name' name='prep_sso_plugin_setting_options[cookie_name]' type='text' value='" . esc_attr(self::get_sso_cookie_name() ) . "' />";
    }

    public static function get_sso_auth_check_api()
    {
        return self::getPrepSsoSettingOptions()['auth_check_api'] ?? PREP_SSO_DEFAULT_AUTH_CHECK_API;
    }

    public static function get_sso_auth_login_url()
    {
        return self::getPrepSsoSettingOptions()['login_url'] ?? '';
    }

    public static function get_sso_auth_login_iframe_url()
    {
        return self::getPrepSsoSettingOptions()['login_iframe_url'] ?? '';
    }

    public static function get_sso_auth_redirect_uri_query()
    {
        return self::getPrepSsoSettingOptions()['redirect_uri_query'] ?? 'redirect_uri';
    }

    public static function get_sso_cookie_name()
    {
        return self::getPrepSsoSettingOptions()['cookie_name'] ?? PREP_SSO_DEFAULT_COOKIE_NAME;
    }

    public static function get_sso_auth_account_url()
    {
        return self::getPrepSsoSettingOptions()['account_url'] ?? '#';
    }

    public static function get_sso_auth_default_avatar()
    {
        return self::getPrepSsoSettingOptions()['default_avatar'] ?? '';
    }

    public static function prep_sso_setting_auth_check_api() {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[auth_check_api]' type='text' value='" . esc_attr(self::get_sso_auth_check_api() ) . "' />";
    }
    public static function prep_sso_setting_login_url() {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[login_url]' type='text' value='" . esc_attr(self::get_sso_auth_login_url() ) . "' />";
    }

    public static function prep_sso_setting_login_iframe_url() {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[login_iframe_url]' type='text' value='" . esc_attr(self::get_sso_auth_login_iframe_url() ) . "' />";
    }
    public static function prep_sso_setting_redirect_uri_query() {
        echo "<input name='prep_sso_plugin_setting_options[redirect_uri_query]' type='text' value='" . esc_attr(self::get_sso_auth_redirect_uri_query() ) . "' />";
    }

    public static function prep_sso_setting_default_avatar() {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[default_avatar]' type='text' value='" . esc_attr(self::get_sso_auth_default_avatar() ) . "' />";
    }

    public static function prep_sso_setting_account_url() {
        echo "<input style='width: 50%;' name='prep_sso_plugin_setting_options[account_url]' type='text' value='" . esc_attr(self::get_sso_auth_account_url() ) . "' />";
    }
}
