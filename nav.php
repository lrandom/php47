<!doctype html >
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo( 'charset' );?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
    ?>
</head>

<body <?php body_class() ?> itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WebPage">
<?php do_action('td_wp_body_open') ?>

<?php /* scroll to top */
$td_hide_totop_on_mob = '';
if (td_util::get_option('tds_to_top_on_mobile') !== 'show') {
    $td_hide_totop_on_mob = ' td-hide-scroll-up-on-mob';
}

if ( td_util::get_option('tds_to_top') != 'hide' ) {
    ?>
    <div class="td-scroll-up <?php echo $td_hide_totop_on_mob ?>" style="display:none;"><i class="td-icon-menu-up"></i></div>
<?php } ?>

<?php //load_template( TDC_PATH_LEGACY . '/parts/menu-mobile.php', true);?>
<?php //load_template( TDC_PATH_LEGACY . '/parts/search.php', true);?>


<div class="mx-auto shadow-lg border-b bg-white">
    <nav class="mx-auto container px-5 md:flex hidden h-16 flex-row justify-between items-center gap-5">
        <a href="/"
           class="relative top-5 transition md:self-start self-center cursor-pointer duration-500"><img
                src="/_ipx/w_120/imgs/logo.png" width="120" alt="Prep.vn"></a>
        <div class="flex md:flex-row flex-col md:items-center items-start gap-5 md:flex">
            <h3 class="m-1 group"><a href="/" aria-current="page"
                                     class="text-gray-500 font-semibold group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out nuxt-link-exact-active nuxt-link-active">Trang
                    chủ
                </a>
                <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
            </h3>
            <div class="m-1 dropdown group relative">
                <h3><a href="javascript:void(0)"
                       class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out font-bold">Khoá
                        học</a>
                    <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
                </h3>
                <div class="rounded-md dropdown-item shadow-md p-0 m-0 absolute top-8 bg-white border-t-2 border-gray-100 justify-start z-20 text-left hidden block group-hover:block -right-20 -left-20">
                    <ul class="-mt-2">
                        <li class="m-0"><h4><a href="https://prep.vn/ielts"
                                               class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                                    IELTS
                                </a></h4></li>
                        <li class="m-0"><h4><a href="https://prep.vn/thptqg"
                                               class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                                    THPT
                                </a></h4></li>
                        <li class="m-0"><h4><span class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                  TOEIC
                </span></h4></li>
                    </ul>
                </div>
            </div>
            <div class="m-1 group">
                <h3><a href="/kiem-tra-dau-vao-mien-phi"
                       class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out font-bold">Kiểm
                        tra đầu vào
                    </a>
                    <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
                </h3>
            </div>
            <div class="m-1 group">
                <h3><a href="/test-practice/virtual-speaking-room"
                       class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out font-bold">Phòng
                        Speaking ảo
                    </a>
                    <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
                </h3>
            </div>
            <div class="m-1 dropdown group relative">
                <h3><a href="https://prep.vn/blog"
                       class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out font-bold">Blog</a>
                    <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
                </h3>
                <div class="rounded-md dropdown-item shadow-md p-0 m-0 absolute top-8 bg-white border-t-2 border-gray-100
             justify-start z-20 text-left hidden block
             group-hover:block -right-20 -left-20">
                    <ul class="-mt-2">
                        <li class="m-0"><h4><a href="https://prep.vn/blog/kien-thuc-tieng-anh/"
                                               class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                                    Kiến thức
                                </a></h4></li>
                        <li class="border-t-2 border-gray-50"></li>
                        <li class="m-0"><h4><a href="https://prep.vn/blog/kinh-nghiem-chinh-phuc-tieng-anh/"
                                               class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                                    Kinh nghiệm
                                </a></h4></li>
                        <li class="m-0">
                            <h4><a href="https://prep.vn/blog/tai-lieu-tieng-anh/"
                                   class="p-2 group relative block hover:bg-indigo-50 font-semibold nested-tree-item text-gray-500">
                                    Tài liệu
                                    <ul class="hidden m-0 absolute w-60 child -left-60 top-0 bg-white shadow rounded text-center">
                                        <li><a href="https://prep.vn/blog/de-thi-tieng-anh/"
                                               class="font-semibold block hover:bg-indigo-50 p-2 text-gray-500">
                                                Đề thi
                                            </a></li>
                                    </ul>
                                </a></h4>
                        </li>
                        <li class="m-0"><h4><a href="https://prep.vn/blog/su-kien/"
                                               class="p-2 block hover:bg-indigo-50 font-semibold text-gray-500">
                                    Sự kiện
                                </a></h4></li>
                    </ul>
                </div>
            </div>
            <?php global $prepUser ?>
            <?php if (!$prepUser): ?>
                <div class="group">
                    <h3><a
                            class="m-1 font-bold text-primary transition-font-size duration-500 ease-in-out group-hover:text-gray-500 prep-login">Đăng
                            nhập
                        </a>
                        <div class="h-1 w-0 bg-gray-500 transition-width duration-500 ease-in-out group-hover:w-full"></div>
                    </h3>
                </div>
                <div class="group"><h3><a href="/signup"
                                          class="block m-1 font-bold bg-blue-600 text-white pl-10 pr-10 pt-2 pb-2 rounded-lg font-bold transition duration-500 ease-in-out transform hover:scale-110">
                            Đăng ký
                        </a></h3></div> <!----> <!----> <!---->
            <?php else: ?>
                <?php echo do_shortcode('[prep_auth_info]') ?>
            <?php endif; ?>
        </div>
    </nav>
