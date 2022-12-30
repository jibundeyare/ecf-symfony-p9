<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class UserVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    private ?Security $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on `User` objects
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a User object, thanks to `supports()`
        /** @var User $userSubject */
        $userSubject = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($userSubject, $user);
            case self::EDIT:
                return $this->canEdit($userSubject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(User $userSubject, User $user): bool
    {
        // on utilise la même logique pour la lecture et l'écriture des données
        return $this->canEdit($userSubject, $user);
    }

    private function canEdit(User $userSubject, User $user): bool
    {
        // l'utilistateur admin a toutes les permissions
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        // les profiles emprunteurs ne peuvent accéder qu'au compte utilistateur qui leur appartient
        if ($this->security->isGranted('ROLE_EMPRUNTEUR')
            && $user === $userSubject
        ) {            
            return true;
        }

        // aucun autre utilisateur ne peut avoir accès au compte utilistateur
        return false;
    }
}
