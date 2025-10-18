<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('role');
        $uri = service('uri')->getPath();

        if($role === 'admin' && !str_starts_with($uri, 'admin')) {
            return redirect()->to('/announcements')->with('error','Access Denied: Insufficient Permissions');
        }

        if($role === 'teacher' && !str_starts_with($uri, 'teacher')) {
            return redirect()->to('/announcements')->with('error','Access Denied: Insufficient Permissions');
        }

        if($role === 'student' && !($uri === 'announcements' || str_starts_with($uri,'student'))) {
            return redirect()->to('/announcements')->with('error','Access Denied: Insufficient Permissions');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
}
