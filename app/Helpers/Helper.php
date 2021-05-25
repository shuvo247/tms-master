<?php 

namespace App\Helpers;


class Helper {
    // Make Slug Attribute
    public static function makeSlug($string){
        $slug = trim($string); // trim the string
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // only take alphanumerical characters, but keep the spaces and dashes too...
        $slug= str_replace(' ','-', $slug); // replace spaces by dashes
        $slug= strtolower($slug);  // make it lowercase
        return $slug;
    }
    // Get SFT in a PCS from using Size
    public static function SftInAPcs($size){
        $getAttributeValue = \App\Models\AttributeValue::where('id',$size)->first();
        $getInchCM = preg_split('#(?<=\d)(?=[a-z])#i',$getAttributeValue->attribute_value);
        preg_match_all('/\d+(\.\d+)?/',$getAttributeValue->attribute_value,$matches);
        $getSftInAPcs = $matches[0][0]*$matches[0][1];
        if ($getInchCM[2] == 'CM' || $getInchCM[2] == 'cm' || $getInchCM[2] == 'centimetre' || $getInchCM[1] == 'CM' || $getInchCM[1] == 'cm' || $getInchCM[1] == 'centimetre') {
            $getSftInAPcs = ($matches[0][0])/2.54*($matches[0][1])/2.54;
        }
        return $getSftInAPcs;
    }
}
