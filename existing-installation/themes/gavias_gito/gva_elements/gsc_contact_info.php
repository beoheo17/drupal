<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_contact_info')):
   class gsc_contact_info{
      public function render_form(){
         return array(
           'type'          => 'gsc_contact_info',
            'title'        => t('Contact Information'),
            'size'         => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'address',
                  'type'      => 'textarea',
                  'title'     => t('Address'),
               ),
               array(
                  'id'        => 'email',
                  'type'      => 'text',
                  'title'     => t('Email'),
               ),
               array(
                  'id'        => 'phone',
                  'type'      => 'text',
                  'title'     => t('Phone'),
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
                  'desc'      => t('Content for box info'),
               ),
               array(
                  'id'        => 'facebook',
                  'type'      => 'text',
                  'title'     => t('Fackebook Link'),
               ),
               array(
                  'id'        => 'twitter',
                  'type'      => 'text',
                  'title'     => t('Twitter Link'),
               ),
               array(
                  'id'        => 'instagram',
                  'type'      => 'text',
                  'title'     => t('Instagram Link'),
               ),
               array(
                  'id'        => 'linkedin',
                  'type'      => 'text',
                  'title'     => t('Linkedin Link'),
               ),
               array(
                  'id'        => 'dribbble',
                  'type'      => 'text',
                  'title'     => t('Dribbble Link'),
               ),
               array(
                  'id'        => 'pinterest',
                  'type'      => 'text',
                  'title'     => t('Pinterest Link'),
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
                  'id'        => 'skin_text',
                  'type'      => 'select',
                  'title'     => 'Skin Text for box',
                  'options'   => array(
                     'text-dark'  => t('Text Dark'), 
                     'text-light' => t('Text Light')
                  ) 
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
      }

      public function render_content( $item ) {
         if( ! key_exists('content', $item['fields']) ) $item['fields']['content'] = '';
            print self::sc_contact_info( $item['fields'], $item['fields']['content'] );
      }

      public static function sc_contact_info( $attr, $content = null ){
         global $base_url;
         extract(shortcode_atts(array(
            'title'              => '',
            'address'            => '',
            'email'              => '',
            'phone'              => '',
            'content'            => '',
            'facebook'           => '',
            'twitter'            => '',
            'instagram'          => '',
            'linkedin'           => '',
            'dribbble'           => '',
            'pinterest'          => '',
            'ajax_link'          => '',
            'ajax_link_text'     => '',
            'el_class'           => '',
            'animate'            => '',
            'skin_text'          => ''
         ), $attr));

         if($animate){
            $el_class .= ' wow';
            $el_class .= ' '. $animate;
         }
         if($skin_text){
             $el_class .= ' '. $skin_text;
         }
           ob_start();
         ?>
            <div class="widget gsc-contact-info clearfix <?php print $el_class ?>">
               <?php if($title){?><div class="widget-title title"><?php print $title ?></div> <?php } ?>
               <?php if($content){?><div class="content"><?php print $content ?></div> <?php } ?>
               <?php if($address){?><div class="address info"><span class="icon gv-icon-1138"></span><?php print $address ?></div> <?php } ?>
               <?php if($email){?><div class="email info"><span class="icon gv-icon-226"></span><?php print $email ?></div> <?php } ?>
               <?php if($phone){?><div class="phone info"><span class="icon gv-icon-266"></span><?php print $phone ?></div> <?php } ?>
               <div class="social-inline">
                  <?php if($facebook){ ?>
                     <a href="<?php echo $facebook ?>"><i class="fa fa-facebook-square"></i></a>
                  <?php } ?>   
                  <?php if($twitter){ ?>
                     <a href="<?php echo $twitter ?>"><i class="fa fa-twitter-square"></i></a>
                  <?php } ?>   
                  <?php if($instagram){ ?>
                     <a href="<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
                  <?php } ?>
                  <?php if($dribbble){ ?>
                     <a href="<?php echo $dribbble ?>"><i class="fa fa-dribbble"></i></a>
                  <?php } ?>
                  <?php if($linkedin){ ?>
                     <a href="<?php echo $linkedin ?>"><i class="fa fa-linkedin-square"></i></a>
                  <?php } ?>
                  <?php if($pinterest){ ?>
                     <a href="<?php echo $pinterest ?>"><i class="fa fa-pinterest"></i></a>
                  <?php } ?>
               </div>
               <?php if($ajax_link){ ?>
                  <div class="ajax-action"><a class="use-ajax" data-dialog-options="{&quot;height&quot;:600,&quot;width&quot;:800,&quot;dialogClass&quot;:&quot;order-dialog&quot;}" data-dialog-type="modal" href="<?php echo $ajax_link ?>"><i class="gv-icon-226"></i>&nbsp;&nbsp;<?php echo $ajax_link_text ?></a></div>
               <?php } ?>
           </div>
           <?php return ob_get_clean() ?>
      <?php
      } 

      public function load_shortcode(){
         add_shortcode( 'contact_info', array($this, 'sc_contact_info'));
      }
   }
endif;   
