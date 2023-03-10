<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_call_to_action')):
   class gsc_call_to_action{
      public function render_form(){
         $fields = array(
            'type' => 'gsc_call_to_action',
            'title' => t('Call to Action'),
            'size' => 12,
            
            'fields' => array(
               array(
                  'id'        => 'subtitle',
                  'type'      => 'text',
                  'title'     => t('Sub Title')
               ),
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('HTML tags allowed.'),
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'button_title',
                  'type'      => 'text',
                  'title'     => t('Button Title'),
                  'desc'      => t('Leave this field blank if you want Call to Action with Big Icon'),
               ),
               array(
                  'id'           => 'button_align',
                  'type'         => 'select',
                  'title'        => 'Style',
                  'options'      => array(
                     'button-left'              => t('Button Left'),
                     'button-right'             => t('Button Right'),
                     'button-bottom'            => t('Button Bottom Left'),
                     'button-center'            => t('Button Bottom Center'),
                  )
               ),
               array(
                  'id'        => 'box_background',
                  'type'      => 'text',
                  'title'     => t('Box Background'),
                  'desc'      => t('Box Background, e.g: #f5f5f5')
               ),
               array(
                  'id'        => 'width',
                  'type'      => 'text',
                  'title'     => t('Max width for content'),
                  'desc'      => 'e.g 660px'
               ),
               array(
                  'id'        => 'style_text',
                  'type'      => 'select',
                  'title'     => 'Skin Text for box',
                  'options'   => array(
                        'text-light'  => 'Text light',
                        'text-dark'   => 'Text dark',
                  ),
                  'std'       => 'text-dark'
               ),
               array(
                  'id'        => 'style_button',
                  'type'      => 'select',
                  'title'     => 'Style button',
                  'options'   => array(
                        'btn-theme'    => 'Button default of theme',
                        'btn-white'    => 'Button white'
                  ),
                  'std'       => 'text-dark'
               ),
               array(
                  'id'        => 'video',
                  'type'      => 'text',
                  'title'     => t('Link Video'),
                  'desc'      => t('e.g: https://www.youtube.com/watch?v=4g7zRxRN1Xk')
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 'off' => 'No', 'on' => 'Yes' ),
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
                  'sub_desc'  => t('Entrance animation'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
            ),                                       
         );
      return $fields;
      }

      function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_call_to_action( $item['fields'], $item['fields']['content'] );
      }

      function sc_call_to_action( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'           => '',
            'subtitle'        => '',
            'link'            => '',
            'button_title'    => '',
            'button_align'    => '',
            'width'           => '',
            'style_button'    => 'btn-theme',
            'target'          => '',
            'el_class'        => '',
            'animate'         => '',
            'style_text'      => 'text-dark',
            'box_background'  => '',
            'video'           => ''
         ), $attr));
         
         // target
         if( $target =='on' ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         
         $class = array();
         $class[] = $el_class;
         $class[] = $button_align;
         $class[] = $style_text;
         if($box_background) $class[] = 'has-background';
         if($animate){
            $class[] = ' wow';
            $class[] = $animate;
         }
         $style = '';
         if($width) $style .= "max-width: {$width};";
         if($box_background) $style .= "background: {$box_background};";
         $style = "style=\"".$style ."\"";
         ob_start();
         ?>
         <div class="widget gsc-call-to-action <?php print implode(' ', $class) ?>" <?php print $style ?>>
            <div class="content-inner clearfix" >
               <div class="content">
                  <?php if($subtitle){ ?>
                     <div class="sub-title"><?php print $subtitle; ?></div>
                  <?php } ?>   
                  <h2 class="title"><span><?php print $title; ?></span></h2>
                  <div class="desc"><?php print do_shortcode($content); ?></div>
               </div>
               <?php if(!empty($video)){ ?>
                  <div class="video-body">
                     <a class="popup-video gsc-video-link" href="<?php print $video ?>">
                        <span class="icon-play"></span>
                     </a>
                  </div>
               <?php } ?>
               <?php if($link){?>
                  <div class="button-action">
                     <a href="<?php print $link ?>" class="<?php print $style_button ?>" <?php print $target ?>><?php print $button_title ?></a>   
                  </div>
               <?php } ?>
            </div>
         </div>
         <?php return ob_get_clean() ?>
      <?php
      }

      public function load_shortcode(){
         add_shortcode( 'cta', array($this, 'sc_call_to_action') );
      }
   }
endif;   



