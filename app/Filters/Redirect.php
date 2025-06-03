<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class Redirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Do something make money here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //something here
        // Do something here
        if (session()->has('isLoggedIn') && session()->get('isLoggedIn')) {
            // return redirect()->to('/faq');
            return redirect()->to(base_url('/faq'));
        }
    }
}
