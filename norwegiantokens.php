<?php

require_once 'norwegiantokens.civix.php';
use CRM_Norwegiantokens_ExtensionUtil as E;

/**
 * Implements hook_civicrm_token
 */
function norwegiantokens_civicrm_tokens(&$tokens) {
	$tokens['norsk'] = array(
		'norsk.today' => E::ts('Todays date'),
	  'norsk.pronoun_dudere' => E::ts('Pronoun du/dere'),
	  'norsk.pronoun_dudere_capital' => E::ts('Pronoun Du/Dere'),
	  'norsk.pronoun_degdere' => E::ts('Pronoun deg/dere'),
	  'norsk.pronoun_degdere_capital' => E::ts('Pronoun Deg/Dere'),
	  'norsk.pronoun_dinderes' => E::ts('Pronoun din/deres'),
	  'norsk.pronoun_dinderes_capital' => E::ts('Pronoun Din/Deres'),
	  'norsk.pronoun_dinederes' => E::ts('Pronoun dine/deres'),
	  'norsk.pronoun_dinederes_capital' => E::ts('Pronoun Dine/Deres'),
	);
}

/**
 * implementation of hook_civicrm_tokenValues
 * 
 * This function deletegates the tokens to the desired functions
 * 
 * @param type $values
 * @param type $cids
 * @param type $job
 * @param type $tokens
 * @param type $context
 */
function norwegiantokens_civicrm_tokenValues(&$values, $cids, $job = null, $tokens = array(), $context = null) {
	 if (!empty($tokens['norsk'])) {
    //token maf_tokens.today
		if (in_array('today', $tokens['norsk']) || array_key_exists('today', $tokens['norsk'])) {
			norwegiantokens_today($values, $cids, $job, $tokens,$context);
		}
		
    //pronoun tokens
    //
    // We want to say things like this:
    // «Thanks for your support, Jaap» or «Thanks for your support, Jaap and Erik»
    // In Nowegian that would be:
    // «Takk for din støtte, Jaap» eller «Takk for deres støtte, Jaap og Erik»
    // (And we want to use the different personal pronouns MANY times in the same letter)
    if (in_array('pronoun_dudere', $tokens['norsk']) ||
        in_array('pronoun_dudere_capital', $tokens['norsk']) ||
        in_array('pronoun_degdere', $tokens['norsk']) ||
        in_array('pronoun_degdere_capital', $tokens['norsk']) ||
        in_array('pronoun_dinderes', $tokens['norsk']) ||
        in_array('pronoun_dinderes_capital', $tokens['norsk']) ||
        in_array('pronoun_dinederes', $tokens['norsk']) ||
        in_array('pronoun_dinederes_capital', $tokens['norsk']) ||      
        array_key_exists('pronoun_dudere', $tokens['norsk']) ||
        array_key_exists('pronoun_dudere_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_degdere', $tokens['norsk']) ||
        array_key_exists('pronoun_degdere_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_dinderes', $tokens['norsk']) ||
        array_key_exists('pronoun_dinderes_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_dinederes', $tokens['norsk']) ||
        array_key_exists('pronoun_dinederes_capital', $tokens['norsk'])
        ) {
      norwegiantokens_pronouns($values, $cids, $job, $tokens,$context);
    }
	}
}

