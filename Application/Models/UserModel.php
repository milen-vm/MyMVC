<?php
namespace MyMVC\Application\Models;

use MyMVC\Library\MVC\BaseModel;

class UserModel extends BaseModel
{
    public function register($username, $pasword, $email)
    {
        $db = $this->getDb();
    }

    public function login($params)
    {
        if (!isset($params['email'], $params['password'])) {
        	throw new \Exception('Login parameter is missing', 400);
        }

        $email = $params['email'];
        $pass = $params['password'];

        $statement =
            'SELECT
            	u.id,
                u.name,
                u.email,
                u.password,
                r.name AS role
            FROM users AS u
            	LEFT JOIN roles AS r
                ON u.role_id = r.id
            WHERE u.email = ?';

        $result = $this->db->prepare($statement);

        $result->execute([$email]);

        if ($result->rowCount() == 0) {
            throw new \Exception('Invalid email.', 400);
        }

        $userRow = $result->fetch();

        if ($pass == $userRow['password']) {
            return [
                'id' => $userRow['id'],
                'name' => $userRow['name'],
                'role' => $userRow['role']
            ];
        }

        throw new \Exception('Invalid password.');
    }
}