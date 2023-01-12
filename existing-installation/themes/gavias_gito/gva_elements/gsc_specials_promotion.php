<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_specials_promotion')):
   class gsc_specials_promotion{

      public function render_form(){
         $fields = array(
            'type' => 'gsc_specials_promotion',
            'title' => ('Special Promotion'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'sub_title',
                  'type'      => 'text',
                  'title'     => t('Sub Title')
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Icon image'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Some Shortcodes and HTML tags allowed'),
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
                  'desc'      => t('Link for title')
               ),
               array(
                  'id'        => 'ajax_link',
                  'type'      => 'text',
                  'title'     => t('Ajax Link'),
               ),
               array(
                  'id'        => 'ajax_link_text',
                  'type'      => 'text',
                  'title'     => t('Ajax Text Link'),
                  'std'       => t('Read more')
               ),
               array(
                  'id'        => 'featured',
                  'type'      => 'select',
                  'title'     => t('Enable Featured'),
                  'options'   => array(
                     'disable'  => t('Disable'), 
                     'enable'   => t('Enable'), 
                  )
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array(
                     'style-1'  => t('Style #1'), 
                     'style-2'  => t('Style #2'), 
                  )
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
               array(
                  'id'     => 'el_class',
                  'type'      => 'text',
                  'title'  => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),

            ),                                       
         );
         return $fields;
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
         print self::sc_specials_promotion( $item['fields'], $item['fields']['content'] );
      }


      public static function sc_specials_promotion( $attr, $content = null ){
         extract(shortcode_atts(array(
            'title'           => '',
            'sub_title'       => '',
            'image'           => '',
            'link'            => '',
            'ajax_link'       => '',
            'ajax_link_text'  => 'Read more',
            'featured'        => 'disable',
            'style'           => 'style-1',
            'animate'         => '',
            'el_class'        => ''
         ), $attr));

         if($image){
            $image = substr(base_path(), 0, -1) . $image; 
         }

         $class = array();
         if($el_class) $class[] = $el_class;
         $class[] = $style;
         $class[] = "featured-{$featured}";
         if($animate){
            $class[] = 'wow';
            $class[] = $animate;
         }

                 ob_start();
         ?>
         <div class="widget gsc-special-promotion <?php if(count($class)>0) print implode(' ', $class) ?>">
            <?php if($image){ ?>
               <div class="image text-center">
                  <img src="<?php print $image ?>" alt=""/>
               </div>
            <?php }?>
            <div class="box-content">
               <?php if($sub_title){ ?>
                  <div class="sub-title"><?php print $sub_title ?></div>
               <?php } ?>
               <div class="title">
                  <?php if($link){ ?> <a href="<?php echo $link ?>"> <?php } ?>
                     <?php print $title; ?>
                  <?php if($link){ ?> </a> <?php } ?>   
               </div>
               <?php if($content){ ?><div class="desc"><?php print $content; ?></div><?php } ?>
              
               <?php if($ajax_link){ ?>
                  <div class="ajax-action"><a class="use-ajax" data-dialog-options="{&quot;height&quot;:600,&quot;width&quot;:800,&quot;dialogClass&quot;:&quot;order-dialog&quot;}" data-dialog-type="modal" href="<?php echo $ajax_link ?>"><?php echo $ajax_link_text ?><i class="gv-icon-165"></i></a></div>
               <?php } ?>
            </div>
            
         </div> 
         <?php return ob_get_clean() ?>
       <?php
      }

      public function load_shortcode(){
         add_shortcode( 'special_food', array($this, 'sc_specials_promotion') );
      }
   }
endif;   




