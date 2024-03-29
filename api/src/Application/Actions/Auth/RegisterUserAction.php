<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;

use Exception;
use App\Domain\User\User;
use App\Domain\User\UserAlreadyExistsException;
use App\Domain\User\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use ReallySimpleJWT\Token;

class RegisterUserAction extends AuthAction
{
    /**
     * {@inheritdoc}
     * @throws UserAlreadyExistsException
     */
    protected function action(): Response
    {
        if (!$this->isGuest()) {
            throw new Exception("Sie sind bereits angemeldet.");
        }

        $data = $this->getFormData();

        if (empty($data['username']) || empty($data['full_name']) ||
            empty($data['password']) || empty($data['conf_password'])) {
            throw new Exception("Erforderliche Felder fehlen.");
        }

        if ($data['password'] !== $data['conf_password']) {
            throw new Exception("Passwort stimmt nicht überein");
        }

        $user = $this->userRepository->findUserOfUsername($data['username']);

        if ($user) {
            throw new UserAlreadyExistsException();
        }

        $user = $this->userRepository->store($data);

        $token = $this->createCustomerToken($user);

        return $this->respondWithData(['user' => $user, 'token' => $token]);
    }

}
