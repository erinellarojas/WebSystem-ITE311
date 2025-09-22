if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
    // save user data to session
    session()->set([
        'id'         => $user['id'],
        'name'       => $user['name'],
        'email'      => $user['email'],
        'role'       => $user['role'],
        'isLoggedIn' => true
    ]);

    // role-based redirection
    if ($user['role'] == 'admin') {
        return redirect()->to('/admin/dashboard');
    } elseif ($user['role'] == 'teacher') {
        return redirect()->to('/teacher/dashboard');
    } else {
        return redirect()->to('/student/dashboard');
    }
} else {
    return redirect()->back()->with('error', 'Invalid login credentials');
}
