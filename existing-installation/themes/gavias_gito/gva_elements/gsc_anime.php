<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_anime')):
   class gsc_anime{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_anime',
            'title' => t('Anime Text'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Text'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'subtitle',
                  'type'      => 'text',
                  'title'     => t('Sub Title')
               ),
               array(
                  'id'        => 'font_size',
                  'type'      => 'text',
                  'title'     => t('Font Size'),
                  'desc'      => t('E.g: 48px, Font size of text, default = 38px if empty')
               ),
                array(
                  'id'        => 'color',
                  'type'      => 'select',
                  'title'     => t('Style display'),
                  'options'   => array(
                     'theme'   => 'Theme Color',
                     'black'   => 'Black Color',
                     'white'   => 'White Color',
                  )
               ), 
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style display'),
                  'options'   => array(
                     'style-1'   => 'Style #1',
                     'style-2'   => 'Style #2',
                     'style-3'   => 'Style #3',
                     'style-4'   => 'Style #4',
                  )
               ), 
               array(
                  'id'        => 'font_style',
                  'type'      => 'select',
                  'title'     => t('Font Style'),
                  'options'   => array(
                     'font-style-1'   => 'Style #1',
                     'font-style-2'   => 'Style #2'
                  )
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content')
               ),
               array(
                  'id'        => 'align',
                  'type'      => 'select',
                  'title'     => t('Align'),
                  'options'   => array(
                     'center'    => 'Center',
                     'left'      => 'Left',
                     'right'     => 'Right'
                  )
               ),
               array(
                  'id'     => 'animate',
                  'type'      => 'select',
                  'title'  => ('Animation'),
                  'desc'  => t('Entrance animation for element'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),   
            ),                                     
         );
         return $fields;
      }

      public function render_content( $item ) {
         print self::sc_anime( $item['fields'] );
      }

      public static function sc_anime( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'        => '',
            'style'        => 'style-1',
            'font_style'   => 'font-style-1',
            'subtitle'     => '',
            'font_size'    => '38px',
            'color'        => 'black',
            'el_class'     => '',
            'align'        => 'center',
            'animate'      => '',
            'content'      => ''
         ), $attr));
         $el_class .= ' ' . $style;
         $el_class .= ' ' . $align;
         $el_class .= ' ' . $font_style;
         if($animate){
            $el_class .= ' wow';
            $el_class .= ' ' . $animate;
         }
         $style_font_size = '';
         if($font_size){
            $style_font_size = 'style="font-size: ' . $font_size . '"';
         }
      ?>
      <div class="gsc-anime clearfix <?php print $el_class ?> color-<?php print $color ?>">
         <?php if($style == 'style-1'){ ?>
            <div class="text-anime">
               <div class="content-inner">
                  <?php if($subtitle){ ?>
                     <div class="subtitle"><?php print $subtitle ?></div>
                  <?php } ?>
                  <h2 class="ml14">
                    <span class="text-wrapper">
                      <span class="letters<?php print ($color ? " text-{$color}" : "" ) ?>" <?php print ($style_font_size ? $style_font_size : ''); ?>><?php print $title; ?></span>
                      <span class="line<?php print ($color ? " bg-{$color}" : "" ) ?>"></span>
                    </span>
                  </h2>
               </div>   
            </div>   
            <?php if($content){ ?>
               <div class="main-content"><div class="content-inner"><?php echo $content ?></div></div>  
            <?php } ?>   
         <?php } ?>


         <?php if($style == 'style-2'){ ?>
            <div class="text-anime">
               <div class="content-inner">
                  <?php if($subtitle){ ?>
                     <div class="subtitle"><?php print $subtitle ?></div>
                  <?php } ?>
                  <h2 class="ml9">
                    <span class="text-wrapper">
                      <span class="letters<?php echo ($color ? " text-{$color}" : "" ) ?>" <?php print ($style_font_size ? $style_font_size : ''); ?>><?php print $title; ?></span>
                    </span>
                  </h2>
               </div>   
            </div>   
            <?php if($content){ ?>
               <div class="main-content"><div class="content-inner"><?php echo $content ?></div></div>  
            <?php } ?>   
         <?php } ?>

         <?php if($style == 'style-3'){ ?>
            <div class="text-anime">
               <div class="content-inner">
                  <?php if($subtitle){ ?>
                     <div class="subtitle"><?php print $subtitle ?></div>
                  <?php } ?>
                  <h2 class="ml12<?php echo ($color ? " text-{$color}" : "" ) ?>" <?php print ($style_font_size ? $style_font_size : ''); ?>>
                      <?php print $title; ?>
                  </h2>
               </div>   
            </div>   
            <?php if($content){ ?>
               <div class="main-content"><div class="content-inner"><?php echo $content ?></div></div>  
            <?php } ?>   
         <?php } ?>

         <?php if($style == 'style-4'){ ?>
            <div class="text-anime">
               <div class="content-inner">
                  <?php if($subtitle){ ?>
                     <div class="subtitle"><?php print $subtitle ?></div>
                  <?php } ?>
                  <h2 class="ml2<?php echo ($color ? " text-{$color}" : "" ) ?>" <?php print ($style_font_size ? $style_font_size : ''); ?>>
                     <?php print $title; ?>
                  </h2>
               </div>   
            </div>   
            <?php if($content){ ?>
               <div class="main-content"><div class="content-inner"><?php echo $content ?></div></div>  
            <?php } ?>   
         <?php } ?>

      </div>   

      <?php
      }

      public function load_shortcode(){
         add_shortcode( 'anime', array($this, 'sc_anime') );
      }
   }
 endif;  



