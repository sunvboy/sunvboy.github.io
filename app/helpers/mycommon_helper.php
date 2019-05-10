<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('show_flashdata_frontend')) {
    function show_flashdata_frontend($body = TRUE)
    {
        $result = '';
        $CI =& get_instance();
        $message = $CI->session->flashdata('message-success');
        if (isset($message)) {
            if ($body == TRUE) $result = $result . '<div class="uk-container uk-container-center"><div class="uk-alert uk-alert-success uk-margin-top uk-margin-bottom" data-uk-alert>';
            $result = $result . '<a href="#" class="uk-alert-close uk-close"></a><p>' . $message . '</p>';
            if ($body == TRUE) $result = $result . '</div></div>';
            return $result;
        }
        $message = $CI->session->flashdata('message-danger');
        if (isset($message)) {
            if ($body == TRUE) $result = $result . '<div class="uk-container uk-container-center"><div class="uk-alert uk-alert-danger uk-margin-top uk-margin-bottom" data-uk-alert>';
            $result = $result . '<a href="#" class="uk-alert-close uk-close"></a><p>' . $message . '</p>';
            if ($body == TRUE) $result = $result . '</div></div>';
            return $result;
        }
    }
}
if (!function_exists('menu_icon')) {
    function menu_icon()
    {
        return array("fa fa-home", "fa fa-glass", "fa fa-music", "fa fa-search", "fa fa-envelope-o", "fa fa-heart", "fa fa-star", "fa fa-star-o", "fa fa-user", "fa fa-film", "fa fa-th-large", "fa fa-th", "fa fa-th-list", "fa fa-check", "fa fa-remove", "fa fa-close", "fa fa-times", "fa fa-search-plus", "fa fa-search-minus", "fa fa-power-off", "fa fa-signal", "fa fa-gear", "fa fa-cog", "fa fa-trash-o", "fa fa-file-o", "fa fa-clock-o", "fa fa-road", "fa fa-download", "fa fa-arrow-circle-o-down", "fa fa-arrow-circle-o-up", "fa fa-inbox", "fa fa-play-circle-o", "fa fa-rotate-right", "fa fa-repeat", "fa fa-refresh", "fa fa-list-alt", "fa fa-lock", "fa fa-flag", "fa fa-headphones", "fa fa-volume-off", "fa fa-volume-down", "fa fa-volume-up", "fa fa-qrcode", "fa fa-barcode", "fa fa-tag", "fa fa-tags", "fa fa-book", "fa fa-bookmark", "fa fa-print", "fa fa-camera", "fa fa-font", "fa fa-bold", "fa fa-italic", "fa fa-text-height", "fa fa-text-width", "fa fa-align-left", "fa fa-align-center", "fa fa-align-right", "fa fa-align-justify", "fa fa-list", "fa fa-dedent", "fa fa-outdent", "fa fa-indent", "fab fa-youtube", "fa fa-photo", "fa fa-image", "fa fa-picture-o", "fa fa-pencil", "fa fa-map-marker", "fa fa-adjust", "fa fa-tint", "fa fa-edit", "fa fa-pencil-square-o", "fa fa-share-square-o", "fa fa-check-square-o", "fa fa-arrows", "fa fa-step-backward", "fa fa-fast-backward", "fa fa-backward", "fa fa-play", "fa fa-pause", "fa fa-stop", "fa fa-forward", "fa fa-fast-forward", "fa fa-step-forward", "fa fa-eject", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-plus-circle", "fa fa-minus-circle", "fa fa-times-circle", "fa fa-check-circle", "fa fa-question-circle", "fa fa-info-circle", "fa fa-crosshairs", "fa fa-times-circle-o", "fa fa-check-circle-o", "fa fa-ban", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrow-up", "fa fa-arrow-down", "fa fa-mail-forward", "fa fa-share", "fa fa-expand", "fa fa-compress", "fa fa-plus", "fa fa-minus", "fa fa-asterisk", "fa fa-exclamation-circle", "fa fa-gift", "fa fa-leaf", "fa fa-fire", "fa fa-eye", "fa fa-eye-slash", "fa fa-warning", "fa fa-exclamation-triangle", "fa fa-plane", "fa fa-calendar", "fa fa-random", "fa fa-comment", "fa fa-magnet", "fa fa-chevron-up", "fa fa-chevron-down", "fa fa-retweet", "fa fa-shopping-cart", "fa fa-folder", "fa fa-folder-open", "fa fa-arrows-v", "fa fa-arrows-h", "fa fa-bar-chart-o", "fa fa-bar-chart", "fa fa-twitter-square", "fa fa-facebook-square", "fa fa-camera-retro", "fa fa-key", "fa fa-gears", "fa fa-cogs", "fa fa-comments", "fa fa-thumbs-o-up", "fa fa-thumbs-o-down", "fa fa-star-half", "fa fa-heart-o", "fa fa-sign-out", "fa fa-linkedin-square", "fa fa-thumb-tack", "fa fa-external-link", "fa fa-sign-in", "fa fa-trophy", "fa fa-github-square", "fa fa-upload", "fa fa-lemon-o", "fa fa-phone", "fa fa-square-o", "fa fa-bookmark-o", "fa fa-phone-square", "fa fa-twitter", "fa fa-facebook-f", "fa fa-facebook", "fa fa-github", "fa fa-unlock", "fa fa-credit-card", "fa fa-feed", "fa fa-rss", "fa fa-hdd-o", "fa fa-bullhorn", "fa fa-bell", "fa fa-certificate", "fa fa-hand-o-right", "fa fa-hand-o-left", "fa fa-hand-o-up", "fa fa-hand-o-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-circle-down", "fa fa-globe", "fa fa-wrench", "fa fa-tasks", "fa fa-filter", "fa fa-briefcase", "fa fa-arrows-alt", "fa fa-group", "fa fa-users", "fa fa-chain", "fa fa-link", "fa fa-cloud", "fa fa-flask", "fa fa-cut", "fa fa-scissors", "fa fa-copy", "fa fa-files-o", "fa fa-paperclip", "fa fa-save", "fa fa-floppy-o", "fa fa-square", "fa fa-navicon", "fa fa-reorder", "fa fa-bars", "fa fa-list-ul", "fa fa-list-ol", "fa fa-strikethrough", "fa fa-underline", "fa fa-table", "fa fa-magic", "fa fa-truck", "fa fa-pinterest", "fa fa-pinterest-square", "fa fa-google-plus-square", "fa fa-google-plus", "fa fa-money", "fa fa-caret-down", "fa fa-caret-up", "fa fa-caret-left", "fa fa-caret-right", "fa fa-columns", "fa fa-unsorted", "fa fa-sort", "fa fa-sort-down", "fa fa-sort-desc", "fa fa-sort-up", "fa fa-sort-asc", "fa fa-envelope", "fa fa-linkedin", "fa fa-rotate-left", "fa fa-undo", "fa fa-legal", "fa fa-gavel", "fa fa-dashboard", "fa fa-tachometer", "fa fa-comment-o", "fa fa-comments-o", "fa fa-flash", "fa fa-bolt", "fa fa-sitemap", "fa fa-umbrella", "fa fa-paste", "fa fa-clipboard", "fa fa-lightbulb-o", "fa fa-exchange", "fa fa-cloud-download", "fa fa-cloud-upload", "fa fa-user-md", "fa fa-stethoscope", "fa fa-suitcase", "fa fa-bell-o", "fa fa-coffee", "fa fa-cutlery", "fa fa-file-text-o", "fa fa-building-o", "fa fa-hospital-o", "fa fa-ambulance", "fa fa-medkit", "fa fa-fighter-jet", "fa fa-beer", "fa fa-h-square", "fa fa-plus-square", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-double-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-angle-down", "fa fa-desktop", "fa fa-laptop", "fa fa-tablet", "fa fa-mobile-phone", "fa fa-mobile", "fa fa-circle-o", "fa fa-quote-left", "fa fa-quote-right", "fa fa-spinner", "fa fa-circle", "fa fa-mail-reply", "fa fa-reply", "fa fa-github-alt", "fa fa-folder-o", "fa fa-folder-open-o", "fa fa-smile-o", "fa fa-frown-o", "fa fa-meh-o", "fa fa-gamepad", "fa fa-keyboard-o", "fa fa-flag-o", "fa fa-flag-checkered", "fa fa-terminal", "fa fa-code", "fa fa-mail-reply-all", "fa fa-reply-all", "fa fa-star-half-empty", "fa fa-star-half-full", "fa fa-star-half-o", "fa fa-location-arrow", "fa fa-crop", "fa fa-code-fork", "fa fa-unlink", "fa fa-chain-broken", "fa fa-question", "fa fa-info", "fa fa-exclamation", "fa fa-superscript", "fa fa-subscript", "fa fa-eraser", "fa fa-puzzle-piece", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-shield", "fa fa-calendar-o", "fa fa-fire-extinguisher", "fa fa-rocket", "fa fa-maxcdn", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-circle-down", "fa fa-html5", "fa fa-css3", "fa fa-anchor", "fa fa-unlock-alt", "fa fa-bullseye", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-rss-square", "fa fa-play-circle", "fa fa-ticket", "fa fa-minus-square", "fa fa-minus-square-o", "fa fa-level-up", "fa fa-level-down", "fa fa-check-square", "fa fa-pencil-square", "fa fa-external-link-square", "fa fa-share-square", "fa fa-compass", "fa fa-toggle-down", "fa fa-caret-square-o-down", "fa fa-toggle-up", "fa fa-caret-square-o-up", "fa fa-toggle-right", "fa fa-caret-square-o-right", "fa fa-euro", "fa fa-eur", "fa fa-gbp", "fa fa-dollar", "fa fa-usd", "fa fa-rupee", "fa fa-inr", "fa fa-cny", "fa fa-rmb", "fa fa-yen", "fa fa-jpy", "fa fa-ruble", "fa fa-rouble", "fa fa-rub", "fa fa-won", "fa fa-krw", "fa fa-bitcoin", "fa fa-btc", "fa fa-file", "fa fa-file-text", "fa fa-sort-alpha-asc", "fa fa-sort-alpha-desc", "fa fa-sort-amount-asc", "fa fa-sort-amount-desc", "fa fa-sort-numeric-asc", "fa fa-sort-numeric-desc", "fa fa-thumbs-up", "fa fa-thumbs-down", "fa fa-youtube-square", "fa fa-youtube", "fa fa-xing", "fa fa-xing-square", "fa fa-youtube-play", "fa fa-dropbox", "fa fa-stack-overflow", "fa fa-instagram", "fa fa-flickr", "fa fa-adn", "fa fa-bitbucket", "fa fa-bitbucket-square", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-long-arrow-down", "fa fa-long-arrow-up", "fa fa-long-arrow-left", "fa fa-long-arrow-right", "fa fa-apple", "fa fa-windows", "fa fa-android", "fa fa-linux", "fa fa-dribbble", "fa fa-skype", "fa fa-foursquare", "fa fa-trello", "fa fa-female", "fa fa-male", "fa fa-gittip", "fa fa-gratipay", "fa fa-sun-o", "fa fa-moon-o", "fa fa-archive", "fa fa-bug", "fa fa-vk", "fa fa-weibo", "fa fa-renren", "fa fa-pagelines", "fa fa-stack-exchange", "fa fa-arrow-circle-o-right", "fa fa-arrow-circle-o-left", "fa fa-toggle-left", "fa fa-caret-square-o-left", "fa fa-dot-circle-o", "fa fa-wheelchair", "fa fa-vimeo-square", "fa fa-turkish-lira", "fa fa-try", "fa fa-plus-square-o", "fa fa-space-shuttle", "fa fa-slack", "fa fa-envelope-square", "fa fa-wordpress", "fa fa-openid", "fa fa-institution", "fa fa-bank", "fa fa-university", "fa fa-mortar-board", "fa fa-graduation-cap", "fa fa-yahoo", "fa fa-google", "fa fa-reddit", "fa fa-reddit-square", "fa fa-stumbleupon-circle", "fa fa-stumbleupon", "fa fa-delicious", "fa fa-digg", "fa fa-pied-piper-pp", "fa fa-pied-piper-alt", "fa fa-drupal", "fa fa-joomla", "fa fa-language", "fa fa-fax", "fa fa-building", "fa fa-child", "fa fa-paw", "fa fa-spoon", "fa fa-cube", "fa fa-cubes", "fa fa-behance", "fa fa-behance-square", "fa fa-steam", "fa fa-steam-square", "fa fa-recycle", "fa fa-automobile", "fa fa-car", "fa fa-cab", "fa fa-taxi", "fa fa-tree", "fa fa-spotify", "fa fa-deviantart", "fa fa-soundcloud", "fa fa-database", "fa fa-file-pdf-o", "fa fa-file-word-o", "fa fa-file-excel-o", "fa fa-file-powerpoint-o", "fa fa-file-photo-o", "fa fa-file-picture-o", "fa fa-file-image-o", "fa fa-file-zip-o", "fa fa-file-archive-o", "fa fa-file-sound-o", "fa fa-file-audio-o", "fa fa-file-movie-o", "fa fa-file-video-o", "fa fa-file-code-o", "fa fa-vine", "fa fa-codepen", "fa fa-jsfiddle", "fa fa-life-bouy", "fa fa-life-buoy", "fa fa-life-saver", "fa fa-support", "fa fa-life-ring", "fa fa-circle-o-notch", "fa fa-ra", "fa fa-resistance", "fa fa-rebel", "fa fa-ge", "fa fa-empire", "fa fa-git-square", "fa fa-git", "fa fa-y-combinator-square", "fa fa-yc-square", "fa fa-hacker-news", "fa fa-tencent-weibo", "fa fa-qq", "fa fa-wechat", "fa fa-weixin", "fa fa-send", "fa fa-paper-plane", "fa fa-send-o", "fa fa-paper-plane-o", "fa fa-history", "fa fa-circle-thin", "fa fa-header", "fa fa-paragraph", "fa fa-sliders", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-bomb", "fa fa-soccer-ball-o", "fa fa-futbol-o", "fa fa-tty", "fa fa-binoculars", "fa fa-plug", "fa fa-slideshare", "fa fa-twitch", "fa fa-yelp", "fa fa-newspaper-o", "fa fa-wifi", "fa fa-calculator", "fa fa-paypal", "fa fa-google-wallet", "fa fa-cc-visa", "fa fa-cc-mastercard", "fa fa-cc-discover", "fa fa-cc-amex", "fa fa-cc-paypal", "fa fa-cc-stripe", "fa fa-bell-slash", "fa fa-bell-slash-o", "fa fa-trash", "fa fa-copyright", "fa fa-at", "fa fa-eyedropper", "fa fa-paint-brush", "fa fa-birthday-cake", "fa fa-area-chart", "fa fa-pie-chart", "fa fa-line-chart", "fa fa-lastfm", "fa fa-lastfm-square", "fa fa-toggle-off", "fa fa-toggle-on", "fa fa-bicycle", "fa fa-bus", "fa fa-ioxhost", "fa fa-angellist", "fa fa-cc", "fa fa-shekel", "fa fa-sheqel", "fa fa-ils", "fa fa-meanpath", "fa fa-buysellads", "fa fa-connectdevelop", "fa fa-dashcube", "fa fa-forumbee", "fa fa-leanpub", "fa fa-sellsy", "fa fa-shirtsinbulk", "fa fa-simplybuilt", "fa fa-skyatlas", "fa fa-cart-plus", "fa fa-cart-arrow-down", "fa fa-diamond", "fa fa-ship", "fa fa-user-secret", "fa fa-motorcycle", "fa fa-street-view", "fa fa-heartbeat", "fa fa-venus", "fa fa-mars", "fa fa-mercury", "fa fa-intersex", "fa fa-transgender", "fa fa-transgender-alt", "fa fa-venus-double", "fa fa-mars-double", "fa fa-venus-mars", "fa fa-mars-stroke", "fa fa-mars-stroke-v", "fa fa-mars-stroke-h", "fa fa-neuter", "fa fa-genderless", "fa fa-facebook-official", "fa fa-pinterest-p", "fa fa-whatsapp", "fa fa-server", "fa fa-user-plus", "fa fa-user-times", "fa fa-hotel", "fa fa-bed", "fa fa-viacoin", "fa fa-train", "fa fa-subway", "fa fa-medium", "fa fa-yc", "fa fa-y-combinator", "fa fa-optin-monster", "fa fa-opencart", "fa fa-expeditedssl", "fa fa-battery-4", "fa fa-battery-full", "fa fa-battery-3", "fa fa-battery-three-quarters", "fa fa-battery-2", "fa fa-battery-half", "fa fa-battery-1", "fa fa-battery-quarter", "fa fa-battery-0", "fa fa-battery-empty", "fa fa-mouse-pointer", "fa fa-i-cursor", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-sticky-note", "fa fa-sticky-note-o", "fa fa-cc-jcb", "fa fa-cc-diners-club", "fa fa-clone", "fa fa-balance-scale", "fa fa-hourglass-o", "fa fa-hourglass-1", "fa fa-hourglass-start", "fa fa-hourglass-2", "fa fa-hourglass-half", "fa fa-hourglass-3", "fa fa-hourglass-end", "fa fa-hourglass", "fa fa-hand-grab-o", "fa fa-hand-rock-o", "fa fa-hand-stop-o", "fa fa-hand-paper-o", "fa fa-hand-scissors-o", "fa fa-hand-lizard-o", "fa fa-hand-spock-o", "fa fa-hand-pointer-o", "fa fa-hand-peace-o", "fa fa-trademark", "fa fa-registered", "fa fa-creative-commons", "fa fa-gg", "fa fa-gg-circle", "fa fa-tripadvisor", "fa fa-odnoklassniki", "fa fa-odnoklassniki-square", "fa fa-get-pocket", "fa fa-wikipedia-w", "fa fa-safari", "fa fa-chrome", "fa fa-firefox", "fa fa-opera", "fa fa-internet-explorer", "fa fa-tv", "fa fa-television", "fa fa-contao", "fa fa-500px", "fa fa-amazon", "fa fa-calendar-plus-o", "fa fa-calendar-minus-o", "fa fa-calendar-times-o", "fa fa-calendar-check-o", "fa fa-industry", "fa fa-map-pin", "fa fa-map-signs", "fa fa-map-o", "fa fa-map", "fa fa-commenting", "fa fa-commenting-o", "fa fa-houzz", "fa fa-vimeo", "fa fa-black-tie", "fa fa-fonticons", "fa fa-pied-piper");
    }
}

// if(!function_exists('fb_login_link')){
//  	function fb_login_link(){
//   		$CI =& get_instance();
//   		$app_path = substr(APPPATH, 0, -4);
//   		require($app_path.'/plugins/php-graph-sdk-5.5/src/Facebook/autoload.php');
//   		$fb = new Facebook\Facebook([
// 		    'app_id' => '256408298179364', // Replace {app-id} with your app id
// 		    'app_secret' => '3f80035865379a6e0f12159d87004921',
// 		    'default_graph_version' => 'v2.2',
//    		]);
//   		$helper = $fb->getRedirectLoginHelper();
//   		$permissions = ['email']; // Optional permissions
//   		$loginUrl = $helper->getLoginUrl(base_url('customers/manage/manage/fbcallback'), $permissions);
//   		return $loginUrl;
//  	}
// }


// if(!function_exists('google_login_link')){
//  	function google_login_link(){
//   		$CI =& get_instance();
//   		$app_path = substr(APPPATH, 0, -4);
//   		require($app_path.'plugins/google_sdk/Google/autoload.php');
//   		$clientId = '436185409308-5mdtrpoqk3044hoivg0hfu3eg20feauv.apps.googleusercontent.com';
//   		$clientSecret = '5umQA9kH-xpELQKUSiLYX0xH';
//   		$redirectURL = 'http://tinhdau100.codechuanseo.com/customers/manage/manage/google';
//   		//Call Google API
//   		$gClient = new Google_Client();
//   		$gClient->setApplicationName('Login');
//   		$gClient->setClientId($clientId);
//   		$gClient->setClientSecret($clientSecret);
//   		$gClient->setRedirectUri($redirectURL);
//   		$gClient->setScopes(array(
// 		   "https://www.googleapis.com/auth/plus.login",
// 		   "https://www.googleapis.com/auth/plus.me",
// 		   "https://www.googleapis.com/auth/userinfo.email",
// 		   "https://www.googleapis.com/auth/userinfo.profile"
//    		));
//   		/* ---------------------------------------------- */
//   		$authUrl = $gClient->createAuthUrl();
//   		$output = filter_var($authUrl, FILTER_SANITIZE_URL);
//   		return $output;
//  	}
// }

if (!function_exists('convert_date')) {
    function convert_date($timed)
    {
        $string = '';
        $CI =& get_instance();
        $string .= $CI->lang->line('day') . ' ' . show_time($timed, 'd');
        $string .= ' ' . $CI->lang->line('month') . ' ' . show_time($timed, 'm') . ' ';
        $string .= $CI->lang->line('year') . ' ' . show_time($timed, 'Y');
        return $string;
    }
}
if (!function_exists('Load_place')) {
    function Load_place($projectid = 0, $wardid = 0, $districtid = 0)
    {
        $CI =& get_instance();
        if ($projectid != 0) {
            $result = $CI->FrontendProjects_Model->read_place($projectid);
        } elseif ($wardid != 0) {
            $result = $CI->FrontendProjects_Model->read_location($wardid);
        } elseif ($districtid != 0) {
            $result = $CI->FrontendProjects_Model->read_location($districtid);
        } else {
            $result = '...';
        }
        return $result;
    }
}
if (!function_exists('Load_catagoies')) {
    function Load_catagoies($arr = '', $modules = 'articles')
    {
        $CI =& get_instance();
        $CI->load->model('Autoload_model');
        $atr = '';
        if (isset($arr) && is_array($arr) && count($arr)) {
            foreach ($arr as $key => $val) {
                $atr[] = $CI->Autoload_model->_get_where(array(
                    'select' => 'id, title, slug, canonical',
                    'table' => $modules . '_catalogues',
                    'where' => array('id' => $val),
                    'order_by' => 'order desc',
                ), FALSE);
            }
        }
        return $atr;
    }
}
if (!function_exists('code_generator')) {
    function code_generator($module = '')
    {
        $CI =& get_instance();
        $user = $CI->config->item('fcUser');
        $CI->db->select('id');
        $CI->db->from($module);
        $CI->db->where(array('trash' => 0));
        $CI->db->order_by('id desc');
        $result = $CI->db->get()->row_array();
        $code = '#' . $user['id'] . '_' . (10000 + $result['id'] + 1);
        return $code;
    }
}

if (!function_exists('thongketruycap')) {
    function thongketruycap()
    {
        $CI =& get_instance();
        ?>
        <header class="panel-head">
            <h3 class="heading"><span> Thống kê truy cập </span></h3>
        </header>
        <section class="panel-body">
            <?php
            $CI->db->select('*')->from('counter_values');
            $row = $CI->db->get()->row_array();

            $CI->db->select('*')->from('counter_ips');
            $online = $CI->db->count_all_results();
            ?>
            <ul class="online">
                <li>Đang online: <?php echo $online; ?></li>
                <li>Tổng truy cập: <?php echo $row['all_value']; ?></li>
            </ul>
        </section>
        <?php
    }
}


if (!function_exists('getCurrentPageURL')) {
    function getCurrentPageURL()
    {
        $pageURL = 'http';
        if (!empty($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] == 'on') {
                $pageURL .= "s";
            }
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}
if (!function_exists('links_share')) {
    function links_share()
    {
        global $sitename;
        ?>
        <div class="connenct">
            Chia sẻ mạng xã hội:
            <script src="https://apis.google.com/js/platform.js" async defer>
                {
                    lang: 'vi'
                }
            </script>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + '://platform.twitter.com/widgets.js';
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, 'script', 'twitter-wjs');</script>
            <!--			<div class="g-plus hidden" data-action="share" data-annotation="bubble"-->
            <!--				 data-href="--><?php //echo getCurrentPageURL();
            ?><!--" style="="></div>-->
            <div class="fb-like" data-href="<?php echo getCurrentPageURL(); ?>" data-layout="button_count"
                 data-action="like" data-show-faces="true" data-share="true" style="="></div>
            <div class="fb-send" data-href="<?php echo getCurrentPageURL(); ?>" style="="></div>
            <!--			<a href="https://twitter.com/share" class="twitter-share-button hidden" style=""-->
            <!--			   data-url="--><?php //echo getCurrentPageURL();
            ?><!--" data-via="--><?php //echo $sitename
            ?><!--">Tweet</a>-->

        </div>
        <?php
    }
}

if (!function_exists('coment_fb')) {
    function coment_fb()
    {
        ?>
        <div class="comment_fb">
            <div class="fb-comments" data-href="<?php echo getCurrentPageURL(); ?>" data-numposts="5"
                 data-width="100%"></div>
        </div>
        <?php
    }
}

if (!function_exists('show_flashdata')) {
    function show_flashdata($body = TRUE)
    {
        $result = '';
        $CI =& get_instance();
        $message = $CI->session->flashdata('message-success');
        if (isset($message)) {
            if ($body == TRUE) $result = $result . '<div class="box-body">';
            $result = $result . '<div class="callout callout-success">';
            $result = $result . '<p>' . $message . '</p>';
            $result = $result . '</div>';
            if ($body == TRUE) $result = $result . '</div><!-- /.box-body -->';
            return $result;
        }
        $message = $CI->session->flashdata('message-danger');
        if (isset($message)) {
            if ($body == TRUE) $result = $result . '<div class="box-body">';
            $result = $result . '<div class="callout callout-danger">';
            $result = $result . '<p>' . $message . '</p>';
            $result = $result . '</div>';
            if ($body == TRUE) $result = $result . '</div><!-- /.box-body -->';
            return $result;
        }
    }
}

if (!function_exists('selecteddropdown')) {
    function selecteddropdown($dropdown = NULL)
    {
        $temp = NULL;
        foreach ($dropdown as $key => $val) {
            $temp[] = $key;
        }
        return $temp;
    }
}

if (!function_exists('convert_time')) {
    function convert_time($time = '')
    {
        $current = explode('-', $time);
        $date = explode('/', trim($current[1]));
        $time_stamp = $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . trim($current[0]) . ':00';
        return $time_stamp;
    }
}

if (!function_exists('remake_array')) {
    function remake_array($array = '', $keyword = '')
    {
        $temp = '';
        if (isset($array) && is_array($array) && count($array)) {
            foreach ($array as $key => $val) {
                $temp[] = $val[$keyword];
            }
        }
        return $temp;
    }
}
if (!function_exists('get_videos_code')) {
    function get_videos_code($url = '')
    {
        $result = '';
        if (!empty($url)) {
            $result = explode('?v=', $url);
        }
        return $result[1];
    }
}

if (!function_exists('location_dropdown')) {
    function location_dropdown($keyword = '', $where = '')
    {
        $dropdown[0] = '--' . '' . $keyword . '--';
        $CI =& get_instance();
        $CI->load->model('Autoload_model');
        $result = $CI->Autoload_model->_get_where(array(
            'select' => 'id, title',
            'table' => 'province',
            'where' => $where,
            'order_by' => 'order desc, title asc',
        ), TRUE);
        if (isset($result) && is_array($result) && count($result)) {
            foreach ($result as $key => $val) {
                $dropdown[$val['id']] = $val['title'];
            }
        }
        return $dropdown;
    }
}


if (!function_exists('percent')) {
    function percent($price = 0, $saleoff = 0)
    {
        $percent = ($price - $saleoff) / $price * 100;
        return $percent;
    }
}


if (!function_exists('check_delete')) {
    function check_delete($param = '', $modules = 'articles')
    {
        // param là list các id bài viết, sản phẩm ...
        $CI =& get_instance();
        $CI->load->model('routers/BackendRouters_Model');
        $model = 'Backend' . ucfirst($modules) . '_Model';
        $flag = 0;
        $_temp_ = '';
        $_list_ = $CI->$model->_get_where(array(
            'select' => 'id, slug, canonical, catalogues',
            'table' => $modules,
            'where' => array('trash' => 0),
            'where_in' => $param,
            'where_in_field' => 'id'
        ), TRUE);


        if (isset($_list_) && is_array($_list_) && count($_list_)) {
            foreach ($_list_ as $key => $val) {
                $json_decode_catalogues = json_decode($val['catalogues'], TRUE);
                if (count($json_decode_catalogues) == 1) {
                    // xóa trong catalogues relationship
                    $CI->$model->_delete_relationship($modules, $val['id']);
                    $_temp_[] = array(
                        'id' => $val['id'],
                        'canonical' => $val['canonical'],
                    ); // mảng id của những bài viết sẽ xóa
                }
            }
        }

        if (isset($_temp_) && is_array($_temp_) && count($_temp_)) {
            foreach ($_temp_ as $key => $val) {
                // xóa trong bảng routers
                $CI->BackendRouters_Model->Delete($val['canonical'], $modules . '/frontend/' . $modules . '/view', $val['id'], 'number');
                // xóa bài viết --> cập nhật canonical bài viết về 0
                $_update_['table'] = $modules;
                $_update_['where'] = array('id' => $val['id'],);
                $_update_['data'] = array('trash' => 1, 'canonical' => '');
                $CI->$model->_delete($_update_);
            }
        }

    }
}


if (!function_exists('catalogues_relationship')) {
    function catalogues_relationship($cataloguesid = 0, $modules = 'articles', $model = '', $table = 'articles', $lang = 'vietnamese', $param = '')
    {
        $CI =& get_instance();
        if (isset($model) && is_array($model) && count($model)) {
            foreach ($model as $key => $val) {
                $CI->load->model($modules . '/' . $val . '_Model');
            }
        }

        $model_cat = $model[1] . '_Model';

        $detail_catalogues = $CI->$model_cat->_get_where(array(
            'table' => $table,
            'where' => array('id' => $cataloguesid, 'alanguage' => $lang),
            'select' => 'id, title, slug, canonical, lft, rgt',
            'trash' => 0
        ), FALSE);

        $_id_list = '';
        $_article_id_list = '';
        $result_1 = '';
        if ($detail_catalogues['rgt'] - $detail_catalogues['lft'] > 1) {
            $result = $CI->$model_cat->_get_where(array(
                'table' => $table,
                'where' => array(
                    'lft >=' => $detail_catalogues['lft'],
                    'rgt <=' => $detail_catalogues['rgt'],
                    'trash' => 0,
                ),
                'select' => 'id',
            ), TRUE);
            if (isset($result) && is_array($result) && count($result)) {
                foreach ($result as $key => $val) {
                    $_id_list[] = $val['id'];
                }
            }
            if (isset($_id_list) && is_array($_id_list) && count($_id_list)) {
                $result_1 = $CI->db->select('modulesid')->from('catalogues_relationship')->where(array('modules' => $modules))->where_in('cataloguesid', $_id_list)->group_by('modulesid')->get()->result_array();
            }
        } else {
            $result_1 = $CI->db->select('modulesid')->from('catalogues_relationship')->where(array('cataloguesid' => $cataloguesid, 'modules' => $modules))->get()->result_array();

        }
        if (isset($result_1) && is_array($result_1) && count($result_1)) {
            foreach ($result_1 as $key => $val) {
                $_article_id_list[] = $val['modulesid'];
            }
        }

        return $_article_id_list;
    }
}

if (!function_exists('user_statistic')) {
    function user_statistic($week = '')
    {
        $CI =& get_instance();
        $day = date('w');
        $temp['week_start'] = date('Y-m-d', strtotime('-' . $day . ' days')) . ' 00:00:00';
        $temp['week_end'] = date('Y-m-d', strtotime('+' . (6 - $day) . ' days')) . ' 00:00:00';
        $temp_1 = '';
        if ($week == 'current') {
            $CI->db->select('*, DATE_FORMAT(created,\'%a\') AS daybyday ');
            $CI->db->from('users_online');
            $CI->db->where(array(
                'created >=' => $temp['week_start'],
                'created <=' => $temp['week_end'],
            ));
            $result = $CI->db->get()->result_array();
            $temp_1 = converday($result);
            return $temp_1;
        }
        if ($week = 'lastweek') {
            $previous_week = strtotime("-1 week +1 day");
            $start_week = strtotime("last sunday midnight", $previous_week);
            $end_week = strtotime("next saturday", $start_week);

            $temp['week_start'] = date("Y-m-d", $start_week);
            $temp['week_end'] = date("Y-m-d", $end_week);
            $CI->db->select('*, DATE_FORMAT(created,\'%a\') AS daybyday ');
            $CI->db->from('users_online');
            $CI->db->where(array(
                'created >=' => $temp['week_start'],
                'created <=' => $temp['week_end'],
            ));
            $result = $CI->db->get()->result_array();
            $temp_1 = converday($result);
            return $temp_1;
        }
    }
}

if (!function_exists('converday')) {
    function converday($param = '')
    {
        $CI =& get_instance();
        $result = '';
        $date = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        foreach ($date as $key => $val) {
            $result[] = array(
                'value' => count_array_by_value($param, $val),
            );

        }
        return $result;
        // $timestamp = gmdate('D', strtotime($val['created'])+7*3600);
        // echo gmdate('D', strtotime('2016-11-22')+7*3600);die();

    }
}

if (!function_exists('count_array_by_value')) {
    function count_array_by_value($array = '', $value = 0, $keyword = 'daybyday')
    {
        $total = 0;
        foreach ($array as $key => $val) {
            if ($val[$keyword] == $value) {
                $total = $total + 1;
            }
        }
        return $total;

    }
}

if (!function_exists('count_array_by_condition')) {
    function count_array_by_condition($array = '', $value = 0, $keyword = 'district')
    {
        $total = 0;
        foreach ($array as $key => $val) {
            if ($val[$keyword] == $value) {
                $total = $total + $val['price'] * $val['quantity'];
            }
        }
        return $total;

    }
}


if (!function_exists('mail_html')) {
    function mail_html($param = NULL)
    {
        $CI =& get_instance();
        return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="display: block;width: 100%;height: 100%;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><img src="' . BASE_URL . $CI->fcSystem['homepage_cover'] . '" alt="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;display: block;width: 100%;height: 100%;object-fit: cover;"></div><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);"> Đặt hàng thành công</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 20px;">Cảm ơn <strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">anh ' . $param['fullname'] . '</strong> đã cho ' . $param['web'] . ' cơ hội được phục vụ. Nhân viên sẽ liên hệ lại với anh để xác nhận thông tin đặt hàng trong 5 phút.</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 5px 10px;margin-bottom: 10px;text-transform: uppercase;background: #f3f3f3;">Thông tin đặt hàng:</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số khách(người lớn): ' . $param['person'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số khách(trẻ em): ' . $param['child'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phoneorder'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Ghi chú: ' . $param['message'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;"><strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">Thanh toán tiền mặt khi nhận hàng</strong></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Tổng tiền: <span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-weight: bold;color: #c10017;">' . (number_format($param['total_price'])) . '₫</span></div></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 20px;padding-left: 15px">Trước khi giao nhân viên sẽ liên lạc với anh <strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">anh ' . $param['fullname'] . '</strong>để xác nhận. Khi cần trợ giúp vui lòng gọi <a href="tel:' . $param['hotline'] . '" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-weight: bold;color: #288ad6;">' . $param['hotline'] . '</a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 5px 10px;margin-bottom: 10px;text-transform: uppercase;background: #f3f3f3;padding-left: 15px">Sản phẩm đã mua:</div><ul style="margin: 0;padding: 0;list-style: none;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding-left: 15px">' . $param['product'] . '</ul><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;text-align: center;margin-top: 30px;"><a href="' . $param['web'] . '" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;text-decoration: none;display: inline-block;overflow: hidden;background: #fff;line-height: 40px;width: 250px;font-size: 14px;color: #288ad6;font-weight: 600;text-transform: uppercase;border: 1px solid #288ad6;border-radius: 4px;-webkit-transition: all .25s linear;-o-transition: all .25s linear;transition: all .25s linear;">Mua thêm sản phẩm khác</a></div></div></div></section>';
    }
}

if (!function_exists('mail_html_online')) {
    function mail_html_online($param = NULL)
    {
        $CI =& get_instance();
        return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="display: block;width: 100%;height: 100%;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"></div><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);"> Đặt hàng thành công</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 20px;">Cảm ơn <strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">anh ' . $param['fullname'] . '</strong> đã cho ' . $param['web'] . ' cơ hội được phục vụ. Nhân viên sẽ liên hệ lại với anh để xác nhận thông tin đặt hàng trong 5 phút.</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 5px 10px;margin-bottom: 10px;text-transform: uppercase;background: #f3f3f3;">Thông tin đặt hàng:</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Địa chỉ nhận hàng: ' . $param['address'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phone'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;"><strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">Thanh toán tiền mặt khi nhận hàng</strong></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Tổng tiền: <span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-weight: bold;color: #c10017;">' . (str_replace(',', '.', number_format($param['total_price']))) . '₫</span></div></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 20px;padding-left: 15px">Trước khi giao nhân viên sẽ liên lạc với anh <strong style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;">anh ' . $param['fullname'] . '</strong>để xác nhận. Khi cần trợ giúp vui lòng gọi <a href="tel:' . $param['hotline'] . '" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-weight: bold;color: #288ad6;">' . $param['hotline'] . '</a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 5px 10px;margin-bottom: 10px;text-transform: uppercase;background: #f3f3f3;padding-left: 15px">Sản phẩm đã mua:</div><ul style="margin: 0;padding: 0;list-style: none;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding-left: 15px"><li style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;margin-bottom: 10px;padding-bottom: 10px;border-bottom: 1px solid #ebebeb;display: flex;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;width: 80px;"><a href="" title="" style="display: block;width: 100%;height: 75px;-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><img src="' . BASE_URL . $param['images'] . '" alt="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;display: block;width: 100%;height: 100%;object-fit: scale-down;"></a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;display: flex;-ms-flex-pack: justify;-moz-justify-content: space-between;-o-justify-content: space-between;-ms-justify-content: space-between;-webkit-justify-content: space-between;justify-content: space-between;padding-left: 15px;-webkit-width: calc(100% - 80px);-o-width: calc(100% - 80px);-ms-width: calc(100% - 80px);-moz-width: calc(100% - 80px);width: calc(100% - 80px);"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;font-size: 14px;line-height: 18px;overflow: hidden;-ms-text-overflow: ellipsis;text-overflow: ellipsis;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;height: 36px;"><a href="" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #333;font-weight: bold;text-decoration: none;">' . $param['title'] . '</a></div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #c10017;font-weight: bold;margin-bottom: 5px;">' . (str_replace(',', '.', number_format($param['price']))) . '₫</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #999;">Số lượng: <span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;color: #333;font-weight: bold;">' . $param['quantity'] . '</span></div></div></div></li></ul><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;text-align: center;margin-top: 30px;"><a href="' .BASE_URL. '" title="" style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;text-decoration: none;display: inline-block;overflow: hidden;background: #fff;line-height: 40px;width: 250px;font-size: 14px;color: #288ad6;font-weight: 600;text-transform: uppercase;border: 1px solid #288ad6;border-radius: 4px;-webkit-transition: all .25s linear;-o-transition: all .25s linear;transition: all .25s linear;">Mua thêm sản phẩm khác</a></div></div></div></section>';
    }
}

