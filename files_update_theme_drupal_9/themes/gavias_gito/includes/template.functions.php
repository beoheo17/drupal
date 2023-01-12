<?php
function gavias_gito_base_url(){
  global $base_url;
  $theme_path = drupal_get_path('theme', 'gavias_gito');
  return $base_url . '/' . $theme_path . '/';
}

function gavias_gito_preprocess_node(&$variables) {
  $date = $variables['node']->getCreatedTime();
  $variables['date'] = t(date( 'j', $date)) . ' ' . t(date( 'F', $date)) . ' ' . date( 'Y', $date);
  
  if ($variables['teaser'] || !empty($variables['content']['comments']['comment_form'])) {
    unset($variables['content']['links']['comment']['#links']['comment-add']);
  }
  if ($variables['node']->getType() == 'article') {
      $node = $variables['node'];
      $variables['comment_count'] = $node->get('comment')->comment_count;
      $post_format = 'standard';
      try{
         $field_post_format = $node->get('field_post_format');
         if(isset($field_post_format->value) && $field_post_format->value){
            $post_format = $field_post_format->value;
         }
      }catch(Exception $e){
         $post_format = 'standard';
      }

      $iframe = '';
      if($post_format == 'video' || $post_format == 'audio'){
         try{
            $field_post_embed = $node->get('field_post_embed');
            if(isset($field_post_embed->value) && $field_post_embed->value){
               $autoembed = new AutoEmbed();
               $iframe = $autoembed->parse($field_post_embed->value);
            }else{
               $iframe = '';
               $post_format = 'standard';
            }
         }
         catch(Exception $e){
            $post_format = 'standard';
         }
      }
      $variables['gva_iframe'] = $iframe;
      $variables['post_format'] = $post_format;
  }
  $variables['link_contact_form_service'] = theme_get_setting('link_contact_service');
  
  $variables['link_contact_menu_food'] = theme_get_setting('link_contact_menu_food');
  $variables['theme_uri'] = base_path() . drupal_get_path('theme', 'gavias_gito');
}

function gavias_gito_preprocess_node__portfolio(&$variables){
  $node = $variables['node'];
  
  // Override lesson list on single course
  $output = '';
  $count_information = 0;
  if($node->hasField('field_portfolio_information')){
    $informations = $node->get('field_portfolio_information');
    $count_information = count($informations);
    foreach ($informations as $key => $information) {
      $texts = preg_split('/--/', $information->value);
        $information_text = '';
        foreach ($texts as $k => $text) {
          $information_text .= '<span>' . $text . '</span>';
        }
      $output .= '<div class="item-information">' . $information_text . '</div>';
    }
  }
  $variables['count_information'] = $count_information;
  $variables['informations'] = $output;
}

function convert_to_date_field($date, $format = 'Y-m-d h:i:s') {
 $date = strtotime($date);
 $data = date($format, $date);
  return (object) array(
    'value' => $date,
    'timezone_db' => 'America/New_York',
    'date_type' => 'datetime',
  );
}

function gavias_gito_preprocess_node__event(&$variables){
  $node = $variables['node'];

  if($node->hasField('field_event_start')){
    $event_date = $node->field_event_start->value;
    $config = \Drupal::config('system.date');
     
    $userTimezone = new DateTimeZone($config->get('timezone.default'));
    $gmtTimezone = new DateTimeZone('GMT');
    $myDateTime = new DateTime($node->field_event_start->value, $gmtTimezone);
    $offset = $userTimezone->getOffset($myDateTime);
    $myInterval = DateInterval::createFromDateString((string)$offset . 'seconds');
    $myDateTime->add($myInterval);
    $result = $myDateTime->format('m-d-Y-H-i-s');
    $variables['event_date'] = $result;
  }
}

function gavias_gito_preprocess_breadcrumb(&$variables){
  $variables['#cache']['max-age'] = 0;
  
  $request = \Drupal::request();
  $title = '';
  if ($route = $request->attributes->get(\Symfony\Cmf\Component\Routing\RouteObjectInterface::ROUTE_OBJECT)) {
    $title = \Drupal::service('title_resolver')->getTitle($request, $route);
  }

  if($variables['breadcrumb']){
     foreach ($variables['breadcrumb'] as $key => &$value) {
      if($value['text'] == 'Node'){
        unset($variables['breadcrumb'][$key]);
      }
    }

    if(!empty($title)){
      $variables['breadcrumb'][] = array(
        'text' => ''
      );
      $variables['breadcrumb'][] = array(
        'text' => $title
      );  
    }  
  }
}