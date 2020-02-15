<?php


namespace App\Http\Repositories\Absr;


use App\Models\Url;
use Illuminate\Database\Eloquent\Model;

interface IUrlRepository
{
    /**
     * Check if the user has saved the url
     *
     * @param int $idUser
     * @param string $url
     * @return Model|null
     */
    public function check(int $idUser, string $url): ?Url;

    /**
     * Method for saving the url
     *
     * @param array $data
     * @return Url
     */
    public function saveUrl(array $data): Url;

    /**
     * Delete the given url
     *
     * @param Url $url
     * @return bool
     * @throws \Exception
     */
    public function deleteUrl(Url $url): bool;

    /**
     * Count url usage
     *
     * @param string $url
     * @return int
     */
    public function urlCount(string $url): int;

    /**
     * Find the real url from the short one
     *
     * @param string $shortUrl
     * @return Url|null
     */
    public function findByShortUrl(string $shortUrl): ?Url;
}
