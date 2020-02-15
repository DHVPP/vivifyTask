<?php

namespace App\Http\Repositories\Concrete;

use App\Models\Url;
use Illuminate\Database\Eloquent\Model;
use App\Http\Repositories\Absr\IUrlRepository;
/**
 * Class UrlRepository
 * @package App\Http\Repositories\Concrete
 */
class UrlRepository implements IUrlRepository
{
    /**
     * @var Url
     */
    protected $model;

    /**
     * UrlRepository constructor.
     * @param Url $model
     */
    public function __construct(Url $model)
    {
        $this->model = $model;
    }

    /**
     * Check if the user has saved the url
     *
     * @param int $idUser
     * @param string $url
     * @return Model|null
     */
    public function check(int $idUser, string $url): ?Url
    {
        $url = $this->model->where('idUser', $idUser)->where('url', $url)->first();
        return $url;
    }

    /**
     * Method for saving the url
     *
     * @param array $data
     * @return Url
     */
    public function saveUrl(array $data): Url
    {
        return $this->model->create($data);
    }

    /**
     * Delete the given url
     *
     * @param Url $url
     * @return bool
     * @throws \Exception
     */
    public function deleteUrl(Url $url): bool
    {
        return $url->delete();
    }

    /**
     * Count url usage
     *
     * @param string $url
     * @return int
     */
    public function urlCount(string $url): int
    {
        return $this->model->where('url', $url)->count();
    }

    /**
     * Find the real url from the short one
     *
     * @param string $shortUrl
     * @return Url|null
     */
    public function findByShortUrl(string $shortUrl): ?Url
    {
        return $this->model->where('shortUrl', $shortUrl)->first();
    }
}
