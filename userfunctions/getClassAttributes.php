<?

//include_once('kernel/classes/datatypes/ezcountry/ezcountrytype.php');

// Quick and dirty way to get the contents of an xml string.
function getClassAttributes( $attribute_names = array() )
{
	$debug = false;
	
	$db = eZDb::instance();
	$ret = array();
	$result = array();
	$result2 = array();

	if (count($attribute_names)>1) {
		foreach ($attribute_names as $key => $attribute_name) {
			$sql = "SELECT tmp.id, tmp.identifier from (select ezcontentclass.id, ezcontentclass.identifier from ezcontentclass,ezcontentclass_attribute where (ezcontentclass.id=ezcontentclass_attribute.contentclass_id AND ezcontentclass_attribute.identifier='servizio')) as tmp, ezcontentclass_attribute where tmp.id=ezcontentclass_attribute.contentclass_id AND ezcontentclass_attribute.identifier='argomento'";
			$ret[] = $db->arrayQuery( $sql );
		}
	} else {
		foreach ($attribute_names as $key => $attribute_name) {
			$sql = "SELECT ezcontentclass.id, ezcontentclass.identifier 
			FROM ezcontentclass_attribute, ezcontentclass 
			WHERE ezcontentclass.id=ezcontentclass_attribute.contentclass_id 
			AND ezcontentclass_attribute.identifier='" . $attribute_name . "'";
			$ret[] = $db->arrayQuery( $sql );
		}
	}

	if ( $debug )
        ezDebug::writeNotice( $ret[0], 'getClassAttributes: risultato per '.implode(',', $attribute_names) );
		
		return $ret[0];

}

?>
