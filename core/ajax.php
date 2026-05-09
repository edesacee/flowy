<?php
namespace flowyth;

abstract class Ajax {
    protected $_selector;
    protected $_prefix;
    protected $_trigger;
    protected $_field_type;
    protected $_get_params_func;
    protected $_async;
    protected $_show_processing_modal = false;

    abstract public function action();

    public function __construct($id, $options = array()) {
        $this->_id    = $id;
        $type         = (isset($options['type'])) ? $options['type'] :'';

        // $this->_slug = isset($options['slug']) ? $options['slug'] : '';

        $library_folder = basename(dirname(__FILE__));

        $this->_prefix = strtolower($library_folder) . '-' . 'ajax-actions';

        // $this->_classes []= $this->_prefix;
        // $this->_classes []= (isset($options['class'])) ? $options['class'] : 'frm-' . uniqid();

        $class = get_class();
        
        $this->_type = $type;
        $this->_show_processing_modal = isset($options['show_processing_modal']) ? $options['show_processing_modal'] : false;
        $this->_selector = isset($options['selector']) ? $options['selector'] : '';
        $this->_trigger = isset($options['trigger']) ? $options['trigger'] : 'click';
        $this->_field_type = isset($options['field_type']) ? $options['field_type'] : 'input';
        $this->_get_params_func = isset($options['get_params_func']) ? $options['get_params_func'] : '';
        $this->_async = isset($options['async']) ? $options['async'] : '';

        if ($type == 'wp') {
            add_action('wp_footer', array($this, 'addScript'));
        }
        else if($type == 'admin' || $type == 'metabox'){
            add_action('admin_footer', array($this, 'addScript'));
        }

        else if($type == 'static'){
            $this->addScript();
        }        
    } //function

    public static function __init() {
        $class = get_class();
        $library_folder = basename(dirname(__FILE__));
        $prefix = strtolower($library_folder) . '-' . 'ajax-actions';

        add_action('wp_ajax_' . $prefix, array($class, '__ajaxCallAjaxAction'));
        add_action('wp_ajax_nopriv_' . $prefix, array($class, '__ajaxCallNoPrivAjaxAction'));
    } //function

