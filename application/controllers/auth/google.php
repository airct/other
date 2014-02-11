<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Google extends CI_Controller
{

    public function index()
    {
        $this->load->helper('url_helper');
		
		$this->load->library('OAuth/OAuth2');
		
		$providerType = "google";
		
        $provider = $this->oauth2->provider($providerType, array(
            'id' => 'google_secret_id',
            'secret' => 'google_secret_key',
        ));

        if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        {
            // Howzit?
            try
            {
                $token = $provider->access($_GET['code']);

                $user = $provider->get_user_info($token);
                // $user_friends = $provider->get_user_friends($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                // echo "<pre>Tokens: ";
                // var_dump($token);

                // echo "\n\nUser Info: ";
				
				$this->load->model('User_model', 'user');
				
				if(!$this->user->exist($user['uid'], $providerType)) {
					
					$user_data['facebook_id'] = ''; 
					$user_data['google_id'] = $user['uid']; 
					
					$user_id = $this->user->regsister($user_data);
				} else {
					$user_id = $this->user->get_user_id($user['uid'], $providerType);
					
					$this->user->login($user_id);
				}
				
				
				$gt_token = array( 	"token" => $token,
									"provider" => $providerType, 
									"user_id" => $user_id );
				/**/
				
				//$this->session->set_userdata(array_merge($user, $gt_token));
				
				//$this->session->set_userdata('user_favorite', $user_favorite);
				
				redirect("/"); 
            }
            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }
}
?>