</div>


<!--MOBILE-->
<nav class="bg-white w-full shadow h-auto md:hidden block mobile-nav ">
    <div class="p-2 flex justify-between items-center gap-4"><a href="/" aria-current="page"
                                                                class="transition cursor-pointer duration-500 ease-in-out transform hover:scale-110 nuxt-link-exact-active nuxt-link-active"><img
                src="/_nuxt/img/logo.957af21.png" alt="Prep.vn" width="100"></a>
        <a href="javascript:void(0)"></a>
        <a
            href="javascript:void(0)" class="p-2 btn-hamburger">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="text-gray-500 h-6 w-6">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
        </a></div>


    <div class="mobile-menu-main-content hidden flex-col items-start box-border rounded-lg w-full flex transition-height overflow-hidden duration-500 ease-in-out h-auto p-5">
        <div class="m-1 font-semibold group"><a href="/"
                                                class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out group-hover:text-xl">Trang
                chủ
            </a>
            <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
        </div>
        <div class="m-1 font-semibold group w-full">
            <div class="text-left"><a href="javascript:void(0)"
                                      class="text-gray-500 group-hover:text-primary cursor-pointer transition-font-size duration-500 ease-in-out group-hover:text-xl">Khoá
                    học
                </a></div>
            <div class="text-left text-gray-500 relative text-sm">
                <ul>
                    <li class="m-0"><a href="https://prep.vn//ielts"
                                       class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                            IELTS
                        </a></li>
                    <li class="m-0"><a href="https://prep.vn//thptqg"
                                       class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                            THPT
                        </a></li>
                    <li class="m-0"><span class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                TOEIC
              </span></li>
                </ul>
            </div>
        </div>
        <div class="m-1 font-semibold group"><a href="/kiem-tra-dau-vao/chon-bai-kiem-tra"
                                                class="group-hover:text-primary cursor-pointer transition-font-size text-gray-500 duration-500 ease-in-out group-hover:text-xl">Kiểm
                tra đầu vào
            </a>
            <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
        </div>
        <div class="m-1 font-semibold group"><a href="/test-practice/virtual-speaking-room"
                                                class="group-hover:text-primary cursor-pointer transition-font-size text-gray-500 duration-500 ease-in-out group-hover:text-xl">Phòng
                Speaking ảo
            </a>
            <div class="h-1 w-0 bg-primary transition-width duration-500 ease-in-out group-hover:w-full"></div>
        </div>
        <div class="m-1 font-semibold group w-full">
            <div class="text-left"><a href="https://prep.vn/blog/"
                                      class="group-hover:text-primary cursor-pointer transition-font-size text-gray-500 duration-500 ease-in-out group-hover:text-xl">Blog</a>
            </div>
            <div class="text-left text-gray-500 relative text-sm">
                <ul>
                    <li class="m-0"><a href="https://prep.vn/blog/kien-thuc-tieng-anh/"
                                       class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                            Kiến thức
                        </a></li>
                    <li class="m-0"><a href="https://prep.vn/blog/kinh-nghiem-chinh-phuc-tieng-anh/"
                                       class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                            Kinh nghiệm
                        </a></li>
                    <li class="m-0"><a href="https://prep.vn/blog/tai-lieu-tieng-anh/"
                                       class="p-2 group relative block hover:bg-indigo-50 font-medium
                                       nested-tree-item text-gray-500">
                            Tài liệu
                        </a>
                        <ul class="child rounded ml-5 text-left text-sm">
                            <li><a href="https://prep.vn/blog/de-thi-tieng-anh/"
                                   class="font-medium block hover:bg-indigo-50 p-2 text-gray-500">
                                    Đề thi
                                </a></li>
                        </ul>
                    </li>
                    <li class="m-0"><a t="" href="https://prep.vn/blog/su-kien/"
                                       class="p-2 block hover:bg-indigo-50 font-medium text-gray-500">
                            Sự kiện
                        </a></li>
                </ul>
            </div>
        </div>
        <?php global $prepUser ?>
        <?php if (!$prepUser): ?>
            <div class="group">
                <h3><a
                        class="m-1 font-bold text-primary transition-font-size duration-500 ease-in-out group-hover:text-gray-500 prep-login">Đăng
                        nhập
                    </a>
                    <div class="h-1 w-0 bg-gray-500 transition-width duration-500 ease-in-out group-hover:w-full"></div>
                </h3>
            </div>
            <div class="group"><h3><a href="/signup"
                                      class="block m-1 font-bold bg-blue-600 text-white pl-10 pr-10 pt-2 pb-2 rounded-lg font-bold transition duration-500 ease-in-out transform hover:scale-110">
                        Đăng ký
                    </a></h3></div> <!----> <!----> <!---->
        <?php else: ?>
            <?php echo do_shortcode('[prep_auth_info]') ?>
        <?php endif; ?>

    </div>