if (!function_exists('mail_html_email')) {
    function mail_html_email($param = NULL)
    {
        $CI =& get_instance();
        return '<section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);">Thông tin đặt bàn</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phone'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Giờ đặt bàn: ' . $param['time'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Ngày đặt bàn: ' . $param['date'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số khách người lớn: ' . $param['person'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số khách trẻ em: ' . $param['child'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Ghi chú: ' . $param['message'] . '</div></div></div></div></section>';
    }
}
if (!function_exists('mail_html_voucher')) {
    function mail_html_voucher($param = NULL)
    {
        $CI =& get_instance();
        return '<section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);">Thông tin đặt Voucher</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Voucher: ' . $param['product'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Sô lượng: ' . $param['quantiny'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phone'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Email: ' . $param['email'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Địa chỉ: ' . $param['address'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Ghi chú: ' . $param['message'] . '</div></div></div></div></section>';
    }
}
/*
if (!function_exists('mail_html_guiyeucau')) {
    function mail_html_guiyeucau($param = NULL)
    {
        $CI =& get_instance();
        return '<section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);"> Thông tin đăng ký tư vấn</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phone'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Email: ' . $param['email'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Nội dung: ' . $param['message'] . '</div></div></div></div></section>';
    }
}


if (!function_exists('mail_html_ctv')) {
    function mail_html_ctv($param = NULL)
    {
        $CI =& get_instance();
        return '<section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><h1 style="box-sizing:border-box;text-align:center;margin:-20px 0 10px 0;"><span style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;padding: 7px 30px;line-height: 24px;font-size: 16px;color: #00af1d;font-weight: bold;text-align: center;text-transform: uppercase;background: #fff;border-radius: 20px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.16);-webkit-transform: translate(0, -50%);-ms-transform: translate(0, -50%);-o-transform: translate(0, -50%);transform: translate(0, -50%);"> ĐĂNG KÝ TRỞ THÀNH CTV</span></h1><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;padding: 0 20px 20px 20px;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;"><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Họ và tên: ' . $param['fullname'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Số điện thoại: ' . $param['phone'] . '</div><div style="-o-box-sizing: border-box;-ms-box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;box-sizing: border-box;position: relative;padding-left: 15px;margin-bottom: 5px;">Email: ' . $param['email'] . '</div></div></div></div></section>';
    }
}
if (!function_exists('mail_html_recovery')) {
    function mail_html_recovery($param = NULL)
    {
        $CI =& get_instance();
        return '<section style="max-width:600px;margin:0 auto;background:#f8f8f8;border:1px solid #d8d8d8; font-family:Arial,sans-serif; font-size:14px;line-height:20px; border-radius: 10px; margin-top: 30px;">'.$param['link'].'</section>';
    }
}
*/