    public function addScript() {
        $ajax_url = admin_url('admin-ajax.php');

        // if (get_bloginfo('wpurl') == 'http://wordpress.local') {
        //     $ajax_url =($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/wp-admin/admin-ajax.php';
        // }
        // else 

    ?>

        <!-- The Modal -->
        <div id="<?php echo  $this->_id ?>-modal" class="ajax-action-processing modal" style="display: none">
            <!-- Modal content -->
            <div class="modal-content"  style="display: table; table-layout: fixed; background: transparent; border: 0;">     
                <!-- <span class="close">&times;</span> -->
                <div class="content" style="display: table-cell; background: transparent; vertical-align: middle;">
                    <div class="inner" style="text-align: center; max-width: 100%; width: 400px; margin: 0 auto; border-radius: 5px; background: #2A51A0; padding: 15px 20px; color: #fff">
                        <div class="fa-3x">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>
                        <div>Processing...</div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var $jx = jQuery.noConflict();
            var ajaxurl = '<?php echo $ajax_url; ?>';

            $jx(function(){
                $jx('body').on('<?php echo  $this->_trigger ?>', '<?php echo  $this->_selector ?>', function(){

                    $params = $jx(this).data('params') ? $jx(this).data('params') : ''; 
                    $confirm = $jx(this).data('confirm');                
                    
                    if ($jx('<?php echo  $this->_selector ?>').is(":disabled") || $jx('<?php echo  $this->_selector ?>').attr("disabled") == 'disabled') {
                        return ;
                    }

                    $show_modal = '<?php echo $this->_show_processing_modal ?>';

                    if ($show_modal) {
                        $jx('#<?php echo  $this->_id ?>-modal .inner').html('<div class="fa-3x"><i class="fas fa-spinner fa-spin"></i></div><div>Processing...</div>');
                    }

                    if ($confirm) {
                        if (!confirm($confirm)) {
                            return false;
                        }

                        $jx(this).attr('disabled', 'disabled');
                        $jx(this).css('cursor', 'progress');     

                        if ($show_modal) {
                            $jx('#<?php echo  $this->_id ?>-modal').fadeIn();
                        }
                    }
                    else {
                        $jx(this).attr('disabled', 'disabled');
                        $jx(this).css('cursor', 'progress');                    

                        if ($show_modal) {
                            $jx('#<?php echo  $this->_id ?>-modal').fadeIn();
                        }
                    }

                    if (typeof window['<?php echo $this->_get_params_func ?>'] !== 'undefined' && typeof window['<?php echo $this->_get_params_func ?>'] === 'function') {
                        $func_res = window['<?php echo $this->_get_params_func ?>']($jx(this));

                        if (!$func_res) {
                            $jx('<?php echo  $this->_selector ?>').removeAttr('disabled');
                            $jx('<?php echo  $this->_selector ?>').css('cursor', 'pointer');                            
                            return false;
                        }
                        else {
                            $params = $func_res;
                        }
                    }

                    if ('<?php echo  $this->_trigger ?>' == 'change') {
                        if ($params) {
                            $params += '&';
                        } //if

                        if ('<?php echo  $this->_field_type ?>' == 'checkbox') {
                            if ($jx(this).is(":checked")) {
                                $params += 'val=on';
                            } //if
                        } //if
                        else {
                            $params += 'val=' + $jx(this).val();   
                        } //else
                    } //else

                    var position = $jx(this).position();

                    $jx.ajax({
                        url: ajaxurl, //AJAX file path – admin_url("admin-ajax.php")
                        type: "POST",
                        data: 'action=<?php echo $this->_prefix ?>&' + $params + '&key_cn=' + encodeURIComponent('<?php echo $this->swapChars(get_class($this)); ?>') + '&key_id=<?php echo $this->_id ?>',
                        dataType: "json",
                        success: function($data){
                            //$jx('#<?php echo  $this->_selector ?>-msg').remove();
                            $jx('<?php echo  $this->_selector ?>').removeAttr('disabled');
                            $jx('<?php echo  $this->_selector ?>').css('cursor', 'pointer');

                            $show_modal = '<?php echo $this->_show_processing_modal ?>';

                            if ($show_modal && $data['message']) {
                                $jx('#<?php echo  $this->_id ?>-modal .inner').html($data['message'] + '<div style="margin-top: 5px;"><span class="close" style="position: static; float: none; border: 0; background: #fff; padding: 5px 10px; line-height: normal; width: auto; height: auto; box-shadow: 1px 1px 3px #000; display: inline-block; border-radius: 3px; font-size: 21px;">OK</span></div>');
                            }
                            else {
                                $jx('#<?php echo  $this->_id ?>-modal').fadeOut();
                            }

                            if ($data['redirect_to']) {
                                window.location = $data['redirect_to'];
                            }
                            else if (typeof window[$data.function] !== 'undefined' && typeof window[$data.function] === 'function') {
                                window[$data.function]($data);
                            } //if
                            },
                        error: function($data, $textStatus, $errorThrown){
                        }
                    });

                    if ('<?php echo  $this->_trigger ?>' == 'change' || '<?php echo  $this->_async ?>' == true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                });
            });
        </script>
    <?php
    } //function   

    public static function __ajaxCallNoPrivAjaxAction() {
        $key_id = sanitize_text_field($_POST['key_id']);
        $class_name = get_class();
        $class = $class_name::unswapChars($_POST['key_cn']);
        $obj = new $class($key_id);

        if (method_exists($obj, 'noPrivAction')) {
            $data = $obj->noPrivAction();
            $data ['function'] = str_replace('-', '', $key_id) . 'Success';
        }
        else {
            $data ['success'] = false;
            $data ['message'] = 'Not allowed.';
        }

        print_r( json_encode($data));
        exit;        
    }

    public static function __ajaxCallAjaxAction() {
        if(!is_user_logged_in()) {
            exit ;
        }

        $key_id = sanitize_text_field($_POST['key_id']);
        $class_name = get_class();
        $class = $class_name::unswapChars($_POST['key_cn']);
        $obj = new $class($key_id);
        $data = $obj->action();
        $data ['function'] = str_replace('-', '', $key_id) . 'Success';

        print_r( json_encode($data));
        exit;
    } //function    


    public static function swapChars($text) {
        $chars1 = 'praywithoutceasing';
        $chars2 = '12345678907!@3#6$%';

        for ($i = 0; $i < strlen($text); $i++) {
            $pos = strpos($chars1, $text[$i]);
            if ($pos !== false) {
                $text[$i] = $chars2[$pos];
            }
        }

        return $text;
    } //function

    public static function unSwapChars($text) {
        $chars1 = '12345678907!@3#6$%';
        $chars2 = 'praywithoutceasing';

        for ($i = 0; $i < strlen($text); $i++) {
            $pos = strpos($chars1, $text[$i]);

            if ($pos !== false) {
                $text[$i] = $chars2[$pos];
            }
        }

        return $text;
    } //function    
}


/**
 ************************************************************************


call __init();


new  Ajax_EnableDisableClient('ajax-toggle-client', array('type' => 'wp', 
                                                          'selector' => '.ajax-toggle-client', 
                                                          'trigger' => 'change', 
                                                          'field_type' => 'checkbox',
                                                          'get_params_func' => functionName
                                                    ));

$dis = $jx(this) or the selector

function ajaxgettimezoneoptGetParams($dis) {
    $facebook_id = $jx('#facebook_id').val();
    $facebook_name = $jx('#facebook_name').val();
    $access_token = $jx('#facebook_access_token').val();
    $facebook_guid = $jx('#facebook_guid').val();
    $loc_guid = $jx('#l').val();

    return 'facebook_id=' + $facebook_id + '&facebook_access_token=' + $access_token + '&l=' + $loc_guid + '&facebook_name=' + $facebook_name + '&facebook_guid=' + $facebook_guid;
}

function ajaxgettimezoneoptGetParams() {
    return 'a=test';
}

<input 
        type="checkbox"
        class="ajax-toggle-client" 
        data-params="c=' . $value['guid'] . '"
        data-confirm="Are you sure ...?"

/>

 ************************************************************************
 */