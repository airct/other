<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Google OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Google extends OAuth2_Provider
{
	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';

	/**
	 * @var  string  scope separator, most use "," but some like Google are spaces
	 */
	public $scope_seperator = ' ';

	public function url_authorize()
	{
		return 'https://accounts.google.com/o/oauth2/auth';
	}

	public function url_access_token()
	{
		return 'https://accounts.google.com/o/oauth2/token';
	}

	public function __construct(array $options = array())
	{

		// Now make sure we have the default scope to get user data
		
		// other option
		// https://www.googleapis.com/auth/userinfo.profile 
		// https://www.googleapis.com/auth/userinfo.email
		// https://www.googleapis.com/auth/plus.me
			
		empty($options['scope']) and $options['scope'] = array(
			"https://www.googleapis.com/auth/plus.login" 
		);
	
		// Array it if its string
		$options['scope'] = (array) $options['scope'];
		
		parent::__construct($options);
	}

	/*
	* Get access to the API
	*
	* @param	string	The access code
	* @return	object	Success or failure along with the response details
	*/	
	public function access($code, $options = array())
	{
		if ($code === null)
		{
			throw new OAuth2_Exception(array('message' => 'Expected Authorization Code from '.ucfirst($this->name).' is missing'));
		}

		return parent::access($code, $options);
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://www.googleapis.com/plus/v1/people/me?'.http_build_query(array(
			'access_token' => $token->access_token,
		));
		
		$user = json_decode(file_get_contents($url), true);
		
		/**
		 * sample
		 *
		 * [kind] => plus#person
		 * [etag] => "RVZ_f1bhF-B19rh4H4M0uhzoFng/BMOIZ_DmHX3p5FVJyTR_dfqFsAQ"
		 * [nickname] => CC
		 * [gender] => male
		 * [objectType] => person
		 * [id] => 110949978290604166581
		 * [displayName] => mingaou yang (CC)
		 * [name] => Array
		 * 	(
		 * 		[familyName] => yang
		 * 		[givenName] => mingaou
		 * 	)
         * 
		 * [url] => https://plus.google.com/110949978290604166581
		 * [image] => Array
		 * 	(
		 * 		[url] => https://lh5.googleusercontent.com/-Pi-nboSEUTk/AAAAAAAAAAI/AAAAAAAAAFk/F2Ku4hlQdX0/photo.jpg?sz=50
		 * 	)
         * 
		 * [isPlusUser] => 1
		 * [language] => zh_TW
		 * [ageRange] => Array
		 * 	(
		 * 		[min] => 21
		 * 	)
         * 
		 * [verified] => 
		 */
		
		return array(
			'uid' => $user['id'],
			'kind' => $user['kind'],
			'etag' => $user['etag'],
			'nickname' => $user['nickname'],
			'gender' => $user['gender'],
			'objectType' => $user['objectType'],
			'displayName' => $user['displayName'],
			'name' => $user['name'],
			'url' => $user['url'],
			'displayName' => $user['displayName'],
			'image' => $user['image'],
			'displayName' => $user['displayName'],
			'isPlusUser' => $user['isPlusUser'],
			'ageRange' => $user['ageRange'],
			'verified' => (isset($user['verified'])) ? $user['verified'] : null,
			'language' => $user['language']
			
		);
	}
	
	
	public function get_user_friends(OAuth2_Token_Access $token)
	{
		$url = 'https://www.googleapis.com/plus/v1/people/me/people/visible?'.http_build_query(array(
			'access_token' => $token->access_token
		));
		
		$friends = json_decode(file_get_contents($url), true);

		return array(
			'kind' => $friends['kind'],
			'etag' => $friends['etag'],
			'title' => $friends['title'],
			'totalItems' => $friends['totalItems'],
			'friends' => $friends['items'],
		);
	}
}
