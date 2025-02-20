<?php 
namespace App\Services;


class GravatarService
{
    private string $email;
    private int $size;
    private string $default;

    public function __construct(string $email, int $size = 80, string $default = 'mm')
    {
        $this->email = strtolower(trim($email));
        $this->size = $size;
        $this->default = $default;
    }

    public function getGravatarUrl(): string
    {
        $hash = md5($this->email);
        return "https://www.gravatar.com/avatar/{$hash}?s={$this->size}&d={$this->default}";
    }

}