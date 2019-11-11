<?php
namespace Ktpl\General\Plugin\Checkout\Block\Checkout\AttributeMerger;

class Plugin
{
  public function afterMerge(\Magento\Checkout\Block\Checkout\AttributeMerger $subject, $result)
  {
    if (array_key_exists('street', $result)) {
        $result['street']['children'][0]['placeholder'] = __('No P.O. Boxes');
        $result['street']['children'][0]['label'] = __('Street Address 1');
        $result['street']['children'][1]['placeholder'] = __('Apartment, Suite, Unit, Building, Floor, etc.');
        $result['street']['children'][1]['label'] = __('Address 2');
        $result['street']['label'] = null;
        $result['street']['required'] = 0;
    }

    if (array_key_exists('company', $result)) {
        $result['company']['placeholder'] = __('(Optional)');
        $result['company']['label'] = __('Company Name');
    }
    
    if (array_key_exists('firstname', $result)) {
        $result['firstname']['additionalClasses'] = 'half-width half-first-row';
    }

    if (array_key_exists('lastname', $result)) {
        $result['lastname']['additionalClasses'] = 'half-width half-first-row';
    }

    if (array_key_exists('region_id', $result)) {
        $result['region_id']['additionalClasses'] = 'half-width half-third-row';
    }

    if (array_key_exists('region', $result)) {
        $result['region']['additionalClasses'] = 'half-width half-third-row';
    }

    if (array_key_exists('city', $result)) {
        $result['city']['additionalClasses'] = 'half-width half-third-row city-field-custom';
    }

    if (array_key_exists('country_id', $result)) {
        $result['country_id']['additionalClasses'] = 'half-width half-second-row';
    }
    
    if (array_key_exists('postcode', $result)) {
        $result['postcode']['additionalClasses'] = 'half-width half-second-row';
    }

    if (array_key_exists('telephone', $result)) {
        $result['telephone']['placeholder'] = __('(XXX) XXX-XXXX');
        $result['telephone']['label'] = __('Telephone');
        $result['telephone']['additionalClasses'] = 'half-width half-tel';
    }    
    return $result;
  }
}