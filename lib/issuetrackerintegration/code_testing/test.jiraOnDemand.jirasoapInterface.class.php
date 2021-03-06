<?php
/**
 * TestLink Open Source Project - http://testlink.sourceforge.net/ 
 *
 * @filesource	test.jirasoapInterface.class.php
 * @author		Francisco Mancardi
 *
 * @internal revisions
 *
**/
require_once('../../../config.inc.php');
require_once('common.php');

$it_mgr = new tlIssueTracker($db);
$itt = $it_mgr->getTypes();

// last test ok: 20121117
$cfg =  "<issuetracker>\n" .
		"<username>testlink.forum</username>\n" .
		"<password>forum</password>\n" .
		"<uribase>http://testlink.atlassian.net/</uribase>\n" .
		"<uriwsdl>http://testlink.atlassian.net/rpc/soap/jirasoapservice-v2?wsdl</uriwsdl>\n" .
		"<uriview>http://testlink.atlassian.net/browse/</uriview>\n" .
		"<uricreate>http://testlink.atlassian.net/secure/CreateIssue!default.jspa</uricreate>\n" .
        "<projectkey>ZOFF</projectkey>\n" .
        "<issuetype>1</issuetype>\n" .
		"<attributes><components><id>10100</id><id>10101</id></components>\n" .
		"</attributes>\n" .
		"</issuetracker>\n";

echo '<hr><br>';
echo "<b>Testing  BST Integration - jirasoapInterface </b>";
echo '<hr><br>';
echo "Configuration settings<br>";
echo "<pre><xmp>" . $cfg . "</xmp></pre>";

echo '<hr><br><br>';

// $safe_cfg = str_replace("\n",'',$cfg);
// echo $safe_cfg;
echo 'Creating INTERFACE<br>';

new dBug($itt);
$its = new jirasoapInterface(5,$cfg);

echo 'Connection OK?<br>';
var_dump($its->isConnected());

if( $its->isConnected() )
{
  echo 'Get Issue Summary<br>';
	var_dump($its->getIssue('ZOFF-25'));
  echo '<br>';

	// echo '<b>Connected !</br></b>';
	// echo '<pre>';
	// var_dump($its->getStatusDomain());
	// echo '</pre>';
  echo 'Get Issue Summary<br>';
	echo($its->getIssueSummary('ZOFF-16'));
  echo '<br>';

	
// I've seen things you people wouldn't believe. 
// Attack ships on fire off the shoulder of Orion. 
// I watched C-beams glitter in the dark near the Tannhauser gate. 
// All those moments will be lost in time... like tears in rain... Time to die. 	
//
  //$issue = array('project' => 'ZOFF','summary' => 'My Firts ISSUE VIA API',
  //               'description' => 'Do Androids Dream of Electric Sheep?',
  //               'type' => 1, 'components' => array( array('id' => '10100'), array('id' => '10101')));
  // $zorro = $its->addIssueFromArray($issue);
  // var_dump($zorro);
  $issue = array('summary' => 'Issue Via API 2013-02-04','description' => 'Do Androids Dream of Electric Sheep?');
  //               'type' => 1, 'components' => array( array('id' => '10100'), array('id' => '10101')));
  
  $zorro = $its->addIssue($issue['summary'],$issue['description']);
  var_dump($zorro);


	/*
	$issue2check = array( array('issue' => 'TLJIRASOAPINTEGRATION-1', 'exists' => true),
	  					  array('issue' => 'TLJIRASOAPINTEGRATION-199999', 'exists' => false));

	*/

}
?>