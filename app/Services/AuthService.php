<?php

namespace App\Services;

use App\Models\UserSession;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class AuthService
{
    /**
     * @var User|null
     */
    private $user;

    /**
     * @var UserSession|null
     */
    private $session;

    /**
     * @var bool
     */
    private $valid = false;

    /**
     * @var array
     */
    private $config = ['cookie_life' => null];

    /**
     * @var Request
     */
    private $request;

    /**
     * Ідентифікатор сесії залогіненого користувача
     * Таблиця user_sessions
     *
     * @var string|null
     */
    private $_session_id;

    /**
     * Ключ сесії конкретного залогіненого користувача
     * Таблиця user_sessions
     *
     * @var string|null
     */
    private $_session;

    /**
     * AuthService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // записуємо Реквест
        $this->request = $request;

        // Конфігурація
        $this->config['cookie_life'] = config('app.cookie_life', 60 * 60);

        // якщо є куки з даними ключа сесії
        if ($request->hasCookie('session'))
            $this->_session = $request->cookie('session');

        // якщо є куки з даними ідентифікатора сесії
        if ($request->hasCookie('session_id'))
            $this->_session_id = $request->cookie('session_id');

        // загрузка сервіса
        $this->boot($request);
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function is_auth(): bool
    {
        return $this->valid;
    }

    /**
     * @throws Exception
     * @return void
     */
    public function exit(): void
    {
        if (!is_null($this->session))
            $this->session->delete();

        setcookie('session_id', '', time() - 3600 * 24 * 385, '/');
        setcookie('session', '', time() - 3600 * 24 * 385, '/');
    }

    /**
     * Загрузка сервіса
     *
     * @param Request $request
     * @return void
     */
    private function boot(Request $request): void
    {
        // якщо в куках є дані про сесію
        if (!is_null($this->_session) && !is_null($this->_session_id)) {

            // получаємо сесію
            $user_session = UserSession::find($this->_session_id);

            if (!is_null($user_session)) {

                // получаємо юзера(з сесії)
                $user = $user_session->user;

                // формуємо хеш(пароль, номер телефону, юзерагент, айпі адрес)
                $hash = $this->hashPrepare($user, $request);

                // Провіряємо хеш на правдивість
                if ($this->hashCheck($hash, $this->_session) && $this->hashCheck($hash, $user_session->ssid)) {
                    // Запамятовуємо юзера в контейнер
                    $this->user = $user;

                    // Запамятовуємо сесію в контейнер
                    $this->session = $user_session;

                    // валідація успішна
                    $this->valid = true;
                } else {
                    // валідація провальна
                    $this->valid = false;
                }
            } else {
                $this->valid = false;
            }
        } else {
            // валідація провальна
            $this->valid = false;
        }
    }

    /**
     * @param string $string
     * @return string
     */
    public function hashMake(string $string): string
    {
        return Hash::make($string);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function hashPrepare(User $user, Request $request): string
    {
        // Підготовка для створення хешу: Пароль, Номер телефону, Агент, Айпі адреса
        return $user->password . $user->phone . $request->server('USER_AGENT') . $request->ip();
    }

    /**
     * @param string $hash
     * @param string $ssid
     * @return bool
     */
    public function hashCheck(string $hash, string $ssid): bool
    {
        // Порівняння хешу
        return Hash::check($hash, $ssid);
    }

    /**
     * @param User $user
     * @param $request
     * @param bool $remember
     */
    public function make(User $user, $request, bool $remember = true): void
    {
        // Зберігаємо сесію в базу даних
        $user_session = new UserSession;
        $user_session->ssid = $this->hashMake($this->hashPrepare($user, $request));
        $user_session->user_id = $user->id;
        $user_session->save();

        // життя сесії в куках
        $cookie_life = $remember ? time() + $this->config['cookie_life'] : null;

        // Зберігаємо дані сесії в куки
        setcookie('session_id', $user_session->id, $cookie_life, '/');
        setcookie('session', $user_session->ssid, $cookie_life, '/');

        // Обновляємо ідентифікатори сесії
        $this->_session = $user_session->ssid;
        $this->_session_id = $user_session->id;

        // Перезагружаємо сервіс
        $this->boot($this->request);

    }
}