<?php

function oc_item_search_filters(array $params = null)
{
    if ($params === null) {
        $request = Zend_Controller_Front::getInstance()->getRequest(); 
        $requestArray = $request->getParams();
    } else {
        $requestArray = $params;
    }
    
    $db = get_db();
    $displayArray = array();
    foreach ($requestArray as $key => $value) {
        $filter = $key;
        if($value != null) {
            $displayValue = null;
            switch ($key) {
                case 'type':
                    $filter = 'Item Type';
                    $itemType = $db->getTable('ItemType')->find($value);
                    if ($itemType) {
                        $displayValue = $itemType->name;
                    }
                    break;
                
                case 'collection':
                    $collection = $db->getTable('Collection')->find($value);
                    if ($collection) {
                        $displayValue = strip_formatting(
                            metadata(
                                $collection,
                                array('Dublin Core', 'Title'),
                                array('no_escape' => true)
                            )
                        );
                    }
                    break;

                case 'user':
                    $user = $db->getTable('User')->find($value);
                    if ($user) {
                        $displayValue = $user->name;
                    }
                    break;

                case 'public':
                case 'featured':
                    $displayValue = ($value == 1 ? __('Yes') : $displayValue = __('No'));
                    break;
                    
                case 'site_title':
                    $filter = 'Site';
                    $displayValue = $value;
                    break;
                    
                case 'site_collection_id':
                    $filter = 'Site Collection';
                    $siteCollection = get_db()->getTable('SiteContext_Collection')->find($value);
                    $displayValue = $siteCollection->title;
                    break;

                case 'search':
                    $filter = 'Keyword';
                    $displayValue = $value;
                    break;

                case 'tags':
                case 'range':
                    $displayValue = $value;
                    break;
            }
            if ($displayValue) {
                $displayArray[$filter] = $displayValue;
            }
        }
    }

    $displayArray = apply_filters('item_search_filters', $displayArray, array('request_array' => $requestArray));
    
    // Advanced needs a separate array from $displayValue because it's
    // possible for "Specific Fields" to have multiple values due to 
    // the ability to add fields.
    if(array_key_exists('advanced', $requestArray)) {
        $advancedArray = array();
        foreach ($requestArray['advanced'] as $i => $row) {
            if (!$row['element_id'] || !$row['type']) {
                continue;
            }
            $elementID = $row['element_id'];
            $elementDb = $db->getTable('Element')->find($elementID);
            $element = $elementDb->name;
            $type = $row['type'];
            $terms = $row['terms'];
            $advancedValue = $element . ' ' . $type;
            if ($terms) {
                $advancedValue .= ' "' . $terms . '"';
            }
            $advancedArray[$i] = $advancedValue;
        }
    }

    $html = '';
    if (!empty($displayArray) || !empty($advancedArray)) {
        $html .= '<div id="item-filters">';
        $html .= '<ul>';
        foreach($displayArray as $name => $query) {
            $html .= '<li class="' . $name . '">' . html_escape(ucfirst($name)) . ': ' . html_escape($query) . '</li>';
        }
        if(!empty($advancedArray)) {
            foreach($advancedArray as $j => $advanced) {
                $html .= '<li class="advanced">' . html_escape($advanced) . '</li>';
            }
        }
        $html .= '</ul>';
        $html .= '</div>';
    }
    return $html;
}

?>