<?php
/*
Plugin Name: Geniux Blank
Description: Basic WordPress plugin structure.
Version: 1.0.0
License: MIT
License URI: http://opensource.org/licenses/bsd-license.php
Author: Geniux Themes (@pabagan)
Author URI: http://www.geniuxthemes.com

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE 
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE 
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL 
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR 
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER 
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, 
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE 
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}


if ( ! class_exists( 'Geniux_Blank' ) ) :
/**
 * Basic class for plugin definition.
 * 
 * @package geniux-blank
 * @version 1.0.0
 * @author   @pabagan
 */
class Geniux_Blank {
    
    /**
     *  Version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     *  Plugin Slug.
     *
     * @var string
     */
    const PLUGIN_SLUG = 'geniux-blank';

    /**
     *  Class Instance.
     *
     * @var object
     */
    protected static $instance = null;

    /**
     *  Initialize the plugin.
     */
    function __construct() {
        
        // Plugin folder URL
        if ( ! defined( 'GX_PLUGIN_URL' ) ) {
            define( 'GX_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
        }
        
        // load includes
        $this->includes();

        // Plugin Scripts
        add_action( 'wp_enqueue_scripts', array(&$this, 'plugin_scripts'));
    }

    /**
     * Class Instance.
     *
     * @return object Instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Plugin included files loaded at constructor.
     *
     * @return object Instance of this class.
     */
    protected function includes() {
        // Include blank
        include_once 'inc/blank.php';
    }
    
    /**
     * Plugin Scripts. Automatic name scripts with 
     * 'plugin-slug' + [js/css].
     * 
     * @return void
     */
    public function plugin_scripts() {
        // JS
        wp_register_script( self::PLUGIN_SLUG, GX_PLUGIN_URL . 'assets/js/' . self::PLUGIN_SLUG . '.js', array( 'jquery' ), '1.0', true);
        wp_enqueue_script( self::PLUGIN_SLUG );
        // Styles
        wp_register_style( self::PLUGIN_SLUG, GX_PLUGIN_URL . 'assets/css/' . self::PLUGIN_SLUG . '.css', array(), '1.0');
        wp_enqueue_style( self::PLUGIN_SLUG );
    }
}
endif;

/**
 *  Init plugin.
 */
add_action( 'plugins_loaded', array( 'Geniux_Blank', 'get_instance' ) );