</nav>

<!--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">-->


<style>
    nav .dropdown .dropdown-item {
        display: none;

    }

    nav .dropdown:hover .dropdown-item {
        display: block;
    }

    nav .group:hover a + div {
        width: 100%;
        background: #0070f3;
    }

    .tdi_13 {
        z-index: 1000;
    }
</style>

<script>
    const btnHamburger = document.querySelector('.btn-hamburger');
    btnHamburger.addEventListener('click', function () {
        const mobileMenuMainContent = document.querySelector('.mobile-menu-main-content');
        mobileMenuMainContent.classList.toggle('hidden');
    });
</script>




<div id="td-outer-wrap" class="td-theme-wrap">



    <?php //this is closing in the footer.php file ?>

    <?php

    if ( td_util::tdc_is_live_editor_iframe() || ( ! td_util::is_template_header() && ! td_util::is_no_header() ) ) {

        $hide_class = '';
        if ( td_util::is_template_header() || td_util::is_no_header() ) {
            $hide_class = 'tdc-zone-invisible';
        }

        ?>

        <div class="tdc-header-wrap <?php echo esc_attr( $hide_class ) ?>">

            <?php
            /*
             * loads the header template set in Theme Panel -> Header area
             * the template files are located in ../parts/header
             */
            //td_api_header_style::show_header();
            ?>

        </div>

        <?php
    }

    if ( td_util::tdc_is_live_editor_iframe() || td_util::is_template_header() ) {

        $tdc_header_template_content = td_util::get_header_template_content();

        $hide_class = '';

        ?>
        <div class="td-header-template-wrap" style="position: relative">
            <?php

            if ( empty( $tdc_header_template_content['tdc_header_mobile'] ) ) {
                $shortcode = '[tdc_zone type="tdc_header_mobile"][vc_row][vc_column][/vc_column][/vc_row][/tdc_zone]';
                $hide_class = 'tdc-zone-invisible';
            } else {
                $shortcode = $tdc_header_template_content['tdc_header_mobile'];
            }

            ?>
            <div class="td-header-mobile-wrap <?php echo esc_attr( $hide_class ) ?>">
                <?php echo do_shortcode( $shortcode ) ?>
            </div>
            <?php

            if ( empty( $tdc_header_template_content['tdc_header_mobile_sticky'] ) || ( ! td_util::tdc_is_live_editor_iframe() && isset( $tdc_header_template_content['tdc_is_mobile_header_sticky'] ) && false === $tdc_header_template_content['tdc_is_mobile_header_sticky'] )) {
                $shortcode = '[tdc_zone type="tdc_header_mobile_sticky"][vc_row][vc_column][/vc_column][/vc_row][/tdc_zone]';
            } else {
                $shortcode = $tdc_header_template_content['tdc_header_mobile_sticky'];
            }

            ?>
            <div class="td-header-mobile-sticky-wrap tdc-zone-sticky-invisible tdc-zone-sticky-inactive" style="display: none">
                <?php echo do_shortcode( $shortcode ) ?>
            </div>
            <?php

            $hide_class = '';

            if ( empty( $tdc_header_template_content['tdc_header_desktop'] ) ) {
                $shortcode = '[tdc_zone type="tdc_header_desktop"][vc_row][vc_column][/vc_column][/vc_row][/tdc_zone]';
                $hide_class = 'tdc-zone-invisible';
            } else {
                $shortcode = $tdc_header_template_content['tdc_header_desktop'];
            }

            ?>

            <div class="td-header-desktop-wrap <?php echo esc_attr( $hide_class ) ?>">
                <?php echo do_shortcode( $shortcode ) ?>
            </div>
            <?php

            if ( empty( $tdc_header_template_content['tdc_header_desktop_sticky'] ) || ( ! td_util::tdc_is_live_editor_iframe() && isset( $tdc_header_template_content['tdc_is_header_sticky'] ) && false === $tdc_header_template_content['tdc_is_header_sticky'] ) ) {
                $shortcode = '[tdc_zone type="tdc_header_desktop_sticky"][vc_row][vc_column][/vc_column][/vc_row][/tdc_zone]';
            } else {
                $shortcode = $tdc_header_template_content['tdc_header_desktop_sticky'];
            }

            ?>
            <div class="td-header-desktop-sticky-wrap tdc-zone-sticky-invisible tdc-zone-sticky-inactive" style="display: none">
                <?php echo do_shortcode( $shortcode ) ?>
            </div>
        </div>
        <?php

    }

    ?>



<?php



do_action('td_wp_booster_after_header'); //used by unique articles


