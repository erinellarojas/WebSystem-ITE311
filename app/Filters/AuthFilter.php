<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error','Please login to access that page.');
        }

        if (! empty($arguments)) {
            $role = $session->get('role');
            if (! in_array($role, $arguments)) {
                return redirect()->to('/dashboard')->with('error','Unauthorized access.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