function norwegiantokens_pronouns(&$values, $cids, $job = null, $tokens = array(), $context = null) {
  	$contacts = implode(',', $cids);
    if (in_array('pronoun_dudere', $tokens['norsk']) ||
        in_array('pronoun_dudere_capital', $tokens['norsk']) ||
        in_array('pronoun_degdere', $tokens['norsk']) ||
        in_array('pronoun_degdere_capital', $tokens['norsk']) ||
        in_array('pronoun_dinderes', $tokens['norsk']) ||
        in_array('pronoun_dinderes_capital', $tokens['norsk']) ||
        in_array('pronoun_dinederes', $tokens['norsk']) ||
        in_array('pronoun_dinederes_capital', $tokens['norsk']) ||      
        array_key_exists('pronoun_dudere', $tokens['norsk']) ||
        array_key_exists('pronoun_dudere_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_degdere', $tokens['norsk']) ||
        array_key_exists('pronoun_degdere_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_dinderes', $tokens['norsk']) ||
        array_key_exists('pronoun_dinderes_capital', $tokens['norsk']) ||
        array_key_exists('pronoun_dinederes', $tokens['norsk']) ||
        array_key_exists('pronoun_dinederes_capital', $tokens['norsk'])
        ) {
      
      
      $dao = CRM_Core_DAO::executeQuery("SELECT * FROM `civicrm_contact` WHERE `id` IN (".$contacts.");");
      while ($dao->fetch()) {
        $cid = $dao->id;
				if (in_array($cid, $cids)) {
          if ($dao->contact_type == "Individual") {
            if (in_array('pronoun_dudere', $tokens['norsk']) || array_key_exists('pronoun_dudere', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dudere'] = "du";
            }
            if (in_array('pronoun_dudere_capital', $tokens['norsk']) || array_key_exists('pronoun_dudere_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dudere_capital'] = "Du";
            }            
            if (in_array('pronoun_degdere', $tokens['norsk']) || array_key_exists('pronoun_degdere', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_degdere'] = "deg";
            }
            if (in_array('pronoun_degdere_capital', $tokens['norsk']) || array_key_exists('pronoun_degdere_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_degdere_capital'] = "Deg";
            }
            if (in_array('pronoun_dinderes', $tokens['norsk']) || array_key_exists('pronoun_dinderes', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinderes'] = "din";
            }
            if (in_array('pronoun_dinderes_capital', $tokens['norsk']) || array_key_exists('pronoun_dinderes_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinderes_capital'] = "Din";
            }
            if (in_array('pronoun_dinederes', $tokens['norsk']) || array_key_exists('pronoun_dinederes', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinederes'] = "dine";
            }
            if (in_array('pronoun_dinederes_capital', $tokens['norsk']) || array_key_exists('pronoun_dinederes_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinederes_capital'] = "Dine";
            }
            
          } else {
            if (in_array('pronoun_dudere', $tokens['norsk']) || array_key_exists('pronoun_dudere', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dudere'] = "dere";
            }
            if (in_array('pronoun_dudere_capital', $tokens['norsk']) || array_key_exists('pronoun_dudere_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dudere_capital'] = "Dere";
            }
            if (in_array('pronoun_degdere', $tokens['norsk']) || array_key_exists('pronoun_degdere', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_degdere'] = "dere";
            }
            if (in_array('pronoun_degdere_capital', $tokens['norsk']) || array_key_exists('pronoun_degdere_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_degdere_capital'] = "Dere";
            }
            if (in_array('pronoun_dinderes', $tokens['norsk']) || array_key_exists('pronoun_dinderes', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinderes'] = "deres";
            }
            if (in_array('pronoun_dinderes_capital', $tokens['norsk']) || array_key_exists('pronoun_dinderes_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinderes_capital'] = "Deres";
            }
            if (in_array('pronoun_dinederes', $tokens['norsk']) || array_key_exists('pronoun_dinederes', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinederes'] = "deres";
            }
            if (in_array('pronoun_dinederes_capital', $tokens['norsk']) || array_key_exists('pronoun_dinederes_capital', $tokens['norsk'])) {
              $values[$cid]['norsk.pronoun_dinederes_capital'] = "Deres";
            }
          }
        }
      }
    }
}

/*
 * Returns the value of token norsk.today
 */
function norwegiantokens_today(&$values, $cids, $job = null, $tokens = array(), $context = null) {
  if (!empty($tokens['norsk'])) {
		if (in_array('today', $tokens['norsk']) || array_key_exists('today', $tokens['norsk'])) {
			$today = new DateTime();
			foreach ($cids as $cid) {
				$values[$cid]['norsk.today'] = _norwegiantokens_date_format($today);
			}
		}
  }
}

/**
 * Format a date to norwegian style
 * 
 * @param type $date
 * @return string
 */
function _norwegiantokens_date_format($date) {
	$month = _norwegiantokens_month_format($date);
	$str = $date->format('j').'. '.$month.' '.$date->format('Y');
	return $str;
}

/**
 * Format a month to norwegian style
 * 
 * @param type $date
 * @return string
 */
function _norwegiantokens_month_format($date) {
	$months = array (
		'1' => 'Januar',
		'2' =>'Februar', 
		'3' =>'Mars', 
		'4' =>'April', 
		'5' =>'Mai', 
		'6' =>'Juni',
		'7' =>'Juli',
		'8' =>'August',
		'9' =>'September',
		'10' =>'Oktober',
		'11' =>'November',
		'12' =>'Desember',
	);
	
	$month_nr = $date->format('n');
	$month = '';
	if (isset($months[$month_nr])) {
		$month = $months[$month_nr];
	}
	return $month;
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function norwegiantokens_civicrm_config(&$config) {
  _norwegiantokens_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function norwegiantokens_civicrm_xmlMenu(&$files) {
  _norwegiantokens_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function norwegiantokens_civicrm_install() {
  _norwegiantokens_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function norwegiantokens_civicrm_postInstall() {
  _norwegiantokens_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function norwegiantokens_civicrm_uninstall() {
  _norwegiantokens_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function norwegiantokens_civicrm_enable() {
  _norwegiantokens_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function norwegiantokens_civicrm_disable() {
  _norwegiantokens_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function norwegiantokens_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _norwegiantokens_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function norwegiantokens_civicrm_managed(&$entities) {
  _norwegiantokens_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function norwegiantokens_civicrm_caseTypes(&$caseTypes) {
  _norwegiantokens_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function norwegiantokens_civicrm_angularModules(&$angularModules) {
  _norwegiantokens_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function norwegiantokens_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _norwegiantokens_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function norwegiantokens_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function norwegiantokens_civicrm_navigationMenu(&$menu) {
  _norwegiantokens_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _norwegiantokens_civix_navigationMenu($menu);
} // */
