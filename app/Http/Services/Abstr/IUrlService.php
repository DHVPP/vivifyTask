<?php

namespace App\Http\Services\Abstr;

use Illuminate\Http\JsonResponse;

/**
 * Interface IUrlService
 * @package App\Http\Services\Abstr
 */
interface IUrlService
{
    /**
     * Method for saving the url
     *
     * @param string $url
     * @param int $idUser
     * @return JsonResponse
     */
    public function saveUrl(string $url, int $idUser): JsonResponse;

    /**
     * Method for deleting the url
     *
     * @param string $url
     * @param int $idUser
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteUrl(string $url, int $idUser): JsonResponse;

    /**
     * Method for counting different users of the same url
     *
     * @param string $url
     * @return JsonResponse
     */
    public function countUrlDuplicates(string $url): JsonResponse;

    /**
     * Redirect user from the short url
     *
     * @param string $shortUrl
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToShortUrl(string $shortUrl);
}
