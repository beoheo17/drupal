<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_box_color')):
   class gsc_box_color{
      
      public function render_form(){
         $fields = array(
            'type'            => 'gsc_box_color',
            'title'           => t('Box color'),
            'size'            => 3,
            'icon'            => 'fa fa-bars',
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => 'Title for box',
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'number',
                  'type'      => 'text',
                  'title'     => 'Number',
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content for box'),
               ),
               array(
                  'id'        => 'icon',
                  'type'      => 'text',
                  'title'     => t('Icon class'),
                  'std'       => '',
                  'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/">Custom icon</a>'),
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'text_link',
                  'type'      => 'text',
                  'title'     => t('Text Link'),
                  'std'       => t('Read more')
               ),
               array(
                  'id'        => 'color',
                  'type'      => 'text',
                  'title'     => t('Background color'),
                  'desc'      => t('Background color fox box. e.g: #ccc')
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 0 => 'No', 1 => 'Yes' ),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
            ),                                     
         );
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_box_color( $item['fields'] );
      }

      public static function sc_box_color( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(
            'icon'                  => '',
            'title'                 => '',
            'number'                => '',
            'content'               => '',
            'link'                  => '',
            'text_link'             => 'Read more',
            'color'                 => '',
            'target'                => '',
            'el_class'              => '',
            'animate'               => ''
         ), $attr));

         // target
         if( $target ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }

         $style_color = '';
         if($color){
            $style_color = "style=\"color: {$color};\"";
         }

         ob_start();
         ?>
         <div class="widget gsc-box-color clearfix <?php print $el_class; ?>">
            <div class="box-content">
               <?php if($number){ ?><div class="number" <?php print $style_color ?>><?php print $number ?></div><?php } ?>
               <?php if($icon){ ?><div class="icon" <?php print $style_color ?>><span class="<?php print $icon ?>"></span></div> <?php } ?>
               <div class="content">
                  <div class="widget-title box-title"><?php print $title ?></div>
                  <div class="desc"><?php print $content ?></div>
               </div>
            </div>
         </div>  
         <?php return ob_get_clean() ?>
         <?php
      }

      public function load_shortcode(){
         add_shortcode( 'box_color', array('gsc_box_color', 'sc_box_color') );
      }
   }
endif;   




