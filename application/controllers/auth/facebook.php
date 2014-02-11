<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends CI_Controller
{

    public function index()
    {
        $this->load->helper('url_helper');

		$this->load->library('OAuth/OAuth2');
		
		$provider = "facebook";
		
        $provider = $this->oauth2->provider($provider, array(
            'id' => '327856124018218',
            'secret' => '48a84803d5a45870e9f4fc1e517feb43',
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

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>Tokens: ";
                var_dump($token);

                echo "\n\nUser Info: ";
                var_dump($user);
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }
}
?>