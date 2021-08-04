<?php
/**
 * Template for Section2 display of More Info Fields
 * @since 1.7.3.2
 * 
 */

$register_section_2_name = get_option( 'register_section_2_name', 'Section 2' );
?>

<div id="tab3" class="tab-content">

<?php

if( !empty(  $field_rows_section2 ) )
{
    $section_holder = '';	
    if($ndf_meta_field_data2_has){
        echo '<div class="field-group-title">'.$register_section_2_name.'</div>';
    }
   
    foreach($field_rows_section2 as $field_row)
    {
        $ndf_more_info_value = '';
        $fields_holder = '';
        $ndf_meta_field_data = ndf_data_settings_get_meta( 'ndf_fields_'.$field_row->ID, $id );
        if( $field_row->field_type == 'section' ){
            $section_holder .= '<div class="frxp-grid test">';
                $section_holder .= '<div class="frxp-width-1-1 title full">';
                    $section_holder .= $NDFFieldGenerator->generateField( 
                    $field_row->field_type,  $field_row->label, $field_row->field_values, $field_row->default_value, $field_row->required, $field_row->field_values, $field_row->default_value
                    );
                $section_holder .= '</div>';
            $section_holder .= '</div>';
        }

        if( $ndf_meta_field_data ){
            $name_holder = '';
            $name_fields_holder = '';
            if( $field_row->field_type == 'name' ){
                $name_fields_holder .= '<div class="frxp-grid name-fields">';
                    $name_fields_holder .= '<div class="frxp-width-1-1 title full"><strong>'.$field_row->label.'</strong></div>';
                    foreach(unserialize($ndf_meta_field_data) as $label => $value){
                        if(!empty($value)){
                            $name_fields_holder .= '<div class="frxp-grid-name-fields">';
                            $name_fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  frxp-flex  title"><strong>'.$label.'</strong></div>';
                            $name_fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  data">'.$value.'</div>';
                            $name_fields_holder .= '</div>';
                        }
                    }
                $name_fields_holder .= '</div>';
                if( !empty( $name_fields_holder ) ){
                    echo $name_fields_holder;
                }
            } 
            else{
                if( $field_row->field_type == 'checkbox' || $field_row->field_type == 'list' ){
                    $list_class = 'ndf_list_pill';
                    $ndf_meta_field_data = get_post_meta( $id, 'ndf_fields_'.$field_row->ID, false );
                }
                
                if( !empty( $ndf_meta_field_data ) ){
                    if( is_array( $ndf_meta_field_data ) ){
                        
                        $ndf_more_info_value = '<ul class="'.$list_class.'">';
                        foreach( $ndf_meta_field_data as $value ){
                            $ndf_more_info_value .= "<li>$value</li>";
                        }
                        $ndf_more_info_value .= '</ul>';
                    }
                    else{
                        $ndf_more_info_value = $ndf_meta_field_data;
                        if( $field_row->field_type == 'image_upload' ){
                            $ndf_more_info_value = '<img src="'.esc_url($ndf_meta_field_data).'">';
                        }
                        else if( $field_row->field_type == 'address' ){
                            $ndf_more_info_value = '<address>'.$ndf_meta_field_data.'</address>';
                        }
                        else if( $field_row->field_type == 'dropdown' ){
                            $ndf_more_info_value = $NDFFieldGenerator->generateField( 
                            'dropdown_label',  $field_row->label, $field_row->field_values, $field_row->default_value, $field_row->required, $field_row->field_values, $ndf_meta_field_data
                            );
                        }
                        else if( $field_row->field_type == 'radio_button' ){
                            $ndf_more_info_value = $NDFFieldGenerator->generateField( 
                            'radio_button_label',  $field_row->label, $field_row->field_values, $field_row->default_value, $field_row->required, $field_row->field_values, $ndf_meta_field_data
                            );
                        }
                        else if( $field_row->field_type == 'website' ){
                            $ndf_more_info_value = '<a href="'.esc_url( $ndf_meta_field_data ).'" target="_blank">'.$ndf_meta_field_data.'</a>';
                        }
                        else if( $field_row->field_type == 'text_editor' ){
                            $ndf_more_info_value = do_shortcode($ndf_meta_field_data);
                        }
                        else if( $field_row->field_type == 'email' ){
                            $ndf_more_info_value = '<a target="_blank" href="mailto:'.do_shortcode($ndf_meta_field_data).'" >'.do_shortcode($ndf_meta_field_data).'</a>';
                        }
                    }
                    if($field_row->field_type == 'text_editor'){
                        $fields_holder .= '<div class="frxp-grid-text-editor">';
                        $fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  frxp-flex  title"><strong>'.$field_row->label.'</strong></div>';
                        $fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  data">'.$ndf_more_info_value.'</div>';
                    $fields_holder .= '</div>';
                    }
                    else{
                        $fields_holder .= '<div class="frxp-grid">';
                        $fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  frxp-flex  title"><strong>'.$field_row->label.'</strong></div>';
                        $fields_holder .= '<div class="frxp-width-1-1 frxp-width-small-1-1  data">'.$ndf_more_info_value.'</div>';
                    $fields_holder .= '</div>';
                    }
                }
                if( !empty( $fields_holder ) ){
                    echo $section_holder.$fields_holder;
                    $section_holder = '';
                }
            }
        }

    }
}

?>
</